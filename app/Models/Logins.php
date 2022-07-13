<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logins extends Model
{
    use HasFactory;

    public static function login($data){
        $user = self::where('employeeUuid', '=', $data['employeeUuid'])
            ->get();
    
        if($user){
            $user = [
                'date' => date('Y-m-d'),
                'employeeUuid' => $data['employeeUuid'],
                'login' => $data['login'],
                'officeUuid' => $data['officeUuid']
            ];

            self::create($user);
            return;
        }

    }
}
