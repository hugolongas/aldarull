<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comanda;
use Cart;
use App\ExtraType;
use Yajra\Datatables\Datatables;
use Notification;
use App\Mail\OrderFinished;
use Illuminate\Support\Facades\Mail;

class ComandaController extends Controller
{
	public function getData()
	{
		return Datatables::of(Comanda::all())->make(true);
	}

	public function Show($id)
	{
		$comanda = Comanda::findOrFail($id);
		$cart = Cart::restoreWithoutSession($id);
		$types = ExtraType::all();
		$total = 0;
		foreach($cart as $c)
		{
			$total+=$c->subtotal;
		}
		
		return view('admin.comandas.show')->with('comanda',$comanda)->with('cart',$cart)->with('types',$types)->with('total',$total);
	}

	public function Finish($id)
	{
		$comanda = Comanda::findOrFail($id);
		return view('admin.comandas.finish')->with('comanda',$comanda);
	}
	public function Close(Request $request)
	{
		$comanda = Comanda::findOrFail($request->id);
		$comanda->process = 'finalitzat';
		$comanda->save();
		$codeSeg = '';
		if($request->has('confirmationCode'))
			$codeSeg = $request->input('confirmationCode');
		Mail::to($comanda->email)->send(new OrderFinished($codeSeg, $comanda->name));
		Notification::success('Email enviat'.' '.$codeSeg);
		return redirect()->route('admin.index');
	}


}
