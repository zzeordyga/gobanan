<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $random_services = Service::inRandomOrder()->limit(6)->get();

        return view('pages.dashboard',
        [
            'services' => $random_services,
        ]);
    }

    /**
     * Display all resource
     *
     */
    public function explore(){
        $services = Service::inRandomOrder()->paginate(20);
        $categories = Category::all();

        return view('pages.explore', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }

    /**
     * Display all resource
     *
     */
    public function userServices($id){
        $user = User::find($id);
        $services = Service::where('user_id', $id)->paginate(10);

        return view('pages.users-service', [
            'services' => $services,
            'user' => $user,
        ]);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);

        if($service == null){
            return redirect('/error');
        }

        return view('pages.service', [
            'service' => $service,
        ]);
    }

    /**
     * Display services based on the category id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $category = Category::find($id);
        $services = Service::where('category_id', $id)->paginate(20);
        $categories = Category::all();

        return view('pages.explore', [
            'services' => $services,
            'curr_category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Display orders for the current users.
     *
     * @return \Illuminate\Http\Response
     */
    public function orders()
    {
        if(!Auth::user()){
            return redirect('/login');
        }

        $user_id = Auth::user()->id;

        $orders = Service::join('transaction_details', 'transaction_details.service_id', '=', 'services.id')
        ->join('transaction_headers', 'transaction_details.header_id', '=', 'transaction_headers.id')
        ->join('users', 'transaction_headers.user_id', '=', 'users.id')
        ->where('services.user_id', $user_id)
        ->where('status', 'Ongoing')
        ->select('services.*', 'users.id as customer_id', 'users.name as customer_name', 'users.email as customer_email',
            'transaction_details.created_at', 'transaction_details.notes', 'transaction_details.id as td_id')
        ->get();

        $purchases = Service::join('transaction_details', 'transaction_details.service_id', '=', 'services.id')
        ->join('transaction_headers', 'transaction_details.header_id', '=', 'transaction_headers.id')
        ->join('users', 'transaction_headers.user_id', '=', 'users.id')
        ->where('transaction_headers.user_id', $user_id)
        ->where('status', 'Ongoing')
        ->select('services.*', 'users.id as user_id', 'users.name as user_name', 'users.email as user_email',
            'transaction_details.created_at', 'transaction_details.notes')
        ->get();

        return view('pages.order', [
            'orders' => $orders,
            'purchases' => $purchases,
        ]);
    }
    /**
     * Display services based on the category id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $services = Service::join('categories', 'categories.id', '=', 'services.category_id')
            ->join('users', 'users.id', '=', 'services.user_id')
            ->where('services.description', 'like', '%'.$keyword.'%')
            ->orWhere('services.name', 'like', '%'.$keyword.'%')
            ->orWhere('users.name', 'like', '%'.$keyword.'%')
            ->orWhere('categories.name', 'like', '%'.$keyword.'%')
            ->orWhere('categories.description', 'like', '%'.$keyword.'%')
            ->select('services.*')
            ->paginate(20);

        return view('pages.search', [
            'services' => $services,
            'keyword' => $keyword,
        ]);
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
