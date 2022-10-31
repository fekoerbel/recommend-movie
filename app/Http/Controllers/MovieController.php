<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use Carbon\Carbon;
use Auth;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
        public function __construct()
        {
            $this->middleware('auth');
        }

    /**
     * Show the application movies.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        
        $data = new Movies;
        $data->name = $request->name;
        $data->year = $request->year;
        $data->genre = $request->genre;
        $data->image = $request->image;
        $data->users_id = Auth::user()->id;
        $data->save();

        return redirect()->back();
    }

    public function recommend(Request $request)
    {
        
        $data = Movies::find($request->id);
        $data->recommended += 1;
        $data->save();

        return redirect()->back();
    }

    public function notRecommend(Request $request)
    {
        $data = Movies::find($request->id);
        $data->notRecommended += 1;
        $data->save();
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}