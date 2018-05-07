<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ICal\ICal;
use \App\Attendance;

class AttendanceController extends Controller
{
	private $ical;

	public function register(Request $request)
	{
		$attendance = new Attendance();
		$attendance->class_name = $request->class_name;
		$attendance->user_id = $request->user_id;
		$attendance->uid = $request->uid;
		$attendance->late_minutes = $request->late_minutes;
		$attendance->status = $request->status;
		$attendance->save();
		return \Response::json([
			'status' => 200,
			'message' => 'OK',
		]);
	}

	public function get(Request $request)
	{
		$user_id = $request->user_id;
		return \Response::json(Attendance::where('user_id', $user_id)->get());
	}
}
