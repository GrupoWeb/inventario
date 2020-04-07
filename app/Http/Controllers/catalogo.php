<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\product;
use App\Model\sequences;
use Carbon\Carbon;
use App\Model\entidad;
use App\Model\unidaEjecutora;
use App\Model\grupo;
use App\Model\categoria;
use App\Model\seccion;
use App\Model\tipo;
use App\Model\biene;
use App\Model\estado;
use App\Model\persona;
use App\Model\dependencias;




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
        if($data = sequences::where('name','=',$tabla)->select('value')->count() === 0){
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
            $cantidad = $data = sequences::where('name','=',$tabla)->select('value')->count();
            $data = new sequences;
            $data->name = $tabla;
            $data->value = $cantidad+1;
            $data->save();
        }
        return response()->json($data,200);
    }

    public function getEntidad(){
        $entidad = entidad::all();
        return response()->json($entidad,200);
    }

    public function getUnidad(){
        $entidad = unidaEjecutora::all();
        return response()->json($entidad,200);
    }

    public function getGrupo(){
        $grupo = grupo::all();
        return response()->json($grupo,200);
    }

    public function getCategoria(Request $request){
        $categoria = categoria::where('id_grupo','=',$request->grupo)->select('id_categoria','name')->get();
        return response()->json($categoria,200);
    }

    public function getSeccion(Request $request){
        $seccion = seccion::where('id_categoria','=',$request->categoria)->select('id_seccion','name')->get();
        return response()->json($seccion,200);
    }

    public function getTipo(Request $request){
        $tipo = tipo::where('id_seccion','=',$request->seccion)->select('id_tipo','name')->get();
        return response()->json($tipo,200);
    }

    public function getBien(Request $request){
        $bien = biene::where('id_tipo','=' ,$request->bien)->select('id_bien','name')->get();
        return response()->json($bien,200);
    }

    public function getEstadoProducto(){
        $estado = estado::all();
        return response()->json($estado,200);
    }

    public function addProductBienes(Request $request){

        try{
            $secuencia = $this->sequences_data("productos");
            $secuencia = json_decode(json_encode($secuencia)) ;
    
            $product = new product;
            $product->id_producto = $secuencia->original->value;
            $product->descripcion = $request->des_producto;
            $product->estatus = 'A';
            $product->save();

            DB::commit();
            return response()->json(true,200);
        }
        catch(\Exceptio $e){
            DB::rollBack();
            return response()->json(false,200);
        }

    }

    public function getPersonas(Request $request){
        $personas = persona::where('id_entidad','=',$request->entidad)->select('id_persona','nombres','apellidos','nit')->get();
        return response()->json($personas,200);

    }

    public function getDependencias(){
        $dep = dependencias::all();
        return response()->json($dep,200);
    }



    
}
