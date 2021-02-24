<template lang='pug'>
   transition(name="modal")
        div(class="modal-mask")
                div(class="modal-dialog modal-lg" role="document" style="margin: 5rem auto;")
                    div(class="modal-content")
                        div(class="modal-header")
                            h5(class="modal-title") Imprimir
                            button(type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close")
                                i(class="fa fa-times")
                        div(class="modal-body" id="printMe")
                            div.row(class="m-1" style="justify-content: center;")
                                h4 Guia de Entrega de Equipo
                            div.row(class="m-1" style="justify-content: center;")
                                h5(style="font-weight:bold;") GUIA: VC-{{guide_out}}
                            div.row(class="m-1" style="justify-content: center;")
                                img(src="/assets/img/favicon.ico" style="width:90px;")
                            div(class="row inv--product-table-section" style="margin: 15px 10px;")
                                div(class="col-12")
                                    div(class="table-responsive")
                                        table(class="table")
                                            thead
                                                tr
                                                    th(class="text-left") IMEI
                                                    th(class="text-left") CARD
                                                    th(class="text-left") ENTREGADO POR
                                                    th(class="text-left") RECIBIDO POR
                                                    th(class="text-left") FECHA DE ENTREGA
                                            tbody
                                                tr(v-for="d in data" :key="d.id")
                                                    td(class="text-left") {{d.imei}}
                                                    td(class="text-left") {{d.card}}
                                                    td(class="text-left") {{d.s_name}}
                                                    td(class="text-left") {{d.r_name}}
                                                    td(class="text-left") {{d.date_s}}
                        div(class="modal-footer")
                            button(type="button" class="btn btn-primary" @click="print") Imprimir


</template>

<script>
import { eventBus } from "../../../app.js";
export default {
    props: ["show", "guide_out"],
    data() {
        return {
            data : [],
            output: null
        }
    },
    mounted() {
        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    },
  methods: {
    close() {
      this.$emit("close");
    },
    print () {
      this.$htmlToPaper('printMe');
    },
    getData(){
        axios.post("/api/get_print",{
            guide_out: this.guide_out
        })
        .then((response) => {
            this.data = response.data;
        });
    }
  },
  created(){
      this.getData();
  }
};
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
  overflow-x: auto;
}
.modal-container {
  width: 75%;
  height: 80%;
  margin: 20px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}
.modal-body {
  margin: 20px 0;
}
/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */
.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
