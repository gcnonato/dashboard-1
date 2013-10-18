<?php
namespace HasOffersTests;

use \HasOffers\Offer;
use \Httpful\Request;
use \Httpful\Mime;

use \ReflectionClass;
use \PHPUnit_Framework_testCase;
use \PHPUnit_Framework_Error_Notice;

abstract class AbstractBaseTest extends PHPUnit_Framework_testCase
{
    protected function invokePrivateMethod(
        $object, $method_name, $argument_array = null, $is_static = false){

        $ref = new ReflectionClass($object);
        $method = $ref->getMethod($method_name);
        $method->setAccessible(true);
        $scope = null;

        if(! $is_static){
            $scope = $object;
        }
        return $method->invokeArgs($scope, $argument_array);
    }

    protected function getPrivatePropertyValue($object, $prop_name){
        $ref = new ReflectionClass($object);
        $property = $ref->getProperty($prop_name);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    protected function setPrivatePropertyValue($object, $prop_name, $value){
        $ref = new ReflectionClass($object);
        $property = $ref->getProperty($prop_name);
        $property->setAccessible(true);
        return $property->setValue($object, $value);
    }

    protected function callApi($method, $params = null, $target = 'Offer'){
        $this->api_settings['Target'] = $target;
        $this->api_settings['Method'] = $method;
        if($params !== null){
            $query = http_build_query(array_merge($this->api_settings, $params));
        } else {
            $query = http_build_query($this->api_settings);
        }
        $response = json_decode(
            Request::post($this->api_url, $query, Mime::FORM)->send()->raw_body,
            true
        );

        return $response;
    }

}
?>