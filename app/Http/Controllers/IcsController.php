<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ICal\ICal;
use \App\Option;

class IcsController extends Controller
{
	private $ical;

	public function register(Request $request)
	{
		$user_id = $request->user_id;
		$ics = $request->ics;
		try {
			$this->ical = new ICal();
			$this->ical->initUrl($ics);
			if ($this->ical->calendarName() !== 'OCW-i カレンダー') {
				return \Response::json([
					'status' => 400,
					'message' => 'Wrong Format',
				], 400);
			}
		} catch (\Exception $e) {
			return \Response::json([
				'status' => 500,
				'message' => $e->getMessage(),
			], 500);
		}
		Option::updateOrCreate(['user_id' => $user_id], ['ics_url' => $ics]);
		return \Response::json([
			'status' => 200,
			'message' => 'OK',
		]);
	}

	public function get(Request $request)
	{
		$user_id = $request->user_id;
		//var_dump($user_id);
		$record = Option::where('user_id', $user_id)->first();
		//var_dump($record);
		return \Response::json($record);
	}
}
