<?php

namespace Yatzy;

use Yatzy\Dice;

class YatzyGame
{
    // made public to simplify unit tests (no need to make a getter/setter for each variable)
    public $rollNum;
    public $diceStates;
    public $keepers;
    public $scoreState;

    public function __construct()
    {
        $this->rollNum = 0;
        $this->diceStates = [new Dice(), new Dice(), new Dice(), new Dice(), new Dice()];
        $this->keepers = [false, false, false, false, false];
        $this->scoreState = [
            //upper section
            "ones" => ["chosen" => false, "score" => 0],
            "twos" => ["chosen" => false, "score" => 0],
            "threes" => ["chosen" => false, "score" => 0],
            "fours" => ["chosen" => false, "score" => 0],
            "fives" => ["chosen" => false, "score" => 0],
            "sixes" => ["chosen" => false, "score" => 0],

            // lower section
            "onePair" => ["chosen" => false, "score" => 0],
            "twoPairs" => ["chosen" => false, "score" => 0],
            "threeOfAKind" => ["chosen" => false, "score" => 0],
            "fourOfAKind" => ["chosen" => false, "score" => 0],
            "smallStraight" => ["chosen" => false, "score" => 0],
            "largeStraight" => ["chosen" => false, "score" => 0],
            "fullHouse" => ["chosen" => false, "score" => 0],
            "chance" => ["chosen" => false, "score" => 0],
            "yatzy" => ["chosen" => false, "score" => 0]
        ];
    }

    /**
     * @return Dice[]
     */
    public function getDiceStates(): array
    {
        return $this->diceStates;
    }

    /**
     * @return Dice[]
     */
    public function getKeepers(): array {
        return $this->keepers;
    }

    /**
     * @return int
     */
    public function getRollNum(): int
    {
        return $this->rollNum;
    }

    /**
     * @return array[]
     */
    public function getScoreState(): array
    {
        return $this->scoreState;
    }

    public function getDice()
    {
        $dice = array(1, 2, 3, 4, 5);

        for ($i = 0; $i < count($dice); $i++) {
            $dice[$i] = ["re-roll" => $this->keepers[$i], "value" => $this->diceStates[$i]->getState()];
        }
        return $dice;
    }

    public function roll(): array
    {
        if ($this->rollNum >= 3) {
            // cannot roll
            return $this->diceStates;
        } else {
            $this->rollNum++;
            for ($i = 0; $i < count($this->diceStates); $i++) {
                if (!$this->keepers[$i]) {
                    $this->diceStates[$i]->roll();
                }
            }
        }
        return $this->diceStates;
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

    public function chooseScoringMethod($methodName)
    {
        switch ($methodName) {
            case "ones":
                if (!$this->scoreState["ones"]["chosen"]) {
                    $this->scoreState["ones"]["chosen"] = true;
                    $this->scoreState["ones"]["score"] = calculateOnes($this->diceStates);
                }
                break;
            case "twos":
                if (!$this->scoreState["twos"]["chosen"]) {
                    $this->scoreState["twos"]["chosen"] = true;
                    $this->scoreState["twos"]["score"] = calculateTwos($this->diceStates);
                }
                break;
            case "threes":
                if (!$this->scoreState["threes"]["chosen"]) {
                    $this->scoreState["threes"]["chosen"] = true;
                    $this->scoreState["threes"]["score"] = calculateThrees($this->diceStates);
                }
                break;
            case "fours":
                if (!$this->scoreState["fours"]["chosen"]) {
                    $this->scoreState["fours"]["chosen"] = true;
                    $this->scoreState["fours"]["score"] = calculateFours($this->diceStates);
                }
                break;
            case "fives":
                if (!$this->scoreState["fives"]["chosen"]) {
                    $this->scoreState["fives"]["chosen"] = true;
                    $this->scoreState["fives"]["score"] = calculateFives($this->diceStates);
                }
                break;
            case "sixes":
                if (!$this->scoreState["sixes"]["chosen"]) {
                    $this->scoreState["sixes"]["chosen"] = true;
                    $this->scoreState["sixes"]["score"] = calculateSixes($this->diceStates);
                }
                break;
            case "onePair":
                if (!$this->scoreState["onePair"]["chosen"]) {
                    $this->scoreState["onePair"]["chosen"] = true;
                    $this->scoreState["onePair"]["score"] = calculateOnePair($this->diceStates);
                }
                break;
            case "twoPairs":
                if (!$this->scoreState["twoPairs"]["chosen"]) {
                    $this->scoreState["twoPairs"]["chosen"] = true;
                    $this->scoreState["twoPairs"]["score"] = calculateTwoPairs($this->diceStates);
                }
                break;
            case "threeOfAKind":
                if (!$this->scoreState["threeOfAKind"]["chosen"]) {
                    $this->scoreState["threeOfAKind"]["chosen"] = true;
                    $this->scoreState["threeOfAKind"]["score"] = calculateThreeOfAKind($this->diceStates);
                }
                break;
            case "fourOfAKind":
                if (!$this->scoreState["fourOfAKind"]["chosen"]) {
                    $this->scoreState["fourOfAKind"]["chosen"] = true;
                    $this->scoreState["fourOfAKind"]["score"] = calculateFourOfAKind($this->diceStates);
                }
                break;
            case "smallStraight":
                if (!$this->scoreState["smallStraight"]["chosen"]) {
                    $this->scoreState["smallStraight"]["chosen"] = true;
                    $this->scoreState["smallStraight"]["score"] = calculateSmallStraight($this->diceStates);
                }
                break;
            case "largeStraight":
                if (!$this->scoreState["largeStraight"]["chosen"]) {
                    $this->scoreState["largeStraight"]["chosen"] = true;
                    $this->scoreState["largeStraight"]["score"] = calculateLargeStraight($this->diceStates);
                }
                break;
            case "fullHouse":
                if (!$this->scoreState["fullHouse"]["chosen"]) {
                    $this->scoreState["fullHouse"]["chosen"] = true;
                    $this->scoreState["fullHouse"]["score"] = calculateFullHouse($this->diceStates);
                }
                break;
            case "chance":
                if (!$this->scoreState["chance"]["chosen"]) {
                    $this->scoreState["chance"]["chosen"] = true;
                    $this->scoreState["chance"]["score"] = calculateChance($this->diceStates);
                }
                break;
            case "yatzy":
                if (!$this->scoreState["yatzy"]["chosen"]) {
                    $this->scoreState["yatzy"]["chosen"] = true;
                    $this->scoreState["yatzy"]["score"] = calculateYatzy($this->diceStates);
                }
                break;
        }
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