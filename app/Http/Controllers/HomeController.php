<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Album;
use App\News;
use App\Podcast;
use App\Video;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $singles = Album::where('filecount', '=', '1')->orderBy('id','desc')->take(10)->get();
        $albums = Album::where('filecount', '>', '1')->orderBy('id','desc')->take(10)->get();
        $videos = Video::orderBy('id','desc')->take(10)->get();
        $podcast = Podcast::orderBy('id','desc')->take(10)->get();
        $news = News::orderBy('id','desc')->take(10)->get();

        return view('user.home', compact('singles','albums','videos','podcast','news'));
    }

    public function search_page(){
        return view('user.search');
    }

    public function search(Request $request){
        $search_key = $request->search_key;

        $albums = Album::search($search_key)->get();
        $videos = Video::search($search_key)->get();
        $news = News::search($search_key)->get();
        $podcasts = Podcast::search($search_key)->get();

        return view('user.search', compact("albums", "videos", "news", "podcasts"));
    }


}