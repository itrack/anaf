# API ANAF
Librarie PHP pentru verificarea contribuabililor care sunt inregistrati conform art. 316 din Codul Fiscal

# Instalare
composer require itrack/anaf

# Exemplu de folosire

- Initializare clasa

$anaf = new Itrack\Anaf\Client(); <br><br>

- Pentru a verifica doar un cui urmati foloseste metoda $anaf->addCui("CUI", "DATA VERIFICARE") conform exemplului de mai jos:

$anaf->addCui("123456", "2017-12-31"); <br>
print_r($anaf->getResults());<br><br>

- Pentru a verifica mai multe CUI-uri in acelasi timp foloseste metoda $anaf->addCui("CUI", "DATA VERIFICARE") de mai multe ori:

$anaf->addCui("123456", "2017-12-31"); <br>
$anaf->addCui("654321", "2017-11-24"); <br>
print_r($anaf->getResults());
