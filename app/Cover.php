<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Widget;
class Cover extends Model
{
	public function GetWidget()
	{
		$w = Widget::find($this->widget_id);
		return $w;
	}

	public function WidgetData()
	{
		$xmlParams = simplexml_load_string($this->widget_param);
		return $xmlParams;
	}

	public function GetValue($attr)
	{
		$xmlParams = simplexml_load_string($this->widget_param);
		foreach($xmlParams->i as $param)
		{
			if((string)$param['k'] == $attr)
				return (string)$param;
		}

	}
}
