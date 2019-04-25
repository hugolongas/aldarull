<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function extras()
	{
		return $this
		->belongsToMany(Extra::class)
		->withTimestamps();
	}

	public function hasExtra($extraID)
	{
		if ($this->extras()->where('extra_id', $extraID)->first()) {
			return true;
		}
		return false;
	}

	public function hasExtras()
	{
		if($this->extras()->count()>0){
			return true;
		}
		return false;
	}
}
