@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                  <div class="table-responsive-sm" id="codigos">
                        <a href="./printer" class="btn btn-primary  mt-3 mb-3" target="_blank">
                              <i class="fas fa-print"></i> 
                        </a>
                        <table class="table table-bordered">
                              <thead>
                                    <tr class="thead-dark">
                                          <th class="handler_producto">Producto</th>
                                          <th class="handler_Barcode">Código de Barra</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    @foreach( $activos as $productos)
                                          <tr>
                                                <td class="handler_for_product">{{ $productos->descripcion }}</td>
                                                <td class="handler_for_Barcode">
                                                      {!! DNS1D::getBarcodeHTML($productos->codigo_sicoin,"C128",2,80,'black',true) !!}
                                                </td>
                                          </tr>
                                    @endforeach
                                    </tbody>
                              </table>
                        </div>
            </div>
        </div>
    </div>
@endsection
@section('breadcrumb')
    Códigos de Barra
@endsection
