<template lang='pug'>
   transition(name="modal")
        div(class="modal-mask")
                div(class="modal-dialog modal-lg" role="document")
                    div(class="modal-content")
                        div(class="modal-header")
                            h5(class="modal-title") Nueva Guia
                            button(type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close")
                                i(class="fa fa-times")
                        div(class="modal-body")
                            div(class="row")
                                div(class="col-xl-6 form-group mb-3")
                                    input(type="text" class="form-control" v-model="number_guide" placeholder="Numero de Guia")
                                    small(class="form-text text-muted") Ingrese numero de guia.
                                div(class="col-xl-6 form-group mb-4")
                                    input(type="text" class="form-control" v-model="cant_deco" placeholder="Ingrese Cantidad")
                                    small(class="form-text text-muted") Cantidad de Decos.
                                div(class="col-xl-6 form-group mb-3")
                                    input(type="date" class="form-control" v-model="date_reception" placeholder="Ingrese Fecha")
                                    small(class="form-text text-muted") Ingrese fecha de recepcion.
                                div(class="col-xl-6 form-group mb-4")
                                    select(class="form-control basic" v-model="person")
                                        option(:value="user.id" v-for="user in users" :key="user.id") {{user.name}} {{user.surname}}
                        div(class="modal-footer")
                            button(type="button" class="btn btn-primary" @click="saveGuide") Save
</template>

<script>
import { eventBus } from "../../../app.js";
export default {
    props: ["show"],
    data() {
        return {
            number_guide : '',
            cant_deco : '',
            date_reception : '',
            person : '',
            users : []
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
    getUsers(){
        axios.post("/api/get_users",{
        })
        .then((response) => {
            if (response.status == 200) {
                this.users = response.data;
            }
        }) .catch((err) => {
            console.error(err);
        });
    },
    saveGuide() {
        const formData = new FormData()
        formData.append('number_guide', this.number_guide)
        formData.append('cant_deco', this.cant_deco)
        formData.append('date_reception', this.date_reception)
        formData.append('person', this.person)
        axios.post("/guides", formData, {
        })
        .then((response) => {
            if (response.status == 200) {
                eventBus.$emit('getListGuide', null)
                this.$emit("close");
            }
        }) .catch((err) => {
            console.error(err);
        });
    }
  },
  created(){
      this.getUsers()
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
