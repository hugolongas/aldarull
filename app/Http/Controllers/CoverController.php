<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Cover;
use App\Gallery;
use App\Schedule;
use App\Product;
use App\Widget;

class CoverController extends Controller
{
	public function IndexAdmin()
	{
		$covers = Cover::all();
		$widgets = Widget::all();
		$widgetArray = array();
		foreach ($covers as $cover) {
			$widgetArray[] = $cover->widget;
		}
		return view('admin.covers.index')->with('covers', $covers)->with('widgets', $widgets);
	}

	public function Create($id)
	{
		$widget = Widget::findOrFail($id);
		return view('admin.covers.create')->with('widget', $widget);
	}

	public function Store(Request $request)
	{
		$widget_id = $request->input('widget_id');
		$widget = Widget::find($widget_id);

		$widget_params = $widget->widget_param;
		$xml = simplexml_load_string($widget_params);
		$widgetConfig = '<is>';
		foreach ($xml as $param) {
			$name = $param->name;
			$type = $param->type;
			if ($type == 'file') {
				$file = $request->file($name);
				if ($file != null) {
					$value = $file->getClientOriginalName();
					Storage::disk('public')->put($value, file_get_contents($file));
				}
			} else if ($name == 'video_url') {
				$videoLink = $request->input($name);
				if (strpos($videoLink, 'http://www.youtube.com/watch?v=') !== false) {
					parse_str(parse_url($videoLink, PHP_URL_QUERY), $variables);
					$value = $variables['v'];
				} else {
					$value = $videoLink;
				}
			} else
				$value = $request->input($name);

			$widgetConfig .= "<i k='" . $name . "'>";
			$widgetConfig .= "<![CDATA[" . $value . "]]>";
			$widgetConfig .= "</i>";
		}

		$widgetConfig .= '</is>';
		$cover = new Cover();
		$cover->widget_param = $widgetConfig;
		$cover->widget_id = $widget_id;
		$cover->save();
		Notification::success("S'ha creat un nou widget");
		return redirect()->route('admin.cover.index');
	}

	public function Edit($id)
	{
		$cover = Cover::findOrFail($id);
		return view('admin.covers.edit')->with('cover', $cover);
	}

	public function Update(Request $request)
	{
		$widget_id = $request->input('widget_id');
		$widget = Widget::find($widget_id);
		$cover = Cover::findOrFail($request->id);

		$widget_params = $widget->widget_param;
		$xml = simplexml_load_string($widget_params);
		$widgetConfig = '<is>';
		foreach ($xml as $param) {
			$name = $param->name;
			$type = $param->type;
			if ($type == 'file') {
				$file_name = $cover->GetValue('link_url');
				$file = $request->file($name);
				if ($file != null) {
					$value = $file->getClientOriginalName();
					Storage::disk('public')->put($value, file_get_contents($file));
					if (Storage::disk('public')->exists($file_name)) {
						Storage::disk('public')->delete($file_name);
					}
				}
			} else if ($name == 'video_url') {
				$videoLink = $request->input($name);
				if (strpos($videoLink, 'http://www.youtube.com/watch?v=') !== false) {
					parse_str(parse_url($videoLink, PHP_URL_QUERY), $variables);
					$value = $variables['v'];
				} else {
					$value = $videoLink;
				}
			} else {
				$value = $request->input($name);
			}


			$widgetConfig .= "<i k='" . $name . "'>";
			$widgetConfig .= "<![CDATA[" . $value . "]]>";
			$widgetConfig .= "</i>";
		}

		$widgetConfig .= '</is>';
		$cover->widget_param = $widgetConfig;
		$cover->widget_id = $widget_id;
		$cover->save();
		Notification::success("S'ha creat un nou widget");
		return redirect()->route('admin.cover.index');
	}

	public function Delete($id)
	{
		$Cover = Cover::findOrFail($id);
		if ($Cover != null) {
			$Cover->delete();
		}
	}
}
