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

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['_podcast'] = [
            'title' => $array['title'],
            'artist' => $array['artist'],
            'tags' => $array['tags']
        ];

        unset($array['seo_title'], $array['description'], $array['poster'], $array['file']);
        unset($array['created_at'], $array['updated_at'],$array['seo_title'], $array['title'],  $array['tags'], $array['language'], $array['artist']);

        return $array;
    }
}
