<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clicks extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'login', 'module'];

    public static function click($data){
        $item = [
            'date' => date('Y-m-d'),
            'login' => $data['login'],
            'module' => $data['module']
        ];
        
        self::create($item);
        return;
    }
}
