<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $fillable= ['title','description','poster','file','filename','language','artist','tags'];

    public $json;
}
