<?php

/**
 * Represents a single node in a binary tree.
 *
 * @author Nicholas Brink <nbrink7@gmail.edu>
 * @package Model
 */
class BinaryNode
{
    /**
     * @var BinaryNode
     */
    private $parent;

    /**
     * @var int
     */
    public $level;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @var BinaryNode
     */
    public $left;

    /**
     * @var BinaryNode
     */
    public $right;

    /**
     * BinaryNode constructor.
     *
     * @param null $value Value for the node.
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return BinaryNode
     */
    public function getParent(): BinaryNode
    {
        return $this->parent;
    }

    /**
     * @param BinaryNode $parent
     * @return BinaryNode
     */
    public function setParent(BinaryNode $parent): BinaryNode
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return BinaryNode
     */
    public function setLevel(int $level): BinaryNode
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return BinaryNode|null
     */
    public function getLeft(): ?BinaryNode
    {
        return $this->left;
    }

    /**
     * @return BinaryNode|null
     */
    public function getRight(): ?BinaryNode
    {
        return $this->right;
    }



    /**
     * Search for a child node in the binary tree for the given value.
     *
     * @param mixed $value Value for a node in the tree.
     * @return BinaryNode Binary node for the given value.
     * @throws Exception Error occurs when a node is not found.
     */
    public function find($value): BinaryNode
    {
        if ($value === $this->getValue()) {
            return $this;
        } else if ($value < $this->getValue()) {
            return $this->getLeft()->find($value);
        } else if ($value > $this->getValue()) {
            return ($this->getRight()->find($value));
        }

        throw new Exception('No node found for given value.');
    }
}