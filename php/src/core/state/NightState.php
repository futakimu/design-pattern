<?php


namespace DP\core\state;


class NightState implements State
{
    private static NightState $singleton;

    private function __construct()
    {
    }

    public static function getInstance(): state
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }

    function doClock(Context $context, int $hour): void
    {
        if ($hour <= 9 && $hour < 17) {
            $context->changeState(DayState::getInstance());
        }
    }

    function doUse(Context $context)
    {
        $context->recordLog("非常:金庫使用");
    }

    function doAlarm(Context $context)
    {
        $context->callSecurityCenter("非常ベル");
    }

    function doPhone(Context $context)
    {
        $context->callSecurityCenter("留守録");
    }
}