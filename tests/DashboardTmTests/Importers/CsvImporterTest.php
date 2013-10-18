<?php
require_once(dirname(__FILE__) . '/../../../class/dashboardtm/importers/csv.php');
use \DashboardTm\Importers\Csv;

class CsvTest extends PHPUnit_Framework_testCase
{
    /**
     * @expectedException Exception
     */
    public function testLoadFileFailsIfNotExists(){
        Csv::loadFile('notexisting');
    }

    /**
     * @expectedException DomainException
     */
    public function testLoadFileFailsIfInvalidCSV(){
        Csv::loadFile(dirname(__FILE__) . '/assets/invalid.csv');
    }

    public function testLoadFileReturnsCsvObject(){
        $csv = Csv::loadFile(dirname(__FILE__) . '/assets/anytv.csv');
        $this->assertInstanceOf('\DashboardTm\Importers\Csv', $csv);
    }

    public function testKeysAreCsvHeaders(){
        $csv = Csv::loadFile(dirname(__FILE__) . '/assets/anytv.csv');
        $headers = array(
            'id','updated','product name','offer id',
            'country','revenue','revenue per sale','payout',
            'payout by formula','difference','notes','country name',
            'category','offer name','expires','tracking id',
            'preview link','offer link','tracking name'
        );
        foreach($headers as $header){
            if(!in_array($header, array_keys($csv->contents))){
                $this->fail("Header $header was not loaded.");
            }
        }
    }

    /**
     * @expectedException DomainException
     */
    public function testHeaderFieldsShouldBeAtLeastAsManyAsEntryFields(){
        $csv = Csv::loadFile(dirname(__FILE__) . '/assets/toolong.csv');
    }

    public function testAllRowsHaveEqualContentLengths(){
        $csv = Csv::loadFile(dirname(__FILE__) . '/assets/anytv.csv');
        $lastLength = null;
        foreach($csv->contents as $row){
            $currentLength = count($row);
            if($lastLength !== null && $lastLength != $currentLength){
                $this->fail('A row is not of equal length', print_r($row, true));
            }
            $lastLength = $currentLength;
        }
    }
}