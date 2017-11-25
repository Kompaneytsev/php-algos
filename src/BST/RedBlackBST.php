<?php

namespace kompaneytsev\phpAlgo\BST;


use Monolog\Logger;

class RedBlackBST
{
    private $logger;
    
    const RED = true;
    const BLACK = false;

    /**
     * @var RedBlackNode
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
     * @param RedBlackNode $node
     * @return int
     */
    private function getNodeSize($node): int
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
     * @param RedBlackNode $x
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
     * @param RedBlackNode $x
     * @return bool
     */
    private function isRed($x)
    {
        if (is_null($x)) return false;
        return $x->getColor() === self::RED;
    }

    /**
     * @param RedBlackNode $h
     * @return RedBlackNode
     */
    private function rotateLeft($h)
    {
        $x = clone $h->getRight();
        $h->setRight($x->getLeft());
        $x->setLeft($h);
        $x->setColor($h->getColor());
        $h->setColor(self::RED);
        $x->setN($h->getN());
        $h->setN(1+$this->getNodeSize($h->getLeft()) + $this->getNodeSize($h->getRight()));
        return $x;
    }

    /**
     * @param RedBlackNode $h
     * @return RedBlackNode
     */
    private function rotateRight($h)
    {
        $x = clone $h->getLeft();
        $h->setLeft($x->getRight());
        $x->setRight($h);
        $x->setColor($h->getColor());
        $h->setColor(self::RED);
        $x->setN($h->getN());
        $h->setN(1+$this->getNodeSize($h->getLeft()) + $this->getNodeSize($h->getRight()));
        return $x;
    }

    /**
     * @param RedBlackNode $h
     */
    private function flipColors($h)
    {
        $h->setColor(self::RED);
        $h->getLeft()->setColor(self::BLACK);
        $h->getRight()->setColor(self::BLACK);
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
        $this->root->setColor(self::BLACK);
    }

    /**
     * @param RedBlackNode $x
     * @param $key
     * @param $val
     * @return RedBlackNode
     */
    private function putNodeValue($x, $key, $val)
    {
        if ($x == null) return new RedBlackNode($key, $val, 1, self::RED);
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
        
        if ($this->isRed($x->getRight()) && !$this->isRed($x->getLeft()))
            $x = $this->rotateLeft($x);
        if ($this->isRed($x->getLeft()) && $this->isRed($x->getLeft()->getLeft()))
            $x = $this->rotateRight($x);
        if ($this->isRed($x->getLeft()) && $this->isRed($x->getRight()))
            $this->flipColors($x);

        $left = ($x->getLeft()) ? $x->getLeft()->getN() : 0;
        $right = ($x->getRight()) ? $x->getRight()->getN() : 0;
        $x->setN($left + $right + 1);
        return $x;
    }
}