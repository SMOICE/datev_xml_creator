<?php

class Model_InvoiceDetail extends Model_Base
{
  protected $amount;
  protected $taxRate;

  public function __construct(float $amount, float $taxRate)
  {
    $this->amount = $amount;
    $this->taxRate = $taxRate;
  }
}