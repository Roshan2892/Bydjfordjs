<?php

namespace App\Http\Controllers;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MusicController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('index', 'show');
    }

    /******************************** User Side *****************************/

    /* Display Music Page */
    public function index(){
        $musics = DB::table('albums')->paginate(2);
        return view('user.music.index', compact('musics'));
    }

    /* Display Single Music Page*/
    public function show($id){
        $music = Album::get()->where('id',$id);
        return view('user.music.show',compact('music'));
    }

    /* Download Music File */
    public function download($downloadFile){
        $music = Album::where('id',$downloadFile)->select('file')->first();
        foreach(unserialize($music->file) as $file){
            return \Response::download(storage_path('app/public/').'uploads/files/'.$file);
        }
    }



    /******************************** Admin Side *****************************/

    /* Display Create Music Page */
    public function create(){
        $language_lists= ['English','Hindi'];
        return view('admin.music.upload', compact('language_lists'));
    }

     /* Store Music Into Database */
    public function store(Request $request){

        $destinationFile = $orginalFiles =  [];
        $count = 0;
        $this->validate($request,[
            'title' => 'required|max:100',
            'description' => 'required',
            'poster' => 'required|image|mimes:jpeg,jpg,bmp,png',
            'tags' => 'nullable|max:255',
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
                $orignalFileName = $fileName; 
        
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
            $count++;
        }

        $poster_uploaded = Storage::put($poster_destinationPath, file_get_contents($poster_file->getRealPath()));

        if ($uploaded && $poster_uploaded) {

            $files = serialize($destinationFile);
            $filesNames = serialize($orginalFiles);
            $tags = serialize($request->tags);
            Album::create([
                'title' => $request->title,
                'description' => $request->description,
                'poster' => $poster_fileName,
                'file' => $files,
                'filename' => $filesNames,
                'filecount' => $count,
                'artist' => $request->artist,
                'tags' => $tags,
                'language' => $request->language
            ]);
            flash('Music Added Successfully', 'success');
            return redirect()->back();

        }
    }


    /* Display Edit Page */
    public function edit($id){
        $music = Album::find($id);
        $files = $tags = [];
        foreach (unserialize($music->tags) as $tag) {
            array_push($tags, $tag);
        }
        foreach (unserialize($music->file) as $file) {
            array_push($files, $file);
        }
        return view('admin.music.upload', compact('music','tags','files'));
    }

    /* Display Edit Page */
    public function update(Request $request, $id){
        dd($request->all());
    }

    /* Delete Music File */
    public function destroy($id)
    {
        $data= Album::find($id);
        $files= $data->file;
        $poster= $data->poster;
        foreach (unserialize($data->file) as $file) {
            Storage::delete('uploads/files/'.$file);
        }
        Storage::delete('uploads/images/'.$poster);
        $data->delete();
        flash('Deleted Successfully', 'success');
        return redirect()->back();
    }

    /* Display Music Files */
    public function showAlbums(){
        $music = DB::table('albums')->get();
        return view('admin.music.index', compact('music'));
    }

    /* Delete Single Music File */
    public function deleteMusic($id, $file)
    {
        $fileNameArr = $fileArr = [];

        $music = Album::find($id);

        $fileNameArr = unserialize($music->filename);
        $fileArr = unserialize($music->file);

        
        $fileNameAtIndex = array_search($file, $fileNameArr); // key of filename based on name specified

        $fileIndex = $fileArr[$fileNameAtIndex]; // value of unique file name array

        unset($fileNameArr[$fileNameAtIndex]); // remove value based on key
        unset($fileArr[$fileNameAtIndex]);

        $music->file = serialize($fileArr);
        $music->filename = serialize($fileNameArr);
        $music->save();

        Storage::delete('uploads/files/'.$fileIndex);
        return redirect()->back();
    }
}
