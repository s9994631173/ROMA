<?php

namespace App\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\CallCentrDds;

class CallCentrDdsRepo{

    public function all(){
        return CallCentrDds::select('id', 'contragent', 'contract', 'message')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create(Request $request){
        $item = [
            'contragent' => $request->input('contragent'),
            'contract' => $request->input('contract'),
            'message' => $request->input('message')
        ];
        CallCentrDds::create($item);

        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
   public function update(Request $request){
        $bd = CallCentrDds::find($request->input('id'));
        if ($bd){
            $bd->contragent = $request->input('contragent');
            $bd->contract = $request->input('contract');
            $bd->message = $request->input('message');
            $bd->save();
        }
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
    public function delete(Request $request){
        $bd = CallCentrDds::find($request->input('id'));
        $bd->delete();
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
}