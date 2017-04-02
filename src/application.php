<?php

require_once 'BinaryNode.php';
require_once 'BinaryTree.php';

// Build the tree.
$binaryTree = new BinaryTree();
do {
    $entry = readline("Would you like to add values to the tree (Y/n)? ");

    if (strtoupper($entry) == 'Y') {
        do {
            $value = readline("Enter a node value (type print to see the current tree, exit to continue): ");
            if (strtolower($value) === 'print') {
                $binaryTree->print();
            } else if (!empty(trim($value)) && strtolower($value) !== 'exit') {
                $binaryTree->add($value);
            }

        } while(strtolower($value) !== 'exit');

    }
} while (strtoupper($entry) != 'N');

// Allow the user to enter children nodes and find the parent and display.
echo 'Enter two nodes below to find the parent. The two entered nodes will be surrounded by "=" signs and the parent will be surrounded by "*."' . "\n";

$node1Value = readline('Enter node 1: ');
$node2Value = readline('Enter node 2: ');

do {
    // Handle if a node is not found.
    try {
        $parent = $binaryTree->parentFinder($node1Value, $node2Value);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} while (empty($parent));

echo "The parent node is " . $parent->getValue() . "!\n";