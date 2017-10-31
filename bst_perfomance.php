<?php
require __DIR__ . '/vendor/autoload.php';
require 'helper.php';

use kompaneytsev\phpAlgo\BST\BST;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$file_name = basename(__FILE__) . '.' . basename($argv[1]);
$log = new Logger($file_name);
$log->pushHandler(new StreamHandler(__DIR__ . '/logs/' . $file_name . '.log', Logger::INFO));

$bst = new BST($log);

foreach(read_file($argv[1]) as $line)
{
    $values = explode(' ', $line);
    $bst->putValue($values[0], $values[1]);
}