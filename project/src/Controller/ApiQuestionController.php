<?php

namespace App\Controller;
use App\Entity\Answer;
use App\Entity\Historicquestion;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\ChoiceValidator;



class ApiQuestionController extends AbstractController
{
    /**
     * @Route("/api/question", name="api_question_index", methods={"GET"})
     */
    public function index(QuestionRepository $questionRepository, NormalizerInterface $normalizer)
    {
        $questions=$questionRepository->findAll();
        $normalizedQuestions= $normalizer->normalize($questions);
        $json= json_encode($normalizedQuestions);
        $response= new Response($json, 200,["content-type"=>"application/json"]);
        return $response;

    }
    /**
     * @Route("/api/question", name="api_question_store", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $manager, ValidatorInterface $validator)
    {
        $json=$request->getContent();
        //$answers=json_decode($json)->answers;
        try {
            $question = $serializer->deserialize($json, Question::class, 'json');
            $question->setCreatedAt(new \datetime());
            $question->setUpdatedAt(new \datetime());
            $errors = $validator->validate($question);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }

            foreach ($question->getAnswers() as $answer){

                    try {
                    $answer->setCreatedAt(new \datetime());
                    $answer->setUpdatedAt(new \datetime());
                    $answer->setQuestion($question);
                    $errors = $validator->validate($answer);
                    if (count($errors) > 0) {
                        return $this->json($errors, 400);
                    }
                }catch (NotEncodableValueException $e){
                    return $this->json([
                        'status'=>400,
                        'message'=>$e->getMessage()
                    ],400);
                }
            }
            $manager->persist($question);
            $manager->flush();
            return $this->json($question, 201, [], ['groups' => 'post:read']);
        }catch (NotEncodableValueException $e){
            return $this->json([
                'status'=>400,
                'message'=>$e->getMessage()
                ],400);
        }

    }

    /**
     * @Route("/api/question/{id}/{title}/{status}", name="api_question_put", methods={"PUT"})
     */
    public function put(int $id,string $title,string $status, EntityManagerInterface $manager, ValidatorInterface $validator)
    {
        try {
            $question = $manager->getRepository(Question::class)->find($id);
            //creer l'historique de la question avant modification
            $historicQuestion=new Historicquestion();
            $historicQuestion->setTitle($question->getTitle());
            $historicQuestion->setStatus($question->getStatus());
            $historicQuestion->setQuestion($question);
            $manager->persist($historicQuestion);
            //modifier l'entité
            $question->setTitle($title);
            $question->setStatus($status);
            $question->setUpdatedAt(new \datetime());
            $errors = $validator->validate($question);
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $manager->flush();
            return $this->json($question, 204, [], ['groups' => 'post:read']);
        }catch (NotFoundHttpException $e){
            return $this->json([
                'status'=>400,
                'message'=>$e->getMessage()
            ],400);
        }
    }
}
