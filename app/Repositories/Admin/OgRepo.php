<?php

namespace App\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\Ogs;

class OgRepo{
    public function all(){
        return Ogs::select('id', 'itemName', 'classHazard', 'avia', 'additional_fee', 'auto', 'note')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create(Request $request){
        $el = Ogs::where('itemName', '=', $request->input('itemName'))
            ->get()
            ->count();
        if($el < 1){
            $item = [
                'itemName' => $request->input('itemName'),
                'classHazard' => $request->input('classHazard'),
                'avia' => $request->input('avia'),
                'additional_fee' => $request->input('addFee'),
                'auto' => $request->input('auto'),
                'note' => $request->input('note')
            ];
            Ogs::create($item);

            return response([
                'success' => true,
                'message' => '',
                'data' => $this->all()
            ], 200);
        }
        return response([
            'success' => true,
            'message' => 'Строка с такой категоией/характеристикой уже есть',
            'data' => $this->all()
        ], 422);
    }
    
   public function update(Request $request){
        $bd = Ogs::find($request->input('id'));
        if ($bd){
            $bd->itemName = $request->input('itemName');
            $bd->classHazard = $request->input('classHazard');
            $bd->avia = $request->input('avia');
            $bd->additional_fee = $request->input('additional_fee');
            $bd->auto = $request->input('auto');
            $bd->note = $request->input('note');
            $bd->save();
        }
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
    public function delete(Request $request){
        $bd = Ogs::find($request->input('id'));
        $bd->delete();
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
}