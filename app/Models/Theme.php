<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'bg_color','text_color', 'menu_color', 'menu_hover_color', 'menu_active_color','user_id'
    ];
}
