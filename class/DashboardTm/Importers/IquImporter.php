<?php
namespace DashboardTm\Importers;
class IquImporter extends Importer
{
    public $file_path;

    private $currency_conversion_map = array(
        'EUR' => array(
            'USD' => 1.26,
            'EUR' => 1
        ),
        'USD' => array(
            'USD' => 1,
            'EUR' => 0.79
        )
    );

    private $currency = 'USD';

    public function __construct($xml_file = null){
        $this->file_path = $xml_file == null
            ? "http://{$_SERVER['HTTP_HOST']}/offers.xml" : $xml_file;
    }

    public function parseXml(){
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Accept: text/xml, application/xml\r\n'
            )
        );

        $context = stream_context_create($opts);

        $offers = array();

       if(($contents = file_get_contents($this->file_path, false, $context)) !== false){
            $xml = simplexml_load_string($contents);
            $result = $xml->xpath('games/game');
            foreach($result as $node){
                $name = (string)$node->name;
                $country = (string)$node->country;
                $currency = (string)$node->currency;
                if(! isset($offers[$name])){
                    $offers[$name] = array();
                }

                $payout = floatval((string)$node->net_payout) *
                    $this->currency_conversion_map[$currency][$this->currency];

                $offer_url = trim(str_replace(
                    'subid=PLACE_HERE_SUB_AFFILIATE_ID',
                    'transaction_id={transaction_id}&adv_sub={offer_id},{affiliate_id}',
                    (string) $node->playnowurl
                ));

                $offers[$name][$country] = array(
                    'name' => $name,
                    'main_category' => 'game',
                    'protocol' => 'server',
                    'revenue_type' => 'cpa_percentage',
                    'max_percent_payout' => floatval(100),
                    'payout_type' => 'cpa_flat',
                    'default_payout' => floatval($payout),
                    'offer_url' => $offer_url
                );
            }
        }
        return $offers;
    }
}
?>