<?php

class View_XML_AccountsReceivableLedger extends View_XML_Base
{
  protected $invoice;

  public function __construct(Model_Invoice $invoice)
  {
    parent::__construct();
    $this->invoice = $invoice;
  }

  protected function rootElement()
  {
    return '<LedgerImport xmlns="http://xml.datev.de/bedi/tps/ledger/v040" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://xml.datev.de/bedi/tps/ledger/v040 Belegverwaltung_online_ledger_import_v040.xsd" version="4.0" generator_info="SMOICE-DATEV" generating_system="SMOICE-DATEV" xml_data="Kopie nur zur Verbuchung berechtigt nicht zum Vorsteuerabzug" />';
  }

  protected function generateContent()
  {
    $consolidate = $this->addConsolidate();
    foreach($this->invoice->details as $detail)
    {$this->addDetails($consolidate,$detail);}
  }

  protected function addConsolidate()
  {
    $consolidate = $this->xml->addChild('consolidate');
    $consolidate->addAttribute('consolidatedAmount', sprintf("%0.2f", $this->invoice->amount));
    $consolidate->addAttribute('consolidatedCurrencyCode', $this->invoice->currencyCode);
    $consolidate->addAttribute('consolidatedDate', $this->invoice->date->format('Y-m-d'));
    $consolidate->addAttribute('consolidatedInvoiceId', $this->invoice->number);
    
    return $consolidate;
  }

  protected function addDetails(SimpleXMLElement $consolidate, Model_InvoiceDetail $detail)
  {
    $accountsReceivableLedger = $consolidate->addChild('accountsReceivableLedger');
    $accountsReceivableLedger->addChild('date', $this->invoice->date->format('Y-m-d'));
    $accountsReceivableLedger->addChild('amount', sprintf("%0.2f", $detail->amount));
    $accountsReceivableLedger->addChild('accountNo', "4400");
    $accountsReceivableLedger->addChild('tax', sprintf("%0.2f", $detail->taxRate));
    $accountsReceivableLedger->addChild('currencyCode', $this->invoice->currencyCode);
    $accountsReceivableLedger->addChild('invoiceId', $this->invoice->number);
    $accountsReceivableLedger->addChild('customerName', htmlspecialchars($this->invoice->customerName, ENT_XML1, 'UTF-8'));
  }
}
