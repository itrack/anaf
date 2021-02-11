<?php
require_once(__DIR__ . "/../vendor/autoload.php");

// Get data about more CIF
$anaf = new \Itrack\Anaf\Client();
$anaf->addCif("14080700");
$anaf->addCif("RO16826034");
$companies = $anaf->get();

foreach ($companies as $company) {
    echo $company->getName();
    echo $company->getCIF();
    echo $company->getRegCom();
    echo $company->getPhone();
    echo $company->getAddress()->getCounty();
    echo $company->getAddress()->getCounty();
    echo $company->getAddress()->getStreet();
    echo $company->getAddress()->getStreetNumber();

    // ... etc
}
