<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logins extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'employeeUuid', 'login', 'officeUuid'];

    public static function login($data){
        $user = self::where('employeeUuid', '=', $data['employeeUuid'])
            ->value('id');
        if(!$user){
            $item = [
                'date' => date('Y-m-d'),
                'employeeUuid' => $data['employeeUuid'],
                'login' => $data['login'],
                'officeUuid' => $data['officeUuid']
            ];

            self::create($item);
            return;
        }

    }
}
