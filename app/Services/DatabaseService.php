<?php

namespace App\Services;

use PDO;
use App\Models\Admin\Database;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DatabaseService {

    public static function CreateNewDatabase($group){

        $database_name = 'regcalls_g'.str_pad($group->id, 4, '0', STR_PAD_LEFT);
        $hasDb = DB::select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database_name'");
        if(empty($hasDb)) {
            DB::statement("CREATE DATABASE $database_name CHARACTER SET 'utf8mb4'");
        }
        $database = Database::create([
            'connection' => $database_name,
            'database' => $database_name,
            'username'=>env('DB_USERNAME'),
            'password'=>env('DB_PASSWORD'),
        ]);

        $group->database_id = $database->id;
        $group->save();

        return $database_name;
    }

    public static function CopyTablesFromTemplateDatabase($database_name){
        $tables = DB::connection('template')->select('SHOW TABLES');
        foreach($tables as $table){
            $table_name = $table->Tables_in_regcalls_g0000;;
            $table_name_with_database = $database_name.'.'.$table_name;
            DB::statement('CREATE TABLE IF NOT EXISTS '.$table_name_with_database.' LIKE regcalls_g0000.'.$table_name.'');
        }

        return true;

    }

    public static function CreateDatabaseConnection($database_name){
        $database = Database::where('database',$database_name)->first();
        //dd($database);
        Config::set('database.connections.template', [
            'driver' =>  $database->driver,
            'url' => $database->url,
            'host' => $database->host,
            'port' => $database->port,
            'database' =>  $database->database,
            'username' => $database->username,
            'password' => $database->password,
            'unix_socket' => $database->unix_socket,
            'charset' =>  $database->charset,
            'collation' =>  $database->collation,
            'prefix' => $database->prefix,
            'prefix_indexes' => $database->prefix_indexes,
            'strict' => $database->strict,
            'engine' => $database->engine,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ]);

    }

}
