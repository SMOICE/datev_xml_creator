<?php

require_once __DIR__ . '/BaseTestCase.php';
require_once __DIR__ . '/../../Model/Base.php';
require_once __DIR__ . '/../../Model/Kontenrahmen.php';

class Model_KontenrahmenTest extends BaseTestCase
{
  public function testEmptyConstructor()
  {
    $rahmen = new smoice\datev\Model_Kontenrahmen;

    $this->assertEquals(4200, $rahmen->konto(0));
    $this->assertEquals(4300, $rahmen->konto(7));
    $this->assertEquals(4400, $rahmen->konto(19));
  }

  public function testDefineYourOwn()
  {
    $rahmen = new smoice\datev\Model_Kontenrahmen;

    $rahmen->konto(0, 8100);
    $rahmen->konto(7, 8300);
    $rahmen->konto(19, 8400);

    $this->assertEquals(8100, $rahmen->konto(0));
    $this->assertEquals(8300, $rahmen->konto(7));
    $this->assertEquals(8400, $rahmen->konto(19));
  }
}
