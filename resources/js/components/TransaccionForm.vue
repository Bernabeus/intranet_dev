<template>
    <div>
        <v-btn
            small
            class="mr-2"
            @click="openModal()"
            style="background-color: #2176bd"
        >
            <v-icon small color="#fff">
                {{ icons.iconTransaccion }}
            </v-icon>
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
                                    Asignar Articulos
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <!--UBICACION -->
                                        <label
                                            for="UBICACION"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Ubicación
                                        </label>
                                        <div class="col-md-4">
                                            <select
                                                required
                                                aria-required="true"
                                                class="form-control"
                                                name="UBICACION"
                                                id="UBICACION"
                                                v-model="
                                                    asignacion.CODUBICACION
                                                "
                                            >
                                                <option disabled>
                                                    Escoja una ubicación...
                                                </option>
                                                <option
                                                    v-for="item in ubicaciones"
                                                    :value="item.CODUBICACION"
                                                    :key="item.CODUBICACION"
                                                >
                                                    {{ item.NOMBRE }}
                                                </option>
                                            </select>
                                        </div>

                                        <!--Concepto-->
                                        <label
                                            for="CONCEPTO"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Concepto
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="CONCEPTO"
                                                type="text"
                                                class="form-control"
                                                name="CONCEPTO"
                                                required
                                                autocomplete="new-CONCEPTO"
                                                v-model="
                                                    detalle_transferencia.CONCEPTO
                                                "
                                            />
                                        </div>
                                    </div>

                                    <!--Empleado Entrega-->
                                    <div class="row">
                                        <label
                                            for="ENTREGA"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Entrega
                                        </label>
                                        <div class="col-md-4">
                                            <select
                                                required
                                                aria-required="true"
                                                class="form-control"
                                                name="ENTREGA"
                                                id="ENTREGA"
                                                v-model="
                                                    detalle_transferencia.CODEMPLEADO
                                                "
                                            >
                                                <option
                                                    v-if="detalle_transferencia.CODEMPLEADO===empleado.CODEMPLEADO"
                                                    v-for="empleado in empleados"
                                                    :value="empleado.CODEMPLEADO"
                                                    :key="empleado.CODEMPLEADO"
                                                >
                                                    {{ empleado.NOMBRE + " " + empleado.APELLIDO }}
                                                </option>
                                            </select>
                                        </div>

                                        <!--Empleado Recibe-->
                                        <label
                                            for="RECIBE"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Recibe
                                        </label>
                                        <div class="col-md-4">
                                            <select
                                                required
                                                aria-required="true"
                                                class="form-control"
                                                name="RECIBE"
                                                id="RECIBE"
                                                v-model="
                                                    detalle_transferencia.EMP_CODEMPLEADO
                                                "
                                            >
                                                <option disabled>
                                                    Escoja un empleado...
                                                </option>
                                                <option
                                                    v-for="item in empleados"
                                                    :value="item.CODEMPLEADO"
                                                    :key="item.CODEMPLEADO"
                                                >
                                                    {{ item.NOMBRE + " " + item.APELLIDO }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!--Observacion Entrega-->
                                        <label
                                            for="OBSERVACIONENTREGA"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Observacion Entrega
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="OBSERVACIONENTREGA"
                                                type="text"
                                                class="form-control"
                                                name="OBSERVACIONENTREGA"
                                                required
                                                autocomplete="new-OBSERVACIONENTREGA"
                                                v-model="
                                                    detalle_transferencia.OBSERVACIONENTREGA
                                                "
                                            />
                                        </div>

                                        <!--OBSERVACION RECIBE -->
                                        <label
                                            for="OBSERVACIONRECIBE"
                                            class="col-md-2 col-form-label text-md-right"
                                        >
                                            Observación Recibe
                                        </label>
                                        <div class="col-md-4">
                                            <input
                                                id="OBSERVACIONRECIBE"
                                                type="text"
                                                class="form-control"
                                                name="OBSERVACIONRECIBE"
                                                required
                                                autocomplete="new-OBSERVACIONRECIBE"
                                                v-model="
                                                    detalle_transferencia.OBSERVACIONRECIBE
                                                "
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
                                            Articulo transferido con exito
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
                                            Transferir
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
import {mdiClipboardFlowOutline} from "@mdi/js";

export default {
    name: "TransaccionForm",
    props: ["item"],

    data() {
        return {
            show: false,
            showModalError: false,
            messageError: "",
            transferencia: {},
            detalle_transferencia: {
                CODEMPLEADO: this.item.CUSTODIO.CODEMPLEADO,
            },
            asignacion: {},
            empleados: {},
            ubicaciones: {},
            articulo: {},
            errors: [],
            fechaActual: "",
            success: false,
            modal: false,

            icons: {
                iconTransaccion: mdiClipboardFlowOutline
            }
        };
    },
    mounted() {
        this.getCurrentDate();
    },
    methods: {
        closeModal() {
            this.show = false;
            this.success = false;
        },
        openModal() {
            this.show = true;
            this.handleEmpleados();
            this.handleUbicacion();
        },
        closeModalError() {
            this.showModalError = false;
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
            this.transferencia.FECHA = this.fechaActual;
            this.asignacion.FECHA = this.fechaActual;
        },

        submit() {
            this.getCurrentDate();
            this.success = false;
            this.errors = {};
            axios
                .post("transferencia", this.transferencia)
                .then(response => {
                    this.detalle_transferencia = {
                        ...this.detalle_transferencia,
                        CODTRANSFERENCIA: response.data.CODTRANSFERENCIA,
                        CODARTICULO: this.item.CODARTICULO
                    };
                    //Detalle transferencia
                    this.createDetalleTransferencia(this.detalle_transferencia);

                })
                .catch(error => {
                    if (error.response) {
                        this.errors = error.response.data || [];
                    }
                });
        },

        createDetalleTransferencia(data) {
            axios.post("detalle_transferencia", data).then(response => {

                this.asignacion = {
                    ...this.asignacion,
                    CODTRANSFERENCIA: response.data.CODTRANSFERENCIA,
                    CODEMPLEADO: response.data.EMP_CODEMPLEADO,
                    OBSERVACIONENTREGA: response.data.OBSERVACIONENTREGA,
                    OBSERVACIONRECIBE: response.data.OBSERVACIONRECIBE,
                };
                //crear asignación
                this.createAsignacion(this.asignacion);

                this.articulo = {
                    ...this.articulo,
                    CODARTICULO: response.data.CODARTICULO,
                };
            })
                .catch(error => {
                    if (error.response) {
                        this.errors = error.response.data || [];
                    }
                });
        },
        createAsignacion(data) {
            axios
                .post("detalle_asignacion", data)
                .then(response => {
                    this.asignacion = {};
                    this.transferencia = {};
                    this.detalle_transferencia = {};

                    // Actualizar articulo
                    this.articulo = {
                        ...this.articulo,
                        CODUBICACION: response.data.CODUBICACION,
                        CODDETASIG: response.data.CODDETASIG,
                    };
                    this.updateArticulo(this.articulo);
                })
                .catch(error => {
                    if (error.response) {
                        this.errors = error.response.data || [];
                    }
                });
        },

        updateArticulo(articulo) {
            axios
                .put(
                    `articulos/${articulo.CODARTICULO}`,
                    articulo
                )
                .then(response => {
                    this.success = true;
                    this.$emit("listar");
                    this.closeModal();
                    this.openModalError("Transferido con exito");
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data || [];
                    }
                });
        },

        handleEmpleados() {
            axios
                .get("empleados")
                .then(response => {
                    this.empleados = response.data;
                })
                .catch(error => {
                });
            this.detalle_transferencia = {
                CODEMPLEADO: this.item.CUSTODIO.CODEMPLEADO,
            };
        },
        handleUbicacion() {
            axios
                .get("ubicacion")
                .then(response => {
                    this.ubicaciones = response.data;
                })
                .catch(error => {
                });
        }
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
