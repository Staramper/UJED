Produc table
<template>
    <!-- TABLA PARA MOSTRAR LOS PRODUCTOS -->
    <button v-if="rol=='socio'" type="button" class="btn btn-danger mb-2" @click="regresar()">
                        <i class="fa-solid fa-reply"></i> Regresar
                    </button>
    <div v-if="modoM" class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="d-flex align-items-center m-0 text-primary">Produtos</h3>
                <div v-if="rol=='socio'" class="d-flex align-items-center m-0 p-2 bg-dark text-white rounded"> {{ bname }}</div>
                <div>
                    <button type="button" class="btn btn-primary" @click="divCrear()">
                        <i class="fa-solid fa-user-plus me-1"></i>Crear Nuevo Producto
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="productTable">
                    <thead>
                        <tr class="bg-dark">
                            <!-- <th v-if="rol=='admin'" width="5%">Id</th>
                            <th v-if="rol=='admin'" width="5%">IdN</th> -->
                            <!-- <th v-if="rol=='admin'" width="5%">Negocio</th> -->
                            <th width="10%">Nombre</th>
                            <th width="10%">Foto</th>
                            <th width="25%">Descripción</th>
                            <th width="10%">Detalles</th>
                            <th width="5%">Precio</th>
                            <th width="5%">Estatus</th>
                            <th width="10%">Tipo</th>
                            <th width="10%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <!-- <td v-if="rol=='admin'">{{ product.id }}</td>
                            <td v-if="rol=='admin'">{{ product.prd_business }}</td> -->
                            <!-- <td v-if="rol=='admin'">{{ product.bsn_title }}</td> -->
                            <td>{{ product.prd_title }}</td>
                            <td><img :src="'storage/' + product.prd_picture" class="img-fluid rounded"></td>
                            <td>{{ product.prd_desc }}</td>
                            <td>{{ product.prd_details }}</td>
                            <td>{{ product.prd_price }}</td>
                            <!-- <td>{{ product.prd_status }}</td> -->
                            <td v-if="product.prd_status=='01'">Activo</td>
                            <td v-if="product.prd_status=='02'">Inactivo</td>
                            <!-- <td>{{ product.prd_type }}</td> -->
                            <td v-if="product.prd_type=='1'">Alimentos y Bebidas</td>
                            <td v-if="product.prd_type=='2'">Prendas</td>
                            <td v-if="product.prd_type=='3'">Articulos personales</td>
                            <td v-if="product.prd_type=='4'">Electronicos</td>
                            <td v-if="product.prd_type=='5'">Accesorios</td>
                            <td v-if="product.prd_type=='6'">Asesorias</td>
                            <td v-if="product.prd_type=='7'">Artesanias</td>
                            <td v-if="product.prd_type=='8'">Servicios</td>
                            <td v-if="product.prd_type=='9'">Envios</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-outline-dark" id="editarP" @click="divEditar(product)" title="Editar el producto">
                                        <i class="fa-regular fa-pen-to-square"></i></button>
                                        <button class="btn btn-outline-dark" id="eliminarP" @click="eliminar(product)" title="Eliminar el producto">
                                            <i class="fa-solid fa-trash"></i></button>
                                    </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DIV PARA EL PRODUCTO -->
    <div v-else class="card">
        <div class="card-header bg-dark text-white"> {{  titulo }} </div>
        <div class="card-body">
            <div class="card-text">
                <form method="post">
                    <!-- <div class="row">
                        <div v-if="rol=='admin'" class="col-12 mb-3">
                            <label for="business" class="form-label">Id del Negocio</label>
                            <input type="number" class="form-control" id="business" placeholder="Escribe el Id del negocio"
                            v-model="datosProduct.prd_business">
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" placeholder="Escribe el Nombre del producto"
                            v-model="datosProduct.prd_title">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="picture" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="picture" name="picture" 
                            v-on:change=onFileChange>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="desc" class="form-label">Descripción</label>
                            <textarea type="text" class="form-control" id="desc" placeholder="Escribe la descripción del producto"
                            v-model="datosProduct.prd_desc"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="detail" class="form-label">Detalles</label>
                            <input type="text" class="form-control" id="detail" placeholder="Escribe  los detalles del producto"
                            v-model="datosProduct.prd_details">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" placeholder="Escribe el precio del producto"
                            v-model="datosProduct.prd_price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="status" class="form-label">Estatus</label>
                            <select class="form-select" aria-label="status" v-model="datosProduct.prd_status">
                                <option value="01">Activo</option>
                                <option value="02">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="type" class="form-label">Tipo</label>
                            <select class="form-select" aria-label="type" v-model="datosProduct.prd_type">
                                <option value="1">Alimentos y bebidas</option>
                                <option value="2">Prendas</option>
                                <option value="3">Articulos Personales</option>
                                <option value="4">Electronicos</option>
                                <option value="5">Accesorios</option>
                                <option value="6">Tutorias</option>
                                <option value="7">Artesanias</option>
                                <option value="8">Servicios</option>
                                <option value="9">Envios</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger" @click.prevent="cancelar()">Cerrar</button>
                                <button type="submit" class="btn btn-success" @click.prevent="crear()"
                                    v-if="btnC">Crear Producto</button>
                                <button type="submit" class="btn btn-warning" @click.prevent="editar()"
                                    v-if="btnE">Guardar Cambios</button>
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
            bname: {
                type: String,
                default: '',
                required: false
            },
            idb: {
                type: String,
                default: '',
                required: false
            },
        },
        mounted() {
            this.getProduct();
        },
        data() {
            return {
                products: [],
                datosProduct: {prd_business:'', prd_title:'',prd_picture:'', prd_desc:'', prd_details:'', 
                prd_price:'', prd_status:'', prd_type: ''},
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
                    $('#productTable').DataTable({
                        "order": [
                            [0, 'desc']
                        ],
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
            getProduct() {
                var url = 'product?bsn=' + this.idb;
                axios.get(url).then(res => {
                    this.products = res.data;
                    $('#productTable').DataTable().destroy();
                    this.tabla();
                });
            },
            cancelar(){
                this.modoM = true; 
                $('#productTable').DataTable().destroy();
                    this.tabla();
            },
            divCrear(){
                this.datosProduct = {prd_business: 1,prd_title:'',prd_picture:'', prd_desc:'', prd_details:'', 
                    prd_price:'', prd_status:'', prd_type: ''};
                this.titulo = 'Crear Nuevo Producto';                
                this.modoM = false;  
                this.btnC = true;
                this.btnE = false;
            },
            crear(){
                var url = 'product';
                axios.post(url, this.datosProduct).then(res => {
                    this.datosProduct = {prd_business:'', prd_title:'',prd_picture:'', prd_desc:'', prd_details:'', 
                        prd_price:'', prd_status:'', prd_type: ''};             
                    this.modoM = true;  
                    this.getProduct();
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
            divEditar(datos){
                this.datosProduct = {bsn_title:datos.bsn_title,prd_business:datos.prd_business, prd_title:datos.prd_title,
                    prd_picture:datos.prd_picture, prd_desc:datos.prd_desc, prd_details:datos.prd_details, 
                    prd_price:datos.prd_price, prd_status:datos.prd_status, prd_type:datos.prd_type };
                this.titulo = 'Editar Producto';                
                this.modoM = false;  
                this.btnC = false;
                this.btnE = true;
                this.id = datos.id;
                console.log(this.id);
            },
            editar(){
                var url = 'product/' + this.id;
                axios.put(url, this.datosProduct).then(res => {
                    this.id = '';
                    this.modoM = true; 
                    this.getProduct();
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
            eliminar(datos){
                Swal.fire({
                title: '¿Estas seguro?',
                text: "No podras revertir esto!, Te recomendamos desactivar tu producto para no perder información.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminalo!',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.value) {
                    var url = 'product/' + datos.id;
                        axios.delete(url).then(res => {
                        this.getProduct();
                        Swal.fire('Eliminado!','El Producto ha sido borrado con exito','success');
                });
            }
               });
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                // console.log(files);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;
                
                reader.onload = (e) => {
                    vm.datosProduct.prd_picture = e.target.result;
                    // console.log(vm.datosProduct.prd_picture);
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            },
            regresar(){
                this.emitter.emit('clicker', 'close');
            },
        }
    }
</script>
