<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use Carbon\Carbon;
use Auth;
use Alert;

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
        $data->movies = Movies::where('users_id', Auth::user()->id)->get();
        
        return view('my-account', compact('data'));
    }

    public function endMovie(Request $request)
    {
        $data = Movies::find($request->id);
            $data->ended_at = Carbon::now();
            $data->save();
        
        return redirect()->back();
    }

    public function delMovie(Request $request)
    {
        $data = Movies::find($request->id);
        if ($data->recommended || $data->notRecommended) {
            Alert::toast('Você não pode deletar um filme com recomendações.', 'error');
        } else {
            $data->ended_at = Carbon::now();
            $data->delete();
        }

        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}