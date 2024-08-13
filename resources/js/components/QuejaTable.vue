<template>
    <!-- TABLA PARA MOSTRAR LAS QUEJAS -->
    <div v-if="modoM" class="card">
        <keep-alive>
            <div>
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="d-flex align-items-center m-0 text-primary">Quejas</h3>
                        <button type="button" class="btn btn-primary" @click="divCrear()" id="CrearQueja">
                            <i class="fa-solid fa-user-plus me-1"></i>Crear Nueva Queja
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="QuejaTable">
                            <thead>
                                <tr class="bg-dark">
                                    <!-- <th v-if="rol=='admin'" width="5%">Id</th>
                                    <th v-if="rol=='admin'" width="5%">Socio</th>
                                    <th width="15%">Negocio</th> -->
                                    <th width="25%">Queja</th>
                                    <th v-if="rol=='admin'" width="20%">Respuesta</th>
                                    <th width="15%">Fecha y Hora</th>
                                    <th v-if="rol=='admin'" width="10%">Estatus</th>
                                    <th width="10%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="queja in quejas">
                                    <!-- <td>{{ queja.id }}</td>
                                    <td>{{ queja.qjs_user }}</td>
                                    <td>{{ queja.qjs_business}}</td> -->
                                    <td>{{ queja.qjs_queja }}</td>
                                    <td>{{ queja.qjs_response }}</td>
                                    <td>{{ queja.qjs_fecha_hora }}</td>
                                    <!-- <td>{{ queja.qjs_status }}</td> -->
                                    <td v-if="queja.qjs_status=='1'">Activo</td>
                                    <td v-if="queja.qjs_status=='2'">Inactivo</td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <button v-if="rol=='admin'" class="btn btn-outline-dark" 
                                            @click="divEditar(queja)"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button class="btn btn-outline-dark" @click="eliminar(queja)">
                                                <i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </keep-alive>
    </div>

    <!-- DIV PARA LAS QUEJAS -->
    <div v-if="modoM==false" class="card">
        <div class="card-header bg-dark text-white"> {{  titulo }} </div>
        <div class="card-body">
            <div class="card-text">
                <form method="post">
                    <div class="row">
                        <div v-if="rol=='admin'" class="col-12 mb-3">
                            <label for="user" class="form-label">Id del Usuario</label>
                            <input type="number" class="form-control" id="user" placeholder="Escribe el Id del usuario"
                                v-model="datosQuejas.qjs_user">
                        </div>
                    </div>
                    <div class="row">
                        <div v-if="rol=='admin'" class="col-6 mb-3">
                            <label for="business" class="form-label">Negocio</label>
                            <input type="text" class="form-control" id="business"
                                placeholder="Escribe el nombre del negocio al que va la queja" 
                                v-model="datosQuejas.qjs_business">
                        </div>
                        <div v-if="rol=='admin'" class="col-6 mb-3">
                            <label for="status" class="form-label">Estatus</label>
                            <select class="form-select" aria-label="status" v-model="datosQuejas.qjs_status">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="queja" class="form-label">Comentario</label>
                            <textarea type="text" class="form-control" id="queja" placeholder="¿Qué piensas de este negocio?" 
                            v-model="datosQuejas.qjs_queja"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div v-if="rol=='admin'" class="col-12 mb-3">
                            <label for="resp" class="form-label">Respuesta</label>
                            <textarea type="text" class="form-control" id="resp" placeholder="Escribe la respuesta del negocio" 
                            v-model="datosQuejas.qjs_response"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" @click.prevent="cerrar()">Cerrar</button>
                                <button type="submit" class="btn btn-success" @click.prevent="crear()" v-if="btnC">Crear Queja</button>
                                <button type="submit" class="btn btn-warning" @click.prevent="editar()" v-if="btnE">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
    import * as alertas from '../alertas';
    export default {
        props: {
            rol: {
                type: String,
                default: 'user',
                required: true
            },
            idu: {
                type: String,
                default: '',
                required: false
            },
        },
        mounted() {
            this.getQueja();
        },
        data() {
            return {
                quejas: [],
                datosQuejas: {
                    qjs_user: '',
                    qjs_business: '',
                    qjs_queja: '',
                    qjs_response: '',
                    qjs_fecha_hora: '',
                    qjs_status: ''
                },
                titulo: '',
                modoM: true,
                btnC: false,
                btnE: false,
                id: '',
            }
        },
        methods: {
            tabla() {
                this.$nextTick(() => {
                    $('#QuejaTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
                        },
                        dom: "<'row'<'col-sm-12 mb-2'B>>" +
                            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [{
                                "extend": "copyHtml5",
                                "text": "<i class='fa-regular fa-copy'></i>",
                                "titleAttr": "Copiar",
                                "className": "bg-dark"
                            },
                            {
                                "extend": "pdfHtml5",
                                "text": "<i class='fa-regular fa-file-lines'></i>",
                                "titleAttr": "Exportar a PDF",
                                "className": "bg-danger"
                            },
                            {
                                "extend": "excelHtml5",
                                "text": "<i class='fa-regular fa-file-excel'></i>",
                                "titleAttr": "Exportar a Excel",
                                "className": "bg-success"
                            },
                            {
                                "extend": "csvHtml5",
                                "text": "<i class='fa-solid fa-file-csv'></i>",
                                "titleAttr": "Exportar a CSV",
                                "className": "bg-secondary"
                            },
                            {
                                "extend": "print",
                                "text": "<i class='fa-solid fa-print'></i>",
                                "titleAttr": "Imprimir",
                                "className": "bg-light"
                            },
                        ]
                    });
                });
            },
            getQueja() {
                var url = 'queja';
                axios.get(url).then(res => {
                    this.quejas = res.data;
                    $('#QuejaTable').DataTable().destroy();
                    this.tabla();
                });
            },
            cerrar() {
                this.modoM = true;
                $('#QuejaTable').DataTable().destroy();
                this.tabla();
            },
            divCrear() {
                const date = new Date(); 
                const formato = date.getFullYear() + "-" + ("0"+(date.getMonth()+1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2) + " " +
                              ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2) + ":"
                            + ("0" + date.getSeconds()).slice(-2);  
                // console.log(formato);
                this.datosQuejas = {
                    qjs_user: this.idu,
                    qjs_business: '',
                    qjs_queja: '',
                    qjs_response: '',
                    qjs_fecha_hora: formato,
                    qjs_status: '1'
                    },
                this.titulo = 'Crear Nueva Queja';
                this.modoM = false;
                this.btnC = true;
                this.btnE = false;
            },
            crear() {
                var url = 'queja';
                axios.post(url, this.datosQuejas).then(res => {
                    this.datosQuejas = {
                    qjs_user: '',
                    qjs_business: '',
                    qjs_queja: '',
                    qjs_response: '',
                    qjs_fecha_hora: '',
                    qjs_status: ''
                    },
                    this.modoM = true;
                    this.getQueja();
                    alertas.correcto();
                }).catch(function (error) {
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            divEditar(datos) {
                this.datosQuejas = {
                    qjs_user: datos.qjs_user,
                    qjs_business: datos.qjs_business,
                    qjs_queja: datos.qjs_queja,
                    qjs_response: datos.qjs_response,
                    qjs_fecha_hora: datos.qjs_fecha_hora,
                    qjs_status: datos.qjs_status
                    },
                this.titulo = 'Editar Queja';
                this.modoM = false;
                this.btnC = false;
                this.btnE = true;
                this.id = datos.id;
            },
            editar() {
                var url = 'queja/' + this.id;
                axios.put(url, this.datosQuejas).then(res => {
                    this.id = '';
                    this.modoM = true;
                    this.getQueja();
                    alertas.correcto();
                }).catch(function (error) {
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            eliminar(datos) {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "No podras revertir esto!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        var url = 'queja/' + datos.id;
                        axios.delete(url).then(res => {
                            this.getQueja();
                            Swal.fire('Eliminado!', 'La Queja ha sido borrada con exito', 'success');
                        });
                    }
                });
            },
        }
    }

</script>
