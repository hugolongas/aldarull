<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public static function seoUrl($string) {
    //Lower case everything
		$finalString = strtolower($string);
    //Make alphanumeric (removes all other characters)
		$finalString = preg_replace("/[^a-z0-9_\s-]/", "", $finalString);
    //Clean up multiple dashes or whitespaces
		$finalString = preg_replace("/[\s-]+/", " ", $finalString);
    //Convert whitespaces and underscore to dash
		$finalString = preg_replace("/[\s_]/", "-", $finalString);
		return $finalString;
	}
}
