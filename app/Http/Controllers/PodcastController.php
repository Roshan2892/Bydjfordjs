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
        $podcasts = DB::table('podcasts')->paginate(10);
        return view('user.podcast.index', compact('podcasts'));
    }

    /* Display Single Podcast Page */
    public function show($title){
        $podcast = Podcast::get()->where('seo_title',$title);
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

            $podcast = new Podcast;
            $podcast->title = $request->title;
            $podcast->description = $request->description;
            $podcast->poster = $poster_fileName;
            $podcast->file = $files;
            $podcast->filename = $filesNames;
            $podcast->artist = $request->artist;
            $podcast->tags = $tags;
            $podcast->language = $request->language;
            $podcast->save();
            $podcast->seo_title = "podcast_page_".$podcast->id;
            $podcast->save();
            
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
        $tags = [];
        $podcast = Podcast::find($id);
        $podcast->title = $request->title;
        $podcast->description = $request->description;
        $podcast->artist = $request->artist;
        $podcast->language = $request->language;

        if($request->tags) {
            foreach ($request->tags as $tag) {
                array_push($tags, $tag);
            }
            $tags = serialize($tags);
            $podcast->tags = $tags;
        }

        if($request->file('poster')) {
            $posterData = $podcast->poster;
            $poster_file = $request->file('poster');
            $poster_extension = $poster_file->getClientOriginalExtension();
            $poster_fileName = $poster_file->getClientOriginalName();
            $poster_unique_name = md5($poster_fileName . time());
            $poster_fileName = $poster_unique_name . '.' . $poster_extension; // renaming image file
            $poster_destinationPath = config('app.fileDestinationPath') . '/images/' . $poster_fileName;
            Storage::put($poster_destinationPath, file_get_contents($poster_file->getRealPath()));
            Storage::delete('uploads/images/'.$posterData);
            $podcast->poster = $poster_fileName;
        }

        if($request->file('file')){
            $podcastFiles = $podcast->file;
            $podcastFiles = unserialize($podcastFiles);

            $podcastFilesName = $podcast->filename;
            $podcastFilesName = unserialize($podcastFilesName);

            $files = $request->file('file');
            foreach($files as $file){

                $extension = $file->getClientOriginalExtension();
                $fileName= $file->getClientOriginalName();

                $orignalFileName = $fileName;

                $unique_name = md5($fileName . time()); // renaming file name
                $fileChangedName = $unique_name . '.' . $extension;
                $destinationPath = config('app.fileDestinationPath') . '/files/' .  $fileChangedName;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
                array_push($podcastFiles,$fileChangedName); // created array for storing unique file names
                array_push($podcastFilesName, $orignalFileName); // created array for stroing original file names
            }
            $podcastFiles = serialize($podcastFiles);
            $podcastFilesName = serialize($podcastFilesName);
            $podcast->file = $podcastFiles;
            $podcast->filename = $podcastFilesName;
        }
        $podcast->save();
        flash('Podcast Updated Successfully', 'success');
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
