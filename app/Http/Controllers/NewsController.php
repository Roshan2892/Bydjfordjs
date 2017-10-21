<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('index', 'show');
    }

    /******************************** User Side *****************************/
    
    /* Display News Page */
    public function index(){
        try{
            $news = DB::table('news')->paginate(2);
            return view('user.news.index', compact('news'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Single News Page */
    public function show($title){
        try{
            $news = News::get()->where('seo_title',$title);
            return view('user.news.show',compact('news'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }
    


    /******************************** Admin Side *****************************/


    /* Display Create News Page */
    public function create(){
        try{
            return view('admin.news.upload');
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Store News Page */
    public function store(Request $request){
        try{
            $this->validate($request,[
                'title' => 'required|max:100',
                'description' => 'required',
                'poster' => 'required|image|mimes:jpeg,jpg,bmp,png',
                'file' => 'required|max:500',
                'tags' => 'nullable|max:255'
            ]);

            if($request->hasFile('poster')){
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $unique_name = md5($fileName . time());
                $fileName = $unique_name . '.' . $extension; // renaming image
                $destinationPath = config('app.fileDestinationPath') . '/images/' . $fileName;

                $data = serialize($request->file);
                $tags = serialize($request->tags);

                $news = new News;
                $news->title = $request->title;
                $news->description = $request->description;
                $news->poster = $fileName;
                $news->file = $data;
                $news->tags = $tags;
                $news->save();
                $news->seo_title = "news_page_".$news->id;
                $news->save();
                
                if($news){
                    Storage::put($destinationPath, file_get_contents($file->getRealPath()));
                }
                flash('News Added Successfully', 'success');
                return redirect()->back();
            }
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Edit News Page */
    public function edit($id)
    {
        try{
            $news = News::where('id', $id)->first();
            $files = $tags = [];
            foreach (unserialize($news->tags) as $tag) {
                array_push($tags, $tag);
            }
            foreach (unserialize($news->file) as $file) {
                array_push($files, $file);
            }
            return view('admin.news.upload', compact('news','tags','files') );
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display News Page */
    public function  showNews()
    {
        try{
            $news = DB::table('news')->get();
            return view('admin.news.index', compact('news'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Update News Page */
    public function update(Request $request ,$id){
        try{
            $tags = $files = [];
            foreach ($request->tags as $tag) {
            array_push($tags, $tag);
            }
            foreach ($request->file as $file) {
            array_push($files, $file);
            }
            $tags = serialize($request->tags);
            $files = serialize($request->file);
            $this->validate($request,[
                'title' => 'required|max:100',
                'description' => 'required',
                'poster' => 'image|mimes:jpeg,jpg,bmp,png',
                'file' => 'required|max:500',
                'tags' => 'required|max:255'
            ]);

            $news = News::find($id);

            $news->title = $request->title;
            $news->description = $request->description;
            $news->tags = $tags;
            $news->file = $files;

            if(!$request->poster){
                $news->poster = $news->poster;
            }
            else if($request->hasFile('poster')){
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $unique_name = md5($fileName . time());
                $fileName = $unique_name . '.' . $extension; // renaming image
                $destinationPath = config('app.fileDestinationPath') . '/images/' . $fileName;
                Storage::delete('uploads/images/'. $news->poster); //delete the file
                $news->poster = $fileName;
                Storage::put($destinationPath, file_get_contents($file->getRealPath()));
            }

            $news->save();
            flash('News Updated Successfully', 'success');
            return redirect()->back();
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Delete News Page */
    public function destroy($id){
        try{
            $data= News::findOrFail($id);
            $poster = $data->poster;
            Storage::delete('uploads/images/'. $poster);
            $data->delete();
            flash('Deleted Successfully', 'success');
            return redirect()->back();
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }
}
