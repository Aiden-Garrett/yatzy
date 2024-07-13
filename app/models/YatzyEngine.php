<?php

function calculateOnes($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 1) {
            $score += $diceState[$i];
        }
    }
    return $score;
}

function calculateTwos($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 2) {
            $score += $diceState[$i];
        }
    }
    return $score;
}

function calculateThrees($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 3) {
            $score += $diceState[$i];
        }
    }
    return $score;
}


function calculateFours($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 4) {
            $score += $diceState[$i];
        }
    }
    return $score;
}

function calculateFives($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 5) {
            $score += $diceState[$i];
        }
    }
    return $score;
}

function calculateSixes($diceState): int
{
    $score = 0;
    for ($i = 0; $i < count($diceState); $i++) {
        if ($diceState[$i] === 6) {
            $score += $diceState[$i];
        }
    }
    return $score;
}

function calculateOnePair($diceState): int
{
    // sort in descending order
    rsort($diceState);
    $l = 0;
    for ($r = 1; $r < count(diceState); $l++, $r++) {
        // if a pair is found, it is the max sum pair
        if ($diceState[$r] === $diceState[$l]) {
            return $diceState[$r] * 2;
        }
    }
    return 0;
}

function calculateTwoPairs($diceState)
{
    // sort in descending order
    rsort($diceState);

    $pairsFound = 0;
    $score = 0;
    $l = 0;
    for ($r = 1; $r < count($diceState); $l++, $r++) {
        // if a pair is found, it is the max sum pair
        if ($diceState[$r] === $diceState[$l]) {
            $score += $diceState[$l] * 2;

            // if two pairs found return them (it is the max)
            if (++$pairsFound === 2) {
                return $score;
            }


            // need to find new numbers (pairs must be distinct)
            while ($r < count($diceState) && $diceState[$r] === $diceState[$l]) {
                $r++;
            }
            // make left pointer 1 lower than the right pointer
            $l = $r - 1;
        }
    }
    return 0;
}

//// console.log(calculateTwoPairs([1,1,1,1,5]));
//// console.log(calculateTwoPairs([1,1,2,2,5]));
//// console.log(calculateTwoPairs([6,1,2,2,6]));
//
//function calculateThreeOfAKind($diceState) {
//    // this works because there is 5 dice
//    $numCount = new Map();
//    for ($i = 0; $i < count($diceState); $i++) {
//        let count = numCount.has($diceState[$i]) ? numCount.get($diceState[$i]) + 1 : 1;
//
//        // if number appears three times
//        if (count === 3) {
//            return $diceState[$i] * 3;
//        }
//        numCount.set($diceState[$i], count);
//    }
//    return 0;
//}

//function calculateFourOfAKind($diceState) {
//    // this works because there is 5 dice
//    let numCount = new Map();
//    for ($i = 0; $i < count($diceState); $i++) {
//        let count = numCount.has($diceState[$i]) ? numCount.get($diceState[$i]) + 1 : 1;
//
//        if (count === 4) {
//            return $diceState[$i] * 4;
//        }
//        numCount.set($diceState[$i], count);
//    }
//    return 0;
//}
//
//function calculateSmallStraight($diceState) {
//    let nums = new Set($diceState);
//    // check if the set has numbers 1-5
//    for ($i = 1; $i <= 5; $i++) {
//        if (!nums.has($i)) {
//            return 0;
//        }
//    }
//    return 15;
//}
//
//function calculateLargeStraight($diceState) {
//    let nums = new Set($diceState);
//    // check if the set has numbers 2-6
//    for ($i = 2; $i <= 6; $i++) {
//        if (!nums.has($i)) {
//            return 0;
//        }
//    }
//    return 20;
//}
//
//function calculateFullHouse($diceState) {
//    // full house = three of a kind + a two of a kind that are distinct
//    let numCount = new Map();
//
//    // get count of each number
//    for ($i = 0; $i < count($diceState); $i++) {
//        let count = numCount.has($diceState[$i]) ? numCount.get($diceState[$i]) + 1 : 1;
//        numCount.set($diceState[$i], count);
//    }
//
//    $score = 0;
//    for (let [num, count] of numCount) {
//        if (count !== 2 && count!== 3) {
//            return 0;
//        }
//        $score += num * count;
//    }
//
//    return $score;
//}
//
//// console.log(calculateFullHouse([1,2,3,4,5]))
//// console.log(calculateFullHouse([1,1,3,3,3]))
//// console.log(calculateFullHouse([6,5,5,6,5]))
//
//function calculateChance($diceState) {
//    $score = 0;
//    for ($i = 0; $i < count($diceState); $i++) {
//        $score += $diceState[$i];
//    }
//    return $score;
//}
//
//function calculateYatzy(diceStates) {
//    for ($i = 1; $i < diceStates.length; $i++) {
//        if (diceStates[$i] !== diceStates[$i - 1]) {
//            return 0;
//        }
//    }
//    return 50;
//}
//
//
//function calculateUpperSum(gameState) {
//    // null = 0 in js so this works
//    return gameState['ones'] + gameState['twos'] + gameState['threes'] + gameState['fours'] + gameState['fives'] + gameState['sixes'];
//}
//
//function calculateBonus(gameState) {
//    // if upper section $score is 63+ -> give bonus
//    return calculateUpperSum(gameState) >= 63 ? 50 : 0
//}
//
//function calculateTotal(gameState) {
//    let total = 0;
//
//    for (const value of Object.values(gameState)) {
//        total += value;
//    }
//
//    total += calculateBonus(gameState);
//
//    return total;
//}