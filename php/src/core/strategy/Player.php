<?php


namespace DP\core\strategy;


class Player
{

    /**
     * @var Strategy
     */
    private Strategy $strategy;
    private int $winCount = 0;
    private int $loseCount = 0;
    private int $gameCount = 0;
    private string $name;

    public function __construct(string $name, Strategy $strategy)
    {
        $this->name = $name;
        $this->strategy = $strategy;
    }

    public function nextHand(): Hand
    {
        return $this->strategy->nextHand();
    }

    public function win(): void
    {
        $this->strategy->study(true);
        $this->winCount++;
        $this->gameCount++;
    }

    public function lose(): void
    {
        $this->strategy->study(false);
        $this->loseCount++;
        $this->gameCount++;
    }

    public function even(): void
    {
        $this->gameCount++;
    }

    public function __toString(): string
    {
        return "[" . $this->name . ":" . $this->gameCount . " games, " . $this->winCount . "win, " . $this->loseCount . "lose" . "]";
    }
}