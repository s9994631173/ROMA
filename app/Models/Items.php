<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public static function search($data){
        return self::select('itemName', 'category', 'char')
        ->where('itemName', 'LIKE', '%' . $data['item'] . '%')
        ->distinct()
        ->get();
    }
}
