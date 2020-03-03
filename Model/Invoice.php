<?php

class Model_Invoice extends Model_Base
{
  protected $date;
  protected $details;
  protected $number;
  protected $customerName;

  public function __construct(DateTime $date, string $number, string $customerName, string $currencyCode)
  {
    $this->date = $date;
    $this->number = $number;
    $this->customerName = $customerName;
    $this->currencyCode = $currencyCode;

    $this->details = array();
  }

  public function addDetail(Model_InvoiceDetail $detail)
  {
    $this->details[$detail->taxRate] = $detail;
  }

  public function getAmount(): float
  {
    $amount = 0;

    foreach ($this->details as $detail) {
      $amount += $detail->amount;
    }

    return $amount;
  }
}
