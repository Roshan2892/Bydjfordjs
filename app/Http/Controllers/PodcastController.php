<?php

namespace App\Http\Controllers;

use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PodcastController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('index', 'show');
    }

    /******************************** User Page ************************/

    /* Display Podcast Page */ 
    public function index(){
        $podcasts = DB::table('podcasts')->paginate(2);
        return view('user.podcast.index', compact('podcasts'));
    }

    /* Display Single Podcast Page */
    public function show($id){
        $podcast = Podcast::get()->where('id',$id);
        return view('user.podcast.show',compact('podcast'));
    }


    /* Download Podcast File */
    public function download($downloadFile){
        $music = Podcast::where('id',$downloadFile)->select('file')->first();
        foreach(unserialize($music->file) as $file){
            return \Response::download(storage_path('app/public/').'uploads/files/'.$file);
        }
    }


    /************************** Admin Page *******************/

    /* Display Create Podcast Page */
    public function create(){
        $language_lists= ['English','Hindi'];
        return view('admin.podcast.upload', compact('language_lists'));
    }

    /* Store Podcast */
    public function store(Request $request){

        $destinationFile = $orginalFiles =  [];
        $this->validate($request,[
            'title' => 'required|max:100',
            'description' => 'required',
            'poster' => 'required|image|mimes:jpeg,jpg,bmp,png',
            'tags' => 'required|max:255',
            'language' => 'required|max:255',
            'artist' => 'required|max:60'
        ]); 

        $poster_file = $request->file('poster');
        $poster_extension = $poster_file->getClientOriginalExtension();
        $poster_fileName = $poster_file->getClientOriginalName();
        
        $poster_unique_name = md5($poster_fileName . time());
        $poster_fileName = $poster_unique_name . '.' . $poster_extension; // renaming image file
        $poster_destinationPath = config('app.fileDestinationPath') . '/images/' . $poster_fileName;
        
        $files = $request->file('file');
        foreach($files as $file){
            $extension = $file->getClientOriginalExtension();
            $fileName= $file->getClientOriginalName();
            $maxFileSize = config('app.maxFileSize');
            $validator = Validator::make(
                array(
                    'file'              =>      $file,
                    'extension'         =>      $extension,
                ),
                [
                    'file'              =>      'required|max:'.$maxFileSize,
                    'extension'         =>      'required|in:mp3,mp4',
                ],[
                    'file.required' => 'File is Required',
                    'extension.mimes' => 'File Should be of type mp3,mp4'
                ]
            );
            if($validator->fails()){
                $errors = $validator->errors();
                return redirect()->back()->withInput()->withErrors($errors);
            }else {
                /*
                    original File that will be used for display purpose
                */
                $orignalFileName = $fileName . '.'. $extension; 
        
                /* 
                    Unique name generated to be stored on disk 
                */
                $unique_name = md5($fileName . time()); // renaming file name
                $fileChangedName = $unique_name . '.' . $extension; 


                /* 
                    Store on disk 
                */
                $destinationPath = config('app.fileDestinationPath') . '/files/' .  $fileChangedName;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
            }

            array_push($destinationFile,$fileChangedName); // created array for storing unique file names 
            array_push($orginalFiles, $orignalFileName); // created array for stroing original file names
        }

        $poster_uploaded = Storage::put($poster_destinationPath, file_get_contents($poster_file->getRealPath()));

        if ($uploaded && $poster_uploaded) {

            $files = serialize($destinationFile);
            $filesNames = serialize($orginalFiles);
            $tags = serialize($request->tags);
            Podcast::create([
                'title' => $request->title,
                'description' => $request->description,
                'poster' => $poster_fileName,
                'file' => $files,
                'filename' => $filesNames,
                'artist' => $request->artist,
                'tags' => $tags,
                'language' => $request->language
            ]);
            flash('Podcast Added Successfully', 'success');
            return redirect()->back();

        }
    }

    
    /* Display Edit Podcast Page */
    public function edit($id)
    {
        $podcast = Podcast::where('id',$id)->first();
       
        $files = $tags = [];
        foreach (unserialize($podcast->tags) as $tag) {
            array_push($tags, $tag);
        }
        foreach (unserialize($podcast->file) as $file) {
            array_push($files, $file);
        }
        return view('admin.podcast.upload', compact('podcast','tags','files') );
    }

    /* Update Podcast */
    public function update(Request $request, $id)
    {
        dd($request->all());
        $destinationFile = $orginalFiles =  [];
        $podcast = Podcast::find($id);

        $this->validate($request, [
            'title' => 'required|max:100',
            'description' => 'required',
            'poster' => 'image|mimes:jpeg,jpg,bmp,png',
            'tags' => 'required|max:255',
            'file' => 'image|mimes:jpeg,jpg,bmp,png',
            'language' => 'required|max:255',
            'artist' => 'required|max:60'
        ]);

        foreach ($request->tags as $tag) {
           array_push($tags, $tag);
        }
        foreach ($request->file as $file) {
           array_push($files, $file);
        }
        $tags = serialize($request->tags);
        $files = serialize($request->file);

        $podcast->title = $request->title;
        $podcast->description = $request->description;
        $podcast->artist = $request->artist;
        $podcast->language = $request->language;
        $podcast->tags = $tags;
        $podcast->file = $files;
        

        if($request->hasFile('poster')){
            $file = $request->file('poster');
            $extension = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $unique_name = md5($fileName . time());
            $fileName = $unique_name . '.' . $extension; // renaming image
            $destinationPath = config('app.fileDestinationPath') . '/images/' . $fileName;
            Storage::delete('uploads/images/'. $podcast->poster); //delete the file
            $podcast->poster = $fileName;
            Storage::put($destinationPath, file_get_contents($file->getRealPath()));
        }

        if($request->hasFile('file')){

            $files = $request->file('file'); 
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $fileName= $file->getClientOriginalName();
                $maxFileSize = config('app.maxFileSize');
                    $orignalFileName = $fileName . '.'. $extension; 
                    $unique_name = md5($fileName . time()); // renaming file name
                    $fileChangedName = $unique_name . '.' . $extension; 
                    $destinationPath = config('app.fileDestinationPath'). '/files/' .$fileChangedName;
                    Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                array_push($destinationFile,$fileChangedName); // created array for storing unique file names 
                array_push($orginalFiles, $orignalFileName); // created array for stroing original file names
            }
        }

        $podcast->save(); 
        return redirect()->back();
    }

    /* Display Podcast Page */
    public function showPodcasts()
    {
        $podcast = DB::table('podcasts')->get();
        return view('admin.podcast.index', compact('podcast'));
    }

    /* Delete Podcast File */
    public function destroy($id)
    {
        $data= Podcast::find($id);
        $poster= $data->poster;
        foreach (unserialize($data->file) as $file) {
            Storage::delete('uploads/files/'.$file);
        }
        Storage::delete('uploads/images/'.$poster);
        $data->delete();
        flash('Deleted Successfully', 'success');
        return redirect()->back();
    }

     /* Delete Single Podcast File */
    public function deletePodcast($id, $file)
    {
        $fileNameArr = $fileArr = [];

        $podcast = Podcast::find($id);

        $fileNameArr = unserialize($podcast->filename);
        $fileArr = unserialize($podcast->file);

        
        $fileNameAtIndex = array_search($file, $fileNameArr); // key of filename based on name specified

        $fileIndex = $fileArr[$fileNameAtIndex]; // value of unique file name array

        unset($fileNameArr[$fileNameAtIndex]); // remove value based on key
        unset($fileArr[$fileNameAtIndex]);

        $podcast->file = serialize($fileArr);
        $podcast->filename = serialize($fileNameArr);
        $podcast->save();

        Storage::delete('uploads/files/'.$fileIndex);
        return redirect()->back();
    }
}
