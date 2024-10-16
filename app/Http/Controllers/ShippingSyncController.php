<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Shipping;

class ShippingSyncController extends Controller
{
	public function read (Request $request)
	{
		$origin = $request->get('origin');
		$email = $request->get('email');
		$url = $request->get('url');

		try {
			//FIND SHIPMENT
			$shipping = Shipping::where( 'shipping_code', $origin)->first();
			$shippingEmail = $shipping->shippingEmails()->where('email', $email)->first();

			if (empty($shippingEmail->read)) {
				$shippingEmail->read = "R";

				$shippingEmail->save();
			}
		} finally {
			return redirect('https://' . $url);
		}
	}
}
