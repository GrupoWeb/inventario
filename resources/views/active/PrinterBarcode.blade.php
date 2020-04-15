<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Invetario</title>
      <style>
            .table {
                  font-family: verdana !important;
                  font-size: 11px;
                  width: 100%;
                  border-spacing: 0;
                  border-collapse: collapse;
                  border: none;
                  /* border-top: none !important;
                  margin-bottom: none !important; */
            }
            /* .handler_producto {
            width: 70%;
            text-align: center;
            }

            .handler_Barcode{
            width: 30%;
            text-align: center;
            } */

            .handler_for_product{
            font-size: 1rem;
            text-align: justify;
            }

            .handler_for_Barcode > div{
            margin:auto;
            }

      </style>
</head>
<body>
      <div class="container">
            <div class="col-md-12">
                  <div class="table-responsive-sm">
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
</body>
</html>

