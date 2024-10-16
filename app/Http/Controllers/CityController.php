<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\State;

class CityController extends Controller
{
	public function options($id)
	{
		$state = State::find($id);
		$result = $state->cities->map(function ($item) {
			return [
				'id' => $item->id, 'text' => $item->name
			];
		});
		return response()->json($result);
	}
}