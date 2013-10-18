<?php
use \HasOffers\Application;
use \Httpful\Request;
use \Httpful\Mime;
class ApplicationTest extends PHPUnit_Framework_testCase
{

    protected function setUp(){
        PHPUnit_Framework_Error_Notice::$enabled = false;

        $this->api_url = "http://mmotm.api.hasoffers.com/Api?";
        $this->api_id = "mmotm";
        $this->api_key = "NETjE4MoLg7NarETCDruHecVmgLHbN";

        $this->api_settings = array(
            "Format" => 'json',
            "Target" => 'Application',
            "Method" => '',
            "Service" => 'HasOffers',
            "Version" => 2,
            "NetworkId" => $this->api_id,
            "NetworkToken" => $this->api_key
        );
    }

    protected function callApi($method, $params = null, $target = 'Application'){
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


    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddOfferCategoryFailsOnDuplicate(){
        $this->markTestIncomplete();
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testAddOfferCategoryFailsOnMissingInput(){
        Application::addOfferCategory();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddOfferCategoryThrowsInvalidArgumentExceptionOnIncorrectArgumentList(){
        Application::addOfferCategory(array('test' => 'test' ));
    }

    public function testAddOfferCategoryReturnsIdOnSuccess(){
        $now = new DateTime('now');
        $name = 'Test Name ' . $now->format('(Y-m-d:His)');
        $data = array(
            'name' => $name
        );

        $id = Application::addOfferCategory($data);
        $this->assertInternalType('integer', $id);
        $filter = array(
            'OfferCategory.id' => $id
        );

        $response = $this->callApi('findAllOfferCategories', array('filters'=>$filter));
        $this->assertEquals(
            $name,
            $response['response']['data'][$id]['OfferCategory']['name'],
            print_r($response, true)
        );
    }

    /**
     * @expectedException Exception
     */
    public function testUpdateOfferCategoryFailsOnDuplicate(){
        $this->markTestIncomplete();
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testUpdateOfferGroupThrowsExceptionOnMissingInput(){
        Application::updateOfferCategory();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testUpdateOfferCategoryThrowsInvalidArgumentExceptionOnIncorrectArgumentList(){
        Application::updateOfferCategory(array('test' => 'test'));
    }

    public function testAddCategoryReturnsArrayOfOfferCategories(){
        $categories = Application::findAllOfferCategories();

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddOfferGroupFailsOnDuplicate(){
        $this->markTestIncomplete();
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testAddOfferGroupFailsOnMissingInput(){
        Application::addOfferGroup();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddOfferGroupThrowsInvalidArgumentExceptionOnIncorrectArgumentList(){
        Application::addOfferGroup(array('test' => 'test' ));
    }

    public function testAddOfferGroupReturnsIdOnSuccess(){
        $now = new DateTime('now');
        $name = 'Test Name ' . $now->format('(Y-m-d:His)');
        $data = array(
            'name' => $name
        );

        $id = Application::addOfferGroup($data);
        $this->assertInternalType('integer', $id);
        $filter = array(
            'OfferGroup.id' => $id
        );

        $response = $this->callApi('findAllOfferGroups', array('filters'=>$filter));
        $this->assertEquals(
            $name,
            $response['response']['data'][$id]['OfferGroup']['name'],
            print_r($response, true)
        );
    }


    public function testUpdateOfferGroupNoErrorOnSuccess(){
        $this->markTestIncomplete();
        $now = new DateTime('now');
        $name = "New Name" . $now->format('(Y-m-d)');
        Application::updateOfferGroup(array( 'name' => $name ));
    }

    public function testFindAllOfferGroupsReturnsArrayOfOfferGroups(){
        $groups = Application::findAllOfferGroups();
        $this->assertInternalType('array', $groups);
    }

    public function testFindAllCountriesFetchesCountries(){
        $response = $this->callApi('findAllCountries');
        $response = $response['response']['data'];
        $countries = Application::findAllCountries();
        $keys = array_keys($countries);
        foreach($response as $key => $resp){
            if(! in_array($key, $keys)){
                $this->fail('Keys did not exist.');
            }
        }
    }

    protected function tearDown(){

    }
}

?>