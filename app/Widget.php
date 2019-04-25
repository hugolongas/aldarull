<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cover;
class Widget extends Model
{
	public function widgetParams()
	{
		$xmlParams = simplexml_load_string($this->widget_param);
		return $xmlParams;
	}
}
