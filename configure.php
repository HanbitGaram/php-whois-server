<?php
include_once(__DIR__.'/autoload.php');
$configure = new FileReader(__DIR__.'/../configure.json');
$configure->returnType('array');
print_r($configure->get());