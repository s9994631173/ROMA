<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Stats\StatsRepo;

class StatsController extends Controller
{
    public function stats(StatsRepo $repo){
        $data = $repo->stats();
        return view('stats', $data);
    }
}
