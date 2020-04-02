<template>
    <div>
        <div class="card">
            <div class="card-header text-white bg-primary">
                <el-row :gutter="10">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="20">
                        Entidad: <span class="pl-3">Ministerio de Economía </span>
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
                            <el-form-item label="Unidad Administrativa Inventario:">
                               <el-select v-model="form.estadoP" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    Grupo y Categoria -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Grupo:" prop="folio">
                                <el-select class="select_width" v-model="form.estadoP" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Categoría:" prop="folio">
                                <el-select class="select_width" v-model="form.estadoP" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    seccion y tipo -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Seccion:" prop="folio">
                                <el-select class="select_width" v-model="form.estadoP" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                            <el-form-item label="Tipo:" prop="folio">
                                <el-select class="select_width" v-model="form.estadoP" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    >
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <!--                    Bien  -->
                    <el-row :gutter="10">
                        <el-col :span="12">
                            <el-form-item label="Bien:">
                                <el-select v-model="form.estadoP" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Estado del Bien:">
                                <el-select v-model="form.estadoP" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
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
                            <el-form-item label="Comentario:" prop="comentario">
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
                                <el-select v-model="form.localidad" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
<!--                    empleado, dependencia y cuenta -->
                    <el-row :gutter="10">
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Empleado:" prop="empleado">
                                <el-select class="select_width" v-model="form.empleado" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Dependencia:" prop="dependencia">
                                <el-select class="select_width" v-model="form.dependencia" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                            <el-form-item label="Cuenta:" prop="cuenta_nueva">
                                <el-select class="select_width" v-model="form.cuenta_nueva" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <!--          respaldo y secuencia  -->
                    <el-row :gutter="10">
                        <el-col :span="12">
                            <el-form-item label="Tipo documento respaldo:">
                                <el-select v-model="form.estadoP" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Secuencia:">
                                <el-select v-model="form.estadoP" class="select_width" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
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
                            <el-form-item label="Serie:" prop="estadoP">
                                <el-input class="font_custom_input" v-model="form.costo"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Proveedor:" prop="proveedor">
                                <el-select class="select_width" v-model="form.proveedor" clearable filterable placeholder="Seleccionar">
                                    <el-option
                                        v-for="item in options"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                        clearable>
                                    </el-option>
                                </el-select>
                            </el-form-item>
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
                            <el-form-item label="Saldo:" prop="baja">
                                <el-input class="font_custom_input" v-model="form.saldo" disabled></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="SICOIN:" prop="sicoin">
                                <el-input class="font_custom_input" v-model="form.sicoin"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                            <el-form-item label="Código Barras:">
                                <el-image style="width: 100%; height: 100px"
                                          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASEAAACvCAMAAACFDpg1AAAAgVBMVEUAAAD+/v7///8BAQH9/f3Dw8N0dHTx8fHd3d3n5+f6+vqlpaXk5OS6urojIyP19fWTk5M+Pj7Q0NBdXV04ODgyMjIRERFoaGirq6tubm7KysqdnZ15eXmRkZF/f38pKSmxsbFERESJiYlPT08dHR01NTVaWlpLS0sODg7W1tYYGBjDVQH+AAAZKUlEQVR4nN1dC1vivBJOsoOFAFZRREUF0VXx///AM7k2bdN2UoLud/rsAra59c3cM00ZBw4AHA/15f7Qn+A+ef2whZqn8x/Q+I5eBh4tNVQndj1ah9U7cB8OHO4/6/VFc4ghjm1E9Slo1qmPuYIDakPxF8PewpqNM9Aq7UYYlnZFomOrnWG1sVX/Eo/z05PIXJrcHrPfUJuG6npryhOPjvqdzUL8dFp3GQ9QNGSZCr+l/QZ/uCvc857jKcdW7hdAWKu6oj4ENI+gjda1eku+o0YXPBhnda1ZzBzSFhVBM7zqOmwHT8r6bTDHvEIIkPpDfZoDC5sfZjhc/WVaURcN3emfehiuBWHvKKzL8VtK7hoOGuG+P9OZBD8IkHhVN28arAYmVT3Ts+nQjBR74K0GzWndt4HIDhJM5WBUuh89PNu2Q0gdYjLfTrjcz+crXsztcV/y1Vb9mFimxSvbBf4WR3VRKIgE7OfbI56TMyxYwHG7vbcQyXvdykLhc9zO7yU8upZXWESU2/l2ho3IlT63lHKprhTqNCyw4xKHKCbb+VKY2Sy2bmCF+huvTACHvF2p6ws8PzP9wkQV2q6g1CPA1hCW1Xa7t5OqTh/VCKZqyGLlRoW3CQIvbqdyulVXtP4xCAnxwNiDgDVjW1Ewe7wX4ln/eDAIicUXY48KoXvG/pb6pJBYZ67OrbDgQswZu7N4yktdWVfYY2uleHEtH9S5Gf6Yqh9bfe4G5Adjz2KBv1fiET81Qk+MfbjuXfW7maq2YWwjip0aMv6lKhxtwQdd6krMvvUP18nOUklxqYas0NcXr1yzF3pUeI8TscQ/Z8LSkP4SF6oAXKuqiNAfdbCdQkj9uDBlxexSDd4g9OoQurYIHXHkC3Xl0ky5wg7reoTWCqE/puVnNVsGIRzoXHeyAbhRt9VACFG9qRCyA9MI6UktbgOEprbghW4QEdrpETiEbh1COKn3FUJb1+yTsPcYIgRMC6FBhHgcIQgQWg0jdAgQCmjIISSzIAR5EUKLkURDHQh10RDPjJDWXVloSDXZjRA0EQIjqYGAEAwitDojQr/IZWQaiiEEfTQEAwjBiQiJsQhBB0KsCyHOKQhpLdmDELQlNachBDSEoI4Qb9AQOIS0lZNXUpPlUBuhfi4bQOh8XJYXoR5tzwxCjCqp/9tyiPVwGZGGIEmXQW4aGuAyui7rlEM9NAR5LMaz0hDko6FehKCJkPM6IIM9lGgxJkpqKkIwWtufymUD9hDUEBL/rBzS3JpoMQJJ26fSEJBpCA2bEXLoR3UZyaY2DGwQQoPD+2XwM16HufEcCAU0BMM0BEC2GDtoSPyQX6bby8Jl55NDXVzG/0/soZO1vaFey2Vxr+P/EiHwcepxNrUKP7e5bGfj0P+p+FCfTU2WQ0C3qX/PHjoLl1nYB+2hNkLQh9Cvea65uUzrv5GSuhOh3+Syn5NDrejHAJf9E9EPGEZoTASNEoXt0vZxr0OvIeaVQ3ASDcEpUViSpG749nun7X/Qpv49SU3msqwxRqAhBLkR6vZcT9f20KKhYL2sFacmcxkJIaBzGfTFqXm4GkT2y06IU1e67F+yqXP69n7dPnf04/9LDpmUkLGRfN6mod1/0R6Keh3c6DIgxYc0f9c9V+PzWoQg9MtMuuA5I/k9cugMuqyDhlprHW3fPm5TGxqCACH4yQha74qiFqdJkhoSoh8RSQ1xhCBF2wMls6HJZTy/pO7U9tQ114rLOAxyGdC5bNyqtBpECkKhTc3pXAZ0vyy6bl/PH6rLoUEaSspsaNFQJ5eNXw2KrnWYDCsgrZd1rLnyH1lz1Q8L1Lmsi4agj8v6LEYWk0M2B43CZbppz2XOplbyOGZT63Fm5DKgr0r367JQUtOiHzr3g5KlBxWX+dUgXTPuddARoukyaNCQ6nDkiiL06LLmqrS6Q7LnGnAZBF5HnMu0kZWVy5ravgMhiGt7iGXpkbQ9uOc6hm3qNDnEa7osgz2UsOaaPzsGKBG0CJcZzdrhuQ769smSug8hIEpq83hADw01cz+SfPuQhvaROPU5/bIki/EMK4q0KGw7Tq0hjuuywUxPOC2Psc/roCIU0fYdCBHj1L3xoXPbQ9BEqFtSx7gMAi7ry7BqcZnKsAKi5zq41hEglOSX/eiaKx/gspgcAlp2DI+sKAbr9nhxdY4obJWlR4/C9nNZr8XYltSKhkytvKvS56Ahsj0UQQio62VRLjtBDlUItSL5nKrtyev2eZ7rGKfLiNGPaE7+WK8D0hBKkNT9NjVP8Tq4yYXtsodqNjUEkhricug/t6IIdJualvvRj9CZMxvgDAhlf74sQQ4RtP2pCI307YcQ6pDUFIQgiORXubA+PsRbciirpDaWXjdCQNdlkBL94Cb6QaOhiG/fw2V1m/o/4Nv3ex1EOcSbcqibhjidhvoRgq74UI9NnTOf2nsdab59EIWNx4dEg8tiNHTqM4ppkfzx+UP09bIOLuuSQ0NeR6JvrxskITTkdSTmoCVkNsRijD/m22eUQyMi+dQ4dUvb8zqX1WKMwyuKiZ5ri4YgHmOE+FoHdUWxpcv6VoOaceqoPQSjEUqlIbJvP06X9Wac03z79qp0I8a4SuOytDVXvTcOZVUa4jloEHAZp+sybjMbiPGhiLaHH8qwEufwy/Lmwta0Pc0vG9D2p3muPANCMZu6Kyc/LX+Ih/lDXXIory6DBM91bIwxGkEDm2E1LIcMKzb9MoBOSZ3Z62jFhzrl0IDFqG46ZVXaansCQoFvD+FqUDzGyOurQX0IETMbMskh3s9lba/jtJ1R6tGPfyUXtp/LAr+MYlMbOZQayYfApu55aoHKZb1ZemNy8qlZegRJbWmIYlNDzLevc1lzR4LMax15VoN4/4piW1KDXS+j7NkQtxi75FBum7oZQetACAYQ6uGy8+8dM3I1iKjL+rksjDEOea5xGjJeRzT3A9xSN93rCG3q7vyhzJK6l8uA7JeNoSGib59EQ5opMq8oEhGi537Qn+JM9TqAtiqdeS89IOd+DEQ/klelaRlWcYux0vbt1aABizFNlw2tdQwhBEEeY0p2DEBKnDq+Kt1pU5/ZYhQ/+hQnpFmMnBCFHcxBS+QynpDZ0L/W0RuFjXod5KcWYnIIMsgh2v5DubyObho6+cmXqC4bj1CiHErxOvJH0E7R9jS/7GfXOjL6Zf00VM+OCeJDQU4+dOXC6k3Pc665NuPUEF/rgP5npWsRNEp2DMDZLMZz67If5TKaHIrQEHR7HTr6SIugkZ5RHFjrCGmIbA+R1jpU7scJFmOf15F1L72IxRiPwnZwGYB7vqw7O6bDpoaEtY529AP6orD9NJQcH2pyWdpTnOfPQYOoxRhwWTuP8Zeetx+55tqDED33o0VDvLYa1Mz9yPwUZ++6fYjQQP5Qkk1t11xpGVYxbd+VYSVIq0FFkrZveh11hKodvOO6zPn2vNseiml7vxqUKIeGJTXkfoqTLIcgLodiCNFyP1K4LEZDGbT9yNyP7mel88ohenZMJJ86sBiTddnvWIx8VHbMaM+V99vUv6PLRF6bWtCjsOGaq8/07IwPNdbLcmR69nIZPZI/Rtsn+2W0+NC539fxc3vpGZmRQkOEnHxCPvX5EOq1h0QnQj0RNCINtePUvZI6+7PSeaKw3fZQz3uDSAhBzR7a//SzQSn2UM4cNKvtgeaXJcapc2Y2JEVhT9mhKWYx0uPUAzb1P7EvrBOqOXXZCev24XoZ1P0yXpPUOWzqLBZj+qo0JCDUshhDSd2moax7x5ys7c8SH2o959pec60sRkjN0oNEGqJK6kE5lBbJ5+Pe+RLEh2I7NO3MhazPdbTWOrpz8nt9+1G6jGYPBVl6hAjar+qyU3aKiz75QpZDiXuc/847X2DgGcVuGuqIoPXsC9v3jOLwalBmhIBKQwMxxgEaEp00lPoEXq9vvzNWya/oMpEgqck7VqZzGQS6LEJDZudcqrYn6bKUSP5YOdShy9Rug0DyOqB3RRFaCOWhoWCP8z45BFAhFLOpIbbWkffdUzBsMf4sl3Vk6Z3FYnSBS3rGOWn35dw0xBu7np6eg0bYS0/TUOdqUCuSH9FlvCM7hrCieOpOcWlPAg/mU8dt6oT1snCP8+H8IUiwGKmSmup1xOUQ0HRZWw6Rs4UN9VJ9++wWYz6buouGeiS1qfTjUdj03A/yvh8Zny8DPiqPEao3mkQl9e++rVScQkNxr4Mqh+LaPvqcq+W/vHmMp8SpxUn2EDX6EfXte55aoGZYUd8kQPZcqc9KU9Y6+KgMK4g8o8jbMcac+dQZPddOXRbbBd6sBo1fL+vwOpykhnyZDdowIT75MkRDSXucZ8gW/qE1V2jYQ7wz03Mw+pHwnCu3nmsHl3Xb1ANPT53pvUHnfWtyp01N3geti4ZOzjgfG8nP/tbkDLkffZ5r0y+jPz3VjxBktxjTdBmQ3z0V1/a8Q9ufxab+pTVX+n6M7egH7/M6YDgXNoGG2jn5PQiNzBbu9joASDsSVDa1oL2b/MxPT3WvKI7cS6+HhqheR+T9ZR3RD0IuLNZMsqmpCA3Fh5Jtavp6WeTJl14uoz4rTdNlA7vAw5A9NDY7JiE+BIHnSsqnzv7uKdqOBGNjjD3aHqiS2tZ+pNlDmaOwLZu6U1JHY4wjbWpnD422qYN1+2RtnyipW35ZB0IdT+ANcxnrzkGja/soDZEyG073XAfsITjbahDQc2GDt5XGd6ysxYfqcigmqSEpPtTa9bTxJLBbUYT4jpVhJL9vp7jI+zro6/b973yB9runsq5KU3XZCXsLd+4Cf2L04x/0XAfeRjFij3Mil0Xyh3okNYQRtBxvK+2lodBiJOcPJcghiucaeB0QINSxZwMMviUw9e1cLRrq9Dp6uYynZcfw3gjayVxGo6Hsvn2vLuNn47Iwks8Hc/KNyqDpspFeB3R5HYNcli6pSTQkUmkIvKRe5aEhKkKD8aFkhE7YO6aeHUN4j+LLKVx2Upw63Dk36X2uXRE0c1xqr4OpgVhBcFfZ1LeOhv5WCDGN0LfRfFzudGXHZZcKIXvUdz3d6nMbgBhCT4x9VHLIHO8OoY2+W42QutujRehBl7rSd8sqGlo7ObSz6tcgdOWavejwXNtyaLN5UMfmqRB79XOzdV7HxcPmqIez2by49bKXzWaptNd0s7mYcbzy5CzGF6y82UzVfT7i6VLcm4YfNnvVSLF52CwESL40nciQho43D5tSKiG12Ty7IPDDgxuY6nm72Wyh1N1jF0cc9cLQLmx1g0tePKkfNwtF60scsgGQF1hnog0UrDMTSzeqeReXNWkIhDtAuh+6EKgrluaEkOYXmOsgwVcwm/FyWxlHbGpKKaqWwdRUAt13EiBketA8YbtXJX11qZo39U3voFvRkw2y6tiWxuLSFqyGbBsHqO6Xt2kojpAEd3D9W+r70Uagpjh7yYynOuOq6HikKVD/rJXi7fMhDVWtdZSuV2110OrPWDW1c7xZ13nnQ36ZwcIQCHcH1P4A90/X5SZ+0z4ajYhYmeAIEQpO+9+1MYQN13qH8M+wHYgPMmwzmtmgL4gGQhXhOQYzMSyhiBU4+HuXUp1UhGzG6dgRXDk7WbqeKsfdXGo/Qtc1LActhMBxp2EJiwTotuw5Rwj6FsAylMXC1NXjkGZgEN6XOeNGq8cLEJFDsTxG/Ls8PNtjyy2DqR73r4z9vQcRcJJ4/ED9flVawrP0DHJxuALjkutzUtxj27d76W5dfS22bziQ13vp0mlCLtNjl3JxoZTMzCJrah6x3PuhlNKho77nqFNfl2oK3Dhm85tvMzbpCFBM3I0djk66cS1LZodnhW707e0RLqsUPnsVftZRLX4/fJisRUtXWmFuNljX07EhJLzZnZtePXdoCqm6z8LPOheX7HJzYdMgNaHVaEhPwmLNPi52bFcKJ+DQrHhnn3juunTDUGM7sN0F4r2sGEdbUhfY5w2XpjG8/2d/Y0vhZk+zwgO7K30svr27TpuG9ua4QovDM+mM7aZc3rPviuSFWLOJlI9faAmFQgeNQPbX8aL6e8k+FxyWyjry0gBeViWI8pmtpTlVQ0iDhnd5Jfnsle2FR7t8Zc8lL97YQXDHsGiMXc+43LJXL4aQqpaF5BL7nFbjPZr7Wr6i7eTIjxuL9lItYMYzPdsISacnL7Cwn5OJdu3KO1Z6OYTE9iax9MZKDouQOH5dfv8NhKF4ZStDSRvh+R/rSb2S+l6YQbQktZCfbCqVSbn1E4C3/Fpgnzjgwo1NWaTPyGAFuxNebmsmxC6ule3gRYW5ryl7hXACp7u778uyrctUiZi2d/IEy22Eo2RlNH/i0I7oVUg/JyX7nkqJhu1C8Eoq4ATfr9dWCKqGSsa04bFEWq6sBWPjPLJrK3Pbukx8IDcoG3npx4EjRVbV5vDSS3C+ZDcolx7ZG1SkbARw8cVmNRWCB47vKDxhIZYbtr1+L/VdxjI9I1xmKh+/doWsdCHOxkVRfCiK97oMB/+2KA/spaaen9mhuFw7WlHms3FnVccrT5SmidkndilNMK4hhzT1v0/w41oKz8Br5ccU67sHLdQMzIBz9FLOrpHluScicxOKbGUwODUTB2a9BHsTc/ZQrN/jcijm24OlyeJVSQ2rG1RnKCLf3tiLdCNQX7Nb9veGfRSVESWR2G6LGSIkPDNKxpTpqZysZWDeoJIpN2wjLQs05JA6Uz6wrwv2bhbCNGbI5TMOBzbfswdrxGpy/2Ifr1jbg2EtwTl6l7wiF11+zz5K8DYBIM9dLjRCvBnJN3Koi4ZQaDwLj4RSNbreBiGoTEEpjtjidWFHZvTCLSI70zRklI/mli0XoFjjXhuYlg0kdoKs61zdhk2NzSuJrP6U/r6LP6zgK9SxyFiBSap0A1KyMSacYSCR/O5WTqAbESD59Ot94QwA/f8N2cIg1KAh3Uptf2peIaRkxltZ6R01WqQhLPBs7XN9lwL1zO0X2xQgvJh+QS2DHf0VwhsxKnh0s0WOfGJ7zy/q/AEBcpZmS9vj//KCfe/YeuokjooI3BXlJ5ZYsg9v0eBo79TYtt761IgrubcSlaDQ5YtPHIP0glrpgQsEfv0uI14Hr2hIB1tUJGNr5ksuLlUwwYGh6k4RHT5XM+XvSe2OeyORND6ls5tQ8t4WpUQaKkuPMIijooWn4inkMqkBqiRCiWUO3mLUHbyghTFbs8qYgAK5bKvmYI/kbA8lo9kcxYuRL3ZGFUBfR8G9HjOS/goBcUwH+rZ2Myln6/eiRKkrZncOoQW3CFkro8DbkoX+1J0+4XQG2CNv3LAnhPkeG5BWgygj8hVheKyGxqtwizI3HUI43HJWCvlW3byevc8y8Cp199x8Gq/kkX1heYToxtIGkuol23+tkTOvtHowxCfRRkLNfmVDRGZOkXDvjlIGrKhOLv5czqQxhIxTsK3Gq9dCVfd6KNIMgjkUFAvr6IYRiNO790Wln0DrIzY1/HhwNo0UO8RbqJ1dr527pgz7w+H55fv9cJiD9HKeGzsELVfLj8rM2xWVZWuL6E+LoWZYqXm08LB+sC82we9Pdm8JQRW4VMsfOAFmpjSeyC+PwpGOnVNFtgfhT6i6jwc8ng/vd4fDFsB1b2Ihqhyz9Rv+sOZyCOFH6v9TgA7WPTnoQOhJE2idrIX0+lgdhZJDgQjQjeLwLkR16tXA64NO1VS7EhvN9AIUQu6c4nNQ1iGbcivAlUmtsBaHipaVjDuAb96z+6uGLejQlCnWl1KArHVvDla5x16rcx1nre7FzG/5B6U4NqXmznYoxRtyHgJxofO3nKXJtUpQ2t5NHbKOGsaEfU39VCBRfs0KfTh5Bf7Dzgq6ETOsd68cEzdCJI09ktqLDc6CmT11TknZibcEBapU13zVrNy5PCyv/HULSpcpG9/5LNUgmBP8/qQZW4iQvSNk2Iv9HHVX4RSLNm1v9vdI+FNPz7oRMfveVUoFhfD6Zb+8YFqLcBerYmytj8tHF5YEF3UCqynX7Hq7fNL17I2rtIrvq+WDFzlqpiQ6xi/77V/0gdyMKsfYNl+Zh2jdX9o8rLAf5avvvksruz2eph3mpDzUgBPLv8/edHZgb3Vo/mZqDQ4tFfa3WiRPqkHoa6L4uAF/Qus8VWzpgjq6yPWrOa5X1ai4C/qYP7UKZLu5hIo+5VyN43VlZ1zb1OXhHc99bWZVYEZ82OZv5z4wgAh9XC9qCFlrofh4k97dCuFzvn0lh+y3lDYYFUAkZqvJ49HZWuZORHGcTI5Fg95UAyUEtSVWnRzLyrFXbmlZSnfU61aELiQ2v5pVDG9Y+HGyKkStHF88Th6n0stpcwf6KGU19aA6rfXjBFTpxgvVNf3Fgr9qN4gqVNZimIa5nRXIDRGZqBO3OsuPTgelfCE9VcKrA8d74APi0ld3pe2n9j1NY65to6RVRLFWUMU6hYmo29Oy8o+rctiTMaergv4ncF8wLMECwMDh4LnQ2c5QXeX1CkZSeoyBWySaiHlo6jXD2awCF76KpY9wUpvUDrWLsROhAghPVAVFX1OsCkR46RLtvjnFtWvVnAdcbBurnQbuAKzkQHU6nFEOzU/wNcPP+r/6Rd6u4ynFffb1o0f1P4WvI9Jh+31HAAAAAElFTkSuQmCC"></el-image>
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
                    folio: "",
                    libro: "",
                    docEntrada: "",
                    docSalida: "",
                    renglon: "",
                    iFisico: "",
                    noMovimiento: "",
                    cantidad: "",
                    producto: "",
                    comentario: "",
                    modelo: "",
                    serie: "",
                    marca: "",
                    fIngreso: "",
                    localidad: "",
                    empleado: "",
                    categoria: "",
                    dependencia: "",
                    cuenta_nueva: "",
                    nFactura: "",
                    proveedor: "",
                    sicoin: "",
                    costo: "",
                    estadoP: "",
                    alza: "",
                    baja: "",
                    saldo: ""

                },
                formEdit: {
                    name: ""
                },
                listProduct: [],
                rules: {
                    folio: [
                        {
                            required: true,
                            message: "El campo folio no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    libro: [
                        {
                            required: true,
                            message: "El campo libro no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    docEntrada: [
                        {
                            required: true,
                            message: "El campo Documento Entrada no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    costo: [
                        {
                            required: true,
                            message: "El campo Costo no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    renglon: [
                        {
                            required: true,
                            message: "El campo Renglón no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    iFisico: [
                        {
                            required: true,
                            message: "El campo Inventario Fisico no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    noMovimiento: [
                        {
                            required: true,
                            message: "El campo Movimiento no puede estar vacio",
                            trigger: "blur"
                        }
                    ],
                    cantidad: [
                        {
                            required: true,
                            message: "El campo Cantidad no puede estar vacio",
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
                    comentario: [
                        {
                            required: true,
                            message: "El campo Comentario no puede estar vacio",
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
                    categoria: [
                        {
                            required: true,
                            message: "El campo Categoría no puede estar vacio",
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
                    nFactura: [
                        {
                            required: true,
                            message: "El campo Número Factura no puede estar vacio",
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
                    estadoP: [
                        {
                            required: true,
                            message: "El campo Estado no puede estar vacio",
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
                dataSatProvider: []

            };
        },
        mounted() {
            this.getAll();
            this.getYear();
            this.getProviderSat();
        },
        methods: {
            getProviderSat(){
                let urlSat="http://gestorquejas.diaco.gob.gt/file-web-quejaini/rs/proveedores/busca?nit=&nombre=";
                axios.get(urlSat).then(response => {
                    this.dataSatProvider = response.data;
                    console.log(response.data);
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
