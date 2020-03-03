<?php

require_once __DIR__ . '/BaseTestCase.php';
require_once __DIR__ . '/../../Model/Base.php';
require_once __DIR__ . '/../../Model/InvoiceDetail.php';

class Model_InvoiceDetailTest extends BaseTestCase
{
  public function testConstructor()
  {
    $detail = new Model_InvoiceDetail(
      59.50,
      19
    );

    $this->assertEquals(59.50, $detail->amount);
    $this->assertEquals(19, $detail->taxRate);
  }
}
