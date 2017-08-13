<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use Searchable;
    protected $fillable= ['title','description','poster','file','language','artist','tags'];
    public $json;
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'videos_index';
    }
}
