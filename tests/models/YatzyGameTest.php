<?php
namespace Yatzy\Test;

use Yatzy\YatzyGame;
use PHPUnit\Framework\TestCase;

class YatzyGameTest extends TestCase
{

    public function testConstructor()
    {
        $d = new YatzyGame();
        $this->assertEquals(0, $d->rollNum);
    }

    public function testRoll()
    {
        $d = new YatzyGame();
        $this->assertEquals(0, $d->rollNum);
        $d->roll();
        $this->assertEquals(1, $d->rollNum);
    }
}