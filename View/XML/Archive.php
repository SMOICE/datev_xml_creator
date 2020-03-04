<?php

class View_XML_Archive extends View_XML_Base
{
  protected $creationTime;
  protected $invoiceDate;
  protected $xmlFileName;
  protected $pdfFileName;
  protected $richtung;
  
  public function __construct ( DateTime $creationTime, DateTime $invoiceDate, string $xmlFileName, string $pdfFileName, string $richtung = 'Ausgang' )
  {
    parent::__construct();
    $this->creationTime = $creationTime;
    $this->invoiceDate = $invoiceDate;
    $this->xmlFileName = $xmlFileName;
    $this->pdfFileName = $pdfFileName;
    $this->richtung = $richtung;
  }
  
  protected function rootElement ( )
  {
    return "<archive xmlns=\"http://xml.datev.de/bedi/tps/document/v04.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/document/v04.0 Document_v040.xsd\" version=\"4.0\" generatingSystem=\"SMOICE-DATEV\" />";
  }

  protected function generateContent ( )
  {
    $this->addHeader();
    $this->addContent();
  }

  protected function addHeader ( )
  {
    $header = $this->xml->addChild('header');
    $header->addChild('date',$this->creationTime->format('Y-m-d\TH:i:s'));
    $header->addChild('description','Belegsatzdaten '.$this->richtung.'srechnung');
  }
  
  protected function addContent ( )
  {
    $doc = $this->xml->addChild('content')->addChild('document');

    $ext = $doc->addChild('extension');
    $ext->addAttribute('xsi:xsi:type','accounts'.($this->richtung == 'Eingang' ? 'Pay' : 'Receiv').'ableLedger');
    $ext->addAttribute('datafile',$this->xmlFileName);

    $prop = $ext->addChild('property');
    $prop->addAttribute('value',$this->invoiceDate->format('Y-m'));
    $prop->addAttribute('key','1');

    $prop = $ext->addChild('property');
    $prop->addAttribute('value',$this->richtung.'srechnungen');
    $prop->addAttribute('key','3');

    $ext = $doc->addChild('extension');
    $ext->addAttribute('xsi:xsi:type','File');
    $ext->addAttribute('name',$this->pdfFileName);
  }
}
