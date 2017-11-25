<?php

namespace kompaneytsev\phpAlgo\BST;


class RedBlackNode
{
    private $key;
    private $val;
    private $left, $right;
    private $N;
    private $color;

    function __construct($key, $val, int $N, bool $color)
    {
        $this->key = $key;
        $this->val = $val;
        $this->N = $N;
        $this->color = $color;
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

    /**
     * @return RedBlackNode|null
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param RedBlackNode $node
     */
    public function setLeft($node)
    {
        $this->left = $node;
    }

    /**
     * @return RedBlackNode|null
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param RedBlackNode $node
     */
    public function setRight($node)
    {
        $this->right = $node;
    }

    public function getColor(): bool
    {
        return $this->color;
    }

    public function setColor(bool $color)
    {
        $this->color = $color;
    }
}