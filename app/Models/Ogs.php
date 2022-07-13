<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ogs extends Model
{
    use HasFactory;

    public static function search($data){
        return self::select('itemName')
        ->where('itemName', 'LIKE', '%' . $data['item'] . '%')
        ->distinct()
        ->get();
    }

    public static function get($data){
        return self::select('classHazard', 'avia', 'additional_fee', 'auto', 'note')
        ->where('itemName', '=', $data['item'])
        ->distinct()
        ->get();
    }
}
