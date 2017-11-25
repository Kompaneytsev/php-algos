<?php

namespace kompaneytsev\phpAlgo\tests\BST;

use kompaneytsev\phpAlgo\BST\RedBlackBST;
use PHPUnit\Framework\TestCase;

class RedBlackBSTTest extends TestCase
{
    public function testGet()
    {
        $_val = 'kek';
        $_key = 1;
        $_new_val = 'prek';

        $bst = new RedBlackBST();

        $bst->putValue($_key, $_val);
        $this->assertEquals($bst->getValue($_key), $_val);

        $bst->putValue($_key, $_new_val);
        $this->assertEquals($bst->getValue($_key), $_new_val);
    }

    public function testSize()
    {
        $size = 100;

        $keys = range(1, $size);
        shuffle($keys);
        $values = array_map(function ($item) {
            return 'val' . $item;
        }, $keys);
        $arr = array_combine($keys, $values);
        

        $bst = new RedBlackBST();
        array_walk($arr, function($val, $key) use (&$bst) {
            $bst->putValue($key, $val);
        });

        $this->assertEquals($bst->getSize(), count($arr));
    }
}