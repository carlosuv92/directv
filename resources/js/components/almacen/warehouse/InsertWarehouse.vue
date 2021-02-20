<template lang="pug">
    div(class="page-header")
                div(class="page-title")
                    h3 INGRESAR DATOS DE GUIA
</template>

<script>
    export default {
        props: ["guide"],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
