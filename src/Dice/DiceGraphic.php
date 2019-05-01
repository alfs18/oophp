<?php
namespace Alfs\Dice;

/**
 * A graphic dice.
 */
class DiceGraphic extends Dice
{
    /**
     * @var int SIDES Number of sides of the Dice.
     */
    const SIDES = 6;

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
    public function getRes()
    {
        return $this->res;
    }

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
        }
        $this->checkDiceValue($this->res);
    }
}
