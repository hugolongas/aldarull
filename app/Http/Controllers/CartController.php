<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Cart;
use Validator;
use App\ExtraType;
use App\Comanda;
use Notification;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ExtraType::all();
        return view('shop.cart')->with('types',$types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $extraTypes = ExtraType::all();
        $options = array();
        foreach($extraTypes as $eType)
        {
            $type = $eType->name;            
            if($request->has($type))
            {
                $options[$type] = $request->input($type);
            }
        }
        Cart::add($request->id, $request->name, $request->qty, $request->price,$options)->associate('App\Product');
        return redirect()->route('cart');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // Validation on max quantity
        $value = $request->value;
        $item = Cart::get($id);
        $qty = $item->qty;
        $qty = $qty+$value;
        if($qty>0){            
            Cart::update($id,$qty);
            return 'true';
        }
        else
        {
            Cart::remove($id);
            return 'true';

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Cart::remove($id);
     return redirect()->route('cart');
 }

       /**
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
       public function emptyCart()
       {
        Cart::destroy();
        return redirect()->route('cart');
    }

    public function purchase(Request $request)
    {
        $tipus = $request->input('input_payment');      
        
        if($tipus =='concert')
        {
            $validatedData = $this->validate($request,[
                'input_name' => 'required',
                'input_email' => 'required|email'
            ],[
                'input_name.required' => "Es necesita indicar un nom",
                'input_email.required' => "Es obligatori indicar un email"
            ]);
        }
        else
        {
            $validatedData = $this->validate($request,[
                'input_name' => 'required',
                'input_email' => 'required|email',
                'input_address' => 'required',
                'input_postcode' => 'required',
                'input_city' => 'required'
            ],[
                'input_name.required' => "Es necesita indicar un nom",
                'input_email.required' => "Es obligatori indicar un email",
                'input_address.required' => "Es obligatori indicar un email",
                'input_postcode.required' => "Es obligatori indicar un codi postal",
                'input_city.required' => "Es obligatori indicar una ciutat"
            ]);   
        }
        
        $name = $request->input('input_name');
        $email = $request->input('input_email');
        $address = $request->input('input_address');
        $address_2 = $request->input('input_address_2','');
        $postcode = $request->input('input_postcode','');        
        $city = $request->input('input_city','');

        if($address=="")
            $address = "";
        if($address_2=="")
            $address_2 = "";
        if($postcode=="")
            $postcode = "";
        if($city=="")
            $city = "";
        $comanda = new Comanda;
        $comanda->name = $name;
        $comanda->email = $email;
        $comanda->address = $address;
        $comanda->address_2 = $address_2;
        $comanda->postcode = $postcode;
        $comanda->city = $city;
        $comanda->process = 'en proces';
        $comanda->tipus = $tipus;
        $comanda->save();
        $comandaID = $comanda->id;
        
        Mail::to($email)->send(new OrderShipped($comanda));
        Cart::store($comandaID);
        Cart::destroy();
        return view('shop.cart_finish')->with('name',$name);
    }
}
