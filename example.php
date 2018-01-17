<?php
include("vendor/autoload.php");

$anaf = new \Itrack\Anaf\Client();
$anaf->addCui("123456", "2017-12-31");
$anaf->addCui("654321", "2017-11-24");
print_r($anaf->getResults());