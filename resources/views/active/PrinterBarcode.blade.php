<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Invetario</title>
      <style>
            
            .container {
                  width: 100%;
                  padding-right: 15px;
                  padding-left: 15px;
                  margin-right: auto;
                  margin-left: auto;
            }
            .handler_producto {
                  width: 70%;
                  text-align: center;
            }

            .handler_Barcode{
                  width: 30%;
                  text-align: center;
            }

            .handler_for_product{
                  font-size: 16px;
                  text-align: justify;
            }

            .handler_for_Barcode > div{
                  margin:auto;
            }

            .table-bordered {
                  border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                  border: 1px solid #dee2e6 !important;
            }

            
            .table-bordered thead th,
            .table-bordered thead td {
                  border-bottom-width: 2px;
            }

            table {
                  border-collapse: collapse;
            }

            .table {
                  width: 100%;
                  margin-bottom: 1rem;
                  color: #212529;
            }

            .table th,
            .table td {
                  padding: 0.75rem;
                  vertical-align: top;
                  border-top: 1px solid #dee2e6;
            }

            .table thead th {
                  vertical-align: bottom;
                  border-bottom: 2px solid #dee2e6;
            }

            .table tbody + tbody {
                  border-top: 2px solid #dee2e6;
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

