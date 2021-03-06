<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('index', 'show');
    }
    
    /************************* User Page ***********************/

    /* Display Video Page */
    public function index(){
        try{
            $videos = DB::table('videos')->paginate(10);
//            foreach($videos as $video){
//                $video->tags = implode(', ', unserialize($video->tags));
//            }
            return view('user.video.index', compact('videos'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Single Video Page */
    public function show($title){
        try{
            $video = Video::get()->where('seo_title',$title);
//            $tags = [];
//            foreach($video as $v) {
//                $tags = unserialize($v->tags);
//            }
//            $tags = implode(', ', $tags);
            return view('user.video.show',compact('video', 'tags'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /*************************** Admin Page *********************/

    /* Display Create Video Page */
    public function create(){
        try{
            $language_lists= ['English','Hindi'];
            return view('admin.video.upload', compact('language_lists'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Store Video */
    public function store(Request $request){
        try{
            $this->validate($request,[
                'title' => 'required|max:100',
                'description' => 'required',
                'poster' => 'required|image|mimes:jpeg,jpg,bmp,png',
                'tags' => 'nullable|max:255',
                'file' => 'required|max:500',
                'language' => 'required|max:255',
                'artist' => 'required|max:60'
            ]);

            if($request->hasFile('poster')) {
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $unique_name = md5($fileName . time());
                $fileName = $unique_name . '.' . $extension; // renaming image
                $destinationPath = config('app.fileDestinationPath') . '/images/' . $fileName;


                $data = serialize($request->file);
                $tags = serialize($request->tags);

                $video = new Video;
                $video->title = $request->title;
                $video->description = $request->description;
                $video->poster = $fileName;
                $video->file = $data;
                $video->artist = $request->artist;
                $video->tags = $tags;
                $video->language = $request->language;
                $video->save();
                $video->seo_title = "video_page_".$video->id;
                $video->save();

                if($video){
                    Storage::put($destinationPath, file_get_contents($file->getRealPath()));
                }
            }
            flash('Video Added Successfully', 'success');
            return redirect()->back();
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }


    /* Display Video Page */
    public function showVideos()
    {
        try{
            $video = DB::table('videos')->get();
            foreach($video as $v){
                $v->tags = implode(', ', unserialize($v->tags));
            }
            return view('admin.video.index', compact('video'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Edit Video Page */
    public function edit($id)
    {
        try{
            $video = Video::where('id', $id)->first();
            $files = $tags = [];
            foreach (unserialize($video->tags) as $tag) {
                array_push($tags, $tag);
            }
            foreach (unserialize($video->file) as $file) {
                array_push($files, $file);
            }
            return view('admin.video.upload', compact('video','tags','files') );
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Update Video Page */
    public function update(Request $request, $id)
    {
        try{
            $tags = $files = [];

            $this->validate($request, [
                'title' => 'required|max:100',
                'description' => 'required',
                'poster' => 'image|mimes:jpeg,jpg,bmp,png',
                'tags' => 'required|max:255',
                'file' => 'required|max:500',
                'language' => 'required|max:255',
                'artist' => 'required|max:60'
            ]);

            foreach ($request->tags as $tag) {
            array_push($tags, $tag);
            }
            foreach ($request->file as $file) {
            array_push($files, $file);
            }
            $tags = serialize($tags);
            $files = serialize($files);

            $video = Video::find($id);
            
            $video->title = $request->title;
            $video->description = $request->description;
            $video->artist = $request->artist;
            $video->language = $request->language;
            $video->tags = $tags;
            $video->file = $files;

            if($request->hasFile('poster')){ 
                $file = $request->file('poster');
                $extension = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $unique_name = md5($fileName . time());
                $fileName = $unique_name . '.' . $extension; // renaming image
                $destinationPath = config('app.fileDestinationPath') . '/images/' . $fileName;
                Storage::delete('uploads/images/'. $video->poster); //delete the file
                $video->poster = $fileName;
                Storage::put($destinationPath, file_get_contents($file->getRealPath()));
            }

            $video->save();
            flash('Updated Successfully', 'success');
            return redirect()->back();
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Delete Video File */
    public function destroy($id)
    {
        try{
            $data= Video::find($id);
            Storage::delete('uploads/images/'.$data->poster);
            $data->delete();
            flash('Deleted Successfully', 'success');
            return redirect()->back();
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }
}
