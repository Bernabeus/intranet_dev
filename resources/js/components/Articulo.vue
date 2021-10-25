<template>
    <div>
        <h1 class="text-center">Lista de Articulos</h1>
        <div
            class="row"
            style="margin: 10px 0; display: flex; justify-content: flex-end;"
        >
            <!-- Registrar Articulo-->
            <div>
                <ArticuloForm @listar="listar"></ArticuloForm>
            </div>
            <div>
                <Asignacion @listar="listar" @emptySelect="emptySelect" :selectItems="selectItems">
                </Asignacion>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="show" class="modal__backdrop">
            <div class="modal__backdrop" @click="closeModal()"></div>

            <div
                class="modal__dialog"
                :class="{ show: modal }"
            >
                <div>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">
                                {{ titleModal }}
                            </h3>
                            <button
                                @click="closeModal()"
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="row">
                                    <label
                                        for="NOMBRE"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Nombre</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.NOMBRE"
                                            type="text"
                                            class="form-control"
                                            id="NOMBRE"
                                            placeholder="Nombre"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        for="PRECIO"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Precio</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.PRECIO"
                                            type="text"
                                            class="form-control"
                                            id="PRECIO"
                                            placeholder="Precio"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        for="DESCRIPCION"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Descripcion</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.DESCRIPCION"
                                            type="text"
                                            class="form-control"
                                            id="DESCRIPCION"
                                            placeholder="Descripcion"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        for="NSERIE"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Numero de serie</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.NSERIE"
                                            type="text"
                                            class="form-control"
                                            id="NSERIE"
                                            placeholder="Numero de serie"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        for="CATEGORIA"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Categoria</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.CATEGORIA"
                                            type="text"
                                            class="form-control"
                                            id="CATEGORIA"
                                            placeholder="Categoria"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <label
                                        for="DEPRECIACION"
                                        class="col-md-4 col-form-label text-md-right"
                                    >Depreciacion</label
                                    >
                                    <div class="col-md-6">
                                        <input
                                            v-model="articulo.DEPRECIACION"
                                            type="text"
                                            class="form-control"
                                            id="DEPRECIACION"
                                            placeholder="Depreciacion"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                @click="closeModal()"
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button
                                @click="save()"
                                type="button"
                                class="btn btn-success btn-blue"
                                data-bs-dismiss="modal"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <v-data-table
            :headers="headers"
            :items="articulos"
            :search="search"
            :items-per-page="-1"
            no-data-text="N/A"
            no-results-text="No se encontraron resultados"
            sort-by="CODARTICULO"
            class="elevation-1"
            v-model="selectItems"
            hide-default-footer
            show-select
            item-key="CODARTICULO"
            loading
            loading-text="Cargando... Por favor espere"
            @toggle-select-all="selectAllToggle"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Buscar en tabla"
                        single-line
                        hide-details
                    ></v-text-field>
                    <v-spacer></v-spacer>
                </v-toolbar>
            </template>

            <template v-slot:item.editar="{ item }">
                <v-btn
                    small
                    class="mr-2"
                    @click="
                        update = true;
                        openModal(item);
                    "
                    style="background-color: #38c172"
                >
                    <v-icon small color="#fff">
                        mdi-pencil
                    </v-icon>
                </v-btn>
            </template>
            <template v-slot:item.transferir="{ item }">
                <Transaccion
                    v-if="item.CODDETASIG!==null"
                    @listar="listar"
                    :item="item"
                ></Transaccion>
            </template>

            <template
                v-slot:item.data-table-select="{ item, isSelected, select }"
            >
                <v-simple-checkbox
                    :value="item.CODDETASIG == null && isSelected"
                    :readonly="item.CODDETASIG !== null"
                    :disabled="item.CODDETASIG !== null"
                    @input="select($event)"
                ></v-simple-checkbox>
            </template>
        </v-data-table>

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
    data() {
        return {
            id: 0,
            update: true,
            modal: 0,
            titleModal: " ",
            headers: [
                {text: "Código", align: "start", value: "CODARTICULO"},
                {text: "Nombre", value: "NOMBRE"},
                {text: "Precio", value: "PRECIO"},
                {text: "Descripción", value: "DESCRIPCION", sortable: false},
                {text: "NSerie", value: "NSERIE"},
                {text: "Depreciación", value: "DEPRECIACION"},
                {text: "Categoria", value: "CATEGORIA", sortable: false},
                {
                    text: "Ubicación",
                    value: "CODUBICACION.NOMBRE",
                    sortable: false
                },
                {text: "Estado", value: "ESTADO", sortable: false},
                {text: "NAsignación", value: "CODDETASIG"},
                {text: "Custodio", value: "CUSTODIO.NOMBRE", sortable: false},
                {text: "Editar", value: "editar", sortable: false},
                {text: "Transferir", value: "transferir", sortable: false},
            ],
            articulo: {
                NOMBRE: "",
                PRECIO: "",
                DESCRIPCION: "",
                NSERIE: "",
                CATEGORIA: "",
                DEPRECIACION: ""
            },
            search: "",
            articulos: [],
            selectItems: [],
            disabledCount: 0,
            show: false,
            showModalError: false,
            messageError: "",
        };
    },
    methods: {
        listar() {
            axios
                .get("lista_articulos")
                .then(res => {
                    this.articulos = res.data.data;
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data || [];
                    }
                });
        },
        async save() {
            this.update;
            axios.put("articulos/" + this.id, this.articulo).then(res => {
                this.listar();
                this.openModalError("Articulo actualizado con exito");
            });

            this.closeModal();
        },
        openModal(data = {}) {
            this.show = true;
            this.modal = 1;
            this.update;
            (this.id = data.CODARTICULO),
            (this.titleModal = "Modificar Articulo");
            this.articulo.NOMBRE = data.NOMBRE;
            this.articulo.PRECIO = data.PRECIO;
            this.articulo.DESCRIPCION = data.DESCRIPCION;
            this.articulo.NSERIE = data.NSERIE;
            this.articulo.CATEGORIA = data.CATEGORIA;
            this.articulo.DEPRECIACION = data.DEPRECIACION;
        },
        closeModal() {
            this.modal = 0;
            this.show = false;
        },
        closeModalError() {
            this.showModalError = false;
        },
        openModalError(message) {
            this.showModalError = true;
            this.messageError = message;
        },
        selectAllToggle(props) {
            this.countSelect();
            if (this.selectItems.length !== this.articulos.length - this.disabledCount) {
                this.selectItems = [];
                const self = this;
                props.items.forEach(item => {
                    if (item.CODDETASIG == null) {
                        self.selectItems.push(item);
                    }
                });
            } else {
                this.emptySelect();
            }
            this.disabledCount = 0;
        },
        countSelect() {
            const self = this;
            this.articulos.map(item => {
                if (item.CODDETASIG !== null) {
                    self.disabledCount += 1;
                }
            });
        },
        emptySelect() {
            this.selectItems = [];
        },
    },
    created() {
        this.listar();
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
