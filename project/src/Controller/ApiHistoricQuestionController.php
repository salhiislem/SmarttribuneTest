<?php

namespace App\Controller;

use App\Repository\HistoricQuestionRepository;
use App\Service\ExporterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ApiHistoricQuestionController extends AbstractController
{
    /**
     * @Route("/api/historic/question", name="api_historic_question", methods={"GET"})
     */
    public function index(HistoricQuestionRepository $historicquestionRepository, NormalizerInterface $normalizer,ExporterService $csvExporter)
    {
        $historicquestions=$historicquestionRepository->findAll();
        $attributes=['id','title','status', 'question' => ['id','title','status','promoted','createdAt','updatedAt']];
        //var_dump($historicquestions);die;
       $fp=$csvExporter->buildCsvFile("historicQuestion",$historicquestions,$attributes);
        return $fp;
    }
}
