# API ANAF
Librarie PHP pentru verificarea gratuita a contribuabililor care sunt inregistrati conform art. 316 din Codul Fiscal

[![Latest Version](http://img.shields.io/packagist/v/itrack/anaf.svg)](https://packagist.org/packages/itrack/anaf)
[![Build Status](https://github.com/itrack/anaf/actions/workflows/tests.yml/badge.svg)](https://app.travis-ci.com/itrack/anaf)

-----


Date care pot fi obtinute:
  - Denumire/Adresa companie
  - Numar Registrul Comertului
  - Numar de telefon / Fax
  - Cod CAEN
  - Act autorizare
  - Stare inregistrare / Data inregistrare
  - Status RO e-Factura
  - Organ fiscal competent
  - Forma de proprietate / Forma de organizare / Forma juridica
  - Adresa sediu social (structurata: strada, numar, localitate, judet, cod postal, tara, detalii)
  - Adresa domiciliu fiscal (structurata: strada, numar, localitate, judet, cod postal, tara, detalii)
  - Platitor/Neplatitor TVA (cu data anulare si temei legal)
  - Platitor TVA la incasare (cu data actualizare, publicare, tip actualizare)
  - Platitor Split TVA (**OUG 23/2017 privind plata defalcată a TVA a fost abrogata incepand cu 1 februarie 2020**)
  - IBAN Split TVA
  - Status Societate (Activa/Inactiva)
  - Data inactivare / Data reactivare / Data publicare / Data radiere
  
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

// Date generale
echo $company->getName();
echo $company->getCIF();
echo $company->getSearchDate();
echo $company->getRegCom();
echo $company->getPhone();
echo $company->getFax();
echo $company->getPostalCode();
echo $company->getAuthorizationAct();
echo $company->getRegistrationState();
echo $company->getRegistrationDate();
echo $company->getCAENCode();
echo $company->getIBAN();
echo $company->hasEFactura();
echo $company->getCompetentFiscalBody();
echo $company->getOwnershipForm();
echo $company->getOrganizationForm();
echo $company->getLegalForm();

// Adresa sediu social (structurata)
echo $company->getHeadquartersAddress()->getStreet();
echo $company->getHeadquartersAddress()->getStreetNumber();
echo $company->getHeadquartersAddress()->getCity();
echo $company->getHeadquartersAddress()->getCityCode();
echo $company->getHeadquartersAddress()->getCounty();
echo $company->getHeadquartersAddress()->getCountyCode();
echo $company->getHeadquartersAddress()->getCountyAutoCode();
echo $company->getHeadquartersAddress()->getCountry();
echo $company->getHeadquartersAddress()->getAddressDetails();
echo $company->getHeadquartersAddress()->getPostalCode();

// Adresa domiciliu fiscal (structurata)
echo $company->getFiscalAddress()->getStreet();
echo $company->getFiscalAddress()->getStreetNumber();
echo $company->getFiscalAddress()->getCity();
echo $company->getFiscalAddress()->getCityCode();
echo $company->getFiscalAddress()->getCounty();
echo $company->getFiscalAddress()->getCountyCode();
echo $company->getFiscalAddress()->getCountyAutoCode();
echo $company->getFiscalAddress()->getCountry();
echo $company->getFiscalAddress()->getAddressDetails();
echo $company->getFiscalAddress()->getPostalCode();

// Adresa (backward compatibility api - depreciat)
echo $company->getFullAddress();
echo $company->getAddress()->getCity();
echo $company->getAddress()->getCounty();
echo $company->getAddress()->getStreet();
echo $company->getAddress()->getStreetNumber();
echo $company->getAddress()->getPostalCode();
echo $company->getAddress()->getOthers();

// TVA
echo $company->getTVA()->hasTVA();
echo $company->getTVA()->getTVAEnrollDate();
echo $company->getTVA()->getTVAEndDate();
echo $company->getTVA()->getTVACancellationDate();
echo $company->getTVA()->getTVACancellationMessage();

// TVA la incasare
echo $company->getTVA()->hasTVACollection();
echo $company->getTVA()->getTVACollectionEnrollDate();
echo $company->getTVA()->getTVACollectionEndDate();
echo $company->getTVA()->getTVACollectionUpdateDate();
echo $company->getTVA()->getTVACollectionPublishDate();
echo $company->getTVA()->getTVACollectionUpdateType();

// Split TVA
echo $company->getTVA()->hasTVASplit();
echo $company->getTVA()->getTVASplitEnrollDate();
echo $company->getTVA()->getTVASplitEndDate();
echo $company->getTVA()->getTVASplitIBAN();

// Stare inactiv
echo $company->isActive();
echo $company->getInactivationDate();
echo $company->getReactivationDate();
echo $company->getPublishDate();
echo $company->getDeletionDate();
```

### Pentru a verifica mai multe CUI-uri in acelasi timp urmeaza exemplul de mai jos:

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
Poti solicita raspuns pentru maxim 100 de CUI-uri simultan cu o rata de 1 request / secunda. 

# Requirements
* PHP >= 7.1 | >= 8
* Ext-Curl
* Ext-Json
* Ext-Mbstring

# Exceptii:

* Itrack\Anaf\Exceptions\LimitExceeded - Ai depasit limita de 100 de CUI-uri / request;
* Itrack\Anaf\Exceptions\ResponseFailed - Raspunsul primit de la ANAF nu este in format JSON, exceptia returneaza body-ul raspunsului pentru a fi verificat manual;
* Itrack\Anaf\Exceptions\RequestFailed - Raspunsul primit de la ANAF nu are status de succes, verifica manual raspunsul primit in exceptie.

# Upgrade de la 2 la 3
Versiunea 2 nu este compatibila cu versiunea 3, daca aveti o implementare veche, trebuie modificata pentru a fi compatibila.

# Contribuitori
[![Contribuitori](https://contributors-img.firebaseapp.com/image?repo=itrack/anaf)](https://github.com/itrack/anaf/graphs/contributors)

# Linkuri utile
https://static.anaf.ro/static/10/Anaf/Informatii_R/Servicii_web/doc_WS_V9.txt
