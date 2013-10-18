<?php
namespace HasOffersTests\Offer;

use \HasOffers\Offer;
use \Httpful\Request;
use \Httpful\Mime;

class OfferFindAllTest extends OfferTest {
    public function testFindAllWithNoParamsShouldShowAllAvailable(){
        $data = Offer::findAll();


        $response = $this->callApi('findAll');
        $this->assertCount(
            count($response['response']['data']),
            $data,
            "FindAll did not return the right number of objects"
        );
    }

    public function testFindAllShouldReturnOfferObjects(){
        $objects = Offer::findAll();
        foreach($objects as $object){
            if(! $object instanceof Offer){
                $this->fail('findAll does not return Offer objects');
                break;
            }
        }
    }

    public function testFindAllFilteredSearch(){
        $params = array(
            'filters' => array(
                'Offer.name' => 'The Kennel Blog CreateTest',
                'Offer.status' => 'active'
            )
        );
        $this->api_settings['Method'] = 'findAll';
        $query = http_build_query(array_merge($this->api_settings, $params));
        $response = json_decode(
            Request::post($this->api_url, $query, Mime::FORM)->send()->raw_body,
            true
        );
        $response = $response['response']['data'];

        $offers = Offer::findAll($params);
        $ids = array();
        foreach($offers as $offer){
            $ids[] = $offer->id;
        }
        $this->assertEquals(asort(array_keys($response)), asort($ids));
    }


    public function testFindByIdReturnsOfferInstanceOnSuccess(){
        $offer = Offer::findById(1030);
        $this->assertInstanceOf('HasOffers\Offer', $offer);
        $this->assertEquals(1030, $offer->id);
    }

    public function testFindByIdReturnsNullOnFail(){
        //It seems hasoffers only generates even numbered IDs, so an
        //odd one should never return anything.
        $offer = Offer::findById(1031);
        $this->assertEquals(null, $offer);
    }

    protected function tearDown(){
    }
}
?>