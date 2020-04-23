<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;
use App\Model\bienes_activos;
use App\Model\checkInventory;
use Illuminate\Support\Facades\DB;


class BarCode extends Controller
{
    public function barcodeGet(Request $request){
        $code = '<div class="BarCode">'. DNS1D::getBarcodeHTML($request->codeBar,"C128",2,80,'black',false).'</div>';
        return $code;
    }

    public function BarCodeAll($account){
       
      
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin','activos.fecha_ingreso', 'activos.cantidad')
                    ->join('productos','productos.id_producto','=','activos.id_producto')
                    ->where('id_cuenta','=',$account)->get();

        return $activos;
        
        // return view('active.Barcode',[
        //     "activos" => $activos
        // ]);
    }
    public function BarCodeAllReport(Request $request){
       
        
        // $report = checkInventory::selectRaw('activos.id_activo as code','productos.descripcion as producto','activos.codigo_sicoin as sicoin','activos.fecha_ingreso as fecha','activos.cantidad as cantidad','check_inventories.fisico','(activos.cantidad - check_inventories.fisico) as diferencia','check_inventories.lugar','check_inventories.empleado')
        $report = checkInventory::selectRaw('activos.id_activo,productos.descripcion as producto,activos.codigo_sicoin as sicoin, activos.fecha_ingreso as fecha, activos.cantidad as cantidad,check_inventories.fisico,check_inventories.lugar,check_inventories.empleado,
        (activos.cantidad - check_inventories.fisico) AS diferencia')
                    ->join('activos','activos.id_activo','=','check_inventories.id_activo')
                    ->join('productos','productos.id_producto','=','activos.id_producto')
                    ->where('activos.id_cuenta','=',$request->account)->get();
    
        return $report;
        
        // return view('active.Barcode',[
        //     "activos" => $activos
        // ]);
    }

    public function BarCodePrinter($data_account){
      
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin','activos.fecha_ingreso', 'activos.cantidad')
                    ->join('productos','productos.id_producto','=','activos.id_producto')
                    ->where('id_cuenta','=',$data_account)->get();
        $id = 1;

                    $pdf = \PDF::loadView('active.PrinterBarcode',[
                        "activos" => $activos,
                        "id" => $id
                    ]);
                    $pdf->setPaper('letter', 'portrait');
                    // $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                    return $pdf->stream("Códigos de Barra".'.pdf'); 
    }


    public function GetBarCodeById($code){
        $code_data = bienes_activos::select('codigo_sicoin')->where('codigo_sicoin','=',$code)->count();
        
        if($code_data == 0){
            $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>INVENTARIO</title>
                    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
                    <style>
                        @page { size:2in 1in; margin: 2cm }
                        * {
                            font-size: 12px;
                            font-family: "Times New Roman";
                        }
                        
                        
                        
                        .centrado {
                            text-align: center;
                            align-content: center;
                        }
                        
                        .ticket {
                            padding:0 auto;
                            margin:0 auto;
                            width: 155px;
                            max-width: 155px;
                        }
                        
                        img {
                            max-width: inherit;
                            width: inherit;
                        }
                        </style>
                    
                
                </head>
                <body>
                    <div class="ticket">

                    </div>
                    <script>
                    </script>
                </body>
                </html>
                ';
        }else{
            $code_data = bienes_activos::select('codigo_sicoin')->where('codigo_sicoin','=',$code)->get();
            $code = ' <img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code_data[0]['codigo_sicoin'], 'C128',2,80,array(0,0,0),true) . '" alt="barcode"   />';
            $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>INVENTARIO</title>
                    
                    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
                    <style>
                        @page { size:2in 1in; margin: 0cm}
                        * {
                            padding:0 auto;
                            font-size: 12px;
                            font-family: "Times New Roman";
                        }
                        
                        
                        

                        .centrado {
                            text-align: center;
                            align-content: center;
                        }
                        
                        .ticket {
                            padding:0 auto;
                            margin:0 auto;
                            width: 150px;
                            max-width: 130px;
                            padding-left: -70px;
                            padding-top:30px;
                        }
                        
                        img {
                            max-width: inherit;
                            width: inherit;
                        }
                        </style>
                    
                
                </head>
                <body>
                    <div class="ticket">
                        <img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code_data[0]['codigo_sicoin'], 'C128',2,80,array(0,0,0),true) . '" alt="barcode"   />
                            
                    </div>
                    <script>
                    </script>
                </body>
                </html>
                ';
        }

        $pdf = \PDF::loadHtml($html);
        $pdf->setPaper('A9', 'landscape');
        // $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream("Códigos de Barra".'.pdf'); 
        // return $html;
        
    }

    public function GetSearchCodeById($code){

        
        $code_data = bienes_activos::select('activos.id_activo','productos.descripcion','activos.codigo_sicoin','activos.fecha_ingreso', 'activos.cantidad')
                        ->join('productos','productos.id_producto','=','activos.id_producto')
                        ->where('codigo_sicoin','=',$code)->get();

        return response()->json($code_data,200);
        
    }

}
