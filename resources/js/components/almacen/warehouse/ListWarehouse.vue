<template lang="pug">
    div
        div(class="page-header")
            div(class="page-title")
                h3 LISTA DE EQUIPOS
            div(style="float: right;margin: 20px 15px 10px;")
                button(class="btn btn-info mb-2 mr-2 btn-rounded" @click="openAssign") Asignar
        div(class="row")
            div(class="col-lg-12 col-12 layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-6 col-md-6 col-sm-6 col-6")
                                h4 TOTAL DE EQUIPOS
                            div(class="col-xl-6 col-md-12 col-sm-12 col-12")
                                div(class="row")
                                    div(class="col-xl-5 col-md-6 col-sm-6 col-4")
                                    div(class="col-xl-5 col-md-4 col-sm-4 col-5")
                                        input(type="text" class="form-control" style="margin: 15px 15px;height:35px;float: right;" v-model="search" @keyup.enter="getListDecos()")
                                    div(class="col-xl-2 col-md-2 col-sm-2 col-3")
                                        button(class="btn btn-warning mb-2 mr-2 btn-rounded" style="margin: 15px 15px;float: right;" @click="getListDecos()") Search
                    div(class="widget-content widget-content-area")
                        div(class="table-responsive")
                            table(class="table table-bordered table-hover table-striped mb-4")
                                thead
                                    tr
                                        th Guia
                                        th Imei
                                        th Card
                                        th Tecnico
                                        th(class="text-center") ESTADO:
                                tbody
                                    tr(v-for="deco in decos.data" :key="deco.id" @click="selectItem(deco.id)"
                                        :style="listDecos.some(function(item) {return item.id === deco.id}) ? 'background-color: rgb(86 118 144) !important': ''")
                                        td {{deco.guide}}
                                        td {{deco.imei}}
                                        td {{deco.card}}
                                        td {{deco.r_name}}
                                        td(class="text-center")
                                            span(class="text-warning" v-if="deco.type_warehouse == 'CAMPO'") {{deco.type_warehouse}}
                                            span(class="text-success" v-if="deco.type_warehouse == 'ALMACEN'") {{deco.type_warehouse}}
                        div
                            pagination(:data="decos" @pagination-change-page="getListDecos")
                assign-warehouse(v-if="showModal" @close="close" @print="openPrint" :arr_decos="listDecos" :type="2")
                print-warehouse(v-if="showPrint" :guide_out="guide_out" @close="showPrint = false")
        </tr>
</template>

<script>
    // Assign type 2 reasignar
    import { eventBus } from "../../../app.js";
    export default {
        data() {
            return {
                showModal : false,
                showPrint : false,
                decos : {},
                search : '',
                listDecos : [],
                guide_out:''
            }
        },
        mounted() {
            eventBus.$on('getListDecos', this.getListDecos)
            this.getListDecos();
        },
        methods: {
            getListDecos(page = 1){
                axios.get("/api/get_all_decos?page=" + page + "&search=" + this.search)
                .then((response) => {
                    this.decos = response.data;
                });
            },
            selectItem(id){
                if(this.listDecos.some(function(item) {return item.id === id})){
                    this.listDecos = this.listDecos.filter(item => item.id !== id)
                }else{
                    this.listDecos.push({"id": id})
                }
            },
            close() {
                this.showModal = false;
            },
            openPrint(id) {
                this.guide_out = id;
                this.listDecos = [];
                this.showPrint = true;
            },
            openAssign(){
                if(this.listDecos.length > 0){
                    this.showModal = true
                }else{
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Cantidad de Equipos',
                        text: 'Seleccione minimo un equipo.'
                    })
                }
            }
        },
        created(){
        }
    }
</script>
<style>
</style>
