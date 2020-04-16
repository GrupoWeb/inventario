<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\categoria;
use App\Model\seccion;
use App\Model\sequences;
use App\Model\tipo;
use App\Model\estado;
use App\Model\biene;
use Illuminate\Support\Facades\DB;

class InventarioInicial extends Controller
{
    public function sequences_data($tabla){
        
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

    public function SetCategory(){
        try {
            DB::beginTransaction();
            $category = array(
                array("code" => 1, "name" => "BIENES PREEXISTENTES"),
                array("code" => 2, "name" => "MAQUINARIA Y EQUIPO"),
                array("code" => 3, "name" => "CONSTRUCCIONES POR CONTRATO"),
                array("code" => 4, "name" => "EQUIPO MILITAR Y DE SEGURIDAD"),
                array("code" => 5, "name" => "LIBROS, REVISTAS Y OTROS ELEMENTOS COLEC."),
                array("code" => 6, "name" => "OBRAS DE ARTE"),
                array("code" => 7, "name" => "ANIMALES"),
                array("code" => 8, "name" => "ACTIVOS INTANGIBLES"),
            );
        
            foreach ($category as $key => $value) {
                $data_category = new categoria;
                $data_category->id_categoria = $value['code'];
                $data_category->id_grupo = 3;
                $data_category->name = $value['name'];
                $data_category->save();
            }


            
            $section = array(
                    array('name' => 'TIERRAS Y TERRENOS', 'code_init' => '1'),
                    array('name' => 'EDIFICIOS E INSTALACIONES', 'code_init' => '1'),
                    array('name' => 'OTROS BIENES MUEBLES PREEXISTENTES', 'code_init' => '1'),
                    array('name' => 'MAQUINARIA Y EQUIPO DE PRODUCCION', 'code_init' => '2'),
                    array('name' => 'EQUIPO DE OFICINA', 'code_init' => '2'),
                    array('name' => 'EQUIPO MEDICO-SANITARIO Y DE LABORATORIO', 'code_init' => '2'),
                    array('name' => 'EQUIPO EDUCACIONAL, CULTURAL Y RECREATIVO', 'code_init' => '2'),
                    array('name' => 'EQUIPO DE TRANSPORTE', 'code_init' => '2'),
                    array('name' => 'EQUIPO PARA COMUNICACIONES', 'code_init' => '2'),
                    array('name' => 'MAQUINARIA Y EQUIPO PARA LA CONSTRUCCION', 'code_init' => '2'),
                    array('name' => 'EQUIPO DE COMPUTO', 'code_init' => '2'),
                    array('name' => 'OTRAS MAQUINARIAS Y EQUIPOS', 'code_init' => '2'),
                    array('name' => 'HERRAMIENTAS', 'code_init' => '2'),
                    array('name' => 'CONST. DE BIENES NAC. DE USO COMUN', 'code_init' => '3'),
                    array('name' => 'CONST. DE BIENES NAC. DE USO NO COMUN', 'code_init' => '3'),
                    array('name' => 'CONSTRUCCIONES MILITARES', 'code_init' => '3'),
                    array('name' => 'EQUIPO MILITAR Y DE SEGURIDAD', 'code_init' => '4'),
                    array('name' => 'LIBROS, REVISTAS Y OTROS ELEMENTOS COLECCIONABLES', 'code_init' => '5'),
                    array('name' => 'OBRAS DE ARTE', 'code_init' => '6'),
                    array('name' => 'ANIMALES', 'code_init' => '7'),
                    array('name' => 'GANADO', 'code_init' => '7'),
                    array('name' => 'CANINOS', 'code_init' => '7'),
                    array('name' => 'ACTIVOS INTANGIBLES', 'code_init' => '8'),
            );


            foreach ($section as $key => $value) {
                $secuencia = $this->sequences_data("seccions");
                $secuencia = json_decode(json_encode($secuencia)) ;

                $unidad = new seccion;
                $unidad->id_seccion = $secuencia->original->value;
                $unidad->id_categoria = $value['code_init'];
                $unidad->name = $value['name'];
                $unidad->save();
            }

            $type =array(
                    array('code_section' => '1', 'name' => 'TERRENOS PARA CONSTRUCCION DE EDIFICIOS'),
                    array('code_section' => '1', 'name' => 'ADQUISICION DE TERRENOS'),
                    array('code_section' => '1', 'name' => 'TERRENOS PARA VIVIENDAS'),
                    array('code_section' => '1', 'name' => 'ADQUISICION DE TERRENOS PARA USO PUBLICO'),
                    array('code_section' => '2', 'name' => 'EDIFICIOS PARA OFICINAS PUBLICAS'),
                    array('code_section' => '2', 'name' => 'EDIFICIOS PARA USO DE ESCUELAS PUBLICAS'),
                    array('code_section' => '2', 'name' => 'EDIFICIOS PARA HABITACIONES'),
                    array('code_section' => '3', 'name' => 'TERRENOS Y EDIFICIOS'),
                    array('code_section' => '3', 'name' => 'ADQUISICION DE MAQUINARIA Y EQUIPOS USADOS'),
                    array('code_section' => '4', 'name' => 'MAQUINAS, PLANTAS, MOTORES, GENERADORES Y COMPRESORES'),
                    array('code_section' => '4', 'name' => 'BOMBAS, MOTORES Y GENERADORES   -EQUIPO CON MOTOR-'),
                    array('code_section' => '4', 'name' => 'MAQUINARIA Y EQUIPO AGRICOLA'),
                    array('code_section' => '4', 'name' => 'MAQUINARIA Y EQUIPO DE PRODUCCIÓN'),
                    array('code_section' => '5', 'name' => 'MUEBLES DE METAL  -ARCHIVADORES, ARMARIOS, ESTANTERIAS Y GABINETES'),
                    array('code_section' => '5', 'name' => 'MUEBLES DE METAL ESCRITORIOS, SILLAS, MESAS, PAPELERAS Y BOTES DE METAL'),
                    array('code_section' => '5', 'name' => 'MUEBLES DE METAL  -MAQUINAS VARIAS CLASES-'),
                    array('code_section' => '5', 'name' => 'OTROS MOBILIARIOS DE METAL'),
                    array('code_section' => '5', 'name' => 'MUEBLES DE MADERA   -AMUEBLADOS-  ESCRITORIOS Y  SILLAS'),
                    array('code_section' => '5', 'name' => 'EQUIPO DE COCINA'),
                    array('code_section' => '5', 'name' => 'EQUIPO DE IMPRENTA'),
                    array('code_section' => '5', 'name' => 'OTROS'),
                    array('code_section' => '5', 'name' => 'EQUIPO DE OFICINA'),
                    array('code_section' => '6', 'name' => 'EQUIPO MEDICO ASISTENCIAL'),
                    array('code_section' => '6', 'name' => 'EQUIPO MEDICO QUIRURGICO'),
                    array('code_section' => '6', 'name' => 'EQUIPO ASISTENCIA HOSPITALARIA'),
                    array('code_section' => '6', 'name' => 'EQUIPO PARA LABORATORIO MEDICO SANITARIOS'),
                    array('code_section' => '6', 'name' => 'EQUIPO DE LABORATORIO'),
                    array('code_section' => '6', 'name' => 'EQUIPO PARA ODONTOLOGIA'),
                    array('code_section' => '6', 'name' => 'EQUIPO E INSTRUMENTAL QUIRURGICO Y ODONTOLOGICO'),
                    array('code_section' => '6', 'name' => 'EQUIPO DE METROLOGIA'),
                    array('code_section' => '6', 'name' => 'EQUIPO DE INGENIERIA'),
                    array('code_section' => '6', 'name' => 'EQUIPO MÉDICO-SANITARIO Y DE LABORATORIO'),
                    array('code_section' => '7', 'name' => 'EQUIPOS MUSICALES'),
                    array('code_section' => '7', 'name' => 'EQUIPO PARA BIBLIOTECAS Y MUSEOS'),
                    array('code_section' => '7', 'name' => 'EQUIPO MICROFILM Y PROYECCION'),
                    array('code_section' => '7', 'name' => 'EQUIPO DE AULAS EDUCATIVAS'),
                    array('code_section' => '7', 'name' => 'MOBILIARIO EDUCATIVO'),
                    array('code_section' => '7', 'name' => 'EQUIPOS DE AUDIO'),
                    array('code_section' => '7', 'name' => 'EQUIPOS FOTOGRAFICOS'),
                    array('code_section' => '7', 'name' => 'EQUIPOS DE TELEVISION'),
                    array('code_section' => '7', 'name' => 'TELESCOPIOS Y LENTES'),
                    array('code_section' => '7', 'name' => 'EQUIPO DEPORTIVO Y RECREATIVO'),
                    array('code_section' => '7', 'name' => 'EQUIPO DEPORTIVO Y RECREATIVO'),
                    array('code_section' => '7', 'name' => 'OTROS EQUIPOS'),
                    array('code_section' => '8', 'name' => 'VEHICULOS LIVIANOS'),
                    array('code_section' => '8', 'name' => 'VEHICULOS PEQUEÑOS DESTINADOS AL CAMPO'),
                    array('code_section' => '8', 'name' => 'VEHICULOS PARA TRANSPORTE DE PERSONAS'),
                    array('code_section' => '8', 'name' => 'CAMIONES PARA CARGA'),
                    array('code_section' => '8', 'name' => 'AVIONES Y AVIONETAS'),
                    array('code_section' => '8', 'name' => 'BICICLETAS'),
                    array('code_section' => '8', 'name' => 'MOTOCICLETAS'),
                    array('code_section' => '8', 'name' => 'TRACTORES'),
                    array('code_section' => '8', 'name' => 'VEHICULOS ACUATICOS'),
                    array('code_section' => '8', 'name' => 'GRUAS'),
                    array('code_section' => '9', 'name' => 'EQUIPO TELEGRAFICO'),
                    array('code_section' => '9', 'name' => 'ACCESORIOS DE TELEFONIA'),
                    array('code_section' => '9', 'name' => 'EQUIPO DE RADIO'),
                    array('code_section' => '9', 'name' => 'EQUIPOS DE TELEVISION'),
                    array('code_section' => '9', 'name' => 'EQUIPO PARA SEÑALES DE NAVEGACION'),
                    array('code_section' => '9', 'name' => 'OTROS EQUIPOS PARA COMUNICACIONES'),
                    array('code_section' => '9', 'name' => 'EQUIPO DE SEÑALIZACION'),
                    array('code_section' => '9', 'name' => 'SERVIDOR DE COMUNICACIONES IP'),
                    array('code_section' => '10', 'name' => 'REPUESTOS DE MAQUINA Y EQUIPO DE CONTRUCCION'),
                    array('code_section' => '10', 'name' => 'MAQUINARIA DE CONSTRUCCION'),
                    array('code_section' => '10', 'name' => 'MOTONIVELADORA'),
                    array('code_section' => '10', 'name' => 'EXCAVADORA'),
                    array('code_section' => '10', 'name' => 'RETROEXCAVADORA'),
                    array('code_section' => '10', 'name' => 'CARGADOR FRONTAL'),
                    array('code_section' => '11', 'name' => 'EQUIPO DE COMPUTACION ELECTRONICA'),
                    array('code_section' => '11', 'name' => 'MAQUINAS IMPRESORAS  Y OTROS'),
                    array('code_section' => '11', 'name' => 'OTROS EQUIPOS DE COMPUTO'),
                    array('code_section' => '11', 'name' => 'DISPOSITIVO DE RESPALDO CON DEDUPLICACIÓN DE DATOS'),
                    array('code_section' => '11', 'name' => 'SERVIDOR BLADE'),
                    array('code_section' => '11', 'name' => 'EQUIPO DE SOLUCIÓN CONVERGENTE'),
                    array('code_section' => '11', 'name' => 'CHASIS MODULAR CON INTERCONECTIVIDAD PARA SERVIDOR BLADE'),
                    array('code_section' => '12', 'name' => 'MOBILIARIO DE DORMITORIO'),
                    array('code_section' => '12', 'name' => 'EQUIPO DE COCINA'),
                    array('code_section' => '12', 'name' => 'EQUIPO DE TOPOGRAFIA - EQUIPOS VARIOS'),
                    array('code_section' => '12', 'name' => 'MOBILIARIOS Y EQUIPOS DOMESTICOS'),
                    array('code_section' => '12', 'name' => 'EQUIPOS DE ILUMINACION'),
                    array('code_section' => '12', 'name' => 'EQUIPOS VARIOS DE MANTENIMIENTO'),
                    array('code_section' => '12', 'name' => 'OTROS EQUIPOS'),
                    array('code_section' => '12', 'name' => 'REPUESTOS DE EQUIPO CLASIFICADOS EN ESTE RENGLON'),
                    array('code_section' => '12', 'name' => 'MAQUINARIA PARA LA CONSTRUCCION - EQUIPO DE CONSTRUCCION'),
                    array('code_section' => '12', 'name' => 'MAQUINARIA PARA LA CONSTRUCCION'),
                    array('code_section' => '12', 'name' => 'EQUIPO DE GRABACIÓN'),
                    array('code_section' => '12', 'name' => 'CHASIS (GABINETE) MODULAR PARA SERVIDOR BLADE'),
                    array('code_section' => '12', 'name' => 'EQUIPO DEPORTIVO'),
                    array('code_section' => '12', 'name' => 'SISTEMA PURIFICADOR DE AGUA'),
                    array('code_section' => '13', 'name' => 'MECANICA'),
                    array('code_section' => '13', 'name' => '....'),
                    array('code_section' => '13', 'name' => '...'),
                    array('code_section' => '17', 'name' => 'FUSILES'),
                    array('code_section' => '17', 'name' => 'SUB AMETRALLADORAS'),
                    array('code_section' => '17', 'name' => 'PISTOLAS'),
                    array('code_section' => '17', 'name' => 'REVOLVERES'),
                    array('code_section' => '17', 'name' => 'DETECTORES'),
                    array('code_section' => '17', 'name' => 'MIRAS TELESCOPICAS'),
                    array('code_section' => '17', 'name' => 'EQUIPO DE PROTECCION'),
                    array('code_section' => '17', 'name' => 'EQUIPO DE EMERGENCIA'),
                    array('code_section' => '17', 'name' => 'ARMAS'),
                    array('code_section' => '17', 'name' => 'EQUIPO MILITAR Y DE SEGURIDAD'),
                    array('code_section' => '17', 'name' => 'EQUIPO ELECTRICO DE DESCARGA'),
                    array('code_section' => '17', 'name' => 'TRAJE ANTI-BOMBAS'),
                    array('code_section' => '17', 'name' => 'AMETRALLADORA'),
                    array('code_section' => '17', 'name' => 'RADARES'),
                    array('code_section' => '18', 'name' => 'LIBROS'),
                    array('code_section' => '18', 'name' => 'REVISTAS COLECCIONABLES'),
                    array('code_section' => '18', 'name' => 'MAPAS'),
                    array('code_section' => '19', 'name' => 'PINTURAS'),
                    array('code_section' => '19', 'name' => 'ESCULTURAS'),
                    array('code_section' => '20', 'name' => 'GANADO'),
                    array('code_section' => '20', 'name' => 'OTROS ANIMALES'),
                    array('code_section' => '21', 'name' => 'GANADO VACUNO'),
                    array('code_section' => '21', 'name' => 'GANADO CABALLAR'),
                    array('code_section' => '21', 'name' => 'GANADO MULAR'),
                    array('code_section' => '21', 'name' => 'GANADO CAPRINO'),
                    array('code_section' => '21', 'name' => 'GANADO OVINO'),
                    array('code_section' => '21', 'name' => 'GANADO ASNAL'),
                    array('code_section' => '21', 'name' => 'GANADO PORCINO'),
                    array('code_section' => '22', 'name' => 'PERROS'),
                    array('code_section' => '23', 'name' => 'LICENCIAS'),
                    array('code_section' => '23', 'name' => 'SOFWARE'),
                );
        
            
            foreach ($type as $key => $value) {
                $secuencia = $this->sequences_data("tipos");
                $secuencia = json_decode(json_encode($secuencia)) ;

                $unidad = new tipo;
                $unidad->id_tipo = $secuencia->original->value;
                $unidad->id_seccion = $value['code_section'];
                $unidad->name = $value['name'];
                $unidad->save();
            }
    
            
            $secuencia = $this->sequences_data("bienes");
            $secuencia = json_decode(json_encode($secuencia)) ;

            $unidad = new biene;
            $unidad->id_bien = $secuencia->original->value;
            $unidad->id_tipo = 1;
            $unidad->name = "SILLA TIPO SECRETARIA CON RODOS";
            $unidad->save();

            $state = array(
                array('code' => '1', 'name' => 'NUEVO'),
                array('code' => '2', 'name' => 'BUENO'),
                array('code' => '3', 'name' => 'REGULAR'),
                array('code' => '4', 'name' => 'MAL ESTADO'),
                array('code' => '5', 'name' => 'INSERVIBLE'),
                array('code' => '6', 'name' => 'CONSERVACION HISTORICA'),
                array('code' => '7', 'name' => 'FALTANTE'),
                array('code' => '8', 'name' => 'PRUEBA DE ESTADO'),
            );

            foreach ($state as $key => $value) {
               

                $unidad = new estado;
                $unidad->id_estadoP = $value['code'];
                $unidad->descripcion = $value['name'];
                $unidad->save();
            }

            DB::commit();
            return response()->json(true,200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(false,200);
        }

    }
}
