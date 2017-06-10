<?php

namespace App\Http\Requests;
use Composer\DependencyResolver\Request;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':  {
                $rules = [
                    'title' => 'required|max:100',
                    'description' => 'required',
                    'poster' => 'required|image|mimes:jpeg,jpg,bmp,png',
                    'tags' => 'nullable|max:255',
                    'language' => 'required|max:255',
                    'artist' => 'required|max:60'
                ];
                $files = count($this->input('file'));
                foreach(range(0, $files) as $index) {
                    $rules[ 'file' ] = 'required|max:8000';
                }

                return $rules;
            }
            case 'PUT':
            case 'PATCH' : {
                $rules = [
                    'title' => 'required|max:100',
                    'description' => 'required',
                    'tags' => 'nullable|max:255',
                    'language' => 'required|max:255',
                    'artist' => 'required|max:60',
                    'poster' => 'nullable|image|mimes:jpeg,jpg,bmp,png',
                ];

                $files = count($this->input('file'));
                foreach(range(0, $files) as $index) {
                    $rules[ 'file' ] = 'nullable|max:8000';
                }

                return $rules;
            }

            default: break;
        }






    }
}
