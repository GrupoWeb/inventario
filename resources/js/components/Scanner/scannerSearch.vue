<template>
    <div>
        
        <div class="card">
            <div class="card-header text-white bg-primary">
                Sistema de SICOIN
            </div>
            <div class="card-body">
                <el-form 
                ref="form"
                :model="form"
                :rules="rules"
                label-width="150px">
                <el-form-item label="SICOIN" prop="name">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" icon="el-icon-search" @click="onSubmit('form')" ></el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
        <div class="cardCenter">
            <el-row>
                <el-col :span="12" >
                    <el-card :body-style="{ padding: '0px' }">
                    
                    <div style="padding: 14px;">
                        <span class="font-weight-bold text-uppercase">Información del Bien</span>
                        <div class="bottom clearfix">
                            <div v-for="(items, i) in listProduct" :key="i">
                                <el-row :gutter="10">
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="8">
                                        <span class="font-weight-bold">Código Sicoin:</span>
                                    </el-col>
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="8">
                                            {{ items.codigo_sicoin}}
                                    </el-col>
                                </el-row>
                                <el-row :gutter="10">
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="8">
                                        <span class="font-weight-bold">Bien:</span>
                                    </el-col>
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="20">
                                            {{ items.descripcion}}
                                    </el-col>
                                </el-row>
                                <el-row :gutter="10">
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="8">
                                        <span class="font-weight-bold">Sistema:</span>
                                    </el-col>
                                    <el-col :xs="25" :sm="6" :md="8" :lg="20" :xl="15">
                                            {{ items.cantidad}} Unidad
                                    </el-col>
                                </el-row>
                                <el-form ref="form" :model="form" :rules="rules" label-width="120px"> 
                                    <el-form-item label="Físico:" prop="unidad">
                                        <el-input class="font_custom_input" v-model="form.fisico"></el-input>
                                    </el-form-item>
                                    <el-form-item label="Lugar:" prop="unidad">
                                        <el-input class="font_custom_input" v-model="form.lugar"></el-input>
                                    </el-form-item>
                                    <el-form-item label="Empleado:" prop="unidad">
                                        <el-input class="font_custom_input" v-model="form.empleado"></el-input>
                                    </el-form-item>

                            </el-form>
                            </div>
                            
                            <!-- <el-button type="text" class="button">Operating</el-button> -->
                        </div>
                    </div>
                    </el-card>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<style >
    .title_bien{
        font-style: bold !important;
        
    }
    /* .cardCenter{
        top: 50%;
        left: 50%;
        width: 600px;  
         margin-top: -200px;
        margin-left: 30%;
} */

</style>
<script>
export default {
    data() {
        return {
            form: {
                name: "",
                fisico: "",
                lugar: "",
                empleado: "",
            },
            listProduct: [],
            rules: {
                name: [
                    {
                        required: true,
                        message: "Este campo no puede ser vacio",
                        trigger: "blur"
                    }
                ]
            },
            fullscreenLoading: false,
            urlData: {
                    searchCode: "searchCode/",
                    
                },
        }
    },
    methods: {
        onSubmit(form) {
            // console.log(this.urlData.searchCode)
            const h = this.$createElement;
            this.$refs[form].validate(valid => {
                if (valid) {
                    this.fullscreenLoading = true;
                    axios
                        .get(this.urlData.searchCode+this.form.name)
                        .then(response => {
                            const status = JSON.parse(response.status); 
                            this.listProduct = response.data;
                            if (status == "200") {
                                // this.$message({
                                //     message: h("p", null, [
                                //         h(
                                //             "i",
                                //             { style: "color: teal" },
                                //             "Producto Agregado!"
                                //         )
                                //     ]),
                                //     type: "success"
                                // });
                                this.fullscreenLoading = false;
                                this.form.code = "";
                                
                            }
                        });
                } else {
                    this.$message.error({
                        message: h("p", null, [
                            h(
                                "i",
                                { style: "color: red" },
                                "Complete datos" 
                            )
                        ])
                    });
                    return false;
                }
            });
        },
    }
}
</script>