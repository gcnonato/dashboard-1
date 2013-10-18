<?php
namespace DashboardTm\Importers;
require_once(dirname(__FILE__) . '/../../hasoffers/offer.php');
use \Exception;
use \DomainException;
use \HasOffers\Offer;
class Csv
{
    private $contents;
    public static function loadFile($filename, $delimiter = ',', $enclosure = '', $escape = '\\'){
        if(($csv = @file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)) === false){
            throw new Exception(sprintf("File '%s' does not '", $filename));
        } else {
            if(count($csv) < 1){
                throw new DomainException('Invalid CSV File. Requires at least 1 line');
            }
            //Column Headers
            $headers = str_getcsv(array_shift($csv), $delimiter, $enclosure, $escape);
            $dict = array();
            $header_length = count($headers);
            foreach($csv as $line){
                $items = str_getcsv($line);
                if($header_length < count($items)){
                    throw new DomainException('Some fields are without headers.');
                }
                foreach($items as $key => $item){
                    $dict[$headers[$key]] = trim($item);
                }
            }

            $csv = new Csv;
            $csv->contents = $dict;

            return $csv;
        }
    }

    public function __get($name){
        if(strpos($name, '_') === 0){
            throw new Exception('Property does not exist or cannot be accessed.');
        }
        return $this->{$name};
    }

    private function _import_row($row){
        if(stripos($row['tracking name'], 'transaction id') !== false){
            $protocol = 'server';
        } else if(stripos($row['tracking name'], 'affiliate id') !== false){
            $protocol = 'server_affiliate';
        } else if(stripos($row['tracking name'], 'http iframe') !== false){
            $protocol = 'http';
        } else if(stripos($row['tracking name'], 'https iframe') !== false){
            $protocol = 'https';
        } else if(stripos($row['tracking name'], 'http image') !== false){
            $protocol = 'http_img';
        } else if(stripos($row['tracking name'], 'https image') !== false){
            $protocol = 'https_img';
        }

        $expiry = null;
        if($row['expiry']==''){
            $expiry = new DateTime('3 years from now');
        } else {
            $expiry = new DateTime($row['expiry']);
        }

        //If the offer wasn't marked as 'Promotion'
        //Add the difference to the payout
        $default_payout = $row['payout'];
        if(strtolower($row['notes']) != 'promotion'){
            $default_payout += $row['difference'];
        }

        $data = array(
            'name' => $row['product name'],
            'description' => '',
            'advertiser_id' => 2,
            'offer_url' => $row['offer link'],
            'preview_url' => $row['preview_url'],
            'protocol' => $protocol,
            'expiration_date' => $expiry->format('Y-m-d\TH:i:sP'),
            'payout_type' => 'cpa_flat',
            'default_payout' => $default_payout,
            'enforce_geo_tagging' => 1
        );

        $matches = null;
        if(preg_match('/(\d+(\.\d+))?%$)/', $row['revenue per sale'], $matches) == false){
            $data['revenue_type'] = 'cpa_percentage';
            $data['max_percent_payout'] = $matches[1];
        } else {
            $data['revenue_type'] = 'cpa_flat';
            $data['max_payout'] = $row['revenue'];
        }

        if(stripos($row['notes'], 'pause')){
            $data['status'] = 'paused';
        } else {
            $data['status'] = 'active';
        }

        return $data;
    }

    public function import(){
        $offerdb = array();

        foreach($this->contents as $row){
            if(!is_array($offerdb[$row['offer id']])){
                $offerdb[$row['offer id']] = array();
            }
            $offerdb[ $row['offer id'] ][ $row['country'] ] = $row;
        }


        foreach($offerdb as $offer => $country_items){
            $countries_with_targeting = array();
            foreach($country_items as $country => $row){
                if(strtolower($country) !== 'zzz'){
                    $countries_with_targeting[] = $country;
                    $func = 'create';

                    $data = $this->_import_row($row);

                    if($row['id'] == ''){
                        $data['id'] = $row['id'];
                        $func = 'update';
                    }

                    $offer = new Offer($data);
                    $offer = Offer::$func($offer);

                    $offer->addTargetCountry(array('country_code' => $country));
                }
            }
        }
    }
}
?>