<?php
namespace DashboardTm\Exporters;

use \HasOffers\Offer;
use \HasOffers\Application;

use \InvalidArgumentException;

class HasOffersExporter extends Exporter
{
    private $offer_list = array();

    private $_uncommitted_groups = array();
    private $_uncommitted_categories = array();

    public function __construct($network_id, $network_key){
        $this->network_id = $network_id;
        $this->network_key = $network_key;
        $this->offer_dict = array();

        $this->countries = Application::findAllCountries();
    }

    public function init($data_array){
        if(! is_array($data_array) || count($data_array) === 0){
            throw new InvalidArgumentException("The data must be a non-empty array.");
        }
        foreach($data_array as $name => $countries){
            $targets = Application::findAllCountries();
            $main_category = null;
            $tags = null;
            foreach($countries as $code => $item){
                $offer = $this->_generateOffer($code, $name, $item);
                $main_category = $item['main_category'];
                $tags = implode(' ', $item['tags']);

                $this->_addOfferToGroupName($offer, $name);
                $this->_addOfferToCategoryName($offer, $name);

                unset($targets[$code]);

                $this->offer_list[] = $offer;
            }
            $offer_name = "ZZ {$main_category} - {$name} - {$tags}";
            $this->_addOfferToGroupName($offer, $name);
            $this->_addOfferToCategoryName($offer, $name);
        }
    }

    private function _generateOffer($country_code, $name, $item){
        $main_category = $item['main_category'];
        $item['name'] = sprintf(
            '%s %s - %s - %s',
            $code,
            $main_category,
            strtoupper($name),
            implode(' ', $item['tags'])
        );

        $item['max_percent_payout'] = floatval($item['max_percent_payout']);
        $item['default_payout'] = floatval($item['default_payout']);

        $item['status'] = 'active';
        $item['enforce_geo_tagging'] = 1;

        $offer->addTargetCountry(array('country_code' => $code));
        $this->_addOfferToCategoryName($offer, $code);

        return $offer = new Offer($item);
    }

    private function _addOfferToGroupName($offer, $group_name){
        $filter = array(
            'filters' => array(
                'OfferGroup.name' => $group_name
            )
        );
        $matches = Application::findAllOfferGroups($filter);

        if(count($matches) > 0){

        }else{
            $this->_uncommitted_groups[$group_name] = $offer->id;
        }
    }

    private function _addOfferToCategoryName($offer, $category_name){
        $filter = array(
            'filters' => array(
                'OfferCategory.name' => strtoupper($category_name)
            )
        );

        $matches = Application::findAllOfferCategories($filter);

        if(count($matches) > 0){

        }else{
            $this->_uncommitted_categories[$category_name] = $offer->id;
        }
    }

    public function apply(){
        $cat = $offer->findAllOfferCategories($cat_filter);
        $group = $offer->findAllOfferGroups($grp_filter);

        if(count($group) === 0){
            $response = Application::addOfferGroup(
                array('name' => $original_name)
            );
            $group = $response['id'];
        } else {
            $group = array_pop($group);
            $group = $group['id'];
        }
        $offer->addOfferGroup($group);

        if(count($cat) !== 0){
            $response = Application::addOfferCategory(
                array('name' => $original_name)
            );
            $cat = $response['id'];
        } else {
            $cat = array_pop($cat);
            $cat = $cat['id'];
        }
        $offer->addOfferCategory($cat);

        $offer->addTargetCountry($code);

        $offer_list[] = $offer;

    }

    public function findAllTestOffers($filter){

    }
 }