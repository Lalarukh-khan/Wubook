<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvailController extends Controller
{
	/**
	 * Create a new controller instance.
	 *	UPDATE AVAILABILITIES
	 * @return void
	 */


	public function helper2($availability, $no_ota)
	{
		return "<value>
		<struct>
			<member>
			<name>avail</name>
			<value>
				<int>" . $availability . "</int>
			</value>
			</member>
			<member>
			<name>no_ota</name>
			<value>
				<int>" . $no_ota . "</int>
			</value>
			</member>
		</struct>
		</value>";
	}

	public function helper($roomId, $days)
	{

		$xml = "";
		foreach ($days as $day) {
			$xml .= $this->helper2($day['avail'], $day['no_ota']);
		}

		// $xml;


		return $gml = " <value>
		<struct>
			<member>
			<name>id</name>
			<value>
				<int>" . $roomId . "</int>
			</value>
			</member>
			<member>
			<name>days</name><value>
			<array>
			<data>" . $xml . " </data>
			</array></value></member>
			</struct>
			</value>";
	}

	public function update(Request $request)
	{

		$information = $this->validate($request, [
			'hotel_lcode' => 'required',
			'date' => 'required',
			"rooms_availabilities" => 'required|array'
		]);

		$g = "<?xml version='1.0' encoding='UTF-8'?>
		<methodCall>
		<methodName>update_avail</methodName>
		<params>
			<param>
			<value>
				<string>wr_bd7e4ce0-b8d8-4038-912f-893c8eb0364d</string>
			</value>
			</param>
			<param>
			<value>
				<int>" . $request->hotel_lcode . "</int>
			</value>
			</param>
			<param>
			<value>
				<string>" . $request->date . "</string>
			</value>
			</param>
			<param>
			<value>
				<array>
				<data>";


		foreach ($request->rooms_availabilities as $ra) {
			$g .= $this->helper($ra['id'], $ra['days']);
		}

		$g .= "</data>
		</array>
	</value>
	</param>
</params>
</methodCall>";

		$url = "https://wired.wubook.net/xrws/";
		$send_context = stream_context_create(array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-Type: application/xml',
				'content' => $g
			)
		));
		$response =  file_get_contents($url, false, $send_context);
		return xmlrpc_decode($response);
	}
}
