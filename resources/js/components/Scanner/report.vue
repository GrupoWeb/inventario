<template>
    <div>
        <a href="./printer" class="btn btn-primary  mt-3 mb-3" target="_blank">
                              <i class="fas fa-print"></i> 
                        </a>
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            total: 0,
            currentPage: 1,
            pagesize: 10,
            bien:[],
            url:{
                    getBienes: 'barCode'
                },    
        }
    },
    mounted() {
        this.getBienesAll();
    },
    methods: {
        getBienesAll(){
            axios.get(this.url.getBienes).then(response => {
                this.bien = response.data
                this.total = response.data.length;
            })
        },
        current_change: function(currentPage) {
            this.currentPage = currentPage;
        },
    },
}
</script>