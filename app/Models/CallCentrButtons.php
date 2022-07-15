<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCentrButtons extends Model
{
    use HasFactory;
    protected $fillable = ['button', 'type', 'info'];

    public static function getAll(){
        return self::select('id', 'button')
        ->get();
    }

    public static function getSelect($data){
        return self::select('type', 'info')
        ->where('id', '=', $data['button'])
        ->get();
    }
}
