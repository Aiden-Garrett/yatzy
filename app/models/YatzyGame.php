<?php
namespace Yatzy;
use Yatzy\Dice;

class YatzyGame {
    private $rollNum;
    private $diceStates;
    private $keepers;

    public function __construct() {
        $this->rollNum = 0;
        $this->diceStates = [new Dice(), new Dice(), new Dice(), new Dice(), new Dice()];
        $this->keepers = [false, false, false, false, false];
    }

    public function roll() {
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

    public function toggleKeeper($diceNum) {
        // assumes it is in range
        $this->keepers[$diceNum] = !$this->keepers[$diceNum];
    }

    public function resetTurn($diceNum) {
        $this->rollNum = 0;
        $this->diceStates = [new Dice(), new Dice(), new Dice(), new Dice(), new Dice()];
        $this->keepers = [false, false, false, false, false];
    }

    public function __toString() : string {
        $out = "Roll number: {$this->rollNum}<br>";
        $i = 0;
        foreach ($this->diceStates as $diceState) {
            ++$i;
            $out .= "DICE {$i}: {$diceState->getState()}<br>";
        }

        return $out;
    }
}