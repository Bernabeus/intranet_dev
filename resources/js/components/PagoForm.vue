<template>
    <div>
        <v-btn @click=openModal()
               class="btn-blue"
        >
            Registrar Pago
        </v-btn>
        <div>
            <div v-if="show" class="modal__backdrop">
                <div class="modal__backdrop" @click="closeModal()"></div>
                <div class="modal__dialog">
                    <div class="modal__header card-header">
                        Registrar un Nuevo Pago
                    </div>
                    <div class="modal__body">

                        <!--Formulario de Registro-->
                        <form method="POST" @submit.prevent="submit">

                            <!--Busqueda-->
                            <div class="row" style="margin-top: 10px; margin-bottom: -5px;">
                                <label for="SearchCodBanco"
                                       class="col-md-4 col-form-label text-md-right"
                                >
                                    Código del banco
                                </label>
                                <div class="col-md-6"
                                     style="display: flex;"
                                >
                                    <input id="SearchCodBanco" type="number"
                                           class="form-control" name="SearchCodBanco"
                                           autocomplete="new-SearchCodBanco" required
                                           v-model="pago.CODBANCO"
                                    >

                                    <v-btn
                                        class="btn-blue"
                                        @click="searchEstudiante"
                                    >
                                        <v-icon>
                                            mdi-magnify
                                        </v-icon>
                                    </v-btn>
                                </div>
                            </div>

                            <div class="form-group modal-footer" style="margin-top: 10px;">
                                <div class="row">
                                    <!--Código del Banco-->
                                    <label
                                        for="CODBANCO"
                                        class="col-md-2 col-form-label text-md-right"
                                    >
                                        Código del Banco
                                    </label>
                                    <div class="col-md-4">
                                        <input
                                            id="CODBANCO" type="text"
                                            class="form-control" name="CODBANCO"
                                            required autocomplete="new-CODBANCO"
                                            v-model="pago.CODBANCO"
                                            disabled
                                        >
                                    </div>

                                    <!--Fecha del Comprobante-->
                                    <label
                                        for="FECHA_COMPROBANTE"
                                        class="col-md-2 col-form-label text-md-right"
                                    >
                                        Fecha del Comprobante
                                    </label>
                                    <div class="col-md-4">
                                        <input
                                            id="FECHA_COMPROBANTE" type="date"
                                            class="form-control" name="FECHA_COMPROBANTE"
                                            autocomplete="new-FECHA_COMPROBANTE"
                                            v-model="pago.FECHA_COMPROBANTE"
                                        >
                                    </div>
                                </div>

                                <div class="row">

                                    <!--Nombres -->
                                    <label for="NOMBRE"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Nombres
                                    </label>
                                    <div class="col-md-4">
                                        <input id="NOMBRE" type="text"
                                               class="form-control" name="NOMBRE"
                                               required autocomplete="new-NOMBRE"
                                               disabled v-model="estudiante.NOMBRE"
                                        >

                                    </div>

                                    <!--Apellidos-->
                                    <label for="APELLIDO"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Apellidos
                                    </label>
                                    <div class="col-md-4">
                                        <input id="APELLIDO" type="text"
                                               class="form-control" name="APELLIDO"
                                               required autocomplete="new-APELLIDO"
                                               disabled v-model="estudiante.APELLIDO"
                                        >

                                    </div>
                                </div>
                                <div class="row">

                                    <!--nro Comprobante-->
                                    <label for="NRO_COMPROBANTE"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Nro Comprobante
                                    </label>
                                    <div class="col-md-4">
                                        <input id="NRO_COMPROBANTE" type="text"
                                               class="form-control" name="NRO_COMPROBANTE"
                                               autocomplete="new-NRO_COMPROBANTE"
                                               v-model="pago.NRO_COMPROBANTE"
                                        >

                                    </div>

                                    <!--Anio Lectivo-->
                                    <label for="ANIO_LECTIVO"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Año Lectivo
                                    </label>
                                    <div class="col-md-4">
                                        <select required aria-required="true"
                                                class="form-control "
                                                name="ANIO_LECTIVO" id="ANIO_LECTIVO"
                                                v-model="pago.ANIO_LECTIVO"
                                        >
                                            <option value="" disabled selected> Seleccione un año lectivo...
                                            </option>
                                            <option v-for="item in catalogo" v-if="item.CATALOGO_MENU_ID===4"
                                                    :value="item.CODCATALOGO" v-bind:key="item.CODCATALOGO">
                                                {{ item.DESCRIPCION }}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">

                                    <!--Detalle del Pago-->
                                    <label for="DETALLE_PAGO"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Detalle
                                    </label>
                                    <div class="col-md-4">
                                        <input id="DETALLE_PAGO" type="text"
                                               class="form-control" name="DETALLE_PAGO"
                                               autocomplete="new-DETALLE_PAGO"
                                               v-model="pago.DETALLE_PAGO"
                                        >

                                    </div>

                                    <!--Concepto del Pago-->
                                    <label for="CONCEPTO"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Concepto
                                    </label>
                                    <div class="col-md-4">
                                        <select required aria-required="true"
                                                class="form-control"
                                                name="CONCEPTO" id="CONCEPTO"
                                                v-model="pago.CONCEPTO"
                                        >
                                            <option value="" disabled selected> Seleccione un concepto de pago...
                                            </option>
                                            <option v-for="item in catalogo" v-if="item.CATALOGO_MENU_ID===1"
                                                    :value="item.CODCATALOGO" v-bind:key="item.CODCATALOGO">
                                                {{ item.DESCRIPCION }}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row">

                                    <!--Valor del Pago-->
                                    <label for="VALOR"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Valor
                                    </label>
                                    <div class="col-md-4">
                                        <input id="VALOR" type="number"
                                               class="form-control" name="VALOR"
                                               required autocomplete="new-VALOR"
                                               v-model="pago.VALOR"
                                        >

                                    </div>

                                    <!--Observación-->
                                    <label for="OBSERVACION"
                                           class="col-md-2 col-form-label text-md-right"
                                    >
                                        Observación
                                    </label>
                                    <div class="col-md-4">
                                        <input id="OBSERVACION" type="text"
                                               class="form-control" name="OBSERVACION"
                                               autocomplete="new-OBSERVACION"
                                               v-model="pago.OBSERVACION"
                                        >

                                    </div>
                                </div>

                                <!--       Modal Success-->
                                <div>
                                    <v-alert v-if="success===true"
                                             id="alertSuccess"
                                             name="alertSuccess"
                                             dismissible
                                             type="success"
                                             class="alert"
                                             transition="scale-transition"
                                    >
                                        Pago Registrado con exito
                                    </v-alert>
                                </div>

                                <!--Buttons-->
                                <div class="row modal-footer">
                                    <v-btn @click="closeModal()"
                                           style="text-transform: capitalize;"
                                           class="btn-gray"
                                    >
                                        Cerrar
                                    </v-btn>
                                    <v-btn type="submit" class="btn-blue">
                                        Guardar Pago
                                    </v-btn>
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
                        <v-btn @click="closeModalError()"
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
    name: "PagoForm",

    data() {
        return {
            show: false,
            showModalError: false,
            messageError: '',
            fechaActual: '',
            pago: {
                CODESTU: '',
                FECHA_INGRESO: this.fechaActual,
            },
            catalogo: [],
            estudiante: {
                NOMBRE: '',
                APELLIDO: ''
            },
            codEstudiante: '',
            errors: [],
            success: false,
            loaded: false,
            date: new Date().toISOString().substr(0, 10),
            modal: false,
        }
    },
    mounted() {
        this.handleCatalogo();
        this.getCurrentDate();
    },
    methods: {
        closeModal() {
            this.show = false;
            this.success = false;
            this.estudiante = [];
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
        getCurrentDate() {
            let fecha = new Date();
            const anio = fecha.getFullYear();
            const mes = fecha.getMonth() + 1;
            const dia = fecha.getDate();

            this.fechaActual = anio + "-" + mes + "-" + dia;
            this.pago.FECHA_INGRESO = this.fechaActual;
        },
        searchEstudiante() {
            let cod;
            this.estudiante = [];
            cod = document.getElementById("SearchCodBanco").value;
            this.codEstudiante = cod;
            axios.get(`estudiantes/${this.codEstudiante}`).then((response) => {
                if (response.data[0] === undefined) {
                    this.openModalError('El estudiante no existe');
                } else {
                    this.estudiante = response.data[0];
                    this.pago.CODESTU = this.estudiante.CODESTU;
                    this.pago.CODBANCO = cod;
                }
                this.loaded = true;
            }).catch(error => {
                this.loaded = false;
                this.openModalError('Ocurrio un problema, intentalo de nuevo');
                if (error.response.status === 422) {
                    this.errors = error.response.data || [];
                }
            });
        },
        handleCatalogo() {
            axios.get('catalogo_pagos').then((response) => {
                this.catalogo = response.data;
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data || [];
                }
            });
        },

        submit() {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                this.getCurrentDate();
                axios.post('detalle_pagos', this.pago).then(response => {
                    this.pago = {}; //limpiar inputs
                    this.estudiante = '';
                    this.loaded = false;
                    this.success = true;
                    this.$emit('readData');
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data || [];
                    }
                });
            } else {
                this.openModalError('Ocurrio un error, asegurate de buscar al estudiante antes de guardar');
            }
        },
    }
}
</script>

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

.btn-gray {
    color: #fff;
    background-color: #6c757d !important;
    border-color: #6c757d;
}
</style>
