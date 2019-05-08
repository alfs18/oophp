<?php

namespace Alfs\Dice2;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $serie The numbers stored in sequence.
     */
    private $serie = [];
    private $sides = 6;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    /**
     * Set the serie.
     */
    public function setHistogramSerie($roll)
    {
        $this->serie[] = $roll;
    }

    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return max($this->serie);
    }

    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return string representing the histogram.
     */
    public function printHistogram(int $min = 1, int $max = 6)
    {
        $res = [];
        if ($min && $max) {
            for ($i=$min; $i <= $max; $i++) {
                $res[$i] = $i . ": ";
            }
            foreach ($this->serie as $key) {
                $res[$key] .= "*";
            }
            return implode("<br>", $res);
        } else {
            foreach ($this->serie as $key) {
                if (!in_array($key, $res)) {
                    $res[$key] = $key . ": ";
                }
                $res[$key] .= "*";
            }
            sort($res);
            return implode("<br>", $res);
        }
    }
}
