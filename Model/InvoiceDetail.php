<?php

class Model_InvoiceDetail
{
  public $amount;
  public $currencyCode;
  public $taxRate;

  public function __construct(float $amount, string $currencyCode, float $taxRate)
  {
    $this->amount = $amount;
    $this->currencyCode = $currencyCode;
    $this->taxRate = $taxRate;
  }
}