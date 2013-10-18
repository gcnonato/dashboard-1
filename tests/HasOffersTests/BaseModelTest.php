<?php
namespace HasOffersTests;

require_once(__DIR__ . '/../../bootstrap.php');

use \HasOffers\BaseModel;

use \ReflectionClass;
use \InvalidArgumentException;
use \PHPUnit_Framework_testCase;

class BaseModelTest extends PHPUnit_Framework_testCase
{
    public function setUp(){
        $this->base = new BaseModel();
        $this->ref_class = new ReflectionClass($this->base);
        $prop = $this->ref_class->getProperty('target');
        $prop->setAccessible(true);
        $prop->setValue('Application');
    }
    protected function callBuildRequest($paramArray){
        $ref_build_request = $this->ref_class->getMethod('_buildRequest');
        $ref_build_request->setAccessible(true);
        return $ref_build_request->invokeArgs(null, $paramArray);
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testBuildRequestDataNotArrayAndNotNullThrowsInvalidArgumentException(){
        $params = array();
        $params[0] = 'ValidNetworkApiKey';
        $params[1] = 'invalid_string';
        $this->callBuildRequest($params);
    }

    public function testBuildRequestDataReturnsRequestObject(){
        $params = array();
        $params[0] = 'ValidNetworkApiKey';
        $result = $this->callBuildRequest($params);
        $this->assertInstanceOf('\Httpful\Request', $result);
    }
}

?>