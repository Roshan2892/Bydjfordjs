<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UploadRequest;

class MusicController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin')->except('index', 'show','download','showAlbum','showSingles');
    }

    /******************************** User Side *****************************/

    /* Display Singles Page */
    public function showSingles(){
        try{
            $musics = DB::table('albums')->where('filecount','=',1)->paginate(10);
            return view('user.music.singles', compact('musics'));
        }
        catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
        
    }

    /* Display Albums Page */
    public function showAlbum(){
        try{
            $musics = DB::table('albums')->where('filecount','>',1)->paginate(10);
            return view('user.music.albums', compact('musics'));
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Single Music Page*/
    public function show($title){
        try{
            $music = Album::get()->where('seo_title',$title);
            foreach($music as $m) {
                $files = unserialize($m->file);
                $fileNames = unserialize($m->filename);
            }
            return view('user.music.show',compact('music','files','fileNames'));
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Download Music File */
    public function download($downloadFile){
        try{
            return \Response::download(storage_path('app/public/').'uploads/files/' . $downloadFile);
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }




    /******************************** Admin Side *****************************/

    /* Display Create Music Page */
    public function create(){
        try{
            $language_lists= ['English','Hindi'];
            return view('admin.music.upload', compact('language_lists'));
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

     /* Store Music Into Database */
    public function store(UploadRequest $request){
        try{
            $destinationFile = $orginalFiles =  [];
            $count = 0;

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
                $orignalFileName = pathinfo($fileName, PATHINFO_FILENAME); // get original file name.
                
                $unique_name = md5($fileName . time()); // renaming file name
                $fileChangedName = $unique_name . '.' . $extension;

                $destinationPath = config('app.fileDestinationPath') . '/files/' .  $fileChangedName;
                $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));

                array_push($destinationFile,$fileChangedName); // created array for storing unique file names 
                array_push($orginalFiles, $orignalFileName); // created array for stroing original file names
                $count++;
            }

            $poster_uploaded = Storage::put($poster_destinationPath, file_get_contents($poster_file->getRealPath()));

            if ($uploaded && $poster_uploaded) {

                $files = serialize($destinationFile);
                $filesNames = serialize($orginalFiles);
                $tags = serialize($request->tags);

                $album = new Album;
                $album->title = $request->title;
                $album->description = $request->description;
                $album->poster = $poster_fileName;
                $album->file = $files;
                $album->filename = $filesNames;
                $album->filecount = $count;
                $album->artist = $request->artist;
                $album->tags = $tags;
                $album->language = $request->language;
                $album->save();

                if($count > 1)
                    $album->seo_title = "album_page_".$album->id;
                else
                    $album->seo_title = "singles_page_".$album->id;
                $album->save();
                
                flash('Music Added Successfully', 'success');
                return redirect()->back();
            }
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }


    /* Display Edit Page */
    public function edit($id){
        try{
            $music = Album::find($id);
            $files = $tags = [];
            foreach (unserialize($music->tags) as $tag) {
                array_push($tags, $tag);
            }
            foreach (unserialize($music->file) as $file) {
                array_push($files, $file);
            }
            return view('admin.music.upload', compact('music','tags','files'));
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Edit Page */
    public function update(UploadRequest $request, $id){
        try{
            $tags =  [];
            $count = 0;
            $album = Album::find($id);
            $album->title = $request->title;
            $album->description = $request->description;
            $album->artist = $request->artist;
            $album->language = $request->language;

            if($request->tags) {
                foreach ($request->tags as $tag) {
                    array_push($tags, $tag);
                }
                $tags = serialize($tags);
                $album->tags = $tags;
            }

            if($request->file('poster')) {
                $posterData = $album->poster;
                $poster_file = $request->file('poster');
                $poster_extension = $poster_file->getClientOriginalExtension();
                $poster_fileName = $poster_file->getClientOriginalName();
                $poster_unique_name = md5($poster_fileName . time());
                $poster_fileName = $poster_unique_name . '.' . $poster_extension; // renaming image file
                $poster_destinationPath = config('app.fileDestinationPath') . '/images/' . $poster_fileName;
                Storage::put($poster_destinationPath, file_get_contents($poster_file->getRealPath()));
                Storage::delete('uploads/images/'.$posterData);
                $album->poster = $poster_fileName;
            }

            if($request->file('file')){
                $musicFiles = $album->file;
                $musicFiles = unserialize($musicFiles);

                $musicFilesName = $album->filename;
                $musicFilesName = unserialize($musicFilesName);
                $filecount = $album->filecount;

                $files = $request->file('file');
                foreach($files as $file){

                    $extension = $file->getClientOriginalExtension();
                    $fileName= $file->getClientOriginalName();

                    $orignalFileName = pathinfo($fileName, PATHINFO_FILENAME); // get original file name.

                    $unique_name = md5($fileName . time()); // renaming file name
                    $fileChangedName = $unique_name . '.' . $extension;
                    $destinationPath = config('app.fileDestinationPath') . '/files/' .  $fileChangedName;
                    $uploaded = Storage::put($destinationPath, file_get_contents($file->getRealPath()));
                    array_push($musicFiles,$fileChangedName); // created array for storing unique file names
                    array_push($musicFilesName, $orignalFileName); // created array for stroing original file names
                    $count++;
                }
                $musicFiles = serialize($musicFiles);
                $musicFilesName = serialize($musicFilesName);
                $filecount += $count;
                $album->filecount = $filecount;
                $album->file = $musicFiles;
                $album->filename = $musicFilesName;
            }
            $album->save();
            flash('Album Updated Successfully', 'success');
            return redirect()->back();
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Delete Music File */
    public function destroy($id)
    {
        try{
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
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Display Music Files */
    public function showAlbums(){
        try{
            $music = DB::table('albums')->get();
            return view('admin.music.index', compact('music'));
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }

    /* Delete Single Music File */
    public function deleteMusic($id, $file)
    {
        try{
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
            $music->filecount = $music->filecount - 1;
            $music->save();

            Storage::delete('uploads/files/'.$fileIndex);
            return redirect()->back();
        }catch(\Exception $exception){
            return view('errors.error', compact('exception'));
        }
    }
}
