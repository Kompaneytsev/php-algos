<?php

namespace kompaneytsev\phpAlgo\BST;


use Monolog\Logger;

class BST
{
    private $logger;

    /**
     * @var Node
     */
    private $root;

    /**
     * BST constructor.
     * @param Logger|null $logger
     */
    public function __construct(Logger $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->getNodeSize($this->root);
    }

    /**
     * @param Node $node
     * @return int
     */
    private function getNodeSize(Node $node): int
    {
        if (is_null($node))
            return 0;
        else
            return $node->getN();
    }

    /**
     * @param $key
     * @return int|null
     */
    public function getValue($key)
    {
        return $this->getNodeValue($this->root, $key);
    }

    /**
     * @param Node $x
     * @param $key
     * @return null|int
     */
    private function getNodeValue($x, $key)
    {
        if ($x == null) return null;
        $cmp = $key <=> $x->getKey();
        if ($cmp == -1) return $this->getNodeValue($x->getLeft(), $key);
        else if ($cmp == 1) return $this->getNodeValue($x->getRight(), $key);
        else if ($cmp == 0) return $x->getVal();
        return null;
    }

    /**
     * Add value to tree
     * 
     * @param $key
     * @param $val
     */
    public function putValue($key, $val): void
    {
        if (!is_null($this->logger)) $this->logger->info('put');
        $this->root = $this->putNodeValue($this->root, $key, $val);
    }

    /**
     * @param Node $x
     * @param $key
     * @param $val
     * @return Node
     */
    private function putNodeValue($x, $key, $val)
    {
        if ($x == null) return new Node($key, $val, 1);
        $cmp = $key <=> $x->getKey();
        if (!is_null($this->logger)) $this->logger->info('+'); // logger
        if ($cmp == -1)
            $x->setLeft($this->putNodeValue($x->getLeft(), $key, $val));
        else if ($cmp == 1)
            $x->setRight($this->putNodeValue($x->getRight(), $key, $val));
        else if ($cmp == 0)
            $x->setVal($val);
        else
            new Node($key, $val, 1);

        $left = ($x->getLeft()) ? $x->getLeft()->getN() : 0;
        $right = ($x->getRight()) ? $x->getRight()->getN() : 0;
        $x->setN($left + $right + 1);
        return $x;
    }
}