<?php
namespace HasOffers;

use \ReflectionClass;
use \ReflectionProperty;
use \DateTime;
use \InvalidArgumentException;
class Base
{
    public function __construct(){

    }

    protected function _serializeProperties(){
        $reflect = new ReflectionClass($this);
        $props = $reflect->getProperties(ReflectionProperty::IS_PRIVATE);

        $properties = array();
        foreach($props as $prop){
            $prop->setAccessible(true);
            $name = $prop->getName();
            if(strpos($name, '_') === 0){
                continue;
            }
            $content = $prop->getValue($this);
            if($content instanceof DateTime){
                $properties['data'][$name] = $content->format('Y-m-d\TH:i:sP');
            } else {
                $properties['data'][$name] = $content;
            }
        }
        return $properties;
    }

    protected static function _get($array, $key, $default){
        if(! isset($array[$key]) || $array[$key] == null){
            return $default;
        }
        return $array[$key];
    }

    protected function _checkParameters($parameters, $required = null, $optional = null){
        $type_check = array();
        if($required !== null){
            foreach($required as $key => $type){
                $type_check[$key] = $type;
                if(!isset($parameters[$key])){
                    throw new InvalidArgumentException(sprintf("The parameter '%s' is required.", $key));
                }
            }
        }
        if($optional !== null){
            foreach($optional as $key => $type){
                if(!isset($parameters[$key]) || $parameters[$key]==null){
                    trigger_error(sprintf("An optional parameter '%s' is missing.", $key));
                } else {
                    $type_check[$key] = $type;
                }
            }
        }
        $required = $optional = null;
        foreach($parameters as $key => $value){
            if(! isset($type_check[$key])){
                continue;
            }
            $got_type = gettype($value);
            if($type_check[$key] == 'mixed'){
                continue;
            }
            if($got_type == 'object'){
                $got_class = get_class($value);
                if($got_class !== $type_check[$key]){
                    throw new InvalidArgumentException(sprintf("The required parameter '%s' is not a member of the '%s' class, but of '%s'.", $key, $type_check[$key], $got_class));
                }
            } else if($got_type !== $type_check[$key]){
                throw new InvalidArgumentException(sprintf("The parameter '%s' is of the type: '%s', expected '%s'.", $key, $got_type, $type_check[$key]));
            }
        }
        return true;
    }
}
?>