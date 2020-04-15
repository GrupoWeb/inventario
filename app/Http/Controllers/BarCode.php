<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;
use App\Model\bienes_activos;


class BarCode extends Controller
{
    public function barcodeGet(Request $request){
        $code = '<div class="BarCode">'. DNS1D::getBarcodeHTML($request->codeBar,"C128",2,80,'black',false).'</div>';
        return $code;
    }

    public function BarCodeAll(){
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin')
                    ->join('productos','productos.id_producto','=','activos.id_producto')->get();
        
        return view('active.Barcode',[
            "activos" => $activos
        ]);
    }

    public function BarCodePrinter(){
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin')
                    ->join('productos','productos.id_producto','=','activos.id_producto')->get();
        
                    $pdf = \PDF::loadView('active.PrinterBarcode',[
                        "activos" => $activos
                    ]);
                    $pdf->setPaper('Legal', 'portrait');
                    return $pdf->stream("Códigos de Barra".'.pdf'); 
    }

}
