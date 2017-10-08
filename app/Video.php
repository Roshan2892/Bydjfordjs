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

       /* $record['_tags'] = explode(';', $array['tags']);

        $record['added_month'] = substr($record['created_at'], 0, 7);

        unset($record['tags'], $record['created_at'], $record['updated_at']);*/

        return $array;
    }
}
