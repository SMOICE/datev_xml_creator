<?php

namespace smoice\datev;

class View_XML_AccountsReceivableLedger extends View_XML_Base
{
  protected $invoice;
  protected $kontenrahmen;

  public function __construct(Model_Invoice $invoice, Model_Kontenrahmen $rahmen = null)
  {
    parent::__construct();
    $this->invoice = $invoice;
    $this->kontenrahmen = $rahmen ? $rahmen : new Model_Kontenrahmen;
  }

  protected function rootElement()
  {
    return '<LedgerImport '.$this->xmlns().' generator_info='.$this->generator().' generating_system='.$this->generator().' xml_data="Kopie nur zur Verbuchung berechtigt nicht zum Vorsteuerabzug" />';
  }

  protected function generateContent()
  {
    $consolidate = $this->addConsolidate();
    foreach($this->invoice->details as $detail)
    {$this->addDetails($consolidate,$detail);}
  }

  protected function addConsolidate(): \SimpleXMLElement
  {
    $consolidate = $this->xml->addChild('consolidate');
    $consolidate->addAttribute('consolidatedAmount', sprintf("%0.2f", $this->invoice->amount));
    $consolidate->addAttribute('consolidatedCurrencyCode', $this->invoice->currencyCode);
    $consolidate->addAttribute('consolidatedDate', $this->invoice->date->format('Y-m-d'));
    $consolidate->addAttribute('consolidatedInvoiceId', $this->invoice->number);
    
    return $consolidate;
  }

  protected function addDetails(\SimpleXMLElement $consolidate, Model_InvoiceDetail $detail)
  {
    $accountsReceivableLedger = $consolidate->addChild('accountsReceivableLedger');
    $accountsReceivableLedger->addChild('date', $this->invoice->date->format('Y-m-d'));
    $accountsReceivableLedger->addChild('amount', sprintf("%0.2f", $detail->amount));
    $accountsReceivableLedger->addChild('accountNo', $this->kontenrahmen->konto($detail->taxRate));
    $accountsReceivableLedger->addChild('tax', sprintf("%0.2f", $detail->taxRate));
    $accountsReceivableLedger->addChild('currencyCode', $this->invoice->currencyCode);
    $accountsReceivableLedger->addChild('invoiceId', $this->invoice->number);
    $accountsReceivableLedger->addChild('customerName', htmlspecialchars($this->invoice->customerName, ENT_XML1, 'UTF-8'));
  }
}
