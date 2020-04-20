<template>
    <div> 
        <el-row :gutter="10">
            <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="20"> 
                Cuenta: 
                
                <el-select v-model="select_item" class="select_width" clearable filterable @change="getBienesAll" placeholder="Seleccionar">
                    <el-option
                        v-for="item in items_account"
                        :key="item.id_cuenta"
                        :label="item.descripcion"
                        :value="item.id_cuenta"
                        >
                    </el-option>
                </el-select>
                
            </el-col>
        </el-row>
        <div v-show="show_table">
            <el-link :underline="false" v-bind:href="'/printer/'+select_item" 
                class=" mt-3 mb-3" target="_blank"
                >
                    <el-button type="success" icon="el-icon-printer"></el-button>
            </el-link>
            <el-button  class="my-5" type="success"  @click="exportExcel" >Exportar</el-button>
            <!-- <a href="./printer/" class="btn btn-primary  mt-3 mb-3" target="_blank">
                                <i class="fas fa-print"></i> 
                            </a> -->
            <el-table
                :data="bien.slice(
                                (currentPage - 1) * pagesize,
                                currentPage * pagesize
                            )"
                style="width:100%"
                
                >
                <el-table-column label="No." type="index"></el-table-column>
                <el-table-column label="Fecha" prop="fecha_ingreso" width="100"></el-table-column>
                <el-table-column label="No. Bien" prop="codigo_sicoin" width="100"></el-table-column>
                <el-table-column label="Producto" prop="descripcion" ></el-table-column>
                <el-table-column label="Sistema" prop="cantidad" width="100"></el-table-column>
                <el-table-column label="Fisico"  width="100"></el-table-column>
                <el-table-column label="Diferencia" width="100"></el-table-column>
            </el-table>
            <div style="text-align: left;margin-top: 30px;">
                <el-pagination
                    background
                    layout="total,prev, pager, next"
                    :total="total"
                    @current-change="current_change"
                ></el-pagination>
            </div>
            <div v-show="show_table_hidden"> 
                <table class="table table-bordered border my-2" id='exportData'>
                              <thead>
                                    <tr class="thead-dark">
                                          <th class="handler_producto">No.</th>
                                          <th class="handler_producto">Fecha</th>
                                          <th class="handler_producto">No. Bien</th>
                                          <th class="handler_Barcode">Producto</th>
                                          <th class="handler_producto">Sistema</th>
                                          <th class="handler_producto">Físico</th>
                                          <th class="handler_producto">Direfencia</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    
                                          <tr v-for="(item, i) in bien" v-bind:key="i">
                                                <td class="handler_for_product">{{ (i+1) }}</td>
                                                <td class="handler_for_product">{{ item.fecha_ingreso }}</td>
                                                <td class="handler_for_product">{{ item.codigo_sicoin }}</td>
                                                <td class="handler_for_description">{{ item.descripcion }}</td>
                                                <td class="handler_for_product">{{ item.cantidad }}</td>
                                                <td class="handler_for_product"></td>
                                                <td class="handler_for_product"></td>
                                                
                                          </tr>
                                   
                              </tbody>
                        </table>
            </div>
            
        </div>
    </div>
</template>

<style lang="css">
    .handler_producto {
                  width: 5%;
                  text-align: center;
                 
            }

            .handler_Barcode{
                  width: 30%;
                  text-align: center;
            }

            .handler_for_product{
                  font-size: 12px;
                  text-align: center;
            }
            .handler_for_description{
                  font-size: 12px;
                  text-align: justify;
            }

            .handler_for_Barcode > div{
                  margin:auto;
            }
</style>
<script>
      import FileSaver from 'file-saver'
      import XLSX from 'xlsx'
export default {
    data() {
        return {
            total: 0,
            currentPage: 1,
            pagesize: 10,
            bien:[],
            select_item:"",
            items_account:[],
            url:{
                    getBienes: 'barCode/',
                    getAccountInitial: 'getAccountInitial',
                },    
            show_table: false,
            show_table_hidden: false,
        }
    },
    mounted() {
        
        this.getAccount();
    },
    methods: {
        getAccount(){
            axios.get(this.url.getAccountInitial).then(response => {
                this.items_account = response.data;
            })
        },
        getBienesAll(){
            this.show_table = true;
            this.bien = [];
            axios.get(this.url.getBienes+this.select_item).then(response => {
                this.bien = response.data
                
                this.total = response.data.length;
                
            })
        },
        current_change: function(currentPage) {
            this.currentPage = currentPage;
        },

         exportExcel () {
                  var table = 'exportData';
                  var name = 'exportData';
                  var DocumentName = "exportData";
                  var link = document.createElement('a');
                  link.download = DocumentName + '.xls';
                  var uri = 'data:application/vnd.ms-excel;base64,'
                  , template = '<html  xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
                  , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                  , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
                        if (!table.nodeType) table = document.getElementById(table)
                        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                        // window.location.href = uri + base64(format(template, ctx))
                        link.href = uri + base64(format(template, ctx));
                        link.click();
                  
            },
        export2(){
            // let data = XLSX.utils.json_to_sheet(this.bien)
            const tbl = document.getElementById('exportData')
            let data = XLSX.utils.table_to_book(tbl)
            const workbook = XLSX.utils.book_new()
            const filename = 'devschile-admins'
            XLSX.utils.book_append_sheet(workbook, data, filename)
            XLSX.writeFile(workbook, `${filename}.xlsx`)
        },
    },
}
</script>