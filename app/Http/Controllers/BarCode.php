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
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin','activos.fecha_ingreso', 'activos.cantidad')
                    ->join('productos','productos.id_producto','=','activos.id_producto')->get();

        return $activos;
        
        // return view('active.Barcode',[
        //     "activos" => $activos
        // ]);
    }

    public function BarCodePrinter(){
        $activos = bienes_activos::select('productos.descripcion','activos.codigo_sicoin')
                    ->join('productos','productos.id_producto','=','activos.id_producto')->get();
        
                    $pdf = \PDF::loadView('active.PrinterBarcode',[
                        "activos" => $activos
                    ]);
                    // $pdf->setPaper('Legal', 'landscape');
                    $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
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
                        @page :left{
                            margin-left: 3cm
                            margin-right:4cm
                        }
                        @page :right{
                            margin-left: 4cm
                            margin-right:3cm
                        }
                        @page :firsts{
                            margin-top: 4cm
                            
                        }
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
            $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>INVENTARIO</title>
                    
                    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
                    <style>
                        @page :left{
                            margin-left: 3cm
                            margin-right:4cm
                        }
                        @page :right{
                            margin-left: 4cm
                            margin-right:3cm
                        }
                        @page :firsts{
                            margin-top: 4cm
                            
                        }

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
                    <img src="data:image/png;base64,' . DNS1D::getBarcodePNG($code_data[0]['codigo_sicoin'], 'C128',2,80,array(0,0,0),true) . '" alt="barcode"   />
                    
                            
                    </div>
                    <script>
                            
                
                            $(document).ready(function() {
                                window.print();
                            });
                    </script>
                </body>
                </html>
                ';
        }
        return $html;
        
    }

}
