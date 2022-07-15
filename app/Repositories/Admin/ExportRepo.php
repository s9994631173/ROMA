<?php

namespace App\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\Exports;

class ExportRepo{

    public function all(){
        return Exports::select('id', 'itemName', 'about')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create(Request $request){
        $el = Exports::where('itemName', '=', $request->input('itemName'))
                ->get()
                ->count();
        if($el < 1){
            $item = [
                'itemName' => $request->input('itemName'),
                'about' => $request->input('about'),
            ];
            Exports::create($item);

            return response([
                'success' => true,
                'message' => '',
                'data' => $this->all()
            ], 200);
        }
    }
    
   public function update(Request $request){
        $bd = Exports::find($request->input('id'));
        if ($bd){
            $bd->itemName = $request->input('itemName');
            $bd->about = $request->input('about');
            $bd->save();
        }
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
    public function delete(Request $request){
        $bd = Exports::find($request->input('id'));
        $bd->delete();
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
}