<?php
include("vendor/autoload.php");

// Gather data about more CUI's
$anaf = new \Itrack\Anaf\Client();

$anaf->addCui(123456, "2019-05-31");
$anaf->addCui("RO16826034");

print_r($anaf->getResults());

// Gather data about more CUI's using an array
$anaf = new \Itrack\Anaf\Client();

$cuis = [
    "RO123456",
    "123456",
    123456
];
$anaf->addCui($cuis);

print_r($anaf->getResults());

// Gather data about one CUI
$anaf = new \Itrack\Anaf\Client();

$anaf->addCui("14080700");

print_r($anaf->getOneResult());

/*
Output example:

stdClass Object
(
    [cui] => 14080700
    [data] => 2019-06-01
    [denumire] => REALITATEA MEDIA SA
    [adresa] => stdClass Object
        (
            [raw] => MUNICIPIUL BUCUREŞTI, SECTOR 1, ŞOS. BUCUREŞTI-PLOIEŞTI, NR.172-176, BL.CORP A, ET.3, AP.CAMERA 5
            [judet] => Municipiul Bucureşti
            [localitate] => Sector 1
            [strada] => Şos. Bucureşti-Ploieşti
            [numar] => 172-176
            [altele] => Bl.corp A, Et.3, Ap.camera 5
        )

    [scpTVA] => 1
    [data_inceput_ScpTVA] => 2001-08-01
    [data_sfarsit_ScpTVA] =>
    [data_anul_imp_ScpTVA] =>
    [mesaj_ScpTVA] => platitor IN SCOPURI de TVA la data cautata
    [dataInceputTvaInc] =>
    [dataSfarsitTvaInc] =>
    [dataActualizareTvaInc] =>
    [dataPublicareTvaInc] =>
    [tipActTvaInc] =>
    [statusTvaIncasare] =>
    [dataInactivare] =>
    [dataReactivare] =>
    [dataPublicare] =>
    [dataRadiere] =>
    [statusInactivi] =>
    [dataInceputSplitTVA] => 2018-03-01
    [dataAnulareSplitTVA] =>
    [statusSplitTVA] => 1
    [iban] => RO53TREZ701505001XXXXTVA
)
 */