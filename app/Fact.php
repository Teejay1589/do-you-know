<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
		protected $table = "facts";
    protected $fillable = [
        'fact', 'fact_image', 'tags', 'is_approved', 'created_by',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public static function booleanLabel($value) {
        if($value)
            return "<label class='label label-success'>YES</label>";
        else
            return "<label class='label label-danger'>NO</label>";
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
