# API ANAF
Librarie PHP pentru verificarea gratuita a contribuabililor care sunt inregistrati conform art. 316 din Codul Fiscal

[![Latest Version](http://img.shields.io/packagist/v/itrack/anaf.svg)](https://packagist.org/packages/itrack/anaf)
[![Build Status](https://travis-ci.com/itrack/anaf.svg?branch=master)](https://app.travis-ci.com/itrack/anaf)
[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://vshymanskyy.github.io/StandWithUkraine/)

-----

[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner2-direct.svg)](https://vshymanskyy.github.io/StandWithUkraine/)

-----

Date care pot fi obtinute:
  - Denumire/Adresa companie
  - Numar Registrul Comertului
  - Numar de telefon
  - Platitor/Neplatitor TVA
  - Platitor TVA la incasare
  - Platitor Split TVA pana la 1 februarie 2020 (**OUG 23/2017 privind plata defalcată a TVA a fost abrogata incepand cu 1 februarie 2020**)
  - IBAN Split TVA
  - Data inregistrare TVA
  - Status Societate (Activa/Inactiva)
  - Data radiere
  
:heart: Daca iti este de folos te rog sa oferi o stea :star:
  
# Instalare

```shell
composer require itrack/anaf
```

# Exemplu de folosire

- Initializare librarie

```php
$anaf = new \Itrack\Anaf\Client(); 
```

### Pentru a verifica doar un CUI foloseste metoda 

```php
$cif = "123456";
$dataVerificare = "YYYY-MM-DD";
$anaf->addCif($cif, $dataVerificare);
```


#### Conform exemplului de mai jos:

```php
$cif = "123456";
$dataVerificare = "2019-05-20";
$anaf->addCif($cif, $dataVerificare);
$company = $anaf->first();

// Metode disponibile
echo $company->getName();
echo $company->getCIF();
echo $company->getRegCom();
echo $company->getPhone();

echo $company->getFullAddress();
echo $company->getAddress()->getCity();
echo $company->getAddress()->getCounty();
echo $company->getAddress()->getStreet();
echo $company->getAddress()->getStreetNumber();
echo $company->getAddress()->getPostalCode();
echo $company->getAddress()->getOthers();

echo $company->getTVA()->hasTVA();
echo $company->getTVA()->getTVAEnrollDate();
echo $company->getTVA()->getTVAEndDate();

echo $company->getTVA()->hasTVACollection();
echo $company->getTVA()->getTVACollectionEnrollDate();
echo $company->getTVA()->getTVACollectionEndDate();

echo $company->getTVA()->hasTVASplit();
echo $company->getTVA()->getTVASplitEnrollDate();
echo $company->getTVA()->getTVASplitEndDate();
echo $company->getTVA()->getTVASplitIBAN();

echo $company->getReactivationDate();
echo $company->getInactivationDate();
echo $company->getDeletionDate();
echo $company->isActive();
```

### Pentru a verifica mai multe CUI-uri in acelasi timp foloseste urmeaza exemplul de mai jos:

```php
$anaf->addCif("123456", "2019-05-20");
$anaf->addCif("RO654321"); // Daca data nu este setata, valoarea default va fi data de azi
$raspuns = $anaf->get();

// SAU

$cifs = [
  "123456",
  "RO6543221"
];
$anaf->addCif($cifs, "2019-05-20");
$raspuns = $anaf->get();
```

# Limite
Poti solicita raspuns pentru maxim 500 de CUI-uri simultan cu o rata de 1 request / secunda. 

# Requirements
* PHP >= 7.1 | >= 8
* Ext-Curl
* Ext-Json
* Ext-Mbstring

# Exceptii:

* Itrack\Anaf\Exceptions\LimitExceeded - Ai depasit limita de 500 de CUI-uri / request;
* Itrack\Anaf\Exceptions\ResponseFailed - Raspunsul primit de la ANAF nu este in format JSON, exceptia returneaza body-ul raspunsului pentru a fi verificat manual;
* Itrack\Anaf\Exceptions\RequestFailed - Raspunsul primit de la ANAF nu are status de succes, verifica manual raspunsul primit in exceptie.

# Upgrade de la 2 la 3
Versiunea 2 nu este compatibila cu versiunea 3, daca aveti o implementare vechie, trebuie refacuta pentru a fi compatibila.

# Contribuitori
[![Contribuitori](https://contributors-img.firebaseapp.com/image?repo=itrack/anaf)](https://github.com/itrack/anaf/graphs/contributors)

# Linkuri utile
https://webservicesp.anaf.ro/PlatitorTvaRest/api/v6/
