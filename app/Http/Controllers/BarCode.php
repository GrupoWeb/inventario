<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;

class BarCode extends Controller
{
    public function barcodeGet(Request $request){
        $code = '<div class="BarCode">'. DNS1D::getBarcodeHTML($request->codeBar,"C128",2,80,'black',false).'</div>';
        return $code;
    }

    public function BarCodeAll(Request $request){
        $code = '<div >'. DNS1D::getBarcodeHTML($request->codeBar,"C128",2,80,'black',true).'</div>';
        return $code;
    }
}
