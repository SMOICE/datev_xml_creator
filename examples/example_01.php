<?php

require_once __DIR__ . '/../Exception/DocumentCreator.php';

require_once __DIR__ . '/../Model/Base.php';
require_once __DIR__ . '/../Model/Invoice.php';
require_once __DIR__ . '/../Model/InvoiceDetail.php';
require_once __DIR__ . '/../Model/Kontenrahmen.php';

require_once __DIR__ . '/../Creator/DocumentPackage.php';

require_once __DIR__ . '/../View/XML/Base.php';
require_once __DIR__ . '/../View/XML/AccountsReceivableLedger.php';
require_once __DIR__ . '/../View/XML/Archive.php';


$invoice = new smoice\datev\Model_Invoice(new DateTime('2020-03-04'), 3657, 'Lieschen Müller', 'EUR');
$invoice->addDetail(new smoice\datev\Model_InvoiceDetail(2975, 19));

try {
  $creator = new smoice\datev\Creator_DocumentPackage($invoice, "ausgangsrechnung_01.pdf", "example_01.zip");
  $creator->createOutput();
} catch (smoice\datev\Exception_DocumentCreator $e) {
  echo $e->getMessage()."\n";
}
