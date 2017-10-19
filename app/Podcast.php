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

        unset($array['seo_title'], $array['description'], $array['poster'], $array['file'], $array['filename']);
        unset($array['created_at'], $array['updated_at'],$array['seo_title'], $array['title'],  $array['tags'], $array['language'], $array['artist']);

        return $array;
    }
}
