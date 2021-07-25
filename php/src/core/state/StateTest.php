<?php


namespace DP\core\state;


use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @test
     */
    public function 金庫は昼間のみ使用ができる()
    {
        $datetime = new \DateTimeImmutable();
        $day = $datetime->setTime(9, 0);
        $night = $datetime->setTime(17, 0);
        $daySafe = new Safe($day);
        $nightSafe = new Safe($night);

        $daySafe->use();
        $nightSafe->use();
        self::expectOutputString("record:金庫使用record:非常:金庫使用");
    }

    /**
     * @test
     */
    public function 金庫の非常ベルはいつでも使用できる()
    {
        $datetime = new \DateTimeImmutable();
        $day = $datetime->setTime(16, 59, 59 );
        $night = $datetime->setTime(8, 59, 59);
        $daySafe = new Safe($day);
        $nightSafe = new Safe($night);

        $daySafe->alarm();
        $nightSafe->alarm();
        self::expectOutputString("call: 非常ベルcall: 非常ベル");
    }

    /**
     * @test
     */
    public function 金庫の電話は昼のみ通常使用できる()
    {
        $datetime = new \DateTimeImmutable();
        $day = $datetime->setTime(9, 0);
        $night = $datetime->setTime(17, 0);
        $daySafe = new Safe($day);
        $nightSafe = new Safe($night);

        $daySafe->phone();
        $nightSafe->phone();
        self::expectOutputString("call: 通話call: 留守録");
    }
}