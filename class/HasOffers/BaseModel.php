<?php
namespace HasOffers;

class BaseModel extends Base
{
    protected static $api_url = 'https://mmotm.api.hasoffers.com/Api';
    protected static $target = 'Application';
    protected static $format = 'json';
    protected static $service = 'hasoffers';
    protected static $version = 2;
    protected static $network_id = 'mmotm';
    protected static $network_token = 'NETjE4MoLg7NarETCDruHecVmgLHbN';

    protected static function _buildRequest($method, $data = null){
        $params = array(
            'Method' => $method,
            'Target' => static::$target,
            'Format' => static::$format,
            'Service' => static::$format,
            'Version' => static::$version,
            'NetworkId' => static::$network_id,
            'NetworkToken' => static::$network_token
        );
        if(is_array($data)){
            $params = array_merge($params, $data);
        }else if($data !== null){
            throw new \InvalidArgumentException('Parameter 2 must be an array.');
        }

        $query = http_build_query($params);
        return \Httpful\Request::post(self::$api_url, $query, \Httpful\Mime::FORM);
    }


}
?>