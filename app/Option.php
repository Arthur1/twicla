<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	/**
	 * Modelと関連しているTable
	 * @var string
	 */
	protected $table = 'user_options';

	/**
	 * ModelのTimestampを更新するか
	 * @var bool
	 */
	public $timestamps = false;

	/**
     * 入力を受け付けるColumn
     */
    protected $fillable = ['user_id', 'ics_url'];

    protected $primaryKey = 'user_id';
    public $incrementing = false;
}
