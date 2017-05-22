<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable= ['title','description','poster','file','filename','language','artist','tags', 'filecount'];
    public $json;
}
