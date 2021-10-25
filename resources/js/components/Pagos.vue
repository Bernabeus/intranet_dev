<template>
    <div>
        <h1 class="text-center">Lista de Pagos</h1>
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
                    @click="searchDataCodBanco"
                >
                    <v-icon>
                        mdi-magnify
                    </v-icon>
                </v-btn>
                <v-btn
                    class="btn-cancel"
                    style="text-transform: capitalize;"
                    @click="cancelSearch"
                >
                    <v-icon>
                        mdi-close-octagon
                    </v-icon>
                </v-btn>
            </div>

            <!-- Registrar Pago-->
            <div style="display: flex; justify-content: flex-end;"
                 class="col-md-4"
            >
                <PagoForm :readData="readData"></PagoForm>
            </div>
        </div>

        <v-data-table
            :headers="headers"
            :items="tableData"
            :search="search"
            :items-per-page="perPage"
            hide-default-footer
            class="elevation-1"
            loading
            loading-text="Cargando... Por favor espere"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
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

        </v-data-table>

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
    name: "Pagos",

    data: () => ({
        page: 1,
        totalPages: 0,
        perPage: 0,
        errors: [],
        search: '',
        headers: [
            {
                text: 'Código del Banco',
                align: 'start',
                value: 'CODBANCO',
            },
            {text: 'Estudiante', value: 'ESTUDIANTE'},
            {text: 'Detalle', value: 'DETALLE', sortable: false},
            {text: 'Valor', value: 'VALOR'},
            {text: 'Observación', value: 'OBSERVACION', sortable: false},
            {text: 'Concepto', value: 'CONCEPTO', sortable: false},
            {text: 'Comprobante', value: 'NRO_COMPROBANTE', sortable: false},
            {text: 'Año Lectivo', value: 'ANIO_LECTIVO'},
            {text: 'Fecha Comprobante', value: 'FECHA_COMPROBANTE'},
        ],
        tableData: [],
        codBanco: '',
        cod: '',

    }),

    mounted() {
        this.readData();
    },

    methods: {

        readData() {
            this.tableData = [];
            axios.get(`detalle_pagos?page=${this.page}`).then((response) => {
                this.pagos = response.data;
                this.tableData = this.pagos.data;
                this.totalPages = this.pagos.meta.last_page;
                this.perPage = this.pagos.meta.per_page;

            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data || [];
                }
            });
        },

        searchDataCodBanco() {
            this.cod = document.getElementById("searchPagos").value;
            if (this.cod !== '') {
                axios.get(`estudiantes/${this.cod}`).then((response) => {
                    this.codBanco = response.data[0].CODESTU;

                    if (this.codBanco !== undefined) {
                        this.tableData = [];
                        axios.get(`detalle_pagos/${this.codBanco}`).then((response) => {
                            this.tableData = response.data.data;

                        }).catch(error => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data || [];
                            }
                        });
                    }

                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data || [];
                    }
                });
            }
        },

        cancelSearch() {
            this.readData();
            this.cod = '';
        },

        handlePage(value) {
            this.page = value;
            this.readData();
        },
    },
}
</script>

<style scoped>
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
