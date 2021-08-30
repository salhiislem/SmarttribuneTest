<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;


/**
 * Historicquestion
 *
 * @ORM\Table(name="HistoricQuestion")
 * @ORM\Entity
 */
class Historicquestion
{
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
     */
    private $title;

    /**
     *
     * @ORM\Column(name="status", type="string", length=0, nullable=false)
     * @Groups({"post:read","rest"})
     */
    private $status;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="historicquestions", cascade={"persist", "remove" })
     * @Groups({"post:read","rest"})
     */
    private $question;

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
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


    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->title;
    }

}
