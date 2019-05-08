<?php

namespace Alfs\Dice2;

use \PHPUnit\Framework\TestCase;

/**
 * Storing information from the request and calculating related essentials.
 */
class DiceGraphicTest2 extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGraphic2()
    {
        $dice = new DiceGraphic2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->graphic(1);
        $exp = "dice-1";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetClass2()
    {
        $dice = new DiceGraphic2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getClass();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetHistogramMax()
    {
        $dice = new DiceGraphic2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getHistogramMax();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }
}
