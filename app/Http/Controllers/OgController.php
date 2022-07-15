<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ogs;
use App\Repositories\Admin\OgRepo;
use App\Http\Requests\OgRequest;

class OgController extends Controller
{
    public function presearch(Request $request){
        return Ogs::presearch($request);
    }

    public function search(Request $request){
        return Ogs::search($request);
    }

    public function adminAll(OgRepo $service){
        return $service->all();
    }
    public function adminCreate(OgRepo $service, OgRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(OgRepo $service, OgRequest $request){
        return $service->update($request);
    }
    public function adminDelete(OgRepo $service, OgRequest $request){
        return $service->delete($request);
    }
}
