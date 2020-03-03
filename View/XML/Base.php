<?php

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
    $this->xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>' . $this->rootElement());
  }

  abstract protected function rootElement();
  abstract protected function generateContent();

  final protected function output()
  {
    $dom = dom_import_simplexml($this->xml)->ownerDocument;
    $dom->formatOutput = true;
    return $dom->saveXML();
  }
}
