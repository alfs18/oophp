<?php

namespace Alfs\Dice;

use \PHPUnit\Framework\TestCase;

/**
 * Storing information from the request and calculating related essentials.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGraphic()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->graphic(1);
        $exp = "dice-1";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetRes()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->getRes();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetClass()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\Alfs\Dice\Dice", $dice);

        $res = $dice->getClass();
        $exp = null;
        $this->assertEquals($exp, $res);
    }
}
