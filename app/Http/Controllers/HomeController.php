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
    private $results_arr;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->results_arr = [];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $singles = Album::where('filecount', '=', '1')->orderBy('id','desc')->take(10)->get();
            $albums = Album::where('filecount', '>', '1')->orderBy('id','desc')->take(10)->get();
            $videos = Video::orderBy('id','desc')->take(10)->get();
            $podcast = Podcast::orderBy('id','desc')->take(10)->get();
            $news = News::orderBy('id','desc')->take(10)->get();

            return view('user.home', compact('singles','albums','videos','podcast','news'));

        } catch (Exception $exception) {
            return view('errors.error', compact('exception'));
        }
        
    }

    public function search_page(){
        return view('user.search');
    }

    public function search(Request $request){
        try {
            $results_arr = [];

            $search_key = $request->search_key;
            $albums = Album::search($search_key)->orderBy('id','desc')->get();
            $videos = Video::search($search_key)->orderBy('id','desc')->get();
            $news = News::search($search_key)->orderBy('id','desc')->get();

            $podcasts = Podcast::search($search_key)->orderBy('id','desc')->get();
            array_push($results_arr, [$albums, $videos, $news, $podcasts]);
            return view('user.search', compact("results_arr"));

        } catch (Exception $exception) {
            return view('errors.error', compact('exception'));
        }
        
    }
}