<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
	/**
	 * ModelのTimestampを更新するか
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * 入力を受け付けないColumn
	 */
	protected $guarded = [];

	protected $primaryKey = 'uid';

	public $incrementing = false;
}
