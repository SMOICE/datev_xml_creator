<?php

class View_XML_AccountsPayableLedger extends View_XML_AccountsReceivableLedger
{
  protected $ohneSkonto;

  public function __construct($invoice, bool $ohneSkonto = false)
  {
    parent::__construct($invoice);
    $this->ohneSkonto = $ohneSkonto;
  }

  protected function addConsolidate(): SimpleXMLElement
  {
    $consolidate = $this->xml->addChild('consolidate');
    $consolidate->addAttribute('consolidatedAmount', sprintf("%0.2f", $this->invoice->amount));
    $consolidate->addAttribute('consolidatedDate', $this->invoice->date->format('Y-m-d'));
    $consolidate->addAttribute('consolidatedInvoiceId', $this->invoice->number);
    $consolidate->addAttribute('consolidatedCurrencyCode', $this->invoice->currencyCode);
    
    return $consolidate;
  }


protected function addDetails(SimpleXMLElement $consolidate, Model_InvoiceDetail $detail)
{
  $ledger = $consolidate->addChild('accountsPayableLedger');
  $ledger->addChild('date', $this->invoice->date->format('Y-m-d'));
  $ledger->addChild('amount', sprintf("%0.2f", $detail->amount));
  $ledger->addChild('tax', sprintf("%0.2f", $detail->taxRate));
  $ledger->addChild('currencyCode', $this->invoice->currencyCode);
  $ledger->addChild('invoiceId', $this->invoice->number);
  $ledger->addChild('supplierName', htmlspecialchars($this->invoice->customerName, ENT_XML1, 'UTF-8'));
}
/*
    if (isset($this->invoice['iban']) && $this->invoice['iban'] > '')
      $accountsReceivableLedger->addChild('iban', $this->invoice['iban']);
    if (isset($this->invoice['bic']) && $this->invoice['bic'] > '')
      $accountsReceivableLedger->addChild('swiftCode', $this->invoice['bic']);
      */
}
