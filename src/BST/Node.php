<?php

namespace kompaneytsev\phpAlgo\BST;


class Node
{
    private $key;
    private $val;
    /**
     * @var Node
     */
    private $left, $right;
    private $N;

    public function __construct($key, $val, $N)
    {
        $this->key = $key;
        $this->val = $val;
        $this->N = $N;
    }

    public function getN(): int
    {
        return $this->N;
    }

    public function setN(int $N)
    {
        $this->N = $N;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getVal()
    {
        return $this->val;
    }

    public function setVal($val): void
    {
        $this->val = $val;
    }

    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param Node $node
     */
    public function setLeft($node)
    {
        $this->left = $node;
    }

    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param Node $node
     */
    public function setRight($node)
    {
        $this->right = $node;
    }
}