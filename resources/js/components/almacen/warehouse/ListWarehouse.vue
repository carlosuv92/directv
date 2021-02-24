<template lang="pug">
    div
        div(class="page-header")
            div(class="page-title")
                h3 LISTA DE EQUIPOS
        div(class="row")
            div(class="col-lg-12 col-12 layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-6 col-md-6 col-sm-6 col-6")
                                h4 TOTAL DE EQUIPOS
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
                                        th Imei
                                        th Card
                                        th(class="text-center") ESTADO:
                                tbody
                                    tr(v-for="deco in decos.data" :key="deco.id")
                                        td {{deco.guide}}
                                        td {{deco.imei}}
                                        td {{deco.card}}
                                        td(class="text-center")
                                            span(class="text-warning" v-if="deco.type_warehouse == 'CAMPO'") {{deco.type_warehouse}}
                                            span(class="text-success" v-if="deco.type_warehouse == 'ALMACEN'") {{deco.type_warehouse}}
                        div
                            pagination(:data="decos" @pagination-change-page="getListDecos")
        </tr>
</template>

<script>
    import { eventBus } from "../../../app.js";
    export default {
        data() {
            return {
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
            /*selectItem(id){
                if(this.listDecos.some(function(item) {return item.id === id})){
                    this.listDecos = this.listDecos.filter(item => item.id !== id)
                }else{
                    this.listDecos.push({"id": id})
                }
            },
            openPrint(id) {
                this.guide_out = id;
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
            }*/
        },
        created(){
        }
    }
</script>
<style>
</style>
