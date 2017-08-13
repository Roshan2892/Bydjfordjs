<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Searchable;
    protected $fillable = ['seo_title','title','description','poster','file','tags'];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'news_index';
    }
}
