<?php
// Load Abstract Class
$libraryList = glob(__DIR__.'/library/*Abstract.php');
foreach($libraryList as $fileName) include_once($fileName);
unset($libraryList);

// Load General Class
$libraryList = glob(__DIR__.'/library/*.php');
foreach($libraryList as $fileName) include_once($fileName);
unset($libraryList);