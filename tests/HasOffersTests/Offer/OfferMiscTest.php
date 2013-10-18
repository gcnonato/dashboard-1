<?php
namespace HasOffersTests\Offer;

use \HasOffers\Offer;
use \Httpful\Request;
use \Httpful\Mime;

use \ReflectionClass;

class OfferMiscTest extends OfferTest
{

    /** --- addTargetCountry TESTS --- **/
    public function testAddTargetCountryShouldNotAddCountryToHasOffers(){
        $offer = Offer::findById(1036);
        $offer->addTargetCountry(array('country_code' => 'US'));

        $response = $this->callApi('getTargetCountries', array( 'id' => 1036 ));
        $found = null;
        foreach($response['response']['data'] as $country){
            if($country['Country']['code'] == 'US'){
                $found = $country['Country']['code'];
                break;
            }
        }

        $countries =  $this->getPrivatePropertyValue($offer,'_countries');
        $this->assertContains('US', $countries);

        if($found !== null){
            $this->fail('Target country not registered to offer 1036.', print_r($response, true));
        }
    }

    /** --- setTargetCountry TESTS --- **/

    public function testSetTargetCountriesSuccessfullyAddsCountries(){
        $offer = Offer::findById(1036);
        $offer->setTargetCountries();
    }

    /**
     * @expectedException Exception
     */
    public function testSetTargetCountriesThrowsExceptionOnFail(){
        $offer = Offer::findById(1036);
        $offer->addTargetCountry(array('country_code' => 'ZZ'));
        $offer->addTargetCountry(array('country_code' => 'US'));
        $offer->setTargetCountries();
    }

    public function testSetTargetCountriesEndsSilentlyIfInternalArrayIsEmpty(){
        $offer = Offer::findById(1034);
        $this->setPrivatePropertyValue($offer, '_countries', array());

        $offer->setTargetCountries();
    }

    /** --- getTargetCountries TESTS --- **/

    /**
     * @depends testSetTargetCountriesSuccessfullyAddsCountries
     */
    public function testGetTargetCountriesReturnsCountryArrayOnSuccess(){
        $offer = Offer::findById(1036);
        $countries = $offer->getTargetCountries();

        $response = $this->callApi('getTargetCountries', array( 'id' => 1036 ));

        foreach($response['response']['data'] as $country){
            if(!isset($countries[$country['Country']['code']])){
                $this->fail('Should have the same countries.');
            }
        }
    }
    public function testGetTargetCountryReturnsEmptyArrayIfEmpty(){
        $offer = Offer::findById(1038);
        $this->assertCount(0, $offer->getTargetCountries());
    }

    /** --- removeTargetCountry TESTS --- **/

    /**
     * @depends testGetTargetCountryReturnsCountryArrayOnSuccess
     */
    public function testRemoveTargetCountriesRemovesCountryOnSuccess(){
        $this->markTestIncomplete(
            'Needs rewrite to support lazy synchronization with '
            .'HasOffers servers'
        );

        $offer = Offer::findById(1036);
        $offer->removeTargetCountry(array( 'country_code' => 'US'));
        $countries = $offer->getTargetCountries();
        $this->assertFalse(isset($countries['US']));
    }

    /**
     * @expectedException Exception
     */
    public function testRemoveTargetCountriesInvalidCountryThrowsException(){
        $this->markTestIncomplete(
            'Needs rewrite to support lazy synchronization with '
            .'HasOffers servers'
        );

        $offer = Offer::findById(1038)->removeTargetCountry(array('country_code' => '122'));
    }

    /** --- addCategory TESTS --- **/


    public function testAddCategoryNoErrorsOnSuccess(){
        $offer = Offer::findById(1036);
        $offer->addCategory(array( 'category_id' => 222 ));

        $categories = $this->getPrivatePropertyValue($offer, '_categories');

        $this->assertContains(222, $categories);
    }

    /** --- setCategories TESTS --- **/

    public function testSetCategoriesNoErrorsOnSuccess(){
        $offer = Offer::findById(1036);
        $offer->addCategory(array( 'category_id' => 222 ));
        $offer->setCategories();

        $response = $this->callApi('getCategories', array( 'id' => 1036 ));

        $found = null;
        foreach($response['response']['data'] as $cat){
            if($cat['OfferCategory']['id'] == 222){
                $found = $cat['OfferCategory']['id'];
                break;
            }
        }

        $this->assertEquals(222, $found,  print_r($response));
    }

    public function testSetCategoriesDoesNotFailBecauseOfHasOffersBug(){
        $params = array(
            'id' => 1036,
            'category_ids' => array(
                221
            )
        );

        $response = $this->callApi('setCategories', $params);
        if(count($response['response']['errors']) > 0){
            $this->fail('If this fails, then the HasOffer bug was patched.');
        }
    }
    public function testSetCategoriesEndsSilentlyIfInternalArrayIsEmpty(){
        $offer = Offer::findById(1034);
        $this->setPrivatePropertyValue($offer, '_categories', array());

        $offer->setCategories();
    }

    /** --- addCategory TESTS --- **/

    public function testAddCategoryShouldAddCategoryToInternalArray(){
        $offer = Offer::findById(1042);
        $offer->addCategory(array( 'category_id' => 222 ));
        $categories = $this->getPrivatePropertyValue($offer, '_categories');

        $this->assertContains(222, $categories);
    }

    public function testAddCategoryShouldNotCommitCategoryToOffer(){
        $offer = Offer::findById(1042);
        $offer->addCategory(array( 'category_id' => 222));
        $categories = $this->getPrivatePropertyValue($offer, '_categories');

        $response = $this->callApi('getCategories', array( 'id' => 1036 ));
        if(array_key_exists('222', $response['response']['data'])){
            $this->fail('222 should not have been committed.');
        }
    }

    /** --- removeCategory TESTS --- **/

    /**
     * @depends testSetCategoriesNoErrorsOnSuccess
     */
    public function testRemoveCategoryDoesNotCommitOnHasOffers(){
        $offer = Offer::findById(1036);
        $offer->removeCategory(array('category_id' => 222));
    }

    public function testRemoveCategoryRemovesItemFromInternalArray(){
        $offer = Offer::findById(1036);
        $offer->removeCategory(array('category_id' => 222));
        $categories = $this->getPrivatePropertyValue($offer, '_categories');

        $this->assertFalse(in_array(222, $categories), '222 should no longer be in the internal array');
    }

    /** --- _updateCategories TESTS --- **/

    public function testUpdateCategories(){
        $this->markTestIncomplete('Requires new tests to reflect new lazy sync technique.');
    }

    /** --- getCategories TESTS --- **/

    public function testGetCategoriesListsOfferCategoriesOnSuccess(){
        $categories = Offer::findById(1036)->getCategories();

        $response = $this->callApi('getCategories', array( 'id' => 1036 ));
        foreach($response['response']['data'] as $cat){
            if(! isset($categories[$cat['OfferCategory']['id']])){
                $this->fail(
                    'Must have same set of categories',
                    print_r(
                        $response['response']['data'],
                        true
                    )
                );
                break;
            }
        }
    }

    public function testGetCategoriesReturnsEmptyArrayIfEmpty(){
        $categories = Offer::findById(1040)->getCategories();
        $this->assertCount(0, $categories, print_r($categories, true));
    }

    /** --- addGroup TESTS --- **/

    public function testAddGroupMustNotCommitToHasOffers(){
        $offer = Offer::findById(1036);
        $offer->addGroup(76);

        $params = array(
            'id' => 1036,
            'group_ids' => array(76)
        );
        $response = $this->callApi('getGroups', $params);

        if(array_key_exists('76', $response['response']['data'])){
            $this->fail('76 should not have been committed.');
        }
    }

    public function testAddGroupMustAddToInternalArray(){
        $offer = Offer::findById(1038);
        $offer->addGroup(76);
        $groups = $this->getPrivatePropertyValue($offer, '_groups');

        $this->assertTrue(in_array(76, $groups));
    }

    /** --- setGroups TESTS --- **/

    public function testSetGroupNoErrorsOnSuccess(){
        $offer = Offer::findById(1036);
        $offer->addGroup(array( 'group_id' => 76));
        $offer->setGroups();

        $response = $this->callApi('getGroups', array( 'id' => 1036 ));
        $found = false;
        foreach($response['response']['data'] as $group){
            if($group['OfferGroup']['id'] == 76){
                $found = true;
                break;
            }
        }
        if(! $found){
            $this->fail('Group not successfully added.');
        }
    }

    public function testSetGroupsDoesNotFailBecauseOfHasOffersBug(){
        $params = array(
            'id' => 1036,
            'group_ids' => array(
                75
            )
        );

        $response = $this->callApi('setGroups', $params);
        if(count($response['response']['errors']) > 0){
            $this->fail('If this fails, then the HasOffer bug was patched.');
        }
    }

    public function testSetGroupsEndsSilentlyIfInternalArrayIsEmpty(){
        $offer = Offer::findById(1034);
        $this->setPrivatePropertyValue($offer, '_groups', array());

        $offer->setGroups();
    }

    /**
     * expectedException Exception

    public function testSetGroupsThrowsExceptionOnFail(){
        $offer = Offer::findById(1036);
        $offer->addGroup(75);
        $offer->setGroups();
    }
    */

    /** --- removeGroup TESTS --- **/

    /** --- _updateGroups TESTS --- **/

    /** --- getGroups TESTS --- **/

    public function testGetGroupsListsOfferGroupsOnSuccess(){
        $groups = Offer::findById(1036)->getGroups();
    }

    public function testGetGroupsReturnsEmptyArrayIfEmpty(){
        $groups = Offer::findById(1038)->getGroups();
    }

    protected function tearDown(){
        //$this->callApi('removeTargetCountry', array('id'=> 1036, 'country_code'=> 'US'));
    }
}
?>