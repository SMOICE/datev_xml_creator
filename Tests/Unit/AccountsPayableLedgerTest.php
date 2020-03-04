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
    $invoice = new Model_Invoice(new DateTime('2020-03-03'), 'number', 'supplierName', 'EUR');
    $invoice->addDetail(new Model_InvoiceDetail(59.50, 19));

    $ledger = new View_XML_AccountsPayableLedger($invoice);

    $this->assertEquals($this->getExpected(), $ledger->__toString());
  }
  /*
  public function testMitIban()
  {
    $invoice = array(
      'name' => 'Ronny Grobe und Eltern',
      'nummer' => 'H03532017',
      'datum' => new Datum('2017-07-03'),
      'betrag' => new Money(7209.81, 'EUR'),
      'steuersatz' => 0,
      'iban' => 'DE46760400610000794000',
      'bic' => 'COBADEFF760',
    );

    $ledger = new XML_Datev_AccountsPayableLedger($invoice);

    $this->assertEquals($this->getExpectedMitIban(), $ledger->__toString());
  }

  public function testMitIbanOhneSkonto()
  {
    $invoice = array(
      'name' => 'Ronny Grobe und Eltern',
      'nummer' => 'H03532017',
      'datum' => new Datum('2017-07-03'),
      'betrag' => new Money(7209.81, 'EUR'),
      'steuersatz' => 0,
      'iban' => 'DE46760400610000794000',
      'bic' => 'COBADEFF760',
    );

    $ledger = new XML_Datev_AccountsPayableLedger($invoice,true);

    $this->assertEquals($this->getExpectedOhneSkonto(), $ledger->__toString());
  }
*/

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
  /*
  private function getExpectedMitIban()
  {
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<LedgerImport xmlns=\"http://xml.datev.de/bedi/tps/ledger/v040\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/ledger/v040 Belegverwaltung_online_ledger_import_v040.xsd\" version=\"4.0\" generator_info=\"EEG-Stadtritter\" generating_system=\"Datadiorama_DatevFilter\" xml_data=\"Kopie nur zur Verbuchung berechtigt nicht zum Vorsteuerabzug\">
  <consolidate consolidatedAmount=\"7209.81\" consolidatedDate=\"2017-07-03\" consolidatedInvoiceId=\"H03532017\" consolidatedCurrencyCode=\"EUR\">
    <accountsPayableLedger>
      <date>2017-07-03</date>
      <amount>7209.81</amount>
      <tax>0.00</tax>
      <currencyCode>EUR</currencyCode>
      <invoiceId>H03532017</invoiceId>
      <iban>DE46760400610000794000</iban>
      <swiftCode>COBADEFF760</swiftCode>
      <paymentConditionsId>12</paymentConditionsId>
      <supplierName>Ronny Grobe und Eltern</supplierName>
    </accountsPayableLedger>
  </consolidate>
</LedgerImport>
";
  }

  private function getExpectedOhneSkonto()
  {
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<LedgerImport xmlns=\"http://xml.datev.de/bedi/tps/ledger/v040\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/ledger/v040 Belegverwaltung_online_ledger_import_v040.xsd\" version=\"4.0\" generator_info=\"EEG-Stadtritter\" generating_system=\"Datadiorama_DatevFilter\" xml_data=\"Kopie nur zur Verbuchung berechtigt nicht zum Vorsteuerabzug\">
  <consolidate consolidatedAmount=\"7209.81\" consolidatedDate=\"2017-07-03\" consolidatedInvoiceId=\"H03532017\" consolidatedCurrencyCode=\"EUR\">
    <accountsPayableLedger>
      <date>2017-07-03</date>
      <amount>7209.81</amount>
      <tax>0.00</tax>
      <currencyCode>EUR</currencyCode>
      <invoiceId>H03532017</invoiceId>
      <iban>DE46760400610000794000</iban>
      <swiftCode>COBADEFF760</swiftCode>
      <supplierName>Ronny Grobe und Eltern</supplierName>
    </accountsPayableLedger>
  </consolidate>
</LedgerImport>
";
  }
*/
}
