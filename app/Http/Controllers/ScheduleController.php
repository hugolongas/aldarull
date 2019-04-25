<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Yajra\Datatables\Datatables;
use Notification;

class ScheduleController extends Controller
{
	public function Index()
	{
		$schedules = Schedule::orderBy('event_date','desc')->where('active',1)->get();
		return view('schedule')->with('schedules',$schedules);
	}

	public function IndexAdmin()
	{
		return view('admin.schedules.index');
	}

	public function getData()
	{
		return Datatables::of(Schedule::all())->make(true);
	}

	public function Show($id)
	{
		$schedule = Schedule::findOrFail($id);
		return view('admin.schedules.show')->with('schedule',$schedule);
	}

	public function Create()
	{
		return view('admin.schedules.create');
	}

	public function Store(Request $request)
	{
		$schedule = new Schedule;
		$schedule->event = $request->input('event') ?:'';
		$schedule->event_date = $request->input('event_date');
		$schedule->event_time = $request->input('event_time');
		$schedule->location = $request->input('location');
		$price = $request->input('price');
		if($price==null)
			$price = "";
		$schedule->price = $price;
		$schedule->active = false;
		$schedule->save();

		$insertedID = $schedule->id;
		Notification::success("S'ha creat un nou esdeveniment");		
		return redirect()->route('admin.schedule.show', ['id' => $insertedID]);
	}

	public function Edit($id)
	{
		$schedule = Schedule::findOrFail($id);
		return view ('admin.schedules.edit')->with('schedule',$schedule);
	}

	public function Update(Request $request)
	{
		$schedule = Schedule::findOrFail($request->id);		 
		$schedule->event = $request->input('event');
		$schedule->event_date = $request->input('event_date');
		$schedule->event_time = $request->input('event_time');
		$schedule->location = $request->input('location');
		$schedule->price = $request->input('price');
		$schedule->save();
		Notification::success('Event Actualitzat');
		return redirect()->route('admin.schedule.show', ['id' => $schedule->id]);
	}

	public function Activate(Request $request)
	{
		$schedule = Schedule::findOrFail($request->id);
		$schedule->active = $request->activate;
		$schedule->save();
		Notification::success('Event Actualitzat');	
	}

	public function Delete($id)
	{
		$schedule = Schedule::findOrFail($id);
		if($schedule!=null){
			$schedule->delete();
    	} //delete the client
    	Notification::success('Event Eliminat');
    }
}
