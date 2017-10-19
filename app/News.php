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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['_news'] = [
            'title' => $array['title'],
            'tags' => $array['tags']
        ];

        unset($array['seo_title'], $array['description'], $array['poster'], $array['file']);
        unset($array['created_at'], $array['updated_at'],$array['seo_title'], $array['title'], $array['tags']);

        return $array;
    }
}
