<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use Yajra\Datatables\Datatables;
use Notification;

class ResourceController extends Controller
{
    public function Index()
    {
        return view('admin.resources.index');
    }

	public function getData()
	{
		return Datatables::of(Resource::all())->make(true);
	}

    public function Create()
    {
        return view('admin.resources.create');
    }

    public function Store(Request $request)
    {
        $resource = new Resource();
        $key = $request->input('key');
        $value = $request->input('value');
        $resource->key = $key;
        $resource->value = $value;
        $resource->save();
        Notification::success("S'ha creat un text");		
		return redirect()->route('admin.resource.index');	
    }

    public function Edit($id)
	{
		$resource = Resource::findOrFail($id);		
		return view ('admin.resources.edit')->with('resource', $resource);
	}

	public function Update(Request $request)
	{		
        $resource = Resource::findOrFail($request->id);
        $text = $request->input('text');
        $resource->value = $text;
        $resource->save();
		Notification::success("S'ha modificat el text");		
		return redirect()->route('admin.resource.index');	
	}
}
