<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use Searchable;
    protected $fillable= ['seo_title','title','description','poster','file','filename','language','artist','tags', 'filecount'];
    public $json;
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'albums_index';
    }
}
