<?php

namespace App\Tests;

use App\Entity\Answer;
use App\Entity\Historicquestion;
use PHPUnit\Framework\TestCase;
use App\Entity\Question;


class QuestionTest extends TestCase
{
    private Question $question;
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    protected function SetUp():void {
        parent::setUp();
        $this->question=new Question();
    }
    public function testGetTitle():void {
        $value="this is a test";
        $response=$this->question->setTitle($value);
        self::assertInstanceOf(Question::class,$response);
        self::assertEquals($value,$this->question->getTitle());
}

    public function testGetPromoted():void {
        $value=false;
        $response=$this->question->setPromoted($value);
        self::assertInstanceOf(Question::class,$response);
        self::assertEquals($value,$this->question->getPromoted());
    }

    public function testGetStatus():void {
        $value="draft";
        $response=$this->question->setStatus($value);
        self::assertInstanceOf(Question::class,$response);
        self::assertEquals($value,$this->question->getStatus());
    }
    public function testGetCreatedAt():void {
        $value=new \datetime();
        $response=$this->question->setCreatedAt($value);
        self::assertInstanceOf(Question::class,$response);
        self::assertEquals($value,$this->question->getCreatedAt());
    }
    public function testGetUpdatedAt():void {
        $value=new \datetime();
        $response=$this->question->setUpdatedAt($value);
        self::assertInstanceOf(Question::class,$response);
        self::assertEquals($value,$this->question->getUpdatedAt());
    }
    public function testGetAnswer():void {
        $answer=new Answer();
        $response= $this->question->addAnswer($answer);
        self::assertInstanceOf(Question::class,$response);
        self::assertCount(1,$this->question->getAnswers());
        self::assertTrue($this->question->getAnswers()->contains($answer));

        $this->question->removeAnswer($answer);

        self::assertInstanceOf(Question::class,$response);
        self::assertCount(1,$this->question->getAnswers());
        self::assertTrue($this->question->getAnswers()->contains($answer));
    }
    public function testGetHistoricQuestion():void {
        $hq=new Historicquestion();
        $response= $this->question->addHistoricquestion($hq);
        self::assertInstanceOf(Question::class,$response);
        self::assertCount(1,$this->question->getHistoricquestions());
        self::assertTrue($this->question->getHistoricquestions()->contains($hq));

        $this->question->removeAnswer($hq);

        self::assertInstanceOf(Question::class,$response);
        self::assertCount(1,$this->question->getHistoricquestions());
        self::assertTrue($this->question->getHistoricquestions()->contains($hq));

    }
}
