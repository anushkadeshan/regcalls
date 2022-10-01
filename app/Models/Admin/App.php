<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'app_key', 'title_en', 'title_pt', 'description_en', 'description_pt', 'redirect_link', 'image', 'active'
    ];
}
