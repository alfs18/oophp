<?php
namespace Alfs\Dice2;

/**
 * A graphic dice.
 */
class DiceGraphic2 extends Dice2 implements HistogramInterface
{
    use HistogramTrait;

    /**
     * @var int SIDES Number of sides of the Dice.
     */
    const SIDES = 6;
    private $res = [];
    private $class = [];


    /**
     * Constructor to initiate the dice.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic(int $res)
    {
        $this->lastRoll = $res;
        return "dice-" . $this->lastRoll;
    }

    /**
     * Get values of res.
     *
     * @return array with the values of the dice.
     */
    // public function getRes()
    // {
    //     return $this->res;
    // }

    /**
     * Get values of class.
     *
     * @return array with the values of the grphic dice.
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Roll the dice.
     */
    public function roll(int $rolls = 3)
    {
        $this->res = [];
        $this->class = [];
        for ($i = 0; $i < $rolls; $i++) {
            $this->res[] = $this->getDice();
            $this->class[] = $this->graphic($this->res[$i], $i+1);
            $this->setPoints($this->res[$i]);
            $this->setHistogramSerie($this->res[$i]);
        }
        if (parent::getPlayer() == "Datorn") {
            $this->checkDiceValue($this->res);
            if (parent::getPlayer() == "Datorn") {
                $differ = parent::getPlayer1() - parent::getPlayer2();
                $point = parent::getPoints();
                $hist = $this->printHistogram()[4];
                if ($hist == "*" || parent::getPlayer2() >= 90) {
                    $this->savePoints();
                } elseif ($point > 12 && $differ < 20) {
                    $this->savePoints();
                } else {
                    $this->roll();
                    $this->savePoints();
                }
            }
        } else {
            $this->checkDiceValue($this->res);
        }
    }


    /**
     * Get max value for the historgram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->sides;
    }

    // /**
    //  * Roll the dice, remember its value in the serie and return
    //  * its value.
    //  *
    //  * @return int the value of the rolled dice.
    //  */
    // public function roll()
    // {
    //     $this->serie[] = parent::getDice();
    //     // return $this->getLastRoll();
    // }
}
