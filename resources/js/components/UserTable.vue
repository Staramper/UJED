User Table
<template>
    <!-- TABLA PARA MOSTRAR LOS USUARIOS -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="d-flex align-items-center m-0 text-primary">Usuarios</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser" @click="mCrear()">
                    <i class="fa-solid fa-user-plus"></i> Crear Nuevo Usuario
                </button>
            </div> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="userTable">
                    <thead>
                        <tr class="bg-dark">
                            <!-- <th width="5%">Id</th> -->
                            <th width="20%">Nombre</th>
                            <th width="15%">Nick</th>
                            <th width="15%">Tel</th>
                            <th width="20%">Email</th>
                            <th width="10%">Rol</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in usuarios">
                            <!-- <td>{{ user.id }}</td> -->
                            <td>{{ user.name }}</td>
                            <td>{{ user.nick }}</td>
                            <td>{{ user.tel }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.role }}</td>
                            <td class="d-flex justify-content-around">
                                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalUser" @click="mEditar(user)" title="Editar el usuario">
                                <i class="fa-regular fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-dark" @click="eliminar(user)" title="Eliminar el usuario"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- VENTANA MODAL PARA EL USUARIO -->
    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5" id="modalUserLabel"> {{ titulo }}</h1>
                    <!-- <button type="button" id="close" class="btn-closex" data-bs-dismiss="modal" aria-label="Close">
                    </button> -->
                    <i class="fa-solid fa-xmark" id="close" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" placeholder="Nombre del usuario"
                            v-model="datosUsuario.name">
                        </div>
                        <div class="mb-3">
                            <label for="nick" class="form-label">Nick</label>
                            <input type="text" class="form-control" id="nick" aria-describedby="nickHelp" placeholder="NickName del usuario"
                            v-model="datosUsuario.nick">
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">Tel</label>
                            <input type="text" class="form-control" id="tel" aria-describedby="telHelp" placeholder="Telefono del usuario"
                            v-model="datosUsuario.tel">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email del usuario"
                            v-model="datosUsuario.email">
                        </div>
                        <div class="" v-if="modoCrear">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña del usuario"
                            v-model="datosUsuario.password">
                            <div id="passwordHelp" class="form-text">Nunca debes compartir tu contraseña con terceros</div>
                        </div>
                        <div class="" v-if="modoEditar">
                            <label for="role" class="form-label">Rol del Usuario</label>
                            <select class="form-select" aria-label="role" v-model="datosUsuario.role">
                                <option value="user">user</option>
                                <!-- <option value="socio">socio</option> -->
                                <option value="admin">admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" @click.prevent="crear()" v-if="modoCrear">Crear Usuario</button>
                        <button type="submit" class="btn btn-success" @click.prevent="editar()" v-if="modoEditar">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import * as alertas from '../alertas';

    export default {
        mounted() {
            this.getUser();
        },
        data() {
            return {
                usuarios: [],
                datosUsuario: {name:'',nick:'',tel:'', email:'',password:'', role:''},
                titulo: '',
                modoCrear: false,
                modoEditar: false,
                idUser: '',
            }
        },
        methods: {
            tabla(){
                this.$nextTick(() => {
                    $('#userTable').DataTable({
                        "order": [[ 0, 'desc']],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
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
            getUser(){
                axios.get('listar_usuarios').then(res => {
                    this.usuarios = res.data;
                    $('#userTable').DataTable().destroy();
                    this.tabla();
                });
            },
            mCrear(){
                this.datosUsuario = {name:'',nick:'',tel:'', email:'',password:'', role:''};
                this.titulo = 'Crear Nuevo Usuario';
                this.modoCrear = true;
                this.modoEditar = false; 
            },
            crear(){
                axios.post('crear_usuarios',this.datosUsuario).then(res => {
                    this.datosUsuario = {name:'',nick:'',tel:'', email:'',password:'', role:''};
                    this.getUser();
                    $('#close').click();
                    alertas.correcto();
                }).catch(function (error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            mEditar(datos){
                this.datosUsuario = {name: datos.name , nick: datos.nick, tel:datos.tel, email: datos.email, role: datos.role};
                this.titulo = 'Editar Usuario';
                this.modoEditar = true; 
                this.modoCrear = false;
                this.idUser = datos.id;
            },
            editar(){
                axios.put('editar_usuarios/' + this.idUser, this.datosUsuario).then(res => {
                    this.idUser = '',
                    this.getUser();
                    $('#close').click();
                    alertas.correcto();
                }).catch(function (error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });    
            },
            eliminar(datos){
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
                    axios.delete('eliminar_usuarios/' + datos.id).then(res => {
                    this.getUser();
                    Swal.fire('Eliminado!','El registro ha sido borrado con exito','success');
                })
            }
                })
            }
        }
    }

</script>
