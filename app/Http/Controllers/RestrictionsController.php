<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestrictionsController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */


  //Add Restrictions
  public function add(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'name' => 'required',
      'compact' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $name = $information['name'];
    $compact = $information['compact'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>rplan_add_rplan</methodName>
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
        <string>" . $name . "</string>
      </value>
    </param>
    <param>
      <value>
        <int>" . $compact . "</int>
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

  //Delete Restrictions
  public function delete(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rid' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rid = $information['rid'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>rplan_del_rplan</methodName>
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
        <int>" . $rid . "</int>
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

  //Fetch Restrictions
  public function list(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>rplan_rplans</methodName>
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

  //Rename Restrictions
  public function rename(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rid' => 'required',
      'name' => 'required'
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rid = $information['rid'];
    $name = $information['name'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
	<methodCall>
  <methodName>rplan_rename_rplan</methodName>
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
        <int>" . $rid . "</int>
      </value>
    </param>
    <param>
      <value>
        <string>" . $name . "</string>
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

  //Values Restrictions
  public function values(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rid' => 'required',
      'dfrom' => 'required',
      'name' => 'required',
      'minstay' => 'required',
      'maxstay' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rid = $information['rid'];
    $dfrom = $information['dfrom'];
    $name = $information['name'];
    $minstay = $information['minstay'];
    $maxstay = $information['maxstay'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
  <methodName>rplan_update_rplan_values</methodName>
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
		<int>" . $rid . "</int>
	  </value>
	</param>
	<param>
	  <value>
		<string>" .  $dfrom . "</string>
	  </value>
	</param>
	<param>
	  <value>
		<struct>
		  <member>
			<name>" .  $name . "</name>
			<value>
			  <array>
				<data>
				  <value>
					<struct>
					  <member>
						<name>min_stay</name>
						<value>
						  <int>" .  $minstay . "</int>
						</value>
					  </member>
					</struct>
				  </value>
				  <value>
					<struct>
					  <member>
						<name>max_stay</name>
						<value>
						  <int>" .  $maxstay . "</int>
						</value>
					  </member>
					</struct>
				  </value>
				</data>
			  </array>
			</value>
		  </member>
		</struct>
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

  //Rules of Restrictions
  public function rules(Request $request)
  {
    $information = $this->validate($request, [
      'hotel_lcode' => 'required',
      'rid' => 'required',
      'closed_arrival' => 'required',
      'closed' => 'required',
      'min_stay' => 'required',
      'closed_departure' => 'required',
      'max_stay' => 'required',
      'min_stay_arrival' => 'required',
    ]);

    $hotel_lcode = $information['hotel_lcode'];
    $rid = $information['rid'];
    $closed_arrival = $information['closed_arrival'];
    $closed = $information['closed'];
    $min_stay = $information['min_stay'];
    $closed_departure = $information['closed_departure'];
    $max_stay = $information['max_stay'];
    $min_stay_arrival = $information['min_stay_arrival'];

    $xml = "<?xml version='1.0' encoding='UTF-8'?>
  <methodCall>
  <methodName>rplan_update_rplan_rules</methodName>
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
            <int>" . $rid . "</int>
        </value>
    </param>
    <param>
        <value>
            <struct>
                <member>
                    <name>closed_arrival</name>
                    <value>
                        <int>" . $closed_arrival . "</int>
                    </value>
                </member>
                <member>
                    <name>closed</name>
                    <value>
                        <int>" . $closed . "</int>
                    </value>
                </member>
                <member>
                    <name>min_stay</name>
                    <value>
                        <int>" . $min_stay . "</int>
                    </value>
                </member>
                <member>
                    <name>closed_departure</name>
                    <value>
                        <int>" . $closed_departure . "</int>
                    </value>
                </member>
                <member>
                    <name>max_stay</name>
                    <value>
                        <int>" . $max_stay . "</int>
                    </value>
                </member>
                <member>
                    <name>min_stay_arrival</name>
                    <value>
                        <int>" . $min_stay_arrival . "</int>
                    </value>
                </member>
            </struct>
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
}
