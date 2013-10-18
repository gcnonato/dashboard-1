<?php
namespace DashboardTmTests\Exporters;

use \HasOffers\Offer;
use \DashboardTm\Exporters\HasOffersExporter;

use \Exception;
use \InvalidArgumentException;
use \DateTime;
use \ReflectionClass;
use \PHPUnit_Framework_testCase;
use \PHPUnit_Framework_Error_Notice;

class HasOffersExporterTest extends PHPUnit_Framework_testCase
{
    private $network_id = 'mmotm';
    private $network_key = 'NETjE4MoLg7NarETCDruHecVmgLHbN';

    protected function setUp(){
        PHPUnit_Framework_Error_Notice::$enabled = false;
        $this->now = new DateTime('now');

        $this->data_array = array(
            'The Kennel Blog ' . $this->now->format('YmdHi') => array(
                'US' => array(
                    'name' => 'The Kennel Blog ' . $this->now->format('YmdHi'),
                    'advertiser_id' => null,
                    'main_category' => 'blog',
                    'protocol' => 'server',
                    'revenue_type' => 'cpa_percentage',
                    'max_percent_payout' => 100.0,
                    'payout_type' => 'cpa_flat',
                    'default_payout' => 1.0,
                    'preview_url' => 'blog.thekennel.info',
                    'offer_url' => 'offers.thekennel.info?t={transaction_id}',
                    'tags' => array(
                        'blog',
                        'kennel',
                        'test'
                    )
                ),
                'PH' => array(
                    'name' => 'The Kennel Blog ' . $this->now->format('YmdHi'),
                    'advertiser_id' => null,
                    'main_category' => 'blog',
                    'protocol' => 'server',
                    'revenue_type' => 'cpa_percentage',
                    'max_percent_payout' => 100,
                    'payout_type' => 'cpa_flat',
                    'default_payout' => 1,
                    'preview_url' => 'blog.thekennel.info',
                    'offer_url' => 'offers.thekennel.info?t={transaction_id}',
                    'tags' => array(
                        'blog',
                        'kennel',
                        'test'
                    )
                ),
                'CA' => array(
                    'name' => 'The Kennel Blog ' . $this->now->format('YmdHi'),
                    'advertiser_id' => null,
                    'main_category' => 'blog',
                    'protocol' => 'server',
                    'revenue_type' => 'cpa_percentage',
                    'max_percent_payout' => 100,
                    'payout_type' => 'cpa_flat',
                    'default_payout' => 1,
                    'preview_url' => 'blog.thekennel.info',
                    'offer_url' => 'offers.thekennel.info?t={transaction_id}',
                    'tags' => array(
                        'blog',
                        'kennel',
                        'test'
                    )
                )
            )
        );

        $this->exporter = new HasOffersExporter($this->network_id, $this->network_key);
        $this->reflected_exporter = new ReflectionClass($this->exporter);
    }

    public function testInitCreatesOfferInstances(){
        $offers = $this->exporter->init($this->data_array);
        $offer_list = $this->reflected_exporter
            ->getProperty('offer_list');
        $offer_list->setAccessible(true);
        $offer_list = $offer_list->getValue($this->exporter);

        foreach($offer_list as $offer){
            if(! $offer instanceof Offer){
                $this->fail('All items must be an instance of the Offer object.');
            }
        }
    }

    public function testInitOffersAreNamedAfterSetConvention(){
        $offers = $this->exporter->init($this->data_array);
        $offer_list = $this->reflected_exporter->getProperty('offer_list');
        $offer_list->setAccessible(true);
        $offer_list = $offer_list->getValue($this->exporter);

        $this->assertGreaterThan(0, count($offer_list), 'Offers should have been generated.');

        $now = $this->now->format('YmdHi');
        foreach($this->data_array['The Kennel Blog '. $now] as $country => $items){
            $flag = false;
            $tags = implode(' ', $items['tags']);
            foreach($offer_list as $offer){
                $name = "{$country} {$items['main_category']} - THE KENNEL BLOG {$now} - {$tags}";
                if($offer->name === $name){
                    $flag = true;
                }
            }
            if(!$flag){
                $this->fail(
                    sprintf(
                        'All items must follow the format %s %s',
                        $name,
                        $offer->name
                    )
                );
            }
        }
    }

    public function testInitOffersCreateAZZOffer(){

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInitFailsOnEmptyArray(){
        $this->exporter->init(array());
    }

    public function testFindAllTestOffersReturnsOffersDefinedAsTest(){
        $this->markTestIncomplete();
    }

    public function testApplyOffersWithNoIdCreatesNewOffers(){

    }

    public function testApplyOverwritesTestOffersFirstBeforeAddingNewOnes(){
        $this->markTestIncomplete();
    }
}