<template>

    <div>
        <h1 class="text-center">Lista de Estudiantes</h1>
        <div class="row" style="margin: 10px 0">

            <!--Busqueda por CODESTU-->
            <div class="col-md-8" style="display: flex; margin-bottom: 12px">
                <label for="searchPagos"
                       class="col-form-label text-md-right"
                       style="min-width: fit-content;"
                >
                    Código del banco
                </label>
                <input id="searchPagos" type="number"
                       class="form-control" style="max-width: fit-content; margin: 0 5px"
                       name="searchPagos" v-model="cod"
                       autocomplete="new-searchPagos"
                >
                <v-btn
                    class="btn-blue"
                    style="color: #fff;"
                    @click="searchDataCodBanco"
                >
                    <v-icon>
                        mdi-magnify
                    </v-icon>
                </v-btn>
                <v-btn
                    class="btn-cancel"
                    style="text-transform: capitalize; color: #fff;"
                    @click="cancelSearch"
                >
                    <v-icon>
                        mdi-close-octagon
                    </v-icon>
                </v-btn>
            </div>

            <div style="display: flex; justify-content: flex-end;" class="col-md-4">
                <v-btn @click="update=false; openModal();" class="btn-blue">
                    <v-icon
                        small
                        style="margin-right: 3px"
                    >
                        mdi-plus-box
                    </v-icon>
                    Nuevo
                </v-btn>
            </div>
        </div>

        <v-card>
            <v-card-title>

                <!-- Modal -->
                <div v-if="show" class="modal__backdrop">
                    <div class="modal__backdrop" @click="closeModal()"></div>
                    <div class="modal" :class="{show:modal}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">{{ titleModal }}</h3>
                                    <button @click="closeModal();" type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="row">
                                            <label for="CEDULA"
                                                   class="col-md-4 col-form-label text-md-right">Cédula</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.CEDULA" type="text" class="form-control"
                                                       id="CEDULA"
                                                       placeholder="Cedula del Estudiante">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="NOMBRE"
                                                   class="col-md-4 col-form-label text-md-right">Nombre</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.NOMBRE" type="text" class="form-control"
                                                       id="NOMBRE"
                                                       placeholder="Nombre del Estudiante">
                                                <span class="text-danger"
                                                      v-if="errores.NOMBRE">{{ errores.NOMBRE[0] }}</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="APELLIDO"
                                                   class="col-md-4 col-form-label text-md-right">Apellido</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.APELLIDO" type="text" class="form-control"
                                                       id="APELLIDO"
                                                       placeholder="Apellido del Estudiante">
                                                <span class="text-danger"
                                                      v-if="errores.APELLIDO">{{ errores.APELLIDO[0] }}</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="DIRECCION"
                                                   class="col-md-4 col-form-label text-md-right">Dirección</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.DIRECCION" type="text" class="form-control"
                                                       id="DIRECCION" placeholder="Direccion del Estudiante">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="EMAIL"
                                                   class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.EMAIL" type="text" class="form-control"
                                                       id="EMAIL"
                                                       placeholder="Email del Estudiante">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="TELEFONO"
                                                   class="col-md-4 col-form-label text-md-right">Teléfono</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.TELEFONO" type="text" class="form-control"
                                                       id="TELEFONO"
                                                       placeholder="Telefono del Estudiante">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="CELULAR"
                                                   class="col-md-4 col-form-label text-md-right">Celular</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.CELULAR" type="text" class="form-control"
                                                       id="CELULAR"
                                                       placeholder="Celular del Estudiante">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="CODBANCO" class="col-md-4 col-form-label text-md-right">Código
                                                Banco</label>
                                            <div class="col-md-6">
                                                <input v-model="estudiante.CODBANCO" type="text" class="form-control"
                                                       id="CODBANCO"
                                                       placeholder="Codbanco del Estudiante">
                                                <span class="text-danger"
                                                      v-if="errores.CODBANCO">{{ errores.CODBANCO[0] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button @click="closeModal();" type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                    <button @click="save();" type="button" class="btn btn-success btn-blue"
                                            data-bs-dismiss="modal">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Buscar en Tabla"
                    single-line
                    hide-details
                ></v-text-field>


            </v-card-title>

            <v-data-table
                :headers="headers"
                :items="estudiantes"
                :search="search"
                :items-per-page="perPage"
                hide-default-footer
                class="elevation-1"
                loading
                loading-text="Cargando... Por favor espere"
                no-results-text="No se encontraron resultados"
            >
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        small
                        class="mr-2"
                        @click="update = true; openModal(item);"
                        style="background-color: #38c172"
                    >
                        <v-icon
                            small
                            color="#fff"
                        >
                            mdi-pencil
                        </v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>
        <div class="text-center pt-2">
            <v-pagination
                v-model="page"
                :length="totalPages"
                total-visible="7"
                @input="handlePage"
            ></v-pagination>
        </div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            page: 1,
            search: '',
            cod: '',
            codBanco: '',
            headers: [
                {text: 'Codigo', value: 'CODESTU',},
                {text: 'Cedula', value: 'CEDULA'},
                {text: 'Nombre', value: 'NOMBRE'},
                {text: 'Apellido', value: 'APELLIDO'},
                {text: 'Direccion', value: 'DIRECCION'},
                {text: 'Email', value: 'EMAIL'},
                {text: 'Telefono', value: 'TELEFONO'},
                {text: 'Celular', value: 'CELULAR'},
                {text: 'Codigo del Banco', value: 'CODBANCO'},
                {text: 'Editar', value: 'actions'},
            ],


            estudiante: {
                CEDULA: '',
                NOMBRE: '',
                APELLIDO: '',
                DIRECCION: '',
                EMAIL: '',
                TELEFONO: '',
                CELULAR: '',
                CODBANCO: ''
            },
            id: 0,
            update: true,
            modal: 0,
            titleModal: ' ',
            estudiantes: [],
            totalPages: 0,
            perPage: 0,
            errores: {},
            show: false,
        }

    },

    mounted() {
        this.list();
    },
    methods: {
        list() {
            axios.get(`lista_estudiantes?page=${this.page}`).then(res => {
                this.est = res.data;
                this.estudiantes = this.est.data;
                this.totalPages = this.est.meta.last_page;
                this.perPage = this.est.meta.per_page;
            });


        },
        async save() {
            try {
                if (this.update) {
                    const res = await axios.put('estudiantes/' + this.id, this.estudiante);
                } else {
                    const res = await axios.post('estudiantes', this.estudiante);
                }
                this.closeModal();
                this.list();

            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors
                }
            }
        },

        searchDataCodBanco() {
            this.cod = document.getElementById("searchPagos").value;
            if (this.cod !== '') {
                axios.get(`estudiantes/${this.cod}`).then((response) => {
                    this.estudiantes = response.data;


                });
            }
        },

        openModal(data = {}) {
            this.show = true;
            this.modal = 1;
            if (this.update) {
                this.id = data.CODESTU,
                    this.titleModal = "Modificar Estudiante";
                this.estudiante.CEDULA = data.CEDULA;
                this.estudiante.NOMBRE = data.NOMBRE;
                this.estudiante.APELLIDO = data.APELLIDO;
                this.estudiante.DIRECCION = data.DIRECCION;
                this.estudiante.EMAIL = data.EMAIL;
                this.estudiante.TELEFONO = data.TELEFONO;
                this.estudiante.CELULAR = data.CELULAR;
                this.estudiante.CODBANCO = data.CODBANCO;
            } else {
                this.titleModal = "Crear Estudiante";
                this.estudiante.CEDULA = '';
                this.estudiante.NOMBRE = '';
                this.estudiante.APELLIDO = '';
                this.estudiante.DIRECCION = '';
                this.estudiante.EMAIL = '';
                this.estudiante.TELEFONO = '';
                this.estudiante.CELULAR = '';
                this.estudiante.CODBANCO = '';
            }
        },


        closeModal() {
            this.modal = 0;
            this.errores = {};
            this.show = false;
        },

        cancelSearch() {
            this.list();
            this.cod = '';
        },

        handlePage(value) {
            this.page = value;
            this.list();
        },
    },

    created() {
        this.list();
    },

};
</script>

<style>
.show {
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75 0.849)
}

</style>

<style lang="scss" scoped>
.alert {
    background-color: #4CAF50;
    border: none;
}

.container {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.modal {
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 9;

    &__backdrop {
        background-color: rgba(0, 0, 0, 0.3);
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
    }

    &__dialog {
        background-color: #ffffff;
        position: absolute;
        max-width: 800px;
        min-width: 600px;
        margin: 50px auto;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        z-index: 2;
        @media screen and (max-width: 992px) {
            width: 90%;
        }
    }

    &__error {
        background-color: #ffffff;
        position: absolute;
        max-width: 400px;
        min-width: 200px;
        margin: 50px auto;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        z-index: 2;
        @media screen and (max-width: 992px) {
            width: 90%;
        }
    }


    &__close {
        width: 30px;
        height: 30px;
    }

    &__header {
        padding: 20px 20px 10px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    &__body {
        padding: 10px 20px 10px;
        overflow: auto;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }

}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.btn-blue {
    text-transform: capitalize;
    color: #fff;
    background-color: #2176bd !important;
    border-color: #1f6fb2;
    margin: 0 3px;
}

.btn-cancel {
    color: #fff;
    background-color: #e3342f !important;
    border-color: #6c757d;
}
</style>

