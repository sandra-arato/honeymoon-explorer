<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
	protected $fillable = [
		'destionation',
    'destination',
    'movie',
    'item',
    'todo',
    'duration'
	];
}
