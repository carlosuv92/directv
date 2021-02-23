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
                        h4(style="color: #e0e6ed; font-size: 0.8rem;") CANTIDAD DE EQUIPOS INGRESADOS: {{modems.total}}
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
                                    input(class="form-control form-control-sm" v-model="imei" maxlength="15" type="text" placeholder="15 dígitos")
                            div(class="col")
                                div(class="form-group")
                                    label CARD
                                    input(class="form-control form-control-sm" v-model="card" maxlength="12" type="text" placeholder="12 dígitos")
                            div(class="col")
                                div(class="form-group")
                                    label TIPO
                                    select(class="form-control form-control-sm")
                                        option TIPO 1
                            div(class="col-xl-2" style="margin: 2.5em 0 0;")
                                button(:disabled="guide.amount == modems.total" class="btn btn-success btn-block" @click="saveModem") AGREGAR
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
                                        input(type="text" class="form-control" style="margin: 15px 15px;height:35px;float: right;" v-model="search" @keyup.enter="getListModem()")
                                    div(class="col-xl-2 col-md-2 col-sm-2 col-2")
                                        button(class="btn btn-warning mb-2 mr-2 btn-rounded" style="margin: 15px 15px;float: right;" @click="getListModem()") Search
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
                                    tr(v-for="modem in modems.data" :key="modem.id")
                                        td {{modem.guide}}
                                        td {{modem.created_at}}
                                        td {{modem.imei}}
                                        td {{modem.card}}
                        div
                            pagination(:data="modems" @pagination-change-page="getListModem")
</template>

<script>
    export default {
        props: ["guide"],
        data() {
            return {
                modems : {},
                search : '',
                imei : '',
                card : '',
            }
        },
        mounted() {
            this.getListModem();
        },
        methods:{
            getListModem(page = 1){
                axios.get("/api/get_modems?page=" + page + "&search=" + this.search + "&id_guide=" + this.guide.id)
                .then((response) => {
                    this.modems = response.data;
                });
            },
            saveModem() {
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
                    this.getListModem(1);
                }) .catch((err) => {
                    console.error(err);
                });
            }
        }
        }
    }
</script>
