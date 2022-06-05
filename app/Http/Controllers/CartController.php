<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)
        ->whereNull('deleted_at')
        ->get();

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->service()->price;
        }

        return view('pages.cart', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    /**
     * Create a new transaction
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!Auth::user()){
            return redirect('/error');
        }

        $user_id = Auth::user()->id;
        $payment_type = $request->payment_type;

        $cartQuery = Cart::where('user_id', $user_id)
        ->whereNull('deleted_at');

        $carts = $cartQuery->get();

        $transaction_header = new TransactionHeader();
        $transaction_header->user_id = $user_id;
        $transaction_header->payment_type = $payment_type;

        $transaction_header->save();

        foreach ($carts as $cart) {
            $transaction_detail = new TransactionDetail();
            $transaction_detail->header_id = $transaction_header->id;
            $transaction_detail->service_id = $cart->service()->id;
            $transaction_detail->status = "Ongoing";
            if(isset($cart->notes)) $transaction_detail->notes = $cart->notes;

            $transaction_detail->save();
        }

        $cartQuery->delete();

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->service_id = $request->service_id;
        if(isset($request->notes)) $cart->notes = $request->notes;

        $cart->save();

        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!Auth::user()){
            return redirect('/error');
        }

        $id = $request->id;
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }
}
