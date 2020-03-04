<?php

require_once __DIR__ . '/BaseTestCase.php';

require_once __DIR__ . '/../../Model/Base.php';
require_once __DIR__ . '/../../Model/Invoice.php';
require_once __DIR__ . '/../../Model/InvoiceDetail.php';

class Model_InvoiceTest extends BaseTestCase
{
  public function testConstructor()
  {
    $invoice = new smoice\datev\Model_Invoice(
      new \DateTime('2020-03-03'),
      'number',
      'customerName',
      'EUR'
    );
    $invoice->addDetail(new smoice\datev\Model_InvoiceDetail(59.50, 19));
    $invoice->addDetail(new smoice\datev\Model_InvoiceDetail(53.50, 7));

    $this->assertEquals(new DateTime('2020-03-03'),$invoice->date);
    $this->assertEquals('number',$invoice->number);
    $this->assertEquals('customerName',$invoice->customerName);
    $this->assertEquals(113,$invoice->amount);
    $this->assertEquals('EUR',$invoice->currencyCode);

    $this->assertCount(2,$invoice->details);
 }
}
