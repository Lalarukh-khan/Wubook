<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

  //Add Plan
  public function store(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'plan_name' => 'required',
    ]);
    $hotel_lcode = $information['hotel_lcode']; //1663764025;
    $plan_name = $information['plan_name'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
  <methodName>add_pricing_plan</methodName>
  <params>
    <param>
      <value>
        <string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
      </value>
    </param>
    <param>
      <value>
        <int>" . $hotel_lcode . "</int>
      </value>
    </param>
    <param>
      <value>
        <string>" . $plan_name . "</string>
      </value>
    </param>
    <param>
      <value>
        <int>1</int>
      </value>
    </param>
  </params>
</methodCall>
";
    $url = "https://wired.wubook.net/xrws/";
    $send_context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/xml',
        'content' => $xml
      )
    ));
    $response =  file_get_contents($url, false, $send_context);
    // $xml1 = simplexml_load_string($response);
    // $json = json_encode($xml1);
    // $array = json_decode($json,TRUE);
    return xmlrpc_decode($response);
  }

  //Update Plan
  public function update(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'plan_code' => 'required',
      'plan_name' => 'required',
    ]);
    $hotel_lcode = $information['hotel_lcode']; //1663764025;
    $plan_code = $information['plan_code'];
    $plan_name = $information['plan_name'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
  <methodName>update_plan_name</methodName>
  <params>
    <param>
      <value>
        <string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
      </value>
    </param>
    <param>
      <value>
        <int>" . $hotel_lcode . "</int>
      </value>
    </param>
    <param>
      <value>
        <int>" . $plan_code . "</int>
      </value>
    </param>
    <param>
      <value>
        <string>" . $plan_name . "</string>
      </value>
    </param>
  </params>
</methodCall>
";
    $url = "https://wired.wubook.net/xrws/";
    $send_context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/xml',
        'content' => $xml
      )
    ));
    $response =  file_get_contents($url, false, $send_context);
    // $xml1 = simplexml_load_string($response);
    // $json = json_encode($xml1);
    // $array = json_decode($json,TRUE);
    return xmlrpc_decode($response);
  }

  //Delete Plan
  public function delete(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'plan_code' => 'required',
    ]);
    $hotel_lcode = $information['hotel_lcode']; //1663764025;
    $plan_code = $information['plan_code'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
    <methodCall>
    <methodName>del_plan</methodName>
    <params>
      <param>
        <value>
          <string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
        </value>
      </param>
      <param>
        <value>
          <int>" . $hotel_lcode . "</int>
        </value>
      </param>
      <param>
        <value>
          <int>" . $plan_code . "</int>
        </value>
      </param>
    </params>
  </methodCall>
  ";
    $url = "https://wired.wubook.net/xrws/";
    $send_context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/xml',
        'content' => $xml
      )
    ));
    $response =  file_get_contents($url, false, $send_context);
    // $xml1 = simplexml_load_string($response);
    // $json = json_encode($xml1);
    // $array = json_decode($json,TRUE);
    return xmlrpc_decode($response);
  }

  //List all plan
  public function list(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
    ]);
    $hotel_lcode = $information['hotel_lcode']; //1663764025;

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
<methodCall>
<methodName>get_pricing_plans</methodName>
<params>
  <param>
    <value>
      <string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
    </value>
  </param>
  <param>
    <value>
      <int>" . $hotel_lcode . "</int>
    </value>
  </param>
</params>
</methodCall>
";
    $url = "https://wired.wubook.net/xrws/";
    $send_context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/xml',
        'content' => $xml
      )
    ));
    $response =  file_get_contents($url, false, $send_context);
    // $xml1 = simplexml_load_string($response);
    // $json = json_encode($xml1);
    // $array = json_decode($json,TRUE);
    return xmlrpc_decode($response);
  }

  public function helper2($price)
  {
    return " <value>
    <int>" . $price . "</int>
  </value>";
  }

  public function helper($roomCode, $dailyRates)
  {

    $xml = "";
    foreach ($dailyRates as $rate) {
      $xml .= $this->helper2($rate);
    }


    $xml3 = " <member>
    <name>" . $roomCode . "</name>
    <value>
      <array>
        <data>\n" . $xml . "\n</data>
        </array>
      </value>
    </member>";
    return $xml3;
  }

  public function price(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'plan_code' => 'required',
      'date' => 'required',
      'room_prices' => 'required|array'
    ]);
    $hotel_lcode = $information['hotel_lcode']; //1663764025;
    $plan_code = $information['plan_code'];  //205196 
    $plan_code = $information['plan_code'];  //205196 
    $plan_code = $information['plan_code'];  //205196 
    $date = $information['date'];  //12/10/2022

    $gXml = "<?xml version='1.0' encoding='UTF-8'?>
    <methodCall>
    <methodName>update_plan_prices</methodName>
    <params>
      <param>
        <value>
          <string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
        </value>
      </param>
      <param>
        <value>
          <int>" . $hotel_lcode . "</int>
        </value>
      </param>
      <param>
        <value>
          <int>" . $plan_code . "</int>
        </value>
      </param>
      <param>
        <value>
          <string>" . $date . "</string>
        </value>
      </param>
      <param>
        <value>
          <struct>";



    $value = "";
    foreach ($request->room_prices as $roomCode => $roomPrices) {
      $value .= $this->helper($roomCode, $roomPrices);
    }


    $gXml .= $value;

    $gXml .= "</struct>
              </value>
            </param>
          </params>
          </methodCall>";


    $url = "https://wired.wubook.net/xrws/";
    $send_context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/xml',
        'content' => $gXml
      )
    ));
    $response =  file_get_contents($url, false, $send_context);
    // $xml1 = simplexml_load_string($response);
    // $json = json_encode($xml1);
    // $array = json_decode($json,TRUE);
    return xmlrpc_decode($response);
  }
}
