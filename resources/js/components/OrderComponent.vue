<template>

    <!-- TABLA PARA MOSTRAR LOS REGISTROS -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="d-flex align-items-center m-0 text-primary">{{ this.fix }}s</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="Table">
                    <thead>
                        <tr class="bg-dark">
                            <!-- <th width="5%">N.</th> -->
                            <th width="10%">Numero de orden</th>
                            <th width="15%">Fecha del pedido</th>
                            <th v-if="rol=='admin'" width="10%">Usuario</th>
                            <th width="10%">Total</th>
                            <th width="5%">Estatus</th>
                            <th width="15%">Domicilio</th>
                            <th width="15%">Observaciones</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="record in data">
                            <!-- <td>{{ record.id }}</td> -->
                            <td>{{ record.num }}</td>
                            <td>{{ record.date }}</td>
                            <td v-if="rol=='admin'">{{ record.user_email }}</td>
                            <td>{{ record.total }}</td>
                            <td v-if="record.status=='E'">Emitido</td>
                            <td v-if="record.status=='C'" class="text-warning">En camino</td>
                            <td v-if="record.status=='R'" class="text-blue">Recibido</td>
                            <td v-if="record.status=='D'" class="text-danger">Declinado</td>
                            <td>{{ record.dom }}</td>
                            <td>{{ record.observations }}</td>
                            <td class="d-flex align-items-stretch justify-content-around">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modal" @click="mProductos(record)" title="Ver productos de la orden">
                                    <i class="fa-solid fa-list"></i>
                                </button>
                                <button v-if="rol=='admin' && record.status!='D'" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modal" @click="mEditar(record)" title="Editar">
                                    <i class="fa-regular fa-pen-to-square"></i></button>
                                <button v-if="record.status!='D'" class="btn btn-outline-dark" @click="eliminar(record)" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- VENTANA MODAL PARA EL REGISTRO -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div v-if="modo == 0" class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5" id="modalLabel"> Productos de la orden </h1>
                    <i class="fa-solid fa-xmark" id="close" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <!-- <div class="row"> -->
                    <div class="modal-body">
                        <card v-for="producto in productos">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <img :src="'storage/' + producto.picture " class="img-fluid rounded">
                                        </div>
                                        <div class="col-8">
                                            <h5 class="card-title">{{ producto.title }}</h5>
                                            <p class="card-text">{{ producto.desc }}</p>
                                            <p class="card-text">Cantidad: {{ producto.amount }}</p>
                                            <p class="card-text">Precio: ${{ producto.price }}</p>
                                        </div>
                                    </div>      
                                </div>
                                </div>
                        </card>
                    </div>
                <!-- </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
            </div>
            <div v-if="modo == 1" class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5" id="modalLabel"> Editar Orden </h1>
                    <i class="fa-solid fa-xmark" id="close" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-text mb-1 text-danger">Los campos con un asterisco rojo, son obligatorios.</div>
                        <div class="row">
                            <div class="col">

                                <div class="mb-3">
                                    <label for="status" class="form-label"><span class="text-danger">* </span>Estatus</label>
                                    <select class="form-select" aria-label="status" v-model="datos.status">
                                        <option value="C">En camino</option>
                                        <option value="R">Recibido</option>
                                        <option value="D">Declinado</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="observations" class="form-label">Observaciones</label>
                                    <textarea type="text" class="form-control" id="observations" aria-describedby="observationsHelp" placeholder="Destino del viaje del prospecto"
                                    v-model="datos.observations"></textarea>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    
                        <button type="submit" class="btn btn-success" @click.prevent="editar()">Guardar Cambios</button>
                    
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
        },
        mounted() {
            this.getInfo();
        },
        data() {
            return {
                data: [],
                productos: [],
                fix: 'Pedido',
                datos: {status:'', observations:''},
                titulo: '',
                modo: 0,
                idRecord: '',
            }
        },
        methods: {
            tabla(){
                this.$nextTick(() => {
                    $('#Table').DataTable({
                        "order": [[ 0, 'asc']],
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        },
                        dom:"<'row'<'col-sm-12 mb-2'B>>" +
                            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: [
                            {
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
                            // 'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    });
                });
            },
            getInfo(){
                axios.get('list_orders').then(res => {
                    this.data = res.data;
                    // console.table(this.data);
                    $('#Table').DataTable().destroy();
                    this.tabla();
                });
            },
            mProductos(datos){
                this.idRecord = datos.id;
                // console.log(this.idRecord);
                axios.get('list_products/'+ this.idRecord).then(res => {
                        this.productos = res.data;
                        this.modo = 0; 
                        // console.table('->',this.productos);
                        // console.log(this.productos.id);
                    });
            },
            crear(){
                axios.post('create_prospects',this.datos).then(res => {
                    this.datos = {name:'', email:'', tel:'', origin:'', destiny:'', status:''};
                    this.getInfo();
                    $('#close').click();
                    alertas.correcto();
                }).catch(function (error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            mEditar(datos){
                this.datos = {status: datos.status, observations: datos.observations};
                this.modo = 1;
                this.idRecord = datos.id;
                this.nipEmployee = datos.nip;
            },
            editar(){                
                axios.put('editar_orders/' + this.idRecord, this.datos).then(res => {
                    this.idRecord = '',
                    this.getInfo();
                    $('#close').click();
                    alertas.correcto();
                }).catch(function (error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            eliminar(datos){
                Swal.fire({
                title: 'Estas seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '¡Sí, declinalo!',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.value) {
                    axios.put('decline_orders/' + datos.id).then(res => {
                    this.getInfo();
                    Swal.fire('Eliminado!','El registro ha sido eliminado exitosamente.','success');
                })
            }
                })
            },
        }
    }

</script>
