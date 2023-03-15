<?php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
require_once __DIR__ . '/../vendor/autoload.php';

class guzzleHelper{

    function __construct()
    {
        require_once __DIR__ . '/config.php';
    }

    function send($request, $type='GET'){

        $data = $request->getQueryParams();
        $advertiser = strtoupper($data['advertiser']);
	    $path = $request->getUri()->getPath();
        $query = $request->getUri()->getQuery();

        $config = new vrConfig;
        $configData = $config->get();
        if(isset($configData[$advertiser])){
            $url = $configData[$advertiser]['URL'];
        }

        $headers = $request->getHeaders();
        $headers['Accept']= 'application/xml';

        $postVars = $request->getParsedBody();
        if(is_null($postVars)){$postVars = array();}
        if(is_null($query)){$query = array();}
        

        $client = new GuzzleHttp\Client(['base_uri' => $url, 'timeout'  => 30.0, 'headers' => $headers, 'query'=>$query]);
        $r = $client->request($type, $path, ['form_params' => $postVars]);//, ['query'=>$query]
        
        return $r->getBody();
        echo '<pre>';
	print_r($r);
	die('loaded');

    }


}