<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    use HasFactory;

    public static function all(){
        return self::select('id', 'button')
        ->get();
    }

    public static function select($data){
        return self::select('type', 'info')
        ->where('id', '=', $data['button'])
        ->get();
    }
}
