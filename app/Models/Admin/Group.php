<?php

namespace App\Models\Admin;

use App\Models\Admin\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = [
        'name', 'description', 'address', 'phone', 'logo', 'banner'
    ];

    public function apps()
    {
        return $this->belongsToMany(App::class, 'app_group', 'group_id', 'app_id');
    }
}
