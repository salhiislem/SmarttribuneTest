<?php

namespace App\Tests;

use App\Entity\Question;
use App\Entity\Historicquestion;
use PHPUnit\Framework\TestCase;

class HistoricQuestionTest extends TestCase
{
    private Historicquestion $question;
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }
    protected function SetUp():void {
        parent::setUp();
        $this->question=new Historicquestion();
    }
    public function testGetTitle():void {
        $value="this is a test";
        $response=$this->question->setTitle($value);
        self::assertInstanceOf(Historicquestion::class,$response);
        self::assertEquals($value,$this->question->getTitle());
    }
    public function testGetStatus():void {
        $value="draft";
        $response=$this->question->setStatus($value);
        self::assertInstanceOf(Historicquestion::class,$response);
        self::assertEquals($value,$this->question->getStatus());
    }
    public function testGetQuestion():void {
        $q= new Question();
        $response= $this->question->setQuestion($q);
        self::assertInstanceOf(Historicquestion::class,$response);
        self::assertEquals($q,$this->question->getQuestion());

    }
}
