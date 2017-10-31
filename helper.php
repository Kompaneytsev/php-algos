<?php

/**
 * @param string $path
 * @return Generator
 */
function read_file(string $path)
{
    $fp = fopen($path, 'rb');

    while(($line = fgets($fp)) !== false)
        yield rtrim($line, "\r\n");

    fclose($fp);
}

/**
 * @param string $path
 * @param int $lines
 */
function write_file(string $path, int $lines)
{
    $fp = fopen($path, 'a+');
    
    foreach (range(0, $lines) as $l)
        fwrite($fp, bin2hex(random_bytes(rand(6,12))) . ' ' . bin2hex(random_bytes(rand(6,12))) . PHP_EOL);

    fclose($fp);
}