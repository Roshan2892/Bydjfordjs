<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable= ['title','description','poster','file','language','artist','tags'];

    public $json;
}
