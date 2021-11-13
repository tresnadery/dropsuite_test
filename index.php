<?php

include_once 'FileReader.php';

$a = new FileReader();
$path_folder = getcwd()."/DropsuiteTest";
if(count($argv) > 1){
    $path_folder = $argv[1];
}
echo $a->read($path_folder);