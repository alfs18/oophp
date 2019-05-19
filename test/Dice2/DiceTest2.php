<?php

namespace Alfs\Dice2;

use \PHPUnit\Framework\TestCase;

/**
 * Storing information from the request and calculating related essentials.
 */
class DiceTest2 extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetPlayer1()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getPlayer1();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * property of 0.
     */
    public function testGetPlayer2()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getPlayer2();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $dice->changePlayer();
        $res = $dice->getPlayer();
        $exp = "Datorn";
        $this->assertEquals($exp, $res);
    }


    /**
     * Construct object and verify that the object has the expected
     * property of 0.
     */
    public function testGetPoints()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getPoints();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Set value and control that the value gets set.
     */
    public function testSetPoints()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->setPoints(10);
        $res = $dice->getPoints();
        $exp = 10;
        $this->assertEquals($exp, $res);
    }

    /**
     * Control that expected value gets returned.
     */
    public function testGetPlayer()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getPlayer();
        $exp = "Spelare 1";
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckDiceValueTrue()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->setPoints(6);
        $dice->setPoints(1);
        $dice->setPoints(3);
        $dice->checkDiceValue([6, 1, 3]);
        $res = $dice->getPoints();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Control that expected value gets returned.
     */
    public function testCheckGameStatus()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->setPoints();
        $dice->savePoints();
        $res = $dice->checkGameStatus();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckDiceValueFalse()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->setPoints(6);
        $dice->setPoints(2);
        $dice->setPoints(3);
        $dice->checkDiceValue([6, 2, 3]);
        $res = $dice->getPoints();
        $exp = 11;
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckGameStatusWin()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->setPoints(100);
        $dice->savePoints();
        $res = $dice->checkGameStatus();
        $exp = "win";
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckGameStatusLose()
    {
        $dice = new Dice2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->changePlayer();
        $dice->setPoints(100);
        $dice->savePoints();
        $res = $dice->checkGameStatus();
        $exp = "lose";
        $this->assertEquals($exp, $res);
    }
}
