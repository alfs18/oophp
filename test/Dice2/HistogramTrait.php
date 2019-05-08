<?php

namespace Alfs\Dice2;

use \PHPUnit\Framework\TestCase;

/**
 * Storing information from the request and calculating related essentials.
 */
class HistogramTraitTest extends TestCase
{
    /**
     * Construct object and verify that the object is the expected
     * type.
     */
    public function testGetHistogramSerie()
    {
        $dice = new DiceGraphic2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $dice->roll();
        $res = $dice->getHistogramSerie();
        $this->assertIsArray($res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testGetHistogramMin()
    {
        $dice = new DiceGraphic2();
        $this->assertInstanceOf("\Alfs\Dice2\Dice2", $dice);

        $res = $dice->getHistogramMin();
        $exp = 1;
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

        $dice->setHistogramSerie(2)
        $dice->setHistogramSerie(3)
        $dice->setHistogramSerie(6)
        $res = $dice->getHistogramMax();
        $exp = [2, 3, 6];
        $this->assertEquals($exp, $res);
    }
}
