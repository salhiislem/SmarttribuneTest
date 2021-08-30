<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity
 */
class Answer
{
    const CHOICES=["faq", "bot"];
    /**
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="channel", type="string", length=0, columnDefinition="enum('faq', 'bot')", nullable=false)
     * @Groups("post:read")
     * @Assert\NotBlank
     * @Assert\Type(type="string")
     * @Assert\Choice(choices= Answer::CHOICES , message="status value must be draft or published")
     */
    private $channel;

    /**
     *
     * @ORM\Column(name="body", type="string", length=500, nullable=false)
     * @Groups("post:read")
     * @Assert\NotBlank
     * @Assert\Length(max=500)
     */
    private $body;

    /**
     *
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     * @Assert\NotBlank
     */
    private $createdAt;


    /**
     *
     * @ORM\Column(type="datetime")
     * @Groups("post:read")
     * @Assert\NotBlank
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question", inversedBy="answers",cascade={"persist", "remove" })
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

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

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




}
