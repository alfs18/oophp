<?php

namespace Alfs\Dice;

use \PHPUnit\Framework\TestCase;

/**
 * Storing information from the request and calculating related essentials.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetPlayer1()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

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
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->getPlayer2();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * property of 0.
     */
    public function testGetPoints()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->getPoints();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Set value and control that the value gets set.
     */
    public function testSetPoints()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

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
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->getPlayer();
        $exp = "Spelare 1";
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckDiceValueTrue()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $dice->setPoints(6);
        $dice->setPoints(1);
        $dice->setPoints(3);
        $dice->checkDiceValue([6, 1, 3]);
        $res = $dice->getPoints();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Change value and control that expected value gets returned.
     */
    public function testCheckDiceValueFalse()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

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
        $dice = new Dice();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $dice->setPoints(100);
        $dice->savePoints();
        $res = $dice->checkGameStatus();
        $exp = "win";
        $this->assertEquals($exp, $res);
    }
}
