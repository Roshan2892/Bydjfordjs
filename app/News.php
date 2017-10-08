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

        /* $record['_tags'] = explode(';', $array['tags']);

         $record['added_month'] = substr($record['created_at'], 0, 7);

         unset($record['tags'], $record['created_at'], $record['updated_at']);*/

        return $array;
    }
}
