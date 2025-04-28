<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\ShortURL\Classes\Builder;
use App\Models\ShortUrl;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $shortUrls = ShortUrl::select('title','default_short_url', 'destination_url', 'created_at')->get();
        $shortUrls = User::find(auth()->user()->id)->shortUrls;

        $params = [
            'shortUrls' => $shortUrls,
        ];

        return view('user\home')->with($params);
    }
}
