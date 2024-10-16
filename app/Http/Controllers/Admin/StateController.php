<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\State;

class StateController extends Controller
{
	public function cities($id)
	{
		$state = State::find($id);
		$result = $state->cities->map(function ($item) {
			return [
				'id' => $item->id, 'title' => $item->name
			];
		});
		return response()->json($result, 200);
	}
}
