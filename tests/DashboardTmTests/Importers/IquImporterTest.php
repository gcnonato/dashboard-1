<?php
namespace DashboardTmTests\Importers;

use DashboardTm\Importers\IquImporter;

use \PHPUnit_Framework_testCase;

class IquImporterTest extends PHPUnit_Framework_testCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage failed to open stream
     */
    public function testLoadXml404ThrowsException(){
        $iqu = new IquImporter();
        $iqu->file_path = 'http://offer.any.tv/tests/404.xml';
        $iqu->parseXml();
    }

    protected function checkArrayKeyExists($key, $item){
        // Yeah, I do know about assertArrayHasKey
        // but I don't want to pollute test data
        // with millions of Assertions
        if(! array_key_exists($key, $item)){
            $this->fail("Key 'name' was not set.");
        }
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage parser error
     */
    public function testLoadXmlInvalidXmlThrowsException(){
        $iqu = new IquImporter();
        $iqu->file_path = 'http://offer.any.tv/tests/invalid.xml';
        $iqu->parseXml();
    }

    public function testLoadXmlArrayKeysArePresent(){
        $iqu = new IquImporter('http://offer.any.tv/tests/offers.xml');
        $offers = $iqu->parseXml();
        foreach($offers as $name=>$countries){
            foreach($countries as $code=>$item){
                $this->checkArrayKeyExists('name', $item);
                $this->checkArrayKeyExists('protocol', $item);
                $this->checkArrayKeyExists('revenue_type', $item);
                $this->checkArrayKeyExists('max_precent_payout', $item);
                $this->checkArrayKeyExists('payout_type', $item);
                $this->checkArrayKeyExists('default_payout', $item);
                $this->checkArrayKeyExists('offer_url', $item);
            }
        }
    }
}

?>