<?php

require_once __DIR__ . '/BaseTestCase.php';

require_once __DIR__ . '/../../Model/Base.php';
require_once __DIR__ . '/../../Model/Invoice.php';
require_once __DIR__ . '/../../Model/InvoiceDetail.php';
require_once __DIR__ . '/../../Model/Kontenrahmen.php';

require_once __DIR__ . '/../../View/XML/Base.php';
require_once __DIR__ . '/../../View/XML/AccountsReceivableLedger.php';
require_once __DIR__ . '/../../View/XML/AccountsPayableLedger.php';

class View_XML_AccountsPayableLedgerTest extends BaseTestCase
{
  public function testNormal()
  {
    $invoice = new smoice\datev\Model_Invoice(new \DateTime('2020-03-03'), 'number', 'supplierName', 'EUR');
    $invoice->addDetail(new smoice\datev\Model_InvoiceDetail(59.50, 19));

    $ledger = new smoice\datev\View_XML_AccountsPayableLedger($invoice);

    $this->assertEquals($this->getExpected(), $ledger->__toString());
  }

  private function getExpected()
  {
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<LedgerImport xmlns=\"http://xml.datev.de/bedi/tps/ledger/v040\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/ledger/v040 Belegverwaltung_online_ledger_import_v040.xsd\" version=\"4.0\" generator_info=\"SMOICE-DATEV\" generating_system=\"SMOICE-DATEV\" xml_data=\"Kopie nur zur Verbuchung berechtigt nicht zum Vorsteuerabzug\">
  <consolidate consolidatedAmount=\"59.50\" consolidatedDate=\"2020-03-03\" consolidatedInvoiceId=\"number\" consolidatedCurrencyCode=\"EUR\">
    <accountsPayableLedger>
      <date>2020-03-03</date>
      <amount>59.50</amount>
      <tax>19.00</tax>
      <currencyCode>EUR</currencyCode>
      <invoiceId>number</invoiceId>
      <supplierName>supplierName</supplierName>
    </accountsPayableLedger>
  </consolidate>
</LedgerImport>
";
  }
}
