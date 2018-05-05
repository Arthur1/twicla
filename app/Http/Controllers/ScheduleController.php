<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ICal\ICal;
use \App\Option;

class ScheduleController extends Controller
{
	public function list(Request $request)
	{
		$user_id = $request->user_id;
		$record = Option::find($user_id);
		if (empty($record['ics_url'])) return \Response::json([], 400);
		$ical = new ICal();
		$ical->initUrl($record['ics_url']);
		$schedule = $ical->eventsFromRange('2018-05-01 00:00:00', '2018-08-31 00:00:00');
		//$schedule = $ical->eventsFromInterval('1 week');
		return \Response::json($schedule);
	}

	public function todayList(Request $request)
	{
		$user_id = $request->user_id;
		$record = Option::find($user_id);
		if (empty($record['ics_url'])) return \Response::json([], 400);
		$ical = new ICal();
		$ical->initUrl($record['ics_url']);
		// $ts = time();
		$ts = strtotime('7 May 2018'); // debug
		$schedule = $ical->eventsFromRange(date('Y-m-d', $ts).' 00:00:00', date('Y-m-d', $ts).' 23:59:00');
		//$schedule = $ical->eventsFromInterval('1 day');
		return \Response::json($schedule);
	}
}
