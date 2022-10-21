<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Database extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['connection', 'driver', 'url', 'host', 'port', 'database', 'username', 'password', 'unix_socket', 'charset', 'collation', 'prefix', 'prefix_indexes', 'strict', 'engine'];

}
