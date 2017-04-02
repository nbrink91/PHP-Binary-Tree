<?php

$srcRoot = "./src";
$buildRoot = "./build";

$phar = new Phar($buildRoot . "/treetest.phar", FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, "treetest.phar");
$phar["application.php"] = file_get_contents($srcRoot . "/application.php");
$phar["BinaryNode.php"] = file_get_contents($srcRoot . "/BinaryNode.php");
$phar["BinaryTree.php"] = file_get_contents($srcRoot . "/BinaryTree.php");
$phar->setStub($phar->createDefaultStub("application.php"));