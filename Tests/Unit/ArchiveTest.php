<?php

require_once __DIR__ . '/BaseTestCase.php';

require_once __DIR__ . '/../../Model/Base.php';

require_once __DIR__ . '/../../View/XML/Base.php';
require_once __DIR__ . '/../../View/XML/Archive.php';

class View_XML_ArchiveTest extends BaseTestCase
{
  public function testAusgang()
  {
    $archive = new View_XML_Archive(new DateTime('2020-03-04 11:57:18'), new DateTime('2020-03-03'), 'ausgangsrechnung_4711.xml', 'ausgangsrechnung_4711.pdf');
    $this->assertEquals($this->getExpectedAusgang(), $archive->__toString());
  }

  public function testEingang()
  {
    $archive = new View_XML_Archive(new DateTime('2020-03-04 11:57:18'), new DateTime('2020-03-03'), 'eingangsrechnung_4711.xml', 'eingangsrechnung_4711.pdf', 'Eingang');
    $this->assertEquals($this->getExpectedEingang(), $archive->__toString());
  }

  private function getExpectedAusgang()
  {
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<archive xmlns=\"http://xml.datev.de/bedi/tps/document/v04.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/document/v04.0 Document_v040.xsd\" version=\"4.0\" generatingSystem=\"SMOICE_DATEV\">
  <header>
    <date>2020-03-04T11:57:18</date>
    <description>Belegsatzdaten Ausgangsrechnung</description>
  </header>
  <content>
    <document>
      <extension xsi:type=\"accountsReceivableLedger\" datafile=\"ausgangsrechnung_4711.xml\">
        <property value=\"2020-03\" key=\"1\"/>
        <property value=\"Ausgangsrechnungen\" key=\"3\"/>
      </extension>
      <extension xsi:type=\"File\" name=\"ausgangsrechnung_4711.pdf\"/>
    </document>
  </content>
</archive>
";
  }

  private function getExpectedEingang()
  {
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<archive xmlns=\"http://xml.datev.de/bedi/tps/document/v04.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://xml.datev.de/bedi/tps/document/v04.0 Document_v040.xsd\" version=\"4.0\" generatingSystem=\"SMOICE_DATEV\">
  <header>
    <date>2020-03-04T11:57:18</date>
    <description>Belegsatzdaten Eingangsrechnung</description>
  </header>
  <content>
    <document>
      <extension xsi:type=\"accountsPayableLedger\" datafile=\"eingangsrechnung_4711.xml\">
        <property value=\"2020-03\" key=\"1\"/>
        <property value=\"Eingangsrechnungen\" key=\"3\"/>
      </extension>
      <extension xsi:type=\"File\" name=\"eingangsrechnung_4711.pdf\"/>
    </document>
  </content>
</archive>
";
  }
}
