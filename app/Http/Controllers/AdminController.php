<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Service;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function category()
    {
        $categories = Category::paginate(8);

        return view('admin.category', [
            "categories" => $categories,
        ]);
    }

    public function review()
    {
        $reviews = Review::paginate(8);

        return view('admin.review', [
            "reviews" => $reviews,
        ]);
    }

    public function service()
    {
        $services = Service::paginate(8);

        return view('admin.service', [
            "services" => $services,
        ]);
    }

    public function transaction()
    {
        $transactions = TransactionHeader::join('users', 'users.id', '=', 'transaction_headers.user_id')
        ->select('transaction_headers.*', 'users.name as name')
        ->paginate(8);

        return view('admin.transaction', [
            "transactions" => $transactions,
        ]);
    }

    public function transactionDetail()
    {
        $transactions = TransactionDetail::join('services', 'services.id', '=', 'transaction_details.service_id')
        ->select('transaction_details.*', 'services.name as name')
        ->paginate(8);

        return view('admin.transaction-detail', [
            "transactions" => $transactions,
        ]);
    }

    public function user()
    {
        $users = User::where('id' , '<>', Auth::user()->id)->paginate(8);

        return view('admin.user', [
            "users" => $users,
        ]);
    }

    public function profile()
    {
        return redirect()->route('profile.show') ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
