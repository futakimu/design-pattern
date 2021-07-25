<?php


namespace DP\core\state;


interface State
{
    function doClock(Context $context, int $hour): void;
    function doUse(Context $context);
    function doAlarm(Context $context);
    function doPhone(Context $context);
}
