<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

	public function count(Request $request)
	{
		$user_id = $request->user_id;
		if ($user_id === null) return \Response::json(['status' => 400, 'message' => 'error'], 400);
		$records = DB::table('attendances')
					->select(DB::raw('user_id, class_name, status, COUNT(*) AS count'))
					->where('user_id', $user_id)
					->orderBy('class_name', 'asc')
					->groupBy('class_name', 'status', 'user_id')
					->get();
		$results = [];
		foreach ($records as $record) {
			$results[$record->class_name][$record->status] = $record->count;
		}
		return \Response::json($results);
	}
}
