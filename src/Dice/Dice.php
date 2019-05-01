<?php

namespace Alfs\Dice;

/**
 * Dice, a class supporting the game through GET, POST and SESSION.
 */
class Dice
{
    /**
     * @var int $dice   The current dice number.
     * @var int $points    Number of points.
     */
    private $dice;
    private $points;
    private $player;
    private $player1;
    private $player2;
    protected $lastRoll;
    private $res = [];
    private $class = [];

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct()
    {
        $this->points = 0;
        $this->player = "player1";
        $this->player1 = 0;
        $this->player2 = 0;
        $this->dice = rand(1, 6);
    }

    /**
     * Get value of dice.
     *
     * @return int as the value of the dice.
     */
    public function getDice()
    {
        $this->dice = rand(1, 6);
        return $this->dice;
    }

    /**
     * Get score of player1.
     *
     * @return int as the current score of player1.
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * Get score of player2.
     *
     * @return int as the current score of player2.
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * Get current points.
     *
     * @return int as the current points.
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Get which player it currently is.
     *
     * @return string as the current player.
     */
    public function getPlayer()
    {
        if ($this->player == "player1") {
            return "Spelare 1";
        } else {
            return "Datorn";
        }
    }

    /**
     * Check if one of the dice values is one.
     */
    public function checkDiceValue($point)
    {
        foreach ($point as $value) {
            if ($value == 1) {
                $this->points = 0;
                $this->changePlayer();
                // return "no";
            } elseif ($this->player == "player2") {
                $this->savePoints();
            }
        }
    }

    /**
     * Set current number of points.
     */
    public function setPoints(int $point)
    {
        $this->points += $point;
    }

    /**
     * Save points and change player.
     */
    public function savePoints()
    {
        $player = $this->player;
        $points = $this->points;
        $this->$player += $points;
        // $this->$player += $this->points;
        $this->points = 0;
        $this->changePlayer();
    }

    /**
     * Change current player.
     */
    public function changePlayer()
    {
        if ($this->player == "player1") {
            $this->player = "player2";
            $this->rollForPlayer2();
        } else {
            $this->player = "player1";
        }
    }

    /**
     * Automatically roll the dice for player2.
     */
    public function rollForPlayer2(int $rolls = 3)
    {
        $this->res = [];
        $this->class = [];
        for ($i = 0; $i < $rolls; $i++) {
            $this->res[] = $this->getDice();
            $this->setPoints($this->res[$i]);
        }
        $this->checkDiceValue($this->res);
        // $this->savePoints();
    }

    /**
     * Check if one of the players has won the game.
     */
    public function checkGameStatus()
    {
        if ($this->player1 >= 100) {
            return "win";
        } elseif ($this->player2 >= 100) {
            return "lose";
        }
    }
}
