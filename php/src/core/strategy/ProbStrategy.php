<?php


namespace DP\core\strategy;


class ProbStrategy implements Strategy
{
    private Hand $currentHand;
    private Hand $prevHand;

    private array $history = [
        [1, 1, 1],
        [1, 1, 1],
        [1, 1, 1]
    ];

    public function __construct()
    {
        $this->currentHand = Hand::random();
    }

    public function nextHand(): Hand
    {
        $bet = random_int(0, $this->sumOfHistory($this->currentHand));
        $currentHandValue = $this->currentHand->value();

        if ($bet < $this->history[$currentHandValue][0]) {
            $this->currentHand = Hand::gu();
        } else if ($bet < $this->history[$currentHandValue][0] + $this->history[$currentHandValue][1]) {
            $this->currentHand = Hand::choki();
        } else {
            $this->currentHand = Hand::pa();
        }

        $this->prevHand = $this->currentHand;

        return $this->currentHand;
    }

    public function study(bool $isWin)
    {
        if (true === $isWin) {
            $this->history[$this->prevHand->value()][$this->currentHand->value()]++;
        } else {
            $this->history[$this->prevHand->value()][($this->currentHand->value() + 1) % 3]++;
            $this->history[$this->prevHand->value()][($this->currentHand->value() + 2) % 3]++;
        }
    }

    private function sumOfHistory(Hand $currentHand): int
    {
        $sum = 0;
        foreach ($this->history[$currentHand->value()] as $value) {
            $sum += $value;
        }
        return $sum;
    }
}