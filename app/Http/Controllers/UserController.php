<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
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
     * Show the application user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Auth::user();
        $data->movies = Movies::where('users_id', Auth::user()->id)->whereNotNull('ended_at')->get();

        return view('my-account', compact('data'));
    }

    public function delete()
    {
        // TO DO

        return view('my-account', compact('data'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}