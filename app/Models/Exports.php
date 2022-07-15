<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exports extends Model
{
    use HasFactory;
    protected $fillable = ['itemName', 'about'];

    public static function presearch($data){
        return self::select('itemName')
        ->where('itemName', 'LIKE', '%' . $data['item'] . '%')
        ->distinct()
        ->get();
    }

    public static function search($data){
        return self::select('about')
        ->where('itemName', '=', $data['item'])
        ->distinct()
        ->get();
    }
}
