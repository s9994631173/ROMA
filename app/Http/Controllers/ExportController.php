<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exports;
use App\Repositories\Admin\ExportRepo;
use App\Http\Requests\ExportRequest;

class ExportController extends Controller
{
    public function presearch(Request $request){
        return Exports::presearch($request);
    }

    public function search(Request $request){
        return Exports::search($request);
    }

    public function adminAll(ExportRepo $service){
        return $service->all();
    }
    public function adminCreate(ExportRepo $service, ExportRequest $request){
        return $service->create($request);
    }
    public function adminUpdate(ExportRepo $service, ExportRequest $request){
        return $service->update($request);
    }
    public function adminDelete(ExportRepo $service, ExportRequest $request){
        return $service->delete($request);
    }
}
