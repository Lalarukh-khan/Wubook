<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	//Get Notification
	public function url(Request $request)
	{
		$rcode = $request->has('rcode') ? $request->rcode : null;
		$lcode = $request->has('lcode') ? $request->lcode : null;
    	return response()->json([$lcode,$rcode],200);
	}
}