<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\product;
use App\Model\sequences;
use Carbon\Carbon;


class catalogo extends Controller
{
    public function addProduct(Request $request){
          $data = new product;
          $data->descripcion = $request->nameP;
          $data->estatus = 'A';
          $data->save();

          return response()->json($data,200);
    }

    public function allProduct(){
          $data = product::where('estatus','=','A')->select('id_producto','descripcion','estatus')->get();
          return response()->json($data,200);
    }

    public function editProduct(Request $request){
          $data = product::where('id_producto', $request->id)->update(['descripcion' => $request->new]);
          return response()->json($data, 200);
    }

    public function deleteProductById(Request $request){
          $data = product::where('id_producto', $request->id)->update(['estatus' => 'I']);
          return response()->json($data, 200);
    }


    public function getYear(){
        $date = Carbon::now('America/Guatemala');
//        return $date->isoFormat('YYYY');
        return response()->json($date->isoFormat('YYYY'),200);
    }

    public function sequences_data($tabla){
        // verificar si es tabla vacia
        if($data = sequences::select('value')->count() === 0){
            $value = 0;
            $vacio = true;
        }else{
            $value = sequences::select('value')->where('name','=', $tabla)->get();
            $vacio = false;
        };

        if($vacio === true){
            $data = new sequences;
            $data->name = $tabla;
            $data->value = $value + 1;
            $data->save();
        }else{
            $data = new sequences;
            $data->name = $tabla;
            $data->value = $value[0]['value']+1;
            $data->save();
        }
        return response()->json($data,200);
    }

    
}
