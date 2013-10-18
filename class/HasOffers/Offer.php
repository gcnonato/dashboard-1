<?php
namespace HasOffers;

use \DateTime;

class Offer extends BaseModel
{
    protected static $target = 'Offer';

    private $id;
    private $name;
    private $description;
    private $advertiser_id;
    private $offer_url;
    private $preview_url;
    private $protocol;
    private $status;
    private $expiration_date;

    //Payout Parameters
    private $payout_type;
    private $revenue_type;
    private $default_payout;
    private $max_payout;
    private $percent_payout;
    private $max_percent_payout;
    private $tiered_payout;
    private $currency;

    //Optional Access Parameters
    private $is_private;
    private $require_approval;
    private $require_terms_and_conditions;
    private $terms_and_conditions;
    //Optional Converted Offer Parameters
    private $_converted_offer_type;
    private $converted_offer_id;
    private $converted_offer_url;

    //Optional DNE/ Email Parameters
    private $dne_list_id;
    private $_show_mail_list;
    private $email_instructions_from;
    private $email_instructions_subject;

    //Other Optional Parameters
    private $approve_conversions;
    private $conversion_cap;
    private $redirect_offer_id;
    private $session_hours;
    private $enforce_geo_targeting;
    private $allow_multiple_conversions;
    private $allow_website_links;
    private $show_custom_variables;
    private $display_advertiser;
    private $set_session_on_impression;
    private $is_seo_friendly_301;
    private $featured;
    private $rating;
    private $disable_click_macro;
    private $click_macro_url;
    private $ref_id;

    private $_modified;
    private $_is_expired;
    private $_dne_unsubscribe_url;
    private $_dne_download_url;

    private $_countries = array();
    private $_groups = array();
    private $_categories = array();

    public function __get($name){
        return $this->$name;
    }

    public function __construct($params){
        $required = array(
            'name' => 'string',
            'offer_url' => 'string',
            'preview_url' => 'string',
            'protocol' => 'string',
            'status' => 'string'
        );

        $optional = array(
            'id' => 'integer',
            'expiration_date' => 'DateTime',
            'advertiser_id' => 'integer',
            'description' => 'string',
            //Payout Parameters
            'payout_type' => 'string',
            'revenue_type' => 'string',
            'default_payout' => 'double',
            'max_payout' => 'double',
            'percent_payout' => 'double',
            'max_percent_payout' => 'double',
            'tiered_payout' => 'integer',
            'currency' => 'string',
            'is_private' => 'integer',
            'require_approval' => 'integer',
            'require_terms_and_conditions' => 'integer',
            'terms_and_conditions' => 'string',
            //Optional Converted Offer Parameters
            'converted_offer_type' => 'string',
            'converted_offer_id' => 'integer',
            'converted_offer_url' => 'string',
            //Optional DNE/ Email Parameters
            'dne_list_id' => 'interger',
            'show_mail_list' => 'string',
            'email_instructions_from' => 'string',
            'email_instructions_subject' => 'string',
            //Other Optional Parameters
            'approve_conversions' => 'integer',
            'conversion_cap' => 'integer',
            'redirect_offer_id' => 'integer',
            'session_hours' => 'integer',
            'enforce_geo_targeting' => 'integer',
            'allow_multiple_conversions' => 'integer',
            'allow_website_links' => 'integer',
            'show_custom_variables' => 'integer',
            'display_advertiser' => 'integer',
            'set_session_on_impression' => 'integer',
            'is_seo_friendly_301' => 'integer',
            'featured' => 'DateTime',
            'rating' => 'integer',
            'disable_click_macro' => 'integer',
            'click_macro_url' => 'string',
            'ref_id' => 'string',
            //Read Only
            'modified' => 'string',
            'is_expired' => 'string',
            'dne_unsubscribe_url' => 'string',
            'dne_download_url' => 'string',

        );
        self::_checkParameters($params, $required, $optional);

        $this->id = self::_get($params,'id', null);
        $this->name = self::_get($params,'name', null);
        $this->description = self::_get($params,'description',null);
        $this->advertiser_id = self::_get($params, 'advertiser_id', null);
        $this->offer_url = self::_get($params, 'offer_url', null);
        $this->preview_url = self::_get($params, 'preview_url', null);
        $this->protocol = self::_get($params, 'protocol', null);
        $this->status = self::_get($params, 'status', null);
        $this->expiration_date = self::_get(
            $params,
            'expiration_date',
            new DateTime('+3 years')
        );

        //Payout Parameters
        $this->payout_type = self::_get($params, 'payout_type', null);
        $this->revenue_type = self::_get($params, 'revenue_type', null);
        $this->default_payout = self::_get($params, 'default_payout', null);
        $this->max_payout = self::_get($params, 'max_payout', null);
        $this->percent_payout = self::_get($params, 'percent_payout', null);
        $this->max_percent_payout = self::_get($params, 'max_percent_payout', null);
        $this->tiered_payout = self::_get($params, 'tiered_payout', null);
        $this->currency = self::_get($params, 'currency', null);

        //Optional Access Parameters
        $this->is_private = self::_get($params, 'is_private', null);
        $this->require_approval = self::_get($params, 'require_approval', null);
        $this->require_terms_and_conditions = self::_get($params, 'require_terms_and_conditions', null);
        $this->terms_and_conditions = self::_get($params, 'terms_and_conditions', null);
        //Optional Converted Offer Parameters
        $this->_converted_offer_type = self::_get($params, '_converted_offer_type', null);
        $this->converted_offer_id = self::_get($params, 'converted_offer_id', null);
        $this->converted_offer_url = self::_get($params, 'converted_offer_url', null);

        //Optional DNE/ Email Parameters
        $this->dne_list_id = self::_get($params, 'dne_list_id', null);
        $this->_show_mail_list = self::_get($params, '_show_mail_list', null);
        $this->email_instructions_from = self::_get($params, 'email_instructions_from', null);
        $this->email_instructions_subject = self::_get($params, 'email_instructions_subject', null);

        //Other Optional Parameters
        $this->approve_conversions = self::_get($params, 'approve_conversions', null);
        $this->conversion_cap = self::_get($params, 'conversion_cap', null);
        $this->redirect_offer_id = self::_get($params, 'redirect_offer_id', null);
        $this->session_hours = self::_get($params, 'session_hours', null);
        $this->enforce_geo_targeting = self::_get($params, 'enforce_geo_targeting', null);
        $this->allow_multiple_conversions = self::_get($params, 'allow_multiple_conversions', null);
        $this->allow_website_links = self::_get($params, 'allow_website_links', null);
        $this->show_custom_variables = self::_get($params, 'show_custom_variables', null);
        $this->display_advertiser = self::_get($params, 'display_advertiser', null);
        $this->set_session_on_impression = self::_get($params, 'set_session_on_impression', null);
        $this->is_seo_friendly_301 = self::_get($params, 'is_seo_friendly_301', null);
        $this->featured = self::_get($params, 'featured', null);
        $this->rating = self::_get($params, 'rating', null);
        $this->disable_click_macro = self::_get($params, 'disable_click_macro', null);
        $this->click_macro_url = self::_get($params, 'click_macro_url', null);
        $this->ref_id = self::_get($params, 'ref_id', null);

        $this->_modified = self::_get($params, '_modified', null);
        $this->_is_expired = self::_get($params, '_is_expired', null);
        $this->_dne_unsubscribe_url = self::_get($params, '_dne_unsubscribe_url', null);
        $this->_dne_download_url = self::_get($params, '_dne_download_url', null);

    }

    public function addTargetCountry($params){
        $req = array(
            'country_code' => 'string'
        );
        $opt = array(
            'regions' => 'array',
            'region_code' => 'string'
        );
        self::_checkParameters($params, $req, $opt);
        array_push($this->_countries, $params['country_code']);
    }

    public function removeTargetCountry($params){
        $req = array(
            'country_code' => 'string'
        );
        self::_checkParameters($params, $req, $opt);

        if(($search = array_search($params['country_code'], $this->_countries)) !== false){
            unset($this->_countries[$search]);
        }
    }

    public function setTargetCountries(){
        if(count($this->_countries) === 0){
            return;
        }

        $params = array(
            'id' => $this->id,
            'country_codes' => $this->_countries
        );
        $response = json_decode(
            self::_buildRequest('setTargetCountries', $params)->send()->raw_body,
            true
        );

        if(count($response['response']['data']['errors'] ) > 0){
            throw new \Exception(
                'Error adding country target. '
                . $response['response']['data']['errors'][0]['publicMessage']
            );
        }

        $this->_updateTargetCountryList();
    }

    public function getTargetCountries(){
        $response = json_decode(
            self::_buildRequest(
                'getTargetCountries', array('id' => $this->id)
            )->send()->raw_body,
            true
        );
        $this->_countries = array();
        $countries = array();
        foreach($response['response']['data'] as $country){
            array_push($this->_countries, $country['Country']['code']);
            array_push($countries, $country['Country']['code']);
        }

        return $countries;
    }

    private function _updateTargetCountryList(){
        $response = json_decode(
            self::_buildRequest(
                'getTargetCountries', array('id' => $this->id)
            )->send()->raw_body,
            true
        );
        $this->_countries = array();
        foreach($response['response']['data'] as $country){
            array_push($this->_countries, $country['Country']['code']);
        }
    }

    public function addCategory($params){
        if(! is_array($params)){
            $params = array( 'category_id' => $params );
        }

        $req = array(
            'category_id' => 'integer'
        );

        $this->_checkParameters($params, $req);
        array_push($this->_categories, $params['category_id']);
    }

    public function getCategories(){
        $response = json_decode(
            self::_buildRequest('getCategories', array( 'id' => $this->id ))->send()->raw_body,
            true
        );

        if(isset($response['response']['error']) && count($response['response']['error']) > 0){
            throw new Exception($response['response']['error'][0]['publicMessage']);
        }

        $cat = array();
        foreach($response['response']['data'] as $data){
            $data = $data['OfferCategory'];
            $cat[$data['id']] = $data;
            $this->_categories[] = $data['id'];
        }
        return $cat;
    }

    public function removeCategory($params){
        $req = array(
            'category_id' => 'integer'
        );
        self::_checkParameters($params, $req, $opt);

        if(($search = array_search($params['category_id'], $this->_categories)) !== false){
            unset($this->_categories[$search]);
        }
    }


    private function _updateCategories(){
        $response = json_decode(
            self::_buildRequest('getCategories', array( 'id' => $this->id ))->send()->raw_body,
            true
        );

        if(isset($response['response']['error']) && count($response['response']['error']) > 0){
            throw new Exception($response['response']['error'][0]['publicMessage']);
        }

        $cat = array();
        foreach($response['response']['data'] as $data){
            $this->_categories[] = $data['id'];
        }
    }

    public function setCategories(){
        if(count($this->_categories) === 0){
            return;
        }

        $params = array(
            'id' => $this->id,
            'category_ids' => $this->_categories
        );

        $response = json_decode(
            self::_buildRequest('setCategories', $params)->send()->raw_body,
            true
        );

        if(count($response['response']['errors']) > 0){
            throw new \Exception(
                sprintf(
                    'Error committing Categories. %s',
                    $response['response']['errors'][0]['publicMessage']
                )
            );
        }
    }

    public function setGroups(){
        if(count($this->_groups) === 0){
            return;
        }
        $params = array(
            'id' => $this->id,
            'group_ids' => $this->_groups
        );
        $response = json_decode(
            self::_buildRequest('setGroups', $params)->send()->raw_body,
            true
        );
        print_r($response);
        if(count($response['response']['errors']) > 0){
            throw new \Exception(
                sprintf('Error adding Group. %s',
                $response['response']['errors'][0]['publicMessage']
                )
            );
        }
    }

    public function addGroup($params){
        if(! is_array($params)){
            $params = array( 'group_id' => $params );
        }

        $req = array(
            'group_id' => 'integer'
        );

        $this->_checkParameters($params, $req);

        array_push($this->_groups, $params['group_id']);
    }

    public function getGroups(){
        $response = json_decode(
            self::_buildRequest('getGroups', array( 'id' => $this->id ))->send()->raw_body,
            true
        );

        if(isset($response['response']['error']) && count($response['response']['error']) > 0){
            throw new Exception($response['response']['error'][0]['publicMessage']);
        }

        $groups = array();
        foreach($response['response']['data'] as $data){
            $data = $data['OfferGroups'];
            $groups[$data['id']] = $data;
        }
        return $groups;
    }


    public static function findAll($params = null){
        $offers = array();
        $response = json_decode(
            self::_buildRequest('findAll', $params)->send()->raw_body,
            true
        );

        foreach($response['response']['data'] as $id => $item){
            $offers[] = self::newInstance($item['Offer']);
        }
        return $offers;
    }

    public static function findById($id){
        $params = array('id'=>$id);
        self::_checkParameters(
            $params,
            array( 'id' => 'integer' )
        );
        $response = json_decode(
            self::_buildRequest('findById', $params)->send()->raw_body,
            true
        );

        if($error = (count($response['response']['errors']) > 0)){
            throw new \Exception($response['response']['errorMessage']);
        }

        if($response['response']['data'] === null){
            return null;
        }
        return self::newInstance($response['response']['data']['Offer']);
    }

    public static function newInstance($response_data){
        $expiration_date = self::_get($response_data, 'expiration_date', null);
        $expiration_date = $expiration_date != null ? new \DateTime($expiration_date) : null;
        $args = array(
            'id' => (int) self::_get($response_data, 'id', null),
            'name' => self::_get($response_data, 'name', null),
            'description' => self::_get($response_data, 'description', null),
            'advertiser_id' => (int) self::_get($response_data, 'advertiser_id', null),
            'offer_url' => self::_get($response_data, 'offer_url', null),
            'preview_url' => self::_get($response_data, 'preview_url', null),
            'protocol' => self::_get($response_data, 'protocol', null),
            'status' => self::_get($response_data, 'status', null),
            'expiration_date' => $expiration_date,
            //Payout Options
            'payout_type' => self::_get($response_data, 'payout_type', null),
            'revenue_type' => self::_get($response_data, 'revenue_type', null),
            'default_payout' => (float) self::_get($response_data, 'default_payout', null),
            'max_payout' => (float) self::_get($response_data, 'max_payout', null),
            'percent_payout' => (float) self::_get($response_data, 'percent_payout', null),
            'max_percent_payout' => (float) self::_get($response_data, 'max_percent_payout', null),
            'tiered_payout' => (int) self::_get($response_data, 'tiered_payout', null),
            'currency' => self::_get($response_data, 'currency', 'network_default'),
            'is_private' => self::_get($params, 'is_private', null),
            'require_approval' => self::_get($params, 'require_approval', null),
            'require_terms_and_conditions' => self::_get($params, 'require_terms_and_conditions', null),
            'terms_and_conditions' => self::_get($params, 'terms_and_conditions', null),
            //Optional Converted Offer Parameters
            '_converted_offer_type' => self::_get($params, '_converted_offer_type', null),
            'converted_offer_id' => self::_get($params, 'converted_offer_id', null),
            'converted_offer_url' => self::_get($params, 'converted_offer_url', null),

            //Optional DNE/ Email Parameters
            'dne_list_id' => self::_get($params, 'dne_list_id', null),
            '_show_mail_list' => self::_get($params, '_show_mail_list', null),
            'email_instructions_from' => self::_get($params, 'email_instructions_from', null),
            'email_instructions_subject' => self::_get($params, 'email_instructions_subject', null),

            //Other Optional Parameters
            'approve_conversions' => self::_get($params, 'approve_conversions', null),
            'conversion_cap' => self::_get($params, 'conversion_cap', null),
            'redirect_offer_id' => self::_get($params, 'redirect_offer_id', null),
            'session_hours' => self::_get($params, 'session_hours', null),
            'enforce_geo_targeting' => self::_get($params, 'enforce_geo_targeting', null),
            'allow_multiple_conversions' => self::_get($params, 'allow_multiple_conversions', null),
            'allow_website_links' => self::_get($params, 'allow_website_links', null),
            'show_custom_variables' => self::_get($params, 'show_custom_variables', null),
            'display_advertiser' => self::_get($params, 'display_advertiser', null),
            'set_session_on_impression' => self::_get($params, 'set_session_on_impression', null),
            'is_seo_friendly_301' => self::_get($params, 'is_seo_friendly_301', null),
            'featured' => self::_get($params, 'featured', null),
            'rating' => self::_get($params, 'rating', null),
            'disable_click_macro' => self::_get($params, 'disable_click_macro', null),
            'click_macro_url' => self::_get($params, 'click_macro_url', null),
            'ref_id' => self::_get($params, 'ref_id', null),

            '_modified' => self::_get($params, '_modified', null),
            '_is_expired' => self::_get($params, '_is_expired', null),
            '_dne_unsubscribe_url' => self::_get($params, '_dne_unsubscribe_url', null),
            '_dne_download_url' => self::_get($params, '_dne_download_url', null)
        );
        return new Offer($args);
    }

    public static function create($offer){
        self::_checkParameters(
            array('offer' => $offer),
            array('offer' => 'HasOffers\Offer')
        );
        $properties = $offer->_serializeProperties();
        $properties['return_object'] = true;

        $response = json_decode(self::_buildRequest('create', $properties)->send()->raw_body, true);

        if(count($response['response']['errors']) > 0){
            throw new \Exception($response['response']['errors'][0]['publicMessage']);
        }

        $new_offer = self::newInstance($response['response']['data']['Offer']);

        $new_offer->_countries = $offer->_countries;
        $new_offer->_categories = $offer->_categories;
        $new_offer->_groups = $offer->_groups;

        $new_offer->setTargetCountries();
        $new_offer->setCategories();
        $new_offer->setGroups();
        return $new_offer;
    }

    public static function update(){
        self::_checkParameters(
            array('offer' => $offer),
            array('offer' => 'HasOffers\Offer')
        );

        $properties = $offer->_serializeProperties();
        $properties['return_object'] = true;

        $response = json_decode(self::_buildRequest('update', $properties)->send()->raw_body, true);

        if(count($response['response']['errors']) > 0){
            throw new \Exception($response['response']['errors'][0]['publicMessage']);
        }

        $new_offer = self::newInstance($response['response']['data']['Offer']);

        $new_offer->_countries = $offer->_countries;
        $new_offer->_categories = $offer->_categories;
        $new_offer->_groups = $offer->_groups;

        $new_offer->setTargetCountries();
        $new_offer->setCategories();
        $new_offer->setGroups();
        return $new_offer;
    }

    public static function delete(){

    }

}
?>