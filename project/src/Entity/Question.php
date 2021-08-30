<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Ignore;




/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
{
    const CHOICES=["draft", "published"];
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"post:read","rest"})
     */
    private $id;

    /**
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     * @Groups({"post:read","rest"})
     * @Assert\NotBlank
     * @Assert\Length(max=100)
     * @Assert\Type(type="string")
     */
    private $title;

    /**
     *
     * @ORM\Column(name="promoted", type="boolean", nullable=false)
     * @Groups({"post:read","rest"})
     * @Assert\Type(type="bool",message="promoted attribut must have a boolean type")
     */
    private $promoted=false;

    /**
     *
     * @ORM\Column(name="status", type="string", length=0, columnDefinition="enum('draft', 'published')", nullable=false)
     * @Groups({"post:read","rest"})
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Choice(choices= Question::CHOICES , message="status value must be draft or published")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Answer", mappedBy="question",cascade={"persist", "remove" })
     */
    private $answers;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Historicquestion", mappedBy="question",cascade={"persist", "remove" })
     * @Ignore()
     */
    private $historicquestions;

    /**
     *
     * @ORM\Column(type="datetime")
     * @Groups({"post:read","rest"})
     * @Assert\NotBlank
     */
    private $createdAt;


    /**
     *
     * @ORM\Column(type="datetime")
     * @Groups({"post:read","rest"})
     * @Assert\NotBlank
     */
    private $updatedAt;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->historicquestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPromoted(): ?bool
    {
        return $this->promoted;
    }

    public function setPromoted(bool $promoted): self
    {
        $this->promoted = $promoted;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer)
    {
        $this->answers->add($answer);
        $answer->setQuestion($this);
    }
    /**
     * @return Collection|Historicquestions[]
     */
    public function getHistoricquestions(): Collection
    {
        return $this->historicquestions;
    }
    public function addHistoricquestion(Historicquestion $historicquestion)
    {
        $this->historicquestions->add($historicquestion);
        $historicquestion->setQuestion($this);
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function removeHistoricquestion(Historicquestion $historicquestion): self
    {
        if ($this->historicquestions->removeElement($historicquestion)) {
            // set the owning side to null (unless already changed)
            if ($historicquestion->getQuestion() === $this) {
                $historicquestion->setQuestion(null);
            }
        }

        return $this;
    }

}