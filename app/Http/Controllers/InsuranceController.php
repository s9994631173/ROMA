<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurances;
use App\Repositories\Admin\InsuranceRepo;
use App\Http\Requests\InsuranceRequest;

class InsuranceController extends Controller
{
    public function getAll(){
        return Insurances::getAll();
    }

    public function getSelect(Request $request){
        return Insurances::getSelect($request);
    }

    public function adminAll(InsuranceRepo $service){
        return $service->all();
    }
    public function adminCreate(InsuranceRepo $service, InsuranceRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(InsuranceRepo $service, InsuranceRequest $request){
        return $service->update($request);
    }
    public function adminDelete(InsuranceRepo $service, InsuranceRequest $request){
        return $service->delete($request);
    }
}
