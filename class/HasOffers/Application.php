<?php
namespace HasOffers;

use \Exception;
use \InvalidArgumentException;
use \BadMethodCallException;

class Application extends BaseModel
{
    protected static $target = 'Application';

    public static function addOfferCategory($params){
        $req = array(
            'name' => 'string'
        );
        $opt = array(
            'id' => 'integer',
            'status' => 'string'
        );
        try{
            self::_checkParameters($params, $req, $opt);
        }catch(InvalidArgumentException $e){
            throw $e;
        }
        $params = array( 'data' => $params );

        $response = json_decode(
            self::_buildRequest('addOfferCategory', $params )->send()->raw_body,
            true
        );

        $response = $response['response'];

        if(count($response['errors']) > 0){
            throw new Exception($response['errors'][0]['publicMessage']);
        }

        return $response['data']['OfferCategory'];
    }

    public static function updateOfferCategory($params){
        $req = array(
            'id' => 'integer'
        );
        $opt = array(
            'name' => 'string',
            'status' => 'string'
        );
        try{
            self::_checkParameters($params, array(), $opt);
        }catch(InvalidArgumentException $e){
            throw $e;
        }
        $params = array( 'data' => $params );

        $response = json_decode(
            self::_buildRequest('updateOfferCategory', $params )->send()->raw_body,
            true
        );

        $response = $response['response'];

        if(count($response['errors']) > 0){
            $message = $response['errors'][0]['publicMessage'];
            if(stripos($message, 'Missing required') !== false){
                throw new InvalidArgumentException($message);
            } else {
                throw new Exception($message);
            }
        }
    }

    public static function findAllOfferCategories($params = null){
        if($params !== null){
            $opt = array(
                'filters' => 'array',
                'fields' => 'array'
            );

            self::_checkParameters($params, null, $opt);
        }
        $response = json_decode(
            self::_buildRequest('findAllOfferCategories', $params)->send()->raw_body,
            true
        );

        $categories = array();

        foreach($response['response']['data'] as $id => $cat){
            $categories[$id] = $cat['OfferCategory'];
        }
        return $categories;
    }

    public static function findAllOfferCategoryOfferIds(){
        throw new BadMethodCallException;
    }

    public static function getActiveOfferCategoryCount(){
        throw new BadMethodCallException;
    }

    public static function addOfferGroup($params){
        $req = array(
            'name' => 'string'
        );
        $opt = array(
            'id' => 'integer',
            'status' => 'string'
        );
        self::_checkParameters($params, $req, $opt);
        $params = array( 'data' => $params );

        $response = json_decode(
            self::_buildRequest('addOfferGroup', $params )->send()->raw_body,
            true
        );

        $response = $response['response'];

        if(count($response['errors']) > 0){
            throw new Exception($response['errors'][0]['publicMessage']);
        }

        return $response['data']['OfferGroup'];
    }

    public static function updateOfferGroup($params){
        $req = array(
            'id' => 'integer'
        );

        $opt = array(
            'name' => 'string',
            'status' => 'string'
        );
        self::_checkParameters($params, $req, $opt);
        $params = array( 'data' => $params );

        $response = json_decode(
            self::_buildRequest('updateOfferGroup', $params )->send()->raw_body,
            true
        );

        $response = $response['response'];

        if(count($response['errors']) > 0){
            $message = $response['errors'][0]['publicMessage'];
            if(stripos($message, 'Missing required') !== false){
                throw new InvalidArgumentException($message);
            } else {
                throw new Exception($message);
            }
        }
    }

    public static function findAllOfferGroups($params = null){
        if($params !== null){
            $opt = array(
                'filters' => 'array',
                'fields' => 'array'
            );

            self::_checkParameters($params, null, $opt);
        }
        $response = json_decode(
            self::_buildRequest('findAllOfferGroups', $params)->send()->raw_body,
            true
        );

        $groups = array();

        foreach($response['response']['data'] as $id => $group){
            $groups[$id] = $group['OfferGroup'];
        }
        return $groups;
    }

    public static function findAllOfferGroupIds(){
        throw new BadMethodCallException;
    }

    public static function findAllCountries(){
        $response = json_decode(
            self::_buildRequest('findAllCountries')->send()->raw_body,
            true
        );
        $countries = array();
        foreach($response['response']['data'] as $row){
            $countries[$row['Country']['code']] = $row['Country'];
        }

        return $countries;
    }
}
?>