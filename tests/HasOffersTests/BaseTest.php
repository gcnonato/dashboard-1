<?php
namespace HasOffersTests;

use \HasOffers\Base;

use \PHPUnit_Framework_testCase;
use \DateTime;
use \ReflectionClass;
use \BaseExtend1;
use \BaseExtend2;

class BaseTest extends AbstractBaseTest
{
    public function setUp(){
        $this->base = new Base();
    }

    protected static function getMethod($class, $method_name){
        $class = new ReflectionClass($class);
        $method = $class->getMethod($method_name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCheckParametersMissingRequiredThrowsException(){
        $required = array(
            'id' => 'integer',
            'name' => 'string'
        );

        $params = array(
            'id' => 1
        );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $check->invokeArgs($this->base, array($params, $required));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCheckParametersIncorrectDataTypesThrowsException(){
        $required = array(
            'id' => 'integer',
            'name' => 'string',
            'date' => 'DateTime'
        );

        $params = array(
            'id' => 1,
            'name' => 'The Kennel Blog',
            'date' => 'regular string'
        );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $check->invokeArgs($this->base, array($params, $required));
    }

    public function testCheckParametersMixedParameterPassed(){
        $required = array( 'id' => 'integer' );
        $optional = array( 'name' => 'mixed' );
        $params = array( 'id' => 1, 'name' => new DateTime('now') );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $response = $check->invokeArgs($this->base, array($params, $required, $optional));

        $this->assertTrue($response);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testCheckParametersMissingOptionalReturnsNotice(){
        $required = array(
            'id' => 'integer'
        );

        $optional = array(
            'name' => 'string'
        );

        $params = array(
            'id' => 1
        );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $check->invokeArgs($this->base, array($params, $required, $optional));
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testCheckParametersOptionalParamsCanBeNull(){
        $optional = array( 'item' => 'string' );
        $params = array( 'item' => null );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $check->invokeArgs($this->base, array($params, null, $optional));
    }

    public function testCheckParametersCompleteOptionalParamsPasses(){
        $required = array( 'id' => 'integer' );
        $optional = array( 'name' => 'mixed' );
        $params = array( 'id' => 1, 'name' => new DateTime('now') );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $response = $check->invokeArgs($this->base, array($params, $required, $optional));
        $this->assertTrue($response);
    }

    public function testCheckParametersClassObjectsAreProperlyChecked(){
        $required = array( 'id' => 'integer' );
        $optional = array( 'name' => 'DateTime' );
        $params = array( 'id' => 1, 'name' => new DateTime('now') );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $response = $check->invokeArgs($this->base, array($params, $required, $optional));
        $this->assertTrue($response);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCheckParametersOptionalParamsIncorrectDataTypesThrowsInvalidException(){
        $required = array( 'id' => 'integer' );
        $optional = array( 'name' => 'string' );
        $params = array( 'id' => 1, 'name' => 2 );

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $check->invokeArgs($this->base, array($params, $required, $optional));
    }

    public function testCheckParametersUndefinedParametersAreSkipped(){
        $required = array( 'id' => 'integer');
        $params = array( 'id' => 1, 'test' => 'test');

        $check = self::getMethod('\HasOffers\Base', '_checkParameters');
        $response = $check->invokeArgs($this->base, array($params, $required));
        $this->assertTrue($response);
    }

    public function testSerializePropertiesReturnsArrayOfPrivatePropertiesAndValues(){
        eval('class BaseExtend2{}');
        runkit_class_adopt('\BaseExtend2', '\HasOffers\Base');
        runkit_default_property_add('\BaseExtend2', 'id', 11, RUNKIT_ACC_PRIVATE);
        runkit_default_property_add('\BaseExtend2', 'name', 'test', RUNKIT_ACC_PRIVATE);

        $ref_class = new ReflectionClass('\BaseExtend2');
        $ref_method = $ref_class->getMethod('_serializeProperties');
        $ref_method->setAccessible(true);

        $data = $ref_method->invoke(new BaseExtend2());
        $data = $data['data'];
        $this->assertEquals(11, $data['id']);
        $this->assertEquals('test', $data['name']);
    }

    public function testSerializePropertiesSkipsUnderlinedPrivates(){
        eval('class BaseExtend1{}');
        runkit_class_adopt('\BaseExtend1', '\HasOffers\Base');
        runkit_default_property_add('\BaseExtend1', 'id', 11, RUNKIT_ACC_PRIVATE);
        runkit_default_property_add('\BaseExtend1', '_name', 'test', RUNKIT_ACC_PRIVATE);

        $ref_class = new ReflectionClass('\BaseExtend1');
        $ref_method = $ref_class->getMethod('_serializeProperties');
        $ref_method->setAccessible(true);

        $data = $ref_method->invoke(new BaseExtend1());
        $data = $data['data'];
        $this->assertEquals(11, $data['id']);
        $this->assertClassHasAttribute('_name', 'BaseExtend1');
        $this->assertFalse(isset($data['_name']));
    }


    public function testGetReturnsContentOfKeyIfExists(){
        $base = new Base();

        $ref_class = new ReflectionClass($base);
        $ref_method = $ref_class->getMethod('_get');
        $ref_method->setAccessible(true);
        $data = $ref_method->invoke($base, array('id' => 12), 'id', null);
        $this->assertEquals(12, $data);
    }
    public function testGetReturnsDefaultIfKeyDoesNotExist(){
        $base = new Base();

        $ref_class = new ReflectionClass($base);
        $ref_method = $ref_class->getMethod('_get');
        $ref_method->setAccessible(true);
        $data = $ref_method->invoke($base, array('id' => 12), 'name', 'test');
        $this->assertEquals('test', $data);
    }

}

?>
