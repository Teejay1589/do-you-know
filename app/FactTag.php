<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FactTag extends Model
{
    protected $table = 'fact_tags';
     public $timestamps = false;

    protected $fillable = [
        'fact_id', 'tag_id',
    ];
}
