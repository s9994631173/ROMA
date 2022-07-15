<?php

namespace App\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\Insurances;

class InsuranceRepo{

    public function all(){
        return Insurances::select('id', 'button', 'type', 'info')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create(Request $request){
        $item = [
            'button' => $request->input('button'),
            'type' => $request->input('type'),
            'info' => $request->input('info')
        ];
        Insurances::create($item);
    
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
   public function update(Request $request){
        $bd = Insurances::find($request->input('id'));
        if ($bd){
            $bd->button = $request->input('button');
            $bd->type = $request->input('type');
            $bd->info = $request->input('info');
            $bd->save();
        }
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
    public function delete(Request $request){
        $bd = Insurances::find($request->input('id'));
        $bd->delete();
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
}