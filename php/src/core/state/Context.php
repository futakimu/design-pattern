<?php


namespace DP\core\state;


interface Context
{
    public function changeState(State $state): void;

    public function recordLog(string $message): void;

    public function callSecurityCenter(string $message): void;

}