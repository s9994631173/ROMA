<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guides;
use App\Repositories\Admin\GuideRepo;
use App\Http\Requests\GuideRequest;

class GuideController extends Controller
{
    public function getAll(){
        return Guides::getAll();
    }

    public function getSelect(Request $request){
        return Guides::getSelect($request);
    }

    public function adminAll(GuideRepo $service){
        return $service->all();
    }
    public function adminCreate(GuideRepo $service, GuideRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(GuideRepo $service, GuideRequest $request){
        return $service->update($request);
    }
    public function adminDelete(GuideRepo $service, GuideRequest $request){
        return $service->delete($request);
    }
}
