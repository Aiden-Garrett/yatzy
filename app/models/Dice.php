<?php
namespace Yatzy;

class Dice {
    private $state;

    //constructor
    function __construct()
    {
        $this->state = rand(1,6);
    }

    function roll(): int
    {
        $this->state = rand(1,6);
        return $this->state;
    }
}