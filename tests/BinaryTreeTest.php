<?php

/**
 * Test cases for the BinaryTree class.
 *
 * @author Nicholas Brink <nbrink7@gmail.com>
 */
class BinaryTreeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Verify that the nodes are aligning correctly.
     */
    public function testAdd(): void
    {
        $binaryTree = new BinaryTree();
        $binaryTree
            ->add(7)
            ->add(5)
            ->add(9)
            ->add(10)
            ->add(1);

        $this->assertEquals(7, $binaryTree->getRoot()->getValue());
        $this->assertEquals(5, $binaryTree->getRoot()->getLeft()->getValue());
        $this->assertEquals(10, $binaryTree->getRoot()->getRight()->getRight()->getValue());
        $this->assertEquals(3, $binaryTree->getMaxLevel());
        $this->assertEquals(1, $binaryTree->getRoot()->getLevel());
        $this->assertEquals(2, $binaryTree->getRoot()->getRight()->getLevel());
        $this->assertEquals(3, $binaryTree->getRoot()->getLeft()->getLeft()->getLevel());
    }

    /**
     * Verify that the parent lookup finds the correct parent.
     */
    public function testParentFinder(): void
    {
        $binaryTree = new BinaryTree();
        $binaryTree
            ->add(7)
            ->add(5)
            ->add(9)
            ->add(10)
            ->add(1)
            ->add(8)
            ->add(56);

        $this->assertEquals(9, $binaryTree->parentFinder(8,56)->getValue());
        $this->assertEquals(7, $binaryTree->parentFinder(1,56)->getValue());
    }

    /**
     * Verify that the print array is correct.
     */
    public function testBuildPrint(): void
    {
        $binaryTree = new BinaryTree();
        $binaryTree
            ->add(7)
            ->add(5)
            ->add(9)
            ->add(10)
            ->add(1);

        $list = [];
        $binaryTree->buildPrint($binaryTree->getRoot(), $list);

        $this->assertCount(3, $list);
        $this->assertCount(1, $list[1]);
        $this->assertCount(2, $list[2]);
        $this->assertCount(4, $list[3]);
    }
}