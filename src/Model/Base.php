<?php

namespace smoice\datev;

abstract class Model_Base
{
  public function __construct()
  {
  }

  public function __toString()
  {
    return '';
  }

  public function __get($name)
  {
    $function = 'get' . $name;
    if (method_exists($this, $function)) {
      return $this->$function();
    }

    return $this->$name;
  }

  public function __set($name, $value)
  {
    $function = 'set' . $name;
    if (method_exists($this, $function)) {
      return $this->$function($value);
    }

    $this->$name = $value;
  }
}
