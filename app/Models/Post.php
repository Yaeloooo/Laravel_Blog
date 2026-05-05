<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    protected $table = 'posts';

    public function title() : Attribute{

       return Attribute::make(
            set: fn ($value) => strtolower($value),
            get: fn ($value) => ucwords($value)
        );

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
