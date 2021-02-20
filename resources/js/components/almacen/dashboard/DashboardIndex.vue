<template lang="pug">
    div
        div(class="row")
            div(class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing")
                div(class="widget widget-card-four")
                    div(class="widget-content")
                        div(class="w-content")
                            div(class="w-info")
                                h6(class="value") 125
                                p(class="") Total
                            div
                                div(class="w-icon")
                                    i(class="fas fa-user" style="font-size: 22px;")
                        div(class="progress")
                            div(class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100")
            div(class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing")
                div(class="widget widget-card-four")
                    div(class="widget-content")
                        div(class="w-content")
                            div(class="w-info")
                                h6(class="value") 25
                                p(class="") En Campo
                            div
                                div(class="w-icon" style="background: #007bff;")
                                    i(class="fas fa-user" style="font-size: 22px;")
                        div(class="progress")
                            div(class="progress-bar bg-gradient-info" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100")
            div(class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing")
                div(class="widget widget-card-four")
                    div(class="widget-content")
                        div(class="w-content")
                            div(class="w-info")
                                h6(class="value") 100
                                p(class="") En Almacen
                            div
                                div(class="w-icon" style="background: #28a745;")
                                    i(class="fas fa-user" style="font-size: 22px;")
                        div(class="progress")
                            div(class="progress-bar bg-gradient-success" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100")
        div(class="row")
            div(class="col-lg-12 col-12 layout-spacing")
                div(class="statbox widget box box-shadow")
                    div(class="widget-header")
                        div(class="row")
                            div(class="col-xl-12 col-md-12 col-sm-12 col-12")
                                h4 Tecnicos
                    div(class="widget-content widget-content-area")
                        div(class="table-responsive")
                            table(class="table table-bordered table-hover table-striped mb-4")
                                thead
                                    tr
                                        th Name
                                        th Date
                                        th Sale
                                        th(class="text-center") Status
                                        th
                                tbody
                                    tr
                                        td Tecnico 1
                                        td 10/08/2019
                                        td 320
                                        td(class="text-center")
                                            span(class="text-success") Complete
                                        td(class="text-center")
                                            i(class="fas fa-search")
                                    tr
                                        td Tecnico 2
                                        td 10/08/2019
                                        td 320
                                        td(class="text-center")
                                            span(class="text-danger") Por Devolver
                                        td(class="text-center")
                                            i(class="fas fa-search")

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
