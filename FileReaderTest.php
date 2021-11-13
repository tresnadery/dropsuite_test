<?php

use PHPUnit\Framework\TestCase;

require "FileReader.php";

class FileReaderTest extends TestCase{
    public function testEmptyFolder(){
        $fr = New FileReader();
        $path_folder = getcwd()."/DropsuiteTestEmpty";
        $expetation = "There is no file\n";
        $actual = $fr->read($path_folder);
        $this->assertEquals($expetation, $actual);
    }

    public function testFileReader(){
        $fr = New FileReader();
        $path_folder = getcwd()."/DropsuiteTest";
        $expetation = "abcdef 4\n";
        $actual = $fr->read($path_folder);
        $this->assertEquals($expetation, $actual);
    }
}