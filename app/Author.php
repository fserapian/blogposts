<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    public function profile(): HasOne
    {
        return $this->hasOne('App\Profile');
    }
}
