<?php

require_once __DIR__ . '/BaseTestCase.php';
require_once __DIR__ . '/../../Model/InvoiceDetail.php';

class Model_InvoiceDetailTest extends BaseTestCase
{
  public function testConstructor()
  {
    $detail = new Model_InvoiceDetail(
      59.50,
      'EUR',
      19
    );

    $this->assertEquals(59.50, $detail->amount);
    $this->assertEquals('EUR', $detail->currencyCode);
    $this->assertEquals(19, $detail->taxRate);
  }
}
