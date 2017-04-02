<?php

/**
 * Represents a binary tree that can contain nodes.
 *
 * @author Nicholas Brink <nbrink7@gmail.com>
 */
class BinaryTree
{
    /**
     * @var BinaryNode|null
     */
    private $root;

    /**
     * @var int
     */
    private $maxLevel = 0;

    /**
     * @return int
     */
    public function getMaxLevel(): int
    {
        return $this->maxLevel;
    }

    /**
     * @param int $maxLevel
     * @return BinaryTree
     */
    public function setMaxLevel(int $maxLevel): BinaryTree
    {
        $this->maxLevel = $maxLevel;
        return $this;
    }

    /**
     * Add a new node, using the insert function to put it into the correct location.
     *
     * @param   mixed       $value  New node being added.
     * @return  BinaryTree          Returns the tree.
     */
    public function add($value): BinaryTree
    {
        $node = new BinaryNode($value);

        if ($this->root === null) {
            $node->setLevel(1);
            $this->root = $node;
        } else {
            $this->insert($node, $this->root);
        }

        return $this;
    }

    /**
     * Insert a new node into the tree.
     *
     * @param BinaryNode      $node     Node object to be inserted into the tree.
     * @param BinaryNode|null $subtree  Next node in the tree.
     * @param int             $level    Current level of the tree.
     */
    private function insert(BinaryNode $node, ?BinaryNode &$subtree, int $level = 0): void
    {
        if ($this->getMaxLevel() < ++$level) {
            $this->setMaxLevel($level);
        }

        if (!$subtree instanceof BinaryNode) {
            $node->setLevel($level);
            $subtree = $node;
        } else {
            $node->setParent($subtree);
            if ($node->value > $subtree->value) {
                $this->insert($node, $subtree->right, $level);
            } else if ($node->value < $subtree->value) {
                $this->insert($node, $subtree->left, $level);
            }
        }
    }

    /**
     * Find the parent node of two given values.
     *
     * @param   mixed       $value1     Value of a child.
     * @param   mixed       $value2     Value of another child.
     * @return  BinaryNode  Parent node for the two values.
     */
    public function parentFinder($value1, $value2): BinaryNode
    {
        // Find value 1
        $node1 = $this->find($value1);

        // Find value 2
        $node2 = $this->find($value2);

        while ($node1->getParent() != $node2->getParent()) {
            if ($node1->getLevel() > $node2->getLevel()) {
                $node1 = $node1->getParent();
            } else if ($node2->getLevel() > $node1->getLevel()) {
                $node2 = $node2->getParent();
            } else if ($node1->getLevel() === $node2->getLevel()) {
                $node1 = $node1->getParent();
                $node2 = $node2->getParent();
            }
        }

        $this->printAll(20, $value1, $value2, $node1->getParent()->getValue());

        return $node1->getParent();
    }

    /**
     * Find a node for a given value.
     *
     * @param mixed         $value  Value of a node.
     * @return BinaryNode           Node object for the given value if one is found.
     */
    public function find($value): BinaryNode
    {
        return $this->getRoot()->find($value);
    }

    /**
     * Get the root node of the binary tree.
     *
     * @return BinaryNode|null  Root node of the binary tree.
     */
    public function getRoot(): ?BinaryNode
    {
        return $this->root;
    }

    /**
     * Print the binary tree in the terminal.
     */
    public function print(): void
    {
        $this->printAll();
    }

    /**
     * Build an array that can be printed in a left to right order.
     *
     * @param BinaryNode $node
     * @param array      $list
     */
    public function buildPrint(BinaryNode $node, array &$list): void
    {
        $list[$node->getLevel()][] = $node->getValue();

        if ($node->getLeft() !== null) {
            $this->buildPrint($node->getLeft(), $list);
        } else {
            $num = 1;
            for ($currentLevel = $node->getLevel() + 1; $currentLevel <= $this->getMaxLevel(); $currentLevel++) {
                for ($i = 1; $i <= $num; $i++) {
                    $list[$currentLevel][] = null;
                }
                $num *= 2;
            }
        }

        if ($node->getRight() !== null) {
            $this->buildPrint($node->getRight(), $list);
        } else {
            $num = 1;
            for ($currentLevel = $node->getLevel() + 1; $currentLevel <= $this->getMaxLevel(); $currentLevel++) {
                for ($i = 1; $i <= $num; $i++) {
                    $list[$currentLevel][] = null;
                }
                $num *= 2;
            }
        }
    }

    /**
     * Print out the entire tree to the terminal.
     *
     * @param int           $width          Width for each cell.
     * @param mixed|null    $nodeValue1     Value passed into parent finder.
     * @param mixed|null    $nodeValue2     Value2 passed into parent finder.
     * @param mixed|null    $parentValue    Parent returned from parent finder.
     */
    private function printAll(int $width = 20, $nodeValue1 = null, $nodeValue2 = null, $parentValue = null): void
    {
        $list = [];
        $this->buildPrint($this->root, $list);

        $overallWidth = count($list[count($list)]) * ($width + 2);

        foreach ($list as $row)
        {
            $outsideRow = "";
            $insideRow = "";
            $cellPadding = $overallWidth / count($row);

            foreach ($row as $value) {

                if (empty($value)) {
                  $borderString = "-";
                } else if ($value === $nodeValue1 || $value === $nodeValue2) {
                    $borderString = '=';
                } else if ($value === $parentValue) {
                    $borderString = '*';
                } else {
                    $borderString = '-';
                }

                $newOutsideRow = ' ' . str_repeat($borderString, 20) . ' ';
                $newOutsideRow = str_pad($newOutsideRow, $cellPadding, " ", STR_PAD_BOTH);
                $outsideRow .= $newOutsideRow;

                $newInsideRow = ' ' . $borderString . str_pad($value, $width - 2, " ", STR_PAD_BOTH) . $borderString . " ";
                $newInsideRow = str_pad($newInsideRow, $cellPadding, " ", STR_PAD_BOTH);
                $insideRow .= $newInsideRow;
            }

            $outsideRow .= "\n";
            $insideRow .= "\n";

            echo $outsideRow;
            echo $insideRow;
            echo $outsideRow;
        }
    }
}