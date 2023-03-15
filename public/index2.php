<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

require __DIR__ . '/../vendor/autoload.php';
ini_set('display_errors','On');
error_reporting(E_ALL);

// die('loaded');
require_once __DIR__ . '/config.php';

$client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8070/', 'timeout'  => 2.0]);
	$r = $client->request('GET', 'test/west');

	// $client = new GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/']);
	// $r = $client->request('POST', 'http://localhost:8080/', [
	// 	'name' => 'post request data'
	// ]);

	$c = (string) $r->getBody();

	echo '<pre>';
	print_r($c);
	die;



