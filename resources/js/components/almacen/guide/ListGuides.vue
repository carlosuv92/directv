<template lang="pug">
    div
        div(class="page-header")
            div(class="page-title")
                h3 LISTA DE GUIAS
            div(style="float: right;margin: 20px 15px 10px;")
                button(class="btn btn-info mb-2 mr-2 btn-rounded" @click="showModal = true") Nueva Guia
        div(class="row")
            div(class="col-lg-12 col-12 layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-6 col-md-6 col-sm-6 col-6")
                                h4 BUSQUEDA DE GUIAS
                            div(class="col-xl-6 col-md-12 col-sm-12 col-12")
                                div(class="row")
                                    div(class="col-xl-5 col-md-6 col-sm-6 col-4")
                                    div(class="col-xl-5 col-md-4 col-sm-4 col-5")
                                        input(type="text" class="form-control" style="margin: 15px 15px;height:35px;float: right;" v-model="search" @keyup.enter="getListGuide()")
                                    div(class="col-xl-2 col-md-2 col-sm-2 col-3")
                                        button(class="btn btn-warning mb-2 mr-2 btn-rounded" style="margin: 15px 15px;float: right;" @click="getListGuide()") Search
                    div(class="widget-content widget-content-area")
                        div(class="table-responsive")
                            table(class="table table-bordered table-hover table-striped mb-4")
                                thead
                                    tr
                                        th Guia
                                        th Date
                                        th Cantidad
                                        th(class="text-center") Recibido Por
                                        th
                                tbody
                                    tr(v-for="guide in guides.data" :key="guide.id")
                                        td {{guide.guide}}
                                        td {{guide.date_reception}}
                                        td {{guide.amount}}
                                        td(class="text-center")
                                            span(class="text-success") {{guide.name_user}}
                                        td(class="text-center")
                                            i(class="fas fa-search" style="cursor:pointer;" @click="goToWarehouse(guide.id)")
                        div
                            pagination(:data="guides" @pagination-change-page="getListGuide")
                new-guide(v-if="showModal" @close="close")
        </tr>
</template>

<script>
    import { eventBus } from "../../../app.js";
    export default {
        data() {
            return {
                showModal : false,
                guides : {},
                search : '',
            }
        },
        mounted() {
            eventBus.$on('getListGuide', this.getListGuide)
            this.getListGuide();
        },
        methods: {
            close() {
                this.showModal = false;
            },
            getListGuide(page = 1){
                axios.get("/api/get_guides?page=" + page + "&search=" + this.search)
                .then((response) => {
                    this.guides = response.data;
                });
            },
            goToWarehouse(id){
                location.href = "warehouse/insert/"+id;
            }
        },
        created(){
        }
    }
</script>
