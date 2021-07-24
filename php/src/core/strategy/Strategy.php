<?php


namespace DP\core\strategy;


interface Strategy
{
    public function nextHand(): Hand;
    public function study(bool $isWin);
}