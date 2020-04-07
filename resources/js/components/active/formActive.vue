<template>
    <div>
        <div class="card">
            <div class="card-header text-white bg-primary">
                <el-row :gutter="10">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="20">
                        Entidad: <span class="pl-3">{{ entity }} </span>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                        Año Fiscal:
                        <span class="pl-3">{{ nowYear }}</span>
                    </el-col>
                </el-row>
            </div>
            <div class="card-body">
                <el-form ref="form" :model="form" :rules="rules" >
<!--                    Unidad Administrativa -->
                    <el-row :gutter="10">
                        <el-col :span="24">
                            <el-form-item label="Unidad Administrativa Inventario:" prop="unidad">
                               <el-select v-model="form.unidad" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in unidades"
                                        :key="item.id_unidad"
                                        :label="item.id_unidad + '-'+ item.name"
                                        :value="item.name"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    Grupo y Categoria -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Grupo:" prop="grupo">
                                <el-select class="select_width" v-model="form.grupo" clearable filterable placeholder="Seleccionar" @change="getCategorias">
                                    <el-option
                                        v-for="item in grupos"
                                        :key="item.id_grupo"
                                        :label="item.id_grupo + '-'+ item.name"
                                        :value="item.id_grupo"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Categoría:" prop="categoria">
                                <el-select class="select_width" v-model="form.categoria" clearable filterable placeholder="Seleccionar" @change="getSecciones">
                                    <el-option
                                        v-for="item in categorias"
                                        :key="item.id_categoria"
                                        :label="item.id_categoria + '-'+ item.name"
                                        :value="item.id_categoria"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    seccion y tipo -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Seccion:" prop="seccion">
                                <el-select class="select_width" v-model="form.seccion" clearable filterable placeholder="Seleccionar" @change="getTipos">
                                    <el-option
                                        v-for="item in secciones"
                                        :key="item.id_seccion"
                                        :label="item.id_seccion + '-'+ item.name"
                                        :value="item.id_seccion"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Tipo:" prop="tipo">
                                <el-select class="select_width" v-model="form.tipo" clearable filterable placeholder="Seleccionar"  @change="getBienes">
                                    <el-option
                                        v-for="item in tipos"
                                        :key="item.id_tipo"
                                        :label="item.id_tipo + '-'+ item.name"
                                        :value="item.id_tipo"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <!--                    Bien  -->
                    <el-row :gutter="10">
                        <el-col :span="12">
                            <el-form-item label="Bien:" prop="bien">
                                <el-select v-model="form.bien" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in Bienes"
                                        :key="item.id_bien"
                                        :label="item.id_bien + '-'+ item.name"
                                        :value="item.name"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Estado del Bien:" prop=estado>
                                <el-select v-model="form.estado" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in EstadosProducto"
                                        :key="item.id_estadoP"
                                        :label="item.id_estadoP + '-'+ item.descripcion"
                                        :value="item.name"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    Descripion y Comentario-->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="15">
                            <el-form-item label="Descripción del Producto:" prop="producto">
                                <el-input type="textarea" :rows="5" v-model="form.producto"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="9">
                            <el-form-item label="Comentario:">
                                <el-input type="textarea" :rows="5" v-model="form.comentario"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    Modelo, serie, marca, fecha y localizado-->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="5">
                            <el-form-item label="Modelo:">
                                <el-input class="font_custom_input" v-model="form.modelo"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="5">
                            <el-form-item label="Serie:">
                                <el-input class="font_custom_input" v-model="form.serie"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="5">
                            <el-form-item label="Marca:">
                                <el-input class="font_custom_input" v-model="form.marca"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="5">
                            <el-form-item label="Fecha Ingreso:" prop="fIngreso">
                                <el-date-picker v-model="form.fIngreso" type="date"
                                                placeholder="Fecha"></el-date-picker>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                            <el-form-item label="Localizado en:" prop="localidad">
                                    <el-input class="font_custom_input" v-model="form.localidad"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    empleado, dependencia y cuenta -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Empleado:" prop="empleado">
                                <el-select class="select_width" v-model="form.empleado" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in PersonasData"
                                        :key="item.id_persona"
                                        :label="item.nombres + ' '+ item.apellidos"
                                        :value="item.id_persona"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Dependencia:" prop="dependencia">
                                <el-select class="select_width" v-model="form.dependencia" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in dependencias"
                                        :key="item.id_dependencia"
                                        :label="item.descripcion"
                                        :value="item.id_dependencia"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Cuenta:" prop="cuenta_nueva">
                                <el-select class="select_width" v-model="form.cuenta_nueva" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in unidades"
                                        :key="item.id_unidad"
                                        :label="item.id_unidad + ' '+ item.name"
                                        :value="item.name"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <!--          respaldo y secuencia  -->
                    <el-row :gutter="10">
                        <el-col :span="12">
                            <el-form-item label="Tipo documento respaldo:" prop="respaldo">
                                <el-select v-model="form.respaldo" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in unidades"
                                        :key="item.id_unidad"
                                        :label="item.id_unidad + ' '+ item.name"
                                        :value="item.name"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Secuencia:">
                                <el-select v-model="form.secuencia" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in unidades"
                                        :key="item.id_unidad"
                                        :label="item.id_unidad + ' '+ item.name"
                                        :value="item.name"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    Factura, costo, serie y proveedor -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Número Factura" prop="nFactura">
                                <el-input class="font_custom_input" v-model="form.nFactura"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Costo:" prop="costo">
                                <el-input class="font_custom_input" v-model="form.costo"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Serie:" prop="serie">
                                <el-input class="font_custom_input" v-model="form.serie"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Proveedor:" prop="proveedor">
                                <el-input class="font_custom_input" v-model="form.proveedor" @change="searchProvider"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    datos del proveedor -->
                    <el-row :gutter="10" v-show="visible">
                        <el-col :span="24">
                            <el-table :data="dataSatProvider" style="width: 100%">
                                <el-table-column label="Nit" prop="nit"></el-table-column>
                                <el-table-column label="Nombre" prop="name"></el-table-column>
                                <el-table-column label="Dirección" prop="business_address"></el-table-column>
                            </el-table>
                        </el-col>
                    </el-row>
<!--                    alza, baja, saldo, sicoin y codigo de barra-->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                            <el-form-item label="Alza:" prop="alza">
                                <el-input class="font_custom_input" v-model="form.alza"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                            <el-form-item label="Baja:" prop="baja">
                                <el-input class="font_custom_input" @change="getSaldo" v-model="form.baja"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                            <el-form-item label="Saldo:" >
                                <el-input class="font_custom_input" v-model="form.saldo" disabled></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="SICOIN:" prop="sicoin">
                                <el-input class="font_custom_input" v-model="form.sicoin" @change="getCodeBar()"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Código Barras:" >
                                <div class="mt-5 "  v-html="codeBar"></div>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-form-item>
                        <el-button
                            type="primary"
                            @click="onSubmit('form')"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >Guardar
                        </el-button>
                    </el-form-item>
                </el-form>




                <!-- <el-table
                  :data="
                                listProduct.slice(
                                    (currentPage - 1) * pagesize,
                                    currentPage * pagesize
                                )
                            "
                  style="width:100%">
                  <el-table-column label="No." type="index"></el-table-column>
                  <el-table-column label="Producto" prop="descripcion"></el-table-column>
                  <el-table-column label="Acciones" width="200">
                    <template slot-scope="scope">
                      <el-button
                        size="mini"
                        @click="
                                            handleEdit(
                                                scope.row.id_producto,
                                                scope.row.descripcion
                                            )
                                        "
                      >Editar</el-button>
                      <el-button
                        size="mini"
                        type="danger"
                        @click="handleDelete(scope.row.id_producto)"
                        v-loading.fullscreen.lock="EditscreenLoading"
                      >Eliminar</el-button>
                    </template>
                  </el-table-column>
                </el-table>-->
                <!-- <div style="text-align: left;margin-top: 30px;">
                  <el-pagination
                    background
                    layout="total,prev, pager, next"
                    :total="total"
                    @current-change="current_change"
                  ></el-pagination>
                </div>-->
                <!-- <el-dialog
                  title="Modificación"
                  :visible.sync="dialogo"
                  width="70%"
                  top="3vh"
                  destroy-on-close>
                  <el-form :inline="false" :model="formEdit" ref="form" :rule="rules" label-width="150px">
                    <el-form-item label="Nombre Anterior">
                      <label style="color:red;">
                        {{
                        descripcion_seleccion
                        }}
                      </label>
                    </el-form-item>
                    <el-form-item label="Nuevo Nombre">
                      <el-input v-model="formEdit.name"></el-input>
                    </el-form-item>
                    <el-form-item>
                      <el-button
                        type="primary"
                        @click="editProduct()"
                        v-loading.fullscreen.lock="EditscreenLoading"
                      >Guardar</el-button>
                    </el-form-item>
                  </el-form>
                </el-dialog>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                options: [{
                    value: 'Option1',
                    label: 'Option1'
                }, {
                    value: 'Option2',
                    label: 'Option2'
                }, {
                    value: 'Option3',
                    label: 'Option3'
                }, {
                    value: 'Option4',
                    label: 'Option4'
                }, {
                    value: 'Option5',
                    label: 'Option5'
                }],

                total: 0,
                currentPage: 1,
                pagesize: 10,
                nowYear: "",
                form: {
                    unidad: "",
                    grupo: "",
                    seccion: "",
                    tipo: "",
                    bien: "",
                    estado: "",
                    producto: "",
                    comentario: "",
                    modelo: "",
                    serie: "",
                    marca: "",
                    localidad: "",
                    proveedor: "",
                    dependencia: "",
                    cuenta_nueva: "",
                    respaldo: "",
                    secuencia:"",
                    nFactura: "",
                    costo: "",
                    serie:"",
                    alza: "",
                    baja: "",
                    saldo: "",
                    sicoin: "",
                    empleado: "",
                    fIngreso: "",
                    categoria: "",

                },
                formEdit: {
                    name: ""
                },
                listProduct: [],
                rules: {
                    unidad: [
                        {
                            required: true,
                            message: "Seleccione unidad",
                            trigger: "blur"
                        }
                    ],
                    grupo: [
                        {
                            required: true,
                            message: "Seleccione Grupo",
                            trigger: "blur"
                        }
                    ],
                    seccion: [
                        {
                            required: true,
                            message: "Selecciones Seccion",
                            trigger: "blur"
                        }
                    ],
                    tipo: [
                        {
                            required: true,
                            message: "Seleccione Tipo",
                            trigger: "blur"
                        }
                    ],
                    bien: [
                        {
                            required: true,
                            message: "Seleccione Bien",
                            trigger: "blur"
                        }
                    ],
                    estado: [
                        {
                            required: true,
                            message: "Seleccione Estado",
                            trigger: "blur"
                        }
                    ],
                    producto: [
                        {
                            required: true,
                            message: "El campo Producto no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    localidad: [
                        {
                            required: true,
                            message: "El campo Localidad no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    empleado: [
                        {
                            required: true,
                            message: "El campo Empleado no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    dependencia: [
                        {
                            required: true,
                            message: "El campo Dependencia no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    cuenta_nueva: [
                        {
                            required: true,
                            message: "El campo Cuenta Nueva no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    respaldo: [
                        {
                            required: true,
                            message: "El campo respaldo no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    secuencia: [
                        {
                            required: true,
                            message: "El campo Secuencia no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    nFactura: [
                        {
                            required: true,
                            message: "El campo Número Factura no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    costo: [
                        {
                            required: true,
                            message: "El campo Costo Factura no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    serie: [
                        {
                            required: true,
                            message: "El campo serie Factura no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                   

                    fIngreso: [
                        {
                            required: true,
                            message: "El campo Fecha no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    categoria: [
                        {
                            required: true,
                            message: "El campo Categoría no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    proveedor: [
                        {
                            required: true,
                            message: "El campo Proveedor no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    sicoin: [
                        {
                            required: true,
                            message: "El campo Sicoin no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    
                    alza: [
                        {
                            required: true,
                            message: "El campo Alza no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    baja: [
                        {
                            required: true,
                            message: "El campo Baja no puede estar vacio",
                            trigger: "blur"
                        }
                    ]
                },
                fullscreenLoading: false,
                EditscreenLoading: false,
                dialogo: false,
                id_seleccion: 0,
                descripcion_seleccion: "",
                dataSatProvider: [],
                nit:"",
                visible: true,
                codeBar: "",
                urlData: {
                    urlEntity: "entidades",
                    urlSat: "http://gestorquejas.diaco.gob.gt/Consulta/rs/proveedores/empresa?nit=",
                    barCode: "barCode",
                    unidades: "unidades",
                    grupos: "grupos",
                    categorias: "categorias",
                    secciones: "secciones",
                    tipos: "tipos",
                    Bienes: "Bienes",
                    EstadosProducto: "EstadosProducto",
                    addProductoBien: 'addproductobien',
                    getPersonas: 'PersonasEntidad',
                    dependencias: "dependencias"
                },
                entity: "",
                identity: "",
                unidades: [],
                grupos: [],
                categorias: [],
                secciones: [],
                tipos: [],
                Bienes: [],
                EstadosProducto: [],
                PersonasData: [],
                dependencias: [],

            };
        },
        mounted() {
            this.getAll();
            this.getYear();
            this.getEntity();
            this.getUnidad();
            this.getGrupo();
            this.getBienes();
            this.getEstadosProductos();
            this.getDependencias();

        },
        methods: {
            getProviderSat(){
                const config = { headers: {'Content-Type': 'application/json'} };
                axios.get(this.urlData.urlSat+this.nit,config).then(response => {
                    this.dataSatProvider = [];
                   this.dataSatProvider.push({
                       nit: response.data.value.nitProveedor,
                       name: response.data.value.nombre,
                       business_address: response.data.value.direccion
                   });
                })
            },
            searchProvider (){
              this.visible = true;
              this.nit = this.form.proveedor;
              this.getProviderSat();
            },
            getCodeBar(){
                axios.post(this.urlData.barCode,{codeBar: this.form.sicoin}).then(response => {
                    this.codeBar = response.data
                })
            },
            getEntity() {
                axios.get(this.urlData.urlEntity)
                    .then(response => {
                        this.entity = response.data[0].name;
                        this.identity = response.data[0].id_entidad;
                        this.getPersonas(this.identity);
                    })
            },
            getUnidad() {
                axios.get(this.urlData.unidades)
                    .then(response => {
                        this.unidades = response.data;
                    })
            },
            getGrupo() {
                axios.get(this.urlData.grupos)
                    .then(response => {
                        this.grupos = response.data;
                    })
            },
            getCategorias() {
                axios.post(this.urlData.categorias,{grupo: this.form.grupo})
                    .then(response => {
                        this.categorias = response.data;
                    })
            },
            getSecciones() {
                axios.post(this.urlData.secciones,{categoria: this.form.categoria})
                    .then(response => {
                        this.secciones = response.data;
                    })
            },
            getTipos() {
                axios.post(this.urlData.tipos,{seccion: this.form.seccion})
                    .then(response => {
                        this.tipos = response.data;
                    })
            },
            getBienes() {
                axios.post(this.urlData.Bienes,{bien: this.form.tipo})
                    .then(response => {
                        this.Bienes = response.data;
                    })
            },
            getEstadosProductos() {
                axios.get(this.urlData.EstadosProducto)
                    .then(response => {
                        this.EstadosProducto = response.data;
                    })
            },

            // addProduct(){
            //     axios.post(this.urlData.addProductoBien,{des_producto: this.form.producto})
            //         .then(response => {

            //         });
            // },

            getPersonas(entidad){
                console.log(entidad);
                axios.post(this.urlData.getPersonas,{entidad: entidad})
                    .then(response => {
                        this.PersonasData = response.data;
                        console.log(response.data);
                    })
            },

            getDependencias(){
                axios.get(this.urlData.dependencias)
                    .then(response => {
                        this.dependencias = response.data;
                    })
            },







            getSaldo() {
                this.form.saldo = 'Q. ' + (this.form.alza - this.form.baja);
            },
            getYear() {
                let url = "getYear";
                axios.get(url).then(response => {
                    this.nowYear = response.data;
                    console.log(this.nowYear);
                })
            },
            onSubmit(form) {
                const h = this.$createElement;
                this.$refs[form].validate(valid => {
                    if (valid) {
                        this.fullscreenLoading = true;
                        let url = "addProduct";
                        axios
                            .post(url, {
                                nameP: this.form.name
                            })
                            .then(response => {
                                const status = JSON.parse(response.status);
                                if (status == "200") {
                                    this.$message({
                                        message: h("p", null, [
                                            h("i", {style: "color: teal"}, "Producto Agregado!")
                                        ]),
                                        type: "success"
                                    });
                                    this.fullscreenLoading = false;
                                    this.form.name = "";
                                    this.getAll();
                                }
                            });
                    } else {
                        this.$message.error({
                            message: h("p", null, [
                                h("i", {style: "color: red"}, "Ingrese un Nombre de Categoria")
                            ])
                        });
                        return false;
                    }
                });
            },
            getAll() {
                let url = "allProduct";
                axios.get(url).then(response => {
                    this.listProduct = response.data;
                    this.total = response.data.length;
                });
            },
            editProduct() {
                const h = this.$createElement;
                let url = "editProduct";
                this.EditscreenLoading = true;
                axios
                    .post(url, {
                        id: this.id_seleccion,
                        new: this.formEdit.name
                    })
                    .then(response => {
                        const status = JSON.parse(response.status);
                        if (status == "200") {
                            this.$message({
                                message: h("p", null, [
                                    h("i", {style: "color: teal"}, "Cambio realizado con exito!")
                                ]),
                                type: "success"
                            });
                            this.EditscreenLoading = false;
                            this.formEdit.name = "";
                            this.dialogo = false;
                            this.getAll();
                        }
                    });
            },
            current_change: function (currentPage) {
                this.currentPage = currentPage;
            },
            handleEdit(producto, desc) {
                this.dialogo = true;
                this.id_seleccion = producto;
                this.descripcion_seleccion = desc;
            },
            handleDelete(code) {
                const h = this.$createElement;
                let url = "deleteProductById";
                this.EditscreenLoading = true;
                axios
                    .post(url, {
                        id: code
                    })
                    .then(response => {
                        const status = JSON.parse(response.status);
                        if (status == "200") {
                            this.$message({
                                message: h("p", null, [
                                    h("i", {style: "color: teal"}, "Producto Eliminado")
                                ]),
                                type: "success"
                            });
                            this.EditscreenLoading = false;
                            this.formEdit.name = "";
                            this.dialogo = false;
                            this.getAll();
                        }
                    });
            }
        }
    };
</script>
