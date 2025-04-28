<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AshAllenDesign\ShortURL\Classes\Builder;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Validation\Rule;

class ShortUrlController extends Controller
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
        $shortUrls = User::find(auth()->user()->id)->shortUrls;

        $params = [
            'shortUrls' => $shortUrls,
        ];

        return view('user\home')->with($params);
    }

    public function viewCreate()
    {
        return view('user\createShortUrl');
        // return redirect(route('shortUrl.view.create'));
    }



    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'destinationUrl' => 'required|url',
            'urlKey' => 'unique:short_urls,url_key'
        ]);
        if($request->urlKey){
            $shortURLObject = app(Builder::class)
            ->destinationUrl($request->destinationUrl)
            ->urlKey($request->urlKey)
            ->make();
        }else{
            $shortURLObject = app(Builder::class)
            ->destinationUrl($request->destinationUrl)
            ->make();
        }

        $shortURL = $shortURLObject->default_short_url;

        $updateShortUrl = ShortUrl::Where('id',$shortURLObject->id)->update([
            'user_id' => auth()->user()->id,
            'title' => $request->title
        ]);

        return redirect(route('home'));
    }

    public function viewUpdate($id){
        $shortUrl = ShortUrl::Where('id',$id)->first();
        // dd($shortUrl);
        $params = [
            'shortUrl' => $shortUrl,
        ];
        return view('user\updateShortUrl')->with($params);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required',
            'urlKey' => Rule::unique('short_urls', 'url_key')->ignore($id),
        ]);
        $shortUrl = ShortUrl::findOrFail($id);
        $newDefaultShortUrl = str_replace($shortUrl->url_key, '', $shortUrl->default_short_url).$request->urlKey;
        $shortUrl->title = $request->title;
        $shortUrl->url_key = $request->urlKey;
        $shortUrl->default_short_url = $newDefaultShortUrl;
        $shortUrl->save();

        return redirect(route('home'));
    }

    public function delete($id){
        $shortUrl = ShortUrl::findOrFail($id);
        if($shortUrl->user_id == auth()->user()->id){
            ShortUrl::Where('id', $id)->delete();
        }else{
            abort(404, "not allow");
        }

        return redirect()->back();
    }
}
