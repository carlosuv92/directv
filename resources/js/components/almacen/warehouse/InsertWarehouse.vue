<template lang="pug">
    div
        div(class="page-header")
            div(class="page-title")
        div(class="row")
            div(class="col-lg-12 col-12  layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header" style="padding:5px 10px;")
                        div(class="row")
                            div(class="col-xl-12 col-md-12 col-sm-12 col-12")
                                h3 INGRESAR DATOS DE GUIA: {{guide.guide}}
                    div(class="widget-content widget-content-area" style="padding:5px 10px;")
                        h4(style="color: #e0e6ed; font-size: 0.8rem;") CANTIDAD DE EQUIPOS GUIA: {{guide.amount}}
                        h4(style="color: #e0e6ed; font-size: 0.8rem;") CANTIDAD DE EQUIPOS INGRESADOS: {{decos.total}}
        div(class="row")
            div(class="col-lg-12 col-12  layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-12 col-md-12 col-sm-12 col-12")
                                h4 CAMPOS NECESARIOS
                    div(class="widget-content widget-content-area")
                        div(class="row")
                            div(class="col")
                                div(class="form-group")
                                    label IMEI
                                    input(:disabled="guide.amount == decos.total" class="form-control form-control-sm" v-model="imei" maxlength="15" type="text" placeholder="15 dígitos")
                            div(class="col")
                                div(class="form-group")
                                    label CARD
                                    input(:disabled="guide.amount == decos.total" class="form-control form-control-sm" v-model="card" maxlength="12" type="text" placeholder="12 dígitos")
                            div(class="col")
                                div(class="form-group")
                                    label TIPO
                                    select(:disabled="guide.amount == decos.total" class="form-control form-control-sm")
                                        option TIPO 1
                            div(class="col-xl-2" style="margin: 2.5em 0 0;")
                                button(:disabled="guide.amount == decos.total" class="btn btn-success btn-block" @click="savedeco") AGREGAR
        div(class="row")
            div(class="col-lg-12 col-12 layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-6 col-md-6 col-sm-6 col-6")
                                h4 Search
                            div(class="col-xl-6 col-md-6 col-sm-6 col-6")
                                div(class="row")
                                    div(class="col-xl-5 col-md-5 col-sm-5 col-5")
                                    div(class="col-xl-5 col-md-5 col-sm-5 col-5")
                                        input(type="text" class="form-control" style="margin: 15px 15px;height:35px;float: right;" v-model="search" @keyup.enter="getListDecos()")
                                    div(class="col-xl-2 col-md-2 col-sm-2 col-2")
                                        button(class="btn btn-warning mb-2 mr-2 btn-rounded" style="margin: 15px 15px;float: right;" @click="getListDecos()") Search
                    div(class="widget-content widget-content-area")
                        div(class="table-responsive")
                            table(class="table table-bordered table-hover table-striped mb-4")
                                thead
                                    tr
                                        th Guia
                                        th Date
                                        th IMEI
                                        th IMEI
                                tbody
                                    tr(v-for="deco in decos.data" :key="deco.id")
                                        td {{deco.guide}}
                                        td {{deco.created_at}}
                                        td {{deco.imei}}
                                        td {{deco.card}}
                        div
                            pagination(:data="decos" @pagination-change-page="getListDecos")
</template>

<script>
    export default {
        props: ["guide"],
        data() {
            return {
                decos : {},
                search : '',
                imei : '',
                card : '',
            }
        },
        mounted() {
            this.getListDecos();
        },
        methods:{
            getListDecos(page = 1){
                axios.get("/api/get_decos?page=" + page + "&search=" + this.search + "&id_guide=" + this.guide.id)
                .then((response) => {
                    this.decos = response.data;
                });
            },
            savedeco() {
            if(this.imei.length == 15 && this.card.length == 12){
                const formData = new FormData()
                formData.append('number_guide', this.guide.id)
                formData.append('imei', this.imei)
                formData.append('card', this.card)
                axios.post("/almacen/warehouse", formData, {
                })
                .then((response) => {
                    this.imei=''
                    this.card=''
                    this.getListDecos(1);
                }) .catch((err) => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Equipo repetido',
                        text: 'Verifique el imei o card ingresado.'
                    })
                    this.imei=''
                    this.card=''
                    console.error(err);
                });
            }else{
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Cantidad de digitos',
                        text: 'Verifique el imei o card ingresado.'
                    })
                    this.imei=''
                    this.card=''
            }
        }
        }
    }
</script>
