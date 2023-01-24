<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */


  //Add Virtual Room
  public function virtual(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'pid' => 'required',
      'room_name' => 'required',
      'room_price' => 'required',
      'room_occupancy' => 'required',
      'room_children' => 'required',
      'room_shortname' => 'required',
      'dec_avail' => 'required',
      'min_price' => 'required',
      'max_price' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $pid = $information['pid'];
    $room_name = $information['room_name'];
    $room_price = $information['room_price'];
    $room_occupancy = $information['room_occupancy'];
    $room_children = $information['room_children'];
    $room_shortname = $information['room_shortname'];
    $dec_avail = $information['dec_avail'];
    $min_price = $information['min_price'];
    $max_price = $information['max_price'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
  <methodName>new_virtual_room</methodName>
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
        <int>" . $pid . "</int>
      </value>
    </param>
  <param>
    <value>
    <int>0</int>
    </value>
  </param>
    <param>
      <value>
        <string>" . $room_name . "</string>
      </value>
    </param>
    <param>
      <value>
        <int>" . $room_occupancy . "</int>
      </value>
    </param>
    <param>
      <value>
        <int>" . $room_children . "</int>
      </value>
    </param>
    <param>
      <value>
        <int>" . $room_price . "</int>
      </value>
    </param>
    <param>
      <value>
        <string>" . $room_shortname . "</string>
      </value>
    </param>
    <param>
      <value>
        <string>nb</string>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>en</name>
            <value><string>virtual</string></value>
          </member>
          <member>
            <name>it</name>
              <value><string>virtuale</string></value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>en</name>
            <value><string>virtual descr</string></value>
          </member>
          <member>
            <name>it</name>
            <value><string>virtuale descr</string></value>
          </member>
        </struct>
      </value>
    </param>
    <param>
      <value>
        <struct>
          <member>
            <name>hb</name>
            <value><struct>
              <member>
                <name>dtype</name>
                <value><int>1</int></value>
              </member>
              <member>
                <name>value</name>
                <value><int>10</int></value>
              </member>
            </struct></value>
          </member>
          <member>
            <name>fb</name>
            <value><struct>
              <member>
                <name>dtype</name>
                <value><int>2</int></value>
              </member>
              <member>
                <name>value</name>
                <value><int>20</int></value>
              </member>
            </struct></value>
          </member>
        </struct>
      </value>
    </param>
<param>
  <value>
    <int>" . $dec_avail . "</int>
  </value>
</param>
<param>
  <value>
    <int>" . $min_price . "</int>
  </value>
</param>
<param>
  <value>
    <int>" . $max_price . "</int>
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


  //Add Room
  public function store(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'room_name' => 'required',
      'room_price' => 'required',
      'availibility' => 'required',
      'room_occupancy' => 'required',
      'room_shortname' => 'required',
      'roomtype_name' => 'required',
      'min_price' => 'required',
      'max_price' => 'required',
    ]);


    // $id = 1;
    $hotel_lcode = $information['hotel_lcode'];
    $room_name = $information['room_name'];
    $room_price = $information['room_price'];
    $availibility = $information['availibility'];
    $room_occupancy = $information['room_occupancy'];
    $room_shortname = $information['room_shortname'];
    $roomtype_name = $information['roomtype_name'];
    $min_price = $information['min_price'];
    $max_price = $information['max_price'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
<methodCall>
<methodName>new_room</methodName>
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
      <int>0</int>
    </value>
  </param>
  <param>
    <value>
      <string>" . $room_name . "</string>
    </value>
  </param>
  <param>
    <value>
      <int>" . $room_occupancy . "</int>
    </value>
  </param>
  <param>
    <value>
      <int>" . $room_price . "</int>
    </value>
  </param>
  <param>
    <value>
      <int>" . $availibility . "</int>
    </value>
  </param>
  <param>
    <value>
      <string>" . $room_shortname . "</string>
    </value>
  </param>
  <param>
    <value>
      <string>nb</string>
    </value>
  </param>
  <param>
    <value>
      <struct>
        <member>
          <name>ru</name>
          <value>
            <string>russian name</string>
          </value>
        </member>
      </struct>
    </value>
  </param>
  <param>
    <value>
      <struct>
        <member>
          <name>ru</name>
          <value>
            <string>russian description</string>
          </value>
        </member>
      </struct>
    </value>
  </param>
  <param>
    <value>
      <struct>
        <member>
          <name>bb</name>
          <value>
            <struct>
              <member>
                <name>dtype</name>
                <value>
                  <int>1</int>
                </value>
              </member>
              <member>
                <name>value</name>
                <value>
                  <int>10</int>
                </value>
              </member>
            </struct>
          </value>
        </member>
      </struct>
    </value>
  </param>
  <param>
    <value>
      <int>" . $roomtype_name . "</int>
    </value>
  </param>
  <param>
    <value>
      <int>" . $min_price . "</int>
    </value>
  </param>
  <param>
    <value>
      <int>" . $max_price . "</int>
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


  //Update Room
  public function update(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'room_id' => 'required',
      'room_name' => 'required',
      'room_price' => 'required',
      'availibility' => 'required',
      'room_occupancy' => 'required',
      'room_shortname' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $room_id = $information['room_id'];
    $room_name = $information['room_name'];
    $room_price = $information['room_price'];
    $availibility = $information['availibility'];
    $room_occupancy = $information['room_occupancy'];
    $room_shortname = $information['room_shortname'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
      <methodName>mod_room</methodName>
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
            <int>" . $room_id . "</int>
          </value>
      </param>
      <param>
          <value>
            <string>" . $room_name . "</string>
          </value>
      </param>
      <param>
          <value>
            <int>" . $room_occupancy . "</int>
          </value>
      </param>
      <param>
          <value>
            <int>" . $room_price . "</int>
          </value>
      </param>
      <param>
          <value>
            <int>" . $availibility . "</int>
          </value>
      </param>
      <param>
          <value>
            <string>" . $room_shortname . "</string>
          </value>
      </param>
      <param>
          <value>
            <string>nb</string>
          </value>
      </param>
      <param>
        <value>
          <struct>
            <member>
              <name>ru</name>
              <value>
                <string>russian name</string>
              </value>
            </member>
          </struct>
        </value>
      </param>
      <param>
        <value>
          <struct>
            <member>
              <name>ru</name>
              <value>
                <string>russian description</string>
              </value>
            </member>
          </struct>
        </value>
      </param>
      <param>
        <value>
          <struct>
            <member>
              <name>bb</name>
              <value>
                <struct>
                  <member>
                    <name>dtype</name>
                    <value>
                      <int>1</int>
                    </value>
                  </member>
                  <member>
                    <name>value</name>
                    <value>
                      <int>10</int>
                    </value>
                  </member>
                </struct>
              </value>
            </member>
          </struct>
        </value>
      </param>
      <param>
          <value>
            <int>0</int>
          </value>
      </param>
      <param>
          <value>
            <int>" . $room_price . "</int>
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

  //Delete Room
  public function delete(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'room_id' => 'required',
    ]);

    $room_id = $information['room_id']; //566160;
    $hotel_lcode = $information['hotel_lcode']; //1663764326;

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
    <methodCall>
    <methodName>del_room</methodName>
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
          <int>" . $room_id . "</int>
        </value>
      </param>
    </params>
    </methodCall>";


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

  //List of Room
  public function list(Request $request)
  {
    $takevalue =  $this->validate($request, [
      'hotel_lcode' => 'required',
    ]);
    $hotel_lcode = $takevalue['hotel_lcode'];
    // 1663764025
    $xml = "<?xml version='1.0'?><methodCall><methodName>fetch_rooms</methodName><params><param><value><string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string></value></param><param><value><int>" . $hotel_lcode . "</int></value></param></params></methodCall>";


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
