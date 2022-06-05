<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

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
