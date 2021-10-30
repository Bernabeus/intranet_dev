<template>
    <div>
        <v-btn @click="openModal()" class="btn-blue">
            <v-icon
                small
                style="margin-right: 3px;"
            >
                mdi-plus-box
            </v-icon>
            Nuevo
        </v-btn>
        <div>
            <div v-if="show" class="modal__backdrop">
                <div class="modal__backdrop" @click="closeModal()"></div>
                <div class="modal__dialog">
                    <div class="">
                        <!--Formulario de Registro-->
                        <form method="POST" @submit.prevent="submit">
                            <div class="form-group" style="margin-top: 10px;">
                                <div class="modal-header">
                                    Registro de articulos
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!--NOMBRE -->
                                        <label
                                            for="NOMBRE"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Nombre
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="NOMBRE"
                                                type="text"
                                                class="form-control"
                                                name="NOMBRE"
                                                required
                                                autocomplete="new-NOMBRE"
                                                v-model="articulo.NOMBRE"
                                            />
                                        </div>

                                        <!--Precio-->
                                        <label
                                            for="PRECIO"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Precio
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="PRECIO"
                                                type="number"
                                                class="form-control"
                                                name="PRECIO"
                                                required
                                                autocomplete="new-PRECIO"
                                                v-model="articulo.PRECIO"
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!--Descripcion-->
                                        <label
                                            for="DESCRIPCION"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Descripción
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="DESCRIPCION"
                                                type="text"
                                                class="form-control"
                                                name="DESCRIPCION"
                                                required
                                                autocomplete="new-DESCRIPCION"
                                                v-model="articulo.DESCRIPCION"
                                            />
                                        </div>
                                        <!--NSERIE -->
                                        <label
                                            for="NSERIE"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Número de Serie
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="NSERIE"
                                                type="text"
                                                class="form-control"
                                                name="NSERIE"
                                                autocomplete="new-NSERIE"
                                                v-model="articulo.NSERIE"
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!--CATEGORIA -->
                                        <label
                                            for="SearchCodCategoria"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Categoria
                                        </label>
                                        <div class="col-md-3">
                                            <select
                                                required aria-required="true"
                                                    class="form-control"
                                                    name="SearchCodCategoria" id="SearchCodCategoria"
                                                    autocomplete="new-SearchCodCategoria"
                                                    v-model="articulo.CODCATEGORIA"
                                            >
                                                <option value="" disabled selected> seleccione una categoria...</option>
                                                <option v-for="categoria in categorias" :value="categoria.CODCATEGORIA">{{ categoria.NOMBRE }}</option>
                                            </select>

                                            <span v-for="error in errors" class="text-danger">
                                                {{ error.CODCATEGORIA }}
                                            </span>
                                        </div>

                                        <div class="col-md-1">
                                            <v-btn
                                                class="btn-blue"
                                                @click="searchCodigos"
                                            >
                                                <v-icon>
                                                    mdi-magnify
                                                </v-icon>
                                            </v-btn>
                                        </div>

                                        <!--CodigoContable -->
                                        <label
                                            for="CODCONTABLE"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Codigo Contable
                                        </label>
                                        <div class="col-md-2">
                                            <input
                                                id="CODCONTABLE"
                                                type="text"
                                                class="form-control"
                                                name="CODCONTABLE"
                                                required
                                                autocomplete="new-CODCONTABLE"
                                                disabled
                                                v-model="categoria_art.CODCONTABLE"
                                            />
                                        </div>
                                        <div class="col-md-2">
                                            <input
                                                id="CODIGOCONTABLE"
                                                type="number"
                                                class="form-control"
                                                name="CODIGOCONTABLE"
                                                required
                                                autocomplete="new-CODIGOCONTABLE"
                                                v-model="articulo.CODIGOCONTABLE"
                                            />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!--CodigoPresentacion-->
                                        <label
                                            for="CODPRESENTACION"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Codigo Presentacion
                                        </label>
                                        <div class="col-md-2">
                                            <input
                                                id="CODPRESENTACION"
                                                type="text"
                                                class="form-control"
                                                name="CODPRESENTACION"
                                                required
                                                disabled
                                                autocomplete="new-CODPRESENTACION"
                                                v-model="categoria_art.CODPRESENTACION"
                                            />
                                        </div>
                                        <div class="col-md-2">
                                            <input
                                                id="CODIGOPRESENTACION"
                                                type="text"
                                                class="form-control"
                                                name="CODIGOPRESENTACION"
                                                required
                                                autocomplete="new-CODIGOPRESENTACION"
                                                v-model="articulo.CODIGOPRESENTACION"
                                            />
                                        </div>

                                        <!--FECHAOBTENCION -->
                                        <label
                                            for="FECHAOBTENCION"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Fecha de compra
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="FECHAOBTENCION"
                                                type="date"
                                                class="form-control"
                                                name="FECHAOBTENCION"
                                                required
                                                autocomplete="new-FECHAOBTENCION"
                                                v-model="articulo.FECHAOBTENCION"
                                                value="2021-01-01"
                                            />
                                        </div>
                                    </div>

                                    <!-- Modal Success-->
                                    <div>
                                        <v-alert
                                            v-if="success === true"
                                            id="alertSuccess"
                                            name="alertSuccess"
                                            dismissible
                                            type="success"
                                            class="alert"
                                            transition="scale-transition"
                                        >
                                            Articulo Registrado con exito
                                        </v-alert>
                                    </div>

                                    <!--Buttons-->
                                    <div
                                        class="row modal-footer"
                                        style="margin:12px"
                                    >
                                        <v-btn
                                            @click="closeModal()"
                                            style="text-transform: capitalize;"
                                            class="btn-gray"
                                        >
                                            Cerrar
                                        </v-btn>
                                        <v-btn type="submit" class="btn-blue">
                                            Guardar Artículo
                                        </v-btn>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--modal error-->
        <div v-if="showModalError" class="modal__backdrop">
            <div class="modal__backdrop" @click="closeModalError()"></div>
            <div class="modal__error">
                <div class="modal__header card-header">
                    {{ messageError }}
                </div>
                <div class="modal__body">
                    <div style="display: flex; justify-content: flex-end;">
                        <v-btn
                            @click="closeModalError()"
                            style="text-transform: capitalize;"
                            class="btn-gray"
                        >
                            Cerrar
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ArticuloForm",

    data() {
        return {
            show: false,
            showModalError: false,
            messageError: "",
            articulo: {
                CODCAT: '',
            },
            categorias: [],
            codCodigo: '',
            categoria_art: {
                CODCONTABLE: '',
                CODPRESENTACION:  ''
            },
            errors: [],
            success: false,
            loaded: true,
            modal: false,
        };
    },
    mounted() {
        axios.get('categorias').then((response) => {
            this.categorias = response.data;
        })
    },
    methods: {
        closeModal() {
            this.show = false;
            this.success = false;
            this.categoria_art = [];
            this.loaded = false;
        },
        openModal() {
            this.show = true;
        },
        closeModalError() {
            this.showModalError = false;
            this.loaded = false;
        },
        openModalError(message) {
            this.showModalError = true;
            this.messageError = message;
        },

        submit() {

            if (this.loaded) {
                this.success = false;
                this.errors = {};
                axios.post("articulo", this.articulo).then(response => {
                    this.articulo = {}; //limpiar inputs
                    this.success = true;
                    this.$emit("listar");
                })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data || [];
                        }
                    });
            } else {
                this.openModalError("Ocurrio un error");
            }
        },
        searchCodigos() {
            let codigos;
            this.categoria_art = [];
            codigos = document.getElementById("SearchCodCategoria").value;
            this.codCodigo = codigos;
            axios.get(`categorias/${this.codCodigo}`).then((response) => {
                this.categoria_art = response.data[0];
                this.articulo.CODCAT = this.categoria_art.CODCAT;
                this.articulo.CODCATEGORIA = codigos;
                console.log(codigos);
                this.loaded = true;
            }).catch(error => {
                this.loaded = false;
                this.openModalError('Ocurrio un problema, intentalo de nuevo');
                if (error.response.status === 422) {
                    this.errors = error.response.data || [];
                }
            });
        },
    }
};
</script>

<style lang="scss" scoped>
.alert {
    background-color: #4caf50;
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

.btn-gray {
    color: #fff;
    background-color: #6c757d !important;
    border-color: #6c757d;
}
</style>
