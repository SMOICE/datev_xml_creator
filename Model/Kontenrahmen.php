<?php

namespace smoice\datev;

class Model_Kontenrahmen
{
  private $konten;

  public function __construct()
  {
    $this->konten = array(0 => 4200, 7 => 4300, 19 => 4400);
  }

  public function konto(float $taxRate, string $konto = null)
  {
    if ($konto !== null) {
      $this->konten[$taxRate] = $konto;
    }

    return $this->konten[$taxRate];
  }
}
