<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */


  //Add Reservation
  public function new(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'datefrom' => 'required',
      'dateto' => 'required',
      'room_id' => 'required',
      'room_qty' => 'required',
      'c_lname' => 'required',
      'c_email' => 'required',
      'c_fname' => 'required',
      'room_amount' => 'required',
      'men' => 'required',
      'children' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $datefrom = $information['datefrom'];
    $dateto = $information['dateto'];
    $room_id = $information['room_id'];
    $room_qty = $information['room_qty'];
    $c_lname = $information['c_lname'];
    $c_email = $information['c_email'];
    $c_fname = $information['c_fname'];
    $room_amount = $information['room_amount'];
    $men = $information['men'];
    $children = $information['children'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>new_reservation</methodName>
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
        <string>" . $datefrom . "</string>
      </value>
    </param>
    <param>
      <value>
        <string>" . $dateto . "</string>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>" . $room_id . "</name>
            <value>
              <array>
                <data>
                  <value>
                    <int>" . $room_qty . "</int>
                  </value>
                  <value>
                    <string>nb</string>
                  </value>
                </data>
              </array>
            </value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>lname</name>
            <value>
              <string>" . $c_lname . "</string>
            </value>
          </member>
          <member>
            <name>email</name>
            <value>
              <string>" . $c_email . "</string>
            </value>
          </member>
          <member>
            <name>fname</name>
            <value>
              <string>" . $c_fname . "</string>
            </value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <string>" . $room_amount . "</string>
      </value>
    </param>
    <param>
    <value>
      <struct>
       <member>
        <name>men</name>
         <value>
          <int>" . $men . "</int>
         </value>
       </member>
       <member>
        <name>children</name>
         <value>
          <int>" . $children . "</int>
         </value>
       </member>
      </struct>
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

  //Delete Reservation
  public function delete(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rcode' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rcode = $information['rcode'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>cancel_reservation</methodName>
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
        <string>" . $rcode . "</string>
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

  //Fetch Reservations
  public function list(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>fetch_new_bookings</methodName>
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

  //Single Reservations
  public function single(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rcode' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rcode = $information['rcode'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>fetch_booking</methodName>
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
        <string>" . $rcode . "</string>
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

  //Push Activation
  public function activation(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'url' => 'required',
      'test' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $url = $information['url'];
    $test = $information['test'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>push_activation</methodName>
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
        <string>" . $url . "</string>
      </value>
    </param>
    <param>
      <value>
        <int>" . $test . "</int>
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

  //Push URL
  public function push_url(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>push_url</methodName>
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

  //Fetch Fresh Reservations
  public function fresh(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'ancillary' => 'required',
      'mark' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $ancillary = $information['ancillary'];
    $mark = $information['mark'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>fetch_new_bookings</methodName>
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
        <int>" . $ancillary . "</int>
      </value>
    </param>
    <param>
      <value>
        <int>" . $mark . "</int>
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
}
