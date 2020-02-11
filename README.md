# API ANAF
Librarie PHP pentru verificarea gratuita a contribuabililor care sunt inregistrati conform art. 316 din Codul Fiscal

[![Latest Version](http://img.shields.io/packagist/v/itrack/anaf.svg)](https://packagist.org/packages/itrack/anaf)
[![Build Status](https://travis-ci.com/itrack/anaf.svg?branch=master)](https://travis-ci.com/itrack/anaf)

-----

Date care pot fi obtinute:
  - Denumire/Adresa companie
  - Platitor/Neplatitor TVA
  - Platitor TVA la incasare
  - Platitor Split TVA
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
$cui = "123456";
$dataVerificare = "YYYY-MM-DD";
$anaf->addCui($cui, $dataVerificare);
```


#### Conform exemplului de mai jos:

```php
$cui = "123456";
$dataVerificare = "2019-05-20";
$anaf->addCui($cui, $dataVerificare);
$raspuns = $anaf->getOneResult();
```

### Pentru a verifica mai multe CUI-uri in acelasi timp foloseste urmeaza exemplul de mai jos:

```php
$anaf->addCui("123456", "2019-05-20");
$anaf->addCui("RO654321"); // Daca data nu este setata, valoarea default va fi data de azi
$raspuns = $anaf->getResults();

// SAU

$cuis = [
  "123456",
  "RO6543221"
];
$anaf->addCui($cuis, "2019-05-20");
$raspuns = $anaf->getResults();
```

# Exemplu raspuns
![Raspuns ANAF](https://github.com/itrack/anaf/blob/master/response.PNG?raw=true)


# Limite
Poti solicita raspuns pentru maxim 500 de CUI-uri simultan cu o rata de 1 request / secunda. 

# Requirements
* PHP >= 5.5
* Ext-Curl
* Ext-Json
* Ext-Mbstring

# Tratarea exceptiilor
Din versiunea 2.0.0 am adaugat exceptii pentru tratarea erorilor, pentru a nu afecta mediile de productie te rog sa tratezi aceste exceptii prin try -> catch

Exceptii:

* Itrack\Anaf\Exceptions\LimitExceeded - Ai depasit limita de 500 de CUI-uri / request;
* Itrack\Anaf\Exceptions\ResponseFailed - Raspunsul primit de la ANAF nu este in format JSON, exceptia returneaza body-ul raspunsului pentru a fi verificat manual;
* Itrack\Anaf\Exceptions\RequestFailed - Raspunsul primit de la ANAF nu are status de succes, verifica manual raspunsul primit in exceptie.

# Contribuitori
[![Contribuitori](https://contributors-img.firebaseapp.com/image?repo=itrack/anaf)](https://github.com/itrack/anaf/graphs/contributors)

# Linkuri utile
https://blog.turma.ro/api-anaf/ <br>
https://webservicesp.anaf.ro/PlatitorTvaRest/api/v4/
