<?php


namespace DP\core\strategy;


use BadMethodCallException;
use Exception;
use InvalidArgumentException;

class Hand
{
    const GU = 0;
    const CHOKI = 1;
    const PA = 2;

    const NAME = ["グー", "チョキ", "パー"];

    private int $handValue;

    private function __construct(int $handValue)
    {
        $this->validateHandleValue($handValue);
        $this->handValue = $handValue;
    }

    public static function fromValue(int $handValue): self
    {
        return new self($handValue);
    }

    public static function random(): self
    {
        try {
            return new self(random_int(0, 2));
        } catch (Exception $e) {
            throw new BadMethodCallException();
        }
    }

    public static function gu()
    {
        return new self(self::GU);
    }

    public static function choki()
    {
        return new self(self::CHOKI);
    }

    public static function pa()
    {
        return new self(self::PA);
    }

    public function isStrongerThan(self $aHand): bool
    {
        return $this->fight($aHand) === 1;
    }

    private function fight(self $hand): int
    {
        if ($this->handValue === $hand->handValue) {
            return 0;
        } else if (($this->handValue + 1) % 3 === $hand->handValue) {
            return 1;
        } else {
            return -1;
        }
    }

    public function value(): int
    {
        return $this->handValue;
    }

    public function __toString(): string
    {
        return self::NAME[$this->handValue];
    }

    private function validateHandleValue(int $handValue)
    {
        if (0 > $handValue || 2 < $handValue) {
            throw new InvalidArgumentException('Handの値が不正です。');
        }
    }

    public function equals(Hand $aHand): bool
    {
        return $this->value() === $aHand->value();
    }
}