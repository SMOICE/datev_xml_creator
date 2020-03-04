<?php

namespace smoice\datev;

class Creator_DocumentPackage
{
  private $invoice;
  private $pdfFileName;
  private $outputFileName;
  private $richtung;

  private $zip;

  public function __construct(Model_Invoice $invoice, string $pdfFileName, string $outputFileName, string $richtung = 'Ausgang')
  {
    $this->invoice = $invoice;
    $this->pdfFileName = $pdfFileName;
    $this->outputFileName = $outputFileName;
    $this->richtung = $richtung == 'Eingang' ? 'Eingang' : 'Ausgang';
  }

  public function createOutput()
  {
    $this->createZip();
    $this->addInvoice();
    $this->addDocument();
    $this->addFile();
    $this->closeZip();
  }

  private function createZip()
  {
    $this->zip = new \ZipArchive;
    if (TRUE !== $this->zip->open($this->outputFileName, \ZIPARCHIVE::CREATE | \ZIPARCHIVE::OVERWRITE))
      throw new Exception_DocumentCreator('Inititalisierung ZIP-Archiv ist gescheitert.');
  }

  protected function addInvoice()
  {
    if ($this->richtung == 'Ausgang') {
      $xml = new View_XML_AccountsReceivableLedger($this->invoice);
    } else {
      $xml = new View_XML_AccountsPayableLedger($this->invoice);
    }
    $this->zip->addFromString($this->getXMLFileName(), $xml->__toString());
  }

  protected function addDocument()
  {
    $xml = new View_XML_Archive(new \DateTime, $this->invoice->date, $this->getXMLFileName(), $this->getPDFFileName(), $this->richtung);
    $this->zip->addFromString('document.xml', $xml->__toString());
  }

  protected function addFile()
  {
    if (!file_exists($this->pdfFileName))
      throw new Exception_DocumentCreator('Rechnungs-PDF nicht gefunden: ' . $this->pdfFileName);

    $this->zip->addFile($this->pdfFileName, $this->getPDFFileName());
  }

  protected function closeZip()
  {
    $this->zip->close();
  }

  protected function getXMLFileName()
  {
    return $this->getFileName('xml');
  }

  protected function getPDFFileName()
  {
    return $this->getFileName('pdf');
  }

  protected function getFileName($ext)
  {
    return $this->richtung . 'srechnung_' . str_replace(array('/', "\\"), "_", $this->invoice->number) . '.' . $ext;
  }
}
