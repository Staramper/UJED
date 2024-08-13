<template>
    <!-- TABLA PARA MOSTRAR LOS NEGOCIOS -->
    <div v-if="modoM=='1'" class="card">
        <keep-alive>
            <div>
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="d-flex align-items-center m-0 text-primary">Negocios</h3>
                        <div class="d-flex align-items-center m-0 p-2 bg-dark text-white rounded">{{ nick }}</div>
                        <button type="button" class="btn btn-primary" @click="divCrear()">
                            <i class="fa-solid fa-user-plus me-1"></i>Crear Nuevo Negocio
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="businessTable">
                            <thead>
                                <tr class="bg-dark">
                                    <!-- <th v-if="rol=='admin'" width="5%">Id</th> -->
                                    <th v-if="rol=='admin'" width="5%">Socio</th>
                                    <th width="10%">Titulo</th>
                                    <th width="10%">Logo</th>
                                    <th width="30%">Descripción</th>
                                    <th width="10%">Estatus</th>
                                    <th width="20%">Horario</th>
                                    <th width="10%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="business in businesses">
                                    <!-- <td v-if="rol=='admin'">{{ business.id }}</td> -->
                                    <td v-if="rol=='admin'">{{ business.nick }}</td>
                                    <td>{{ business.bsn_title}}</td>
                                    <td><img :src="'storage/' + business.bsn_logo" class="img-fluid rounded"></td>
                                    <td>{{ business.bsn_desc }}</td>
                                    <td v-if="business.bsn_status=='1'">Activo</td>
                                    <td v-if="business.bsn_status=='2'">Inactivo</td>
                                    <td>{{ business.bsn_horario }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <button class="btn btn-outline-dark" id="productosN" @click="productos(business)" title="Ver los productos">
                                                <i class="fa-solid fa-list-check"></i></button>
                                            <button class="btn btn-outline-dark" id="editarN" @click="divEditar(business)" title="Editar el negocio">
                                                <i class="fa-regular fa-pen-to-square"></i></button>
                                            <button class="btn btn-outline-dark" id="eliminarN" @click="eliminar(business)" title="Eliminar el negocio">
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

    <!-- DIV PARA EL NEGOCIO -->
    <div v-else-if="modoM=='2'" class="card">
        <div class="card-header bg-dark text-white"> {{  titulo }} </div>
        <div class="card-body">
            <div class="card-text">
                <form method="post">
                    <div class="row">
                        <div v-if="rol=='admin'" class="col-12 mb-3">
                            <label for="socio" class="form-label">Id del Socio</label>
                            <input type="number" class="form-control" id="socio" placeholder="Escribe el Id del socio"
                                v-model="datosBusiness.bsn_socio">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo"
                                placeholder="Escribe el Titulo del negocio" v-model="datosBusiness.bsn_title">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" 
                            v-on:change=onFileChange>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="desc" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control" id="desc" placeholder="Escribe una descripción del negocio" 
                            v-model="datosBusiness.bsn_desc"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="status" class="form-label">Estatus</label>
                            <select class="form-select" aria-label="status" v-model="datosBusiness.bsn_status">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <input type="text" class="form-control" id="horario"
                                placeholder="Escribe el horario del negocio" v-model="datosBusiness.bsn_horario">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" @click.prevent="cancelar()">Cerrar</button>
                                <button type="submit" class="btn btn-success" @click.prevent="crear()" v-if="btnC">Crear
                                    Negocio</button>
                                <button type="submit" class="btn btn-warning" @click.prevent="editar()"
                                    v-if="btnE">Guardar Cambios</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div v-else>
        <product-table :rol="this.rol" :idb="this.id" :bname="this.bname"></product-table>
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
            nick: {
                type: String,
                default: 'user',
                required: true
            },
            idu: {
                type: String,
                default: '',
                required: false
            },
            idb: {
                type: String,
                default: '',
                required: false
            },
            bname: {
                type: String,
                default: '',
                required: false
            },
        },
        created: function () {
            let self = this;
            this.emitter.on('clicker', function (rComand) {
                self.get_click(rComand);
            });
        },
        mounted() {
            this.getBusiness();
        },
        data() {
            return {
                businesses: [],
                datosBusiness: {
                    bsn_socio: '',
                    bsn_title: '',
                    bsn_logo: '',
                    bsn_desc: '',
                    bsn_status: '',
                    bsn_horario: ''
                },
                titulo: '',
                modoM: '1',
                btnC: false,
                btnE: false,
                id: '',
                bname: '',
            }
        },
        methods: {
            tabla() {
                this.$nextTick(() => {
                    $('#businessTable').DataTable({
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
                                "className": "bg-dark",
                                "name" : "copyB"
                            },
                            {
                                "extend": "pdfHtml5",
                                "text": "<i class='fa-regular fa-file-lines'></i>",
                                "titleAttr": "Exportar a PDF",
                                "className": "bg-danger",
                                "name" : "pdf"
                            },
                            {
                                "extend": "excelHtml5",
                                "text": "<i class='fa-regular fa-file-excel'></i>",
                                "titleAttr": "Exportar a Excel",
                                "className": "bg-success",
                                "name" : "excel"
                            },
                            {
                                "extend": "csvHtml5",
                                "text": "<i class='fa-solid fa-file-csv'></i>",
                                "titleAttr": "Exportar a CSV",
                                "className": "bg-secondary",
                                "name" : "csv"
                            },
                            {
                                "extend": "print",
                                "text": "<i class='fa-solid fa-print'></i>",
                                "titleAttr": "Imprimir",
                                "className": "bg-light",
                                "name" : "print"
                            },
                        ]
                    });
                });
            },
            getBusiness() {
                var url = 'business';
                axios.get(url).then(res => {
                    this.businesses = res.data;
                    $('#businessTable').DataTable().destroy();
                    this.tabla();
                });
            },
            cancelar() {
                this.modoM = '1';
                $('#businessTable').DataTable().destroy();
                this.tabla();
            },
            divCrear() {
                this.datosBusiness = {
                        bsn_socio: this.idu,
                        bsn_title: '',
                        bsn_logo: '',
                        bsn_desc: '',
                        bsn_status: '',
                        bsn_horario: '',
                    },
                this.titulo = 'Crear Nuevo Negocio';
                this.modoM = '2';
                this.btnC = true;
                this.btnE = false;
            },
            crear() {
                var url = 'business';
                axios.post(url, this.datosBusiness).then(res => {
                    this.datosBusiness = {
                        bsn_socio: '',
                        bsn_title: '',
                        bsn_logo: '',
                        bsn_desc: '',
                        bsn_status: '',
                        bsn_horario: ''
                    };
                    this.modoM = '1';
                    this.getBusiness();
                    // console.log(res);
                    alertas.correcto();
                }).catch(error => {
                    if (error.response.status === 422) {
                        var array = Object.values(error.response.data.errors);
                        array.forEach(element => Swal.fire(String(element)));
                    }
                    if (error.response.status === 413) {
                        Swal.fire('Error!','La imagen es demaciado pesada, elije otra, porfavor','error');
                    }
                });
            },
            divEditar(datos) {
                this.datosBusiness = {
                        bsn_socio: datos.bsn_socio,
                        bsn_title: datos.bsn_title,
                        bsn_logo: datos.bsn_logo,
                        bsn_desc: datos.bsn_desc,
                        bsn_status: datos.bsn_status,
                        bsn_horario: datos.bsn_horario
                    },
                this.titulo = 'Editar Negocio';
                this.modoM = '2';
                this.btnC = false;
                this.btnE = true;
                this.id = datos.id;
            },
            editar() {
                var url = 'business/' + this.id;
                axios.put(url, this.datosBusiness).then(res => {
                    this.id = '';
                    this.modoM = '1';
                    console.log(res);
                    this.getBusiness();
                    alertas.correcto();
                }).catch(error => {
                    if (error.response.status === 422) {
                        var array = Object.values(error.response.data.errors);
                        array.forEach(element => Swal.fire(String(element)));
                    }
                    if (error.response.status === 413) {
                        Swal.fire('Error!','La imagen es demaciado pesada, elije otra, porfavor','error');
                    }
                });
            },
            eliminar(datos) {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "No podras revertir esto!, Te recomendamos desactivar tu negocio para no perder información.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        var url = 'business/' + datos.id;
                        axios.delete(url).then(res => {
                            this.getBusiness();
                            Swal.fire('Eliminado!', 'El Negocio ha sido borrado con exito', 'success');
                        });
                    }
                });
            },
            productos(datos) {
                this.id = datos.id;
                this.bname = datos.bsn_title;
                this.modoM = '3';
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.datosBusiness.bsn_logo = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            },
            get_click(click) {
                switch (click) {
                    case 'close':
                        this.modoM = '1';
                        $('#businessTable').DataTable().destroy();
                        this.tabla();
                        break;
                    default:
                        break;
                }
            },
        }
    }

</script>
