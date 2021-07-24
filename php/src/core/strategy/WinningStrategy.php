<?php


namespace DP\core\strategy;


class WinningStrategy implements Strategy
{

    /**
     * @var Hand
     */
    private Hand $nextHand;

    public function __construct()
    {
        $this->nextHand = Hand::random();
    }

    public function nextHand(): Hand
    {
        return $this->nextHand;
    }

    public function study(bool $isWin)
    {
        if ($isWin === false)
        {
            $this->nextHand = Hand::random();
        }
    }
}