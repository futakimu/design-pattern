<?php


namespace DP\core\state;


class DayState implements State
{
    private static DayState $singleton;

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
        if ($hour < 9 || $hour >= 17) {
            $context->changeState(NightState::getInstance());
        }
    }

    function doUse(Context $context)
    {
        $context->recordLog("金庫使用");
    }

    function doAlarm(Context $context)
    {
        $context->callSecurityCenter("非常ベル");
    }

    function doPhone(Context $context)
    {
        $context->callSecurityCenter("通話");
    }
}