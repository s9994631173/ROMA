<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorys;
use App\Models\Items;
use App\Repositories\Admin\PackRepo;
use App\Http\Requests\PackRequest;

class PackController extends Controller
{
    public function getAllCategorys(){
        return Categorys::getAll();
    }
    public function getChars(Request $request){
        return Categorys::getChars($request);
    }
    public function presearch(Request $request){
        return Items::presearch($request);
    }
    public function search(Request $request){
        return Categorys::search($request);
    }

    public function adminAll(PackRepo $service){
        return $service->all();
    }
    public function adminCreate(PackRepo $service, PackRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(PackRepo $service, PackRequest $request){
        return $service->update($request);
    }
    public function adminDelete(PackRepo $service, PackRequest $request){
        return $service->delete($request);
    }
}
