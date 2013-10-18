<?php
namespace HasOffersTests\Offer;

use \HasOffersTests\AbstractBaseTest;

use \HasOffers\Offer;
use \Httpful\Request;
use \Httpful\Mime;


use \PHPUnit_Framework_testCase;
use \PHPUnit_Framework_Error_Notice;

abstract class OfferTest extends AbstractBaseTest
{
    protected function setUp(){
        PHPUnit_Framework_Error_Notice::$enabled = false;

        $this->api_url = "http://mmotm.api.hasoffers.com/Api?";
        $this->api_id = "mmotm";
        $this->api_key = "NETjE4MoLg7NarETCDruHecVmgLHbN";

        $this->api_settings = array(
            "Format" => 'json',
            "Target" => 'Offer',
            "Method" => '',
            "Service" => 'HasOffers',
            "Version" => 2,
            "NetworkId" => $this->api_id,
            "NetworkToken" => $this->api_key
        );
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