<?php


namespace DP\core\strategy;


use PHPUnit\Framework\TestCase;

class StrategyTest extends TestCase
{
    /**
     * @test
     */
    public function WinningStrategyのPlayerは勝利した後に同じ手を出す()
    {
        $player1 = new Player("プレイヤー1", new WinningStrategy());
        $p1Hand = $player1->nextHand();

        $player1->win();
        $this->assertTrue($p1Hand->equals($player1->nextHand()));
    }

    /**
     * @test
     */
    public function 異なるStrategyのPlayerを1000回戦わせる()
    {
        $player1 = new Player("プレイヤー1", new WinningStrategy());
        $player2 = new Player("プレイヤー2", new ProbStrategy());
        $p1WinCount = 0;
        $p2WinCount = 0;

        for ($i = 0; $i < 1000; $i++) {

            $p1Hand = $player1->nextHand();
            $p2Hand = $player2->nextHand();

            if ($p1Hand->isStrongerThan($p2Hand)) {
                $player1->win();
                $player2->lose();
                $p1WinCount++;
            } elseif ($p2Hand->isStrongerThan($p1Hand)) {
                $player1->lose();
                $player2->win();
                $p2WinCount++;
            } else {
                $player1->even();
                $player2->even();
            }
        }
        self::assertEquals("[プレイヤー1:1000 games, " . $p1WinCount . "win, " . $p2WinCount . "lose]", (string)$player1);
        self::assertEquals("[プレイヤー2:1000 games, " . $p2WinCount . "win, " . $p1WinCount . "lose]", (string)$player2);
    }
}