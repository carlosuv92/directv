<template lang='pug'>
   transition(name="modal")
        div(class="modal-mask")
                div(class="modal-dialog modal-lg" role="document" style="margin: 5rem auto;")
                    div(class="modal-content")
                        div(class="modal-header")
                            h5(class="modal-title") Seleccionar Tecnico
                            button(type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close")
                                i(class="fa fa-times")
                        div(class="modal-body")
                            div(class="row")
                                div(class="offset-xl-3 col-xl-6 form-group mb-4")
                                    select(class="form-control basic" v-model="person")
                                        option(:value="user.id" v-for="user in users" :key="user.id") {{user.name}} {{user.surname}}
                        div(class="modal-footer")
                            button(type="button" class="btn btn-primary" @click="saveAssign") Asignar
</template>

<script>
import { eventBus } from "../../../app.js";
export default {
    props: ["show", "arr_decos"],
    data() {
        return {
            person : '',
            users : [],
            decos: this.arr_decos
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
        axios.post("/api/get_users_byrole",{
            role : 'admin'
        })
        .then((response) => {
            if (response.status == 200) {
                this.users = response.data;
            }
        }) .catch((err) => {
            console.error(err);
        });
    },
    saveAssign() {
        const formData = new FormData()
        formData.append('decos', JSON.stringify(this.decos))
        formData.append('person', this.person)
        axios.post("/almacen/warehouse/decos", formData, {
        })
        .then((response) => {
            if (response.status == 200) {
                eventBus.$emit('getListDecos', null)
                this.$emit("close");
                this.$emit("print");
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
