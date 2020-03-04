<?php

namespace smoice\datev;

abstract class View_XML_Base extends Model_Base
{
  protected $xml;

  final public function __toString()
  {
    $this->initXML();
    $this->generateContent();
    return $this->output();
  }

  final protected function initXML()
  {
    $this->xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>' . $this->rootElement());
  }

  abstract protected function rootElement();
  abstract protected function generateContent();

  final protected function output()
  {
    $dom = dom_import_simplexml($this->xml)->ownerDocument;
    $dom->formatOutput = true;
    return $dom->saveXML();
  }

  protected function xmlns(string $bereich = 'ledger/v040', string $dokumentName = 'Belegverwaltung_online_ledger_import')
  {
    return 'xmlns="http://xml.datev.de/bedi/tps/'.$bereich.'" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://xml.datev.de/bedi/tps/'.$bereich.' '.$dokumentName.'_v040.xsd" version="4.0"';
  }

  protected function generator(): string{
    return '"SMOICE-DATEV"';
  }
}
