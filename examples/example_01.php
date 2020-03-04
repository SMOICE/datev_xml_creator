<?php

require_once __DIR__.'/../vendor/autoload.php';

$invoice = new smoice\datev\Model_Invoice(new DateTime('2020-03-04'), 3657, 'Lieschen Müller', 'EUR');
$invoice->addDetail(new smoice\datev\Model_InvoiceDetail(2975, 19));

try {
  $creator = new smoice\datev\Creator_DocumentPackage($invoice, "ausgangsrechnung_01.pdf", "example_01.zip");
  $creator->createOutput();
} catch (smoice\datev\Exception_DocumentCreator $e) {
  echo $e->getMessage()."\n";
}
