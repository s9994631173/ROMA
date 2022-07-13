<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    use HasFactory;

    public static function all(){
        return self::select('category')
        ->distinct()
        ->get();
    }

    public static function chars($data){
        return self::select('char')
        ->where('category', '=', $data['category'])
        ->get();
    }

    public static function search($data){
        return self::select('aboutItem', 'pack', 'method')
        ->where('category', '=', $data['category'])
        ->where('char', '=', $data['char'])
        ->get();
    }
}
