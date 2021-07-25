<?php


namespace DP\core\state;


class Safe implements Context
{
    private State $state;

    public function __construct(\DateTimeImmutable $now)
    {
        $this->state = DayState::getInstance();
        $this->setClock((int)$now->format("H"));
    }

    private function setClock(int $hour){
        $this->state->doClock($this, $hour);
    }

    public function changeState(State $state): void
    {
        $this->state = $state;
    }

    public function recordLog(string $message): void
    {
        echo "record:" . $message;
    }

    public function callSecurityCenter(string $message): void
    {
        echo "call: " . $message;
    }

    public function use()
    {
        $this->state->doUse($this);
    }

    public function alarm()
    {
        $this->state->doAlarm($this);
    }

    public function phone()
    {
        $this->state->doPhone($this);
    }
}