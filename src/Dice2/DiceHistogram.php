<?php

namespace Alfs\Dice2;

/**
 * A dice which has the ability to present data to be used for creating
 * a histogram.
 */
class DiceHistogram extends Dice2 implements HistogramInterface
{
    use HistogramTrait;

    /**
     * Get max value for the historgram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }

    /**
     * Roll the dice, remember its value in the serie and return
     * its value.
     *
     * @return int the value of the rolled dice.
     */
    public function roll()
    {
        $this->serie[] = parent::getDice();
        // return $this->getLastRoll();
    }
}
