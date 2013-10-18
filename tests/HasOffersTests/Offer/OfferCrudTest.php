<?php
namespace HasOffersTests\Offer;

use \HasOffers\Offer;
use \Httpful\Request;
use \Httpful\Mime;

use \DateTime;

class OfferCrudTest extends OfferTest
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateShouldThrowInvalidArgumentExceptionIfNotOfferObject(){
        Offer::create(array(1,2,3));
        Offer::create('test');
    }

    public function testCreateShouldCreateOfferOnSuccess(){
        $args = array(
            'name' => 'The Kennel Blog CreateTest',
            'description' => 'The Kennel Blog Offer',
            'advertiser_id' => 2,
            'offer_url' => 'http://offers.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'http://blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2015-01-01 00:00:00')
        );

        $offer = new Offer($args);
        $r = Offer::create($offer);

        $this->api_settings['Target'] = 'Offer';
        $this->api_settings['Method'] = 'findAll';
        $params = array(
            'filters' => array(
                'Offer.id' => $r->id
            )
        );

        $query = http_build_query(array_merge($this->api_settings, $params));
        $response = json_decode(
            Request::post($this->api_url, $query, Mime::FORM)->send()->raw_body,
            true
        );

        $this->assertEquals(200, $response['response']['httpStatus']);
        $this->assertCount(1, $response['response']['data']);
        $this->assertEquals($r->id, $response['response']['data'][$r->id]['Offer']['id']);
    }

    /**
     * @depends testCreateShouldCreateOfferOnSuccess
     */
    public function testDeleteOfferShouldRemoveOfferFromHasOffers(){
        $this->markTestIncomplete('Test not completely implemented yet');
        Offer::delete($args);

        $filter = array(
            'filters' => array(
                'Offer.status' => 'deleted'
            )
        );
    }

    /**
     * @expectedException Exception
     */
    public function testCreateOfferMustFailIfDateLessThanNow(){
        $now = new DateTime('now');
        $name = 'The Kennel Blog ' . $now->format('(Y-m-d)');
        $args = array(
            'name' => $name,
            'description' => "thekennel.info's main blog.",
            'advertiser_id' => 2,
            'offer_url' => 'offer.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2 years ago')
        );

        $offer = new Offer($args);
        Offer::create($offer);
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testCreateOfferPayoutPercentagesMustBeGreaterThan1AndLessThanOrEqualTo100(){
        $this->markTestIncomplete();
        $args = array(
            'name' => 'The Kennel Blog',
            'description' => 'advertiser_id',
            'offer_url' => 'http://offers.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'http://blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2015-01-01 00:00:00'),
            'percent_payout' => 0.12,
            'max_percent_payout' => 50
        );

        $offer = new Offer($args);
        Offer::create($offer);

        $args = array(
            'name' => 'The Kennel Blog 2',
            'description' => 'advertiser_id',
            'offer_url' => 'http://offers.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'http://blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2015-01-01 00:00:00'),
            'percent_payout' => 100.1,
            'max_percent_payout' => 50
        );

        $offer = new Offer($args);
        Offer::create($offer);

        $args = array(
            'name' => 'The Kennel Blog 3',
            'description' => 'advertiser_id',
            'offer_url' => 'http://offers.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'http://blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2015-01-01 00:00:00'),
            'percent_payout' => 50,
            'max_percent_payout' => 0.1
        );

        $offer = new Offer($args);
        Offer::create($offer);

        $args = array(
            'name' => 'The Kennel Blog 4',
            'description' => 'advertiser_id',
            'offer_url' => 'http://offers.thekennel.info?o={offer_id}&tr={transaction_id}',
            'preview_url' => 'http://blog.thekennel.info',
            'protocol' => 'http',
            'status' => 'active',
            'expiration_date' => new DateTime('2015-01-01 00:00:00'),
            'percent_payout' => 50,
            'max_percent_payout' => 100.1
        );
        $offer = new Offer($args);
        Offer::create($offer);
    }
    protected function tearDown(){
    }
}
?>