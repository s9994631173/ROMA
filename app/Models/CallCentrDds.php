<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCentrDds extends Model
{
    use HasFactory;

    public static function all($data){
        return self::select('message')
        ->where('contract', '=', $data['contract'])
        ->get();
    }
}
