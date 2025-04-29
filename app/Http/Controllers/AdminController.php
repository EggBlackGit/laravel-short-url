<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use AshAllenDesign\ShortURL\Classes\Builder;
use App\Models\User;

class AdminController extends Controller
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
    public function index(Request $request)
    {
        $shortUrls = ShortUrl::query()->with('user');
        if($request->search){
            $shortUrls = $shortUrls->where(function($query) use($request){
                $query->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('destination_url', 'like', '%' . $request->search . '%')
                    ->orWhere('url_key', 'like', '%' . $request->search . '%')
                    ->orWhere('default_short_url', 'like', '%' . $request->search . '%');
            });
        }
        if($request->searchUserId){
            $shortUrls = $shortUrls->where('user_id', $request->searchUserId);
        }
        $shortUrls = $shortUrls->paginate(10);
        // dd($request, $shortUrls);
        $users = User::select('id', 'name')->get();
        $params = [
            'shortUrls' => $shortUrls,
            'search' => $request->search,
            'users' => $users,
            'searchUserId' => $request->searchUserId
        ];
        return view('admin.adminHome', $params);
    }

    public function viewUpdate($id){
        $shortUrl = ShortUrl::Where('id',$id)->first();
        // dd($shortUrl);
        $params = [
            'shortUrl' => $shortUrl,
        ];
        return view('admin.adminUpdate')->with($params);
    }

    public function update(Request $request, $id){
        $shortUrl = ShortUrl::find($id);
        $newDefaultShortUrl = str_replace($shortUrl->url_key, '', $shortUrl->default_short_url).$request->urlKey;
        $shortUrl->title = $request->title;
        $shortUrl->url_key = $request->urlKey;
        $shortUrl->default_short_url = $newDefaultShortUrl;
        $shortUrl->save();

        return redirect(route('admin.home'));
    }

    public function delete($id){
        $shortUrl = ShortUrl::findOrFail($id);
        $shortUrl->delete();
        return redirect()->back();
    }
}
