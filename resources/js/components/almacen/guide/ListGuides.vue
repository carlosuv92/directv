<template lang="pug">
    div
        div(class="page-header")
            div(class="page-title")
                h3 LISTA DE GUIAS
            div(style="float: right;margin: 10px 15px;")
                button(class="btn btn-info mb-2 mr-2 btn-rounded" @click="showModal = true") Nueva Guia
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
                                        input(type="text" class="form-control" style="margin: 15px 15px;height:35px;float: right;")
                                    div(class="col-xl-2 col-md-2 col-sm-2 col-2")
                                        button(class="btn btn-warning mb-2 mr-2 btn-rounded" style="margin: 15px 15px;float: right;") Search
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
                                    tr(v-for="guide in guides" :key="guide.id")
                                        td {{guide.guide}}
                                        td {{guide.date_reception}}
                                        td {{guide.amount}}
                                        td(class="text-center")
                                            span(class="text-success") {{guide.name_user}}
                                        td(class="text-center")
                                            i(class="fas fa-search" @click="goToWarehouse(guide.id)")

                new-guide(v-if="showModal" @close="close")
        </tr>
</template>

<script>
    import { eventBus } from "../../../app.js";
    export default {
        data() {
            return {
                showModal : false,
                guides : []
            }
        },
        mounted() {
            eventBus.$on('getListGuide', this.getListGuide)
        },
        methods: {
            close() {
                this.showModal = false;
            },
            getListGuide(){
                axios.post("/api/get_guides",{
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.guides = response.data;
                    }
                }) .catch((err) => {
                    console.error(err);
                });
            },
            goToWarehouse(id){
                location.href = "warehouse/insert?guide="+id;
            }
        },
        created(){
            this.getListGuide();
        }
    }
</script>
