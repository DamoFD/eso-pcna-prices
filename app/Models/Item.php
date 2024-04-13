<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function prices()
    {
        return $this->hasMany(Price::class)->orderBy('updated_at', 'desc');
    }
}
