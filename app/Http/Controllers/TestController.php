<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  //Testing 
  public function test()
  {
    $xml_string = "<?xml version='1.0'?>
	<methodResponse>
			<ping>pong</ping>
	</methodResponse>
	";
	$xml = simplexml_load_string($xml_string);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
    return $array;
  }
}
