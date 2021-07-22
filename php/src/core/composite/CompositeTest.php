<?php


namespace DP\core\composite;


use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{

    /**
     * @test
     */
    public function Directoryのsizeは含まれる全てのエントリーのサイズの合計である(){

        $rootDir = new Directory("root");
        $tmpDir = new Directory("tmp");
        $tmpChildDir = new Directory("tmpChild");
        $tmpChild2Dir = new Directory("tmpChild2");
        $usrDir = new Directory("usr");

        $rootDir->add($tmpDir);
        $rootDir->add($usrDir);
        $tmpDir->add($tmpChildDir);
        $tmpDir->add($tmpChild2Dir);

        $tmpDir->add(new File("file", 3));
        $tmpChildDir->add(new File("file", 5));
        $tmpChild2Dir->add(new File("file", 7));
        $usrDir->add(new File("file", 11));
        $rootDir->add(new File("file", 13));

        $this->assertEquals(39, $rootDir->size());
    }

    /**
     * @test
     */
    public function DirectoryのprintListがディレクトリに含まれる全てのエントリーとサイズを表示する(){
        $rootDir = new Directory("root");
        $binDir = new Directory("bin");
        $tmpDir = new Directory("tmp");
        $usrDir = new Directory("usr");

        $rootDir->add($binDir);
        $rootDir->add($tmpDir);
        $rootDir->add($usrDir);
        $binDir->add(new File("vi", 10000));
        $binDir->add(new File("index", 20000));

        $rootDir->printList("test");

        $this->expectOutputString("test/root(30000)test/bin(30000)test/tmp(0)test/usr(0)");
    }
}