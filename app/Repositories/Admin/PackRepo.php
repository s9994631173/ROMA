<?php

namespace App\Repositories\Admin;
use Illuminate\Http\Request;
use App\Models\Categorys;

class PackRepo{
    public function all(){
        return Categorys::select('id', 'category', 'char', 'aboutItem', 'pack', 'method')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function create(Request $request){
        $validated = $request->validated();

        $el = Categorys::where('category', '=', $validated['category'])
            ->where('char', '=', $validated['char'])
            ->get()
            ->count();
        if($el < 1){
            $item = [
                'category' => $validated['category'],
                'char' => $validated['char'],
                'aboutItem' => $validated['aboutItem'],
                'pack' => $validated['pack'],
                'method' => $validated['method'],
            ];
            Categorys::create($item);
            
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $this->all()
            ]);
        }
        return response([
            'success' => false,
            'message' => 'Строка с такой категоией/характеристикой уже есть'
        ], 422);

    }
    
   public function update(Request $request){
        $bd = Categorys::find($request->input('id'));
        if ($bd){
            $bd->category = $request->input('category');
            $bd->char = $request->input('char');
            $bd->aboutItem = $request->input('aboutItem');
            $bd->pack = $request->input('pack');
            $bd->method = $request->input('method');
            $bd->save();
        }
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
    
    public function delete(Request $request){
        $bd = Categorys::find($request->input('id'));
        $bd->delete();
        
        return response([
            'success' => true,
            'message' => '',
            'data' => $this->all()
        ], 200);
    }
}