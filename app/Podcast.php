<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use Searchable;
    protected $fillable= ['seo_title','title','description','poster','file','filename','language','artist','tags'];

    public $json;

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'podcasts_index';
    }
}
