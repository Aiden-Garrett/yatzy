<?php

namespace Yatzy;

use Yatzy\Dice;

class YatzyGame
{
    // made public to simplify unit tests (no need to make a getter/setter for each variable)
    public $rollNum;
    public $diceStates;
    public $keepers;

    public function __construct()
    {
        $this->rollNum = 0;
        $this->diceStates = [new Dice(), new Dice(), new Dice(), new Dice(), new Dice()];
        $this->keepers = [false, false, false, false, false];
        $this->scoreState = [
            //upper section
            "ones" => 0,
            "twos" => 0,
            "threes" => 0,
            "fours" => 0,
            "fives" => 0,
            "sixes" => 0,

            // lower section
            "onePair" => 0,
            "twoPairs" => 0,
            "threeOfAKind" => 0,
            "fourOfAKind" => 0,
            "smallStraight" => 0,
            "largeStraight" => 0,
            "fullHouse" => 0,
            "chance" => 0,
            "yatzy" => 0
        ];
    }

    public function roll()
    {
        if ($this->rollNum >= 3) {
            // cannot roll
            return;
        } else {
            $this->rollNum++;
            for ($i = 0; $i < count($this->diceStates); $i++) {
                if (!$this->keepers[$i]) {
                    $this->diceStates[$i]->roll();
                }
            }
        }
    }

    public function toggleKeeper($diceNum)
    {
        // assumes it is in range
        $this->keepers[$diceNum] = !$this->keepers[$diceNum];
    }

    public function resetTurn($diceNum)
    {
        $this->rollNum = 0;
        $this->diceStates = [new Dice(), new Dice(), new Dice(), new Dice(), new Dice()];
        $this->keepers = [false, false, false, false, false];
    }

    public function __toString(): string
    {
        $out = "Roll number: {$this->rollNum}<br>";
        $i = 0;
        foreach ($this->diceStates as $diceState) {
            ++$i;
            $out .= "DICE {$i}: {$diceState->getState()}<br>";
        }

        return $out;
    }
}