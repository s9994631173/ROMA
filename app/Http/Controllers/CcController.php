<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallCentrButtons;
use App\Models\CallCentrDds;
use App\Repositories\Admin\CallCentrButtonsRepo;
use App\Repositories\Admin\CallCentrDdsRepo;
use App\Http\Requests\CcRequest;
use App\Http\Requests\CcDdRequest;

class CcController extends Controller
{
    public function getAll(){
        return CallCentrButtons::getAll();
    }

    public function getSelect(Request $request){
        return CallCentrButtons::getSelect($request);
    }

    public function getAllDd(Request $request){
        return CallCentrDds::getAll();
    }

    public function adminAll(CallCentrButtonsRepo $service){
        return $service->all();
    }
    public function adminCreate(CallCentrButtonsRepo $service, CcRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(CallCentrButtonsRepo $service, CcRequest $request){
        return $service->update($request);
    }
    public function adminDelete(CallCentrButtonsRepo $service, CcRequest $request){
        return $service->delete($request);
    }

    public function adminDdAll(CallCentrDdsRepo $service){
        return $service->all();
    }
    public function adminDdCreate(CallCentrDdsRepo $service, CcDdRequest $request){
        return $service->create($request);
    }
    public function adminDdUpdate(CallCentrDdsRepo $service, CcDdRequest $request){
        return $service->update($request);
    }
    public function adminDdDelete(CallCentrDdsRepo $service, CcDdRequest $request){
        return $service->delete($request);
    }
}
