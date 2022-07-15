<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallCentrDds extends Model
{
    use HasFactory;
    protected $fillable = ['contragent', 'contract', 'message'];


    public static function getAll($data){
        return self::select('message')
        ->where('contract', '=', $data['contract'])
        ->get();
    }
}
