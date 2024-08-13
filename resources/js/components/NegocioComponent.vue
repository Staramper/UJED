<template>

    <!-- DIV DEL TITULO DEL NEGOCIO -->
        <div class="container">
        <div v-if="ModoB==1" class="text-center">
            <p class="display-4 text-primary shadow p-3">¿Qué estás buscando?</p>
            <div class="row">
                <div v-if="rol=='user'" class="col">
                    <button class="btn btn-primary" @click="emprendedor()">¿Quieres convertirte en emprendedor?</button>
                </div>
            </div>
        </div>

        <!-- BOTON PARA REGRESAR A LOS NEGOCIOS -->
        <div class="row my-2">
            <div class="col">
                <button v-if="botonR" type="button" class="btn btn-danger me-2" @click="regresar()">
                    <i class="fa-solid fa-reply"></i> Regresar</button>
        </div>
        </div>

        <!-- DIV PARA LA INFORMACION DEL EMPRENDEDOR -->
        <div v-if="ModoB==3" class="container">
            <div class="row text-center">
                <div class="col mt-3 mb-1">
                    <p class="fs-1 text-primary shadow p-2 fw-bold">¿Qué puedo hacer como emprendedor?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 my-4 my-md-0">
                    <h1 class="fs-2 fw-bold text-primary">BENEFICIOS</h1>
                    <ul class="list-group">
                        <li class="list-group-item">1.- Crear negocios a nombre tuyo (Depende de la cuota).</li>
                        <li class="list-group-item">2.- Poder publicar productos.</li>
                        <li class="list-group-item">3.- Opciones de administración (Tu/s propio/s negocio/s).</li>
                        <li class="list-group-item">4.- Lugar dentro de la página de inicio.</li>
                        <li class="list-group-item">5.- Opción a actualizar.</li>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h1 class="fs-2 fw-bold text-primary">AVISOS</h1>
                    <p class="fs-6">(EL SITIO NO ASUME RESPONSABILIDAD POR LAS TRANSACCIONES REALIZADAS DENTRO DE LA
                        PLATAFORMA,
                        ÚNICAMENTE POR LA PROMOCIÓN DEL CONTENIDO).</p>
                    <p class="fs-6">(PARA CUALQUIER INCONVENIENTE, ESTAMOS A TU DISPOSICIÓN A TRAVÉS DE NUESTROS CANALES
                        DE
                        CONTACTO PARA ESCUCHAR TUS COMENTARIOS Y SUGERENCIAS).</p>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <p class="fs-1 text-primary p-1 fw-bold">Cuotas</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3 text-center">
                    <ul class="list-group">
                        <li class="list-group-item">Primer mes de prueba gratis</li>
                        <li class="list-group-item">1 negocio – $10</li>
                        <li class="list-group-item">3 negocios – $35</li>
                        <li class="list-group-item">5 negocios – $50 </li>
                        <li class="list-group-item">Negocios Ilimitados – $100</li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 text-center">
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Contactanos</button>
                </div>
            </div>
        </div>

        <!-- TARJETA POR CADA NEGOCIO -->
        <div v-if="ModoB==1" class="row">
            <div class="col-sm-12 col-md-6 mx-auto" v-for="business in businesses">
                <div class="card">
                    <div class="card-header bg-dark ">
                        <div class="d-flex justify-content-between">
                            <!-- <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-light" title="Opciones"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Hacer un comentario</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="card-titlex">{{ business.bsn_title }}</h2>
                                <p class="card-text">{{ business.bsn_desc }} </p>
                                <p class="card-text">{{ business.bsn_horario }} </p>
                                <a href="#" class="btn btn-primary"
                                    @click.prevent="getProduct(business.id, business.bsn_socio, business.tel)">Visitar!</a>
                            </div>
                            <div class="col-6 text-center">
                                <img :src="'storage/' + business.bsn_logo" class="img-fluid rounded" width="170"
                                    height="170">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TARJETA PARA VER LOS PROUCTOS -->
        <div v-if="ModoB==2" class="row">
            <div class="text-center">
                <p class="display-4 text-primary shadow p-3">Productos</p>
            </div>
            <div class="col-sm-12 col-md-6 mx-auto" v-for="product in products">
                <div class="card">
                    <div class="card-header bg-dark ">
                        <div class="d-flex justify-content-between">
                            <!-- <div class="d-flex align-items-center m-0 px-2 py-1 bg-light text-dark rounded">{{ nick }}</div> -->
                            <!-- <div class="btn btn-outline-light" title="Opciones"><i class="fa-solid fa-ellipsis-vertical"></i></div> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="text-primary">{{ product.prd_title }}</h2>
                                <p class="card-text">
                                    <div class="fw-bold">Descripción:</div>{{ product.prd_desc }}
                                </p>
                            </div>
                            <div class="col text-center my-autox">
                                <img :src="'storage/' + product.prd_picture" class="img-fluid rounded" width="170"
                                    height="170">
                            </div>
                            <div class="row my-4">
                                <div class="col-8">
                                    <p class="card-text">
                                        <div class="fw-bold">Detalles:</div>{{ product.prd_details }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p class="card-text">
                                        <div class="fw-bold">Precio:</div>${{ product.prd_price }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Comprar!
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMPONENTE PARA ABRIR EL CHAT -->
        <div v-if="Chat" class="row my-3">
            <div class="col">
                <chat-client :idb="this.actualBusiness" :ids="this.socioBusiness" :idu="this.idu"></chat-client>
            </div>
        </div>

        <!-- DIV PARA LAS QUEJAS DEL NEGOCIO -->
        <div>
            <div v-if="ModoB==2">
                <div class="row">
                    <div class="h2 text-primary shadow p-3 my-2">
                        <div class="d-flex justify-content-between">
                            <div class="col-7">
                                Comentarios
                            </div>
                            <div class="col-5 text-end">
                                <button type="button" class="btn btn-success" @click="divCrearQueja()">
                                    <i class="fa-solid fa-comment-medical"></i> Haz un comentario
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="ModoB==2" class="row">
                    <div class="col-12 mx-auto" v-for="queja in quejas">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <p>{{ queja.qjs_queja }}</p>
                                    </div>
                                    <div class="col-4">
                                        <p>{{ queja.qjs_fecha_hora }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COMPONENTE PARA CREAR LAS QUEJAS -->
        <div v-if="ModoB==4" class="row">
            <div class="card">
                <div class="d-flex bg-redx">
                    <h2 class="align-middle pt-2 text-primary">Comentarios</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <textarea type="text" class="form-control" id="queja"
                                placeholder="¿Qué piensas de este negocio?" v-model="datoscomm.qjs_queja"></textarea>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger"
                                        @click.prevent="cerrar()">Cerrar</button>
                                    <button type="submit" class="btn btn-success" @click.prevent="crearQueja()">Crear
                                        Comentario</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA CONTACTARSE CON EL VENDEDOR -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <!-- MODAL PARA EL VENDEDOR -->
                <div v-if="vendedor" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Como quieres contactar al vendedor?</h1>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col">
                                Por nuestro chat interno
                            </div>
                            <div class="col">
                                Por WhatsApp
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <a href="#" class="btn btn-primary" @click.prevent="abrirChat()">Chat</a>
                            </div>
                            <div class="col">
                                <a :href="'https://wa.me/' + this.tel +'?text=¡Estoy+interesado!'"
                                    class="btn btn-success" @click="abrirwhats()">
                                    <i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL PARA CONTACTARNOS -->
                <div v-else="vendedor" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Como quieres contactarnos?</h1>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col">
                                Envianos un Gmail
                            </div>
                            <div class="col">
                                Por WhatsApp
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <a class="btn btn-primary" href="mailto:lizbeth@yout.cloud"><i
                                        class="fa-regular fa-envelope"></i></a>
                            </div>
                            <div class="col">
                                <a href="https://wa.me/6182925191?text=¡Estoy+interesado!" class="btn btn-success"
                                    @click="abrirwhats()">
                                    <i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            nick: {
                type: String,
                default: 'user',
                required: true
            },
            idu: {
                type: String,
                default: 0,
                required: false
            },
            rol: {
                type: String,
                default: 'user',
                required: true
            },
        },
        created: function () {
            let self = this;
            this.emitter.on('categ', function (rComand) {
                self.get_click(rComand);
            });
        },
        mounted() {
            this.getBusiness();
        },
        data() {
            return {
                businesses: [],
                products: [],
                quejas: [],
                datoscomm: [],
                ModoB: 1,
                Chat: false,
                botonR: false,
                vendedor: true,
                showQ: false,
                CQueja: false,
                tel: '',
                Categ: '%',
                actualBusiness: 0,
                socioBusiness: 0,
            }
        },
        methods: {
            getBusiness() {
                var url = 'getnegocio?categ=' + this.Categ;
                axios.get(url).then(res => {
                    this.businesses = res.data;
                    // console.log(res);
                });
            },
            getProduct(dato, socio, tel) {
                this.actualBusiness = dato;
                this.socioBusiness = socio;
                this.tel = tel;
                this.ModoB = 2;
                this.botonR = true;
                // console.log(this.tel);
                var url = 'getproducto/' + dato;
                axios.get(url).then(res => {
                    this.products = res.data;
                });
                this.getQuejas();
            },
            getQuejas() {
                this.showQ = true;
                var url = 'getquejas/' + this.actualBusiness;
                axios.get(url).then(res => {
                    this.quejas = res.data;
                });
            },
            divCrearQueja() {
                this.ModoB = 4;
                this.botonR = false;
                this.Chat = false;
                const date = new Date();
                const formato = date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date
                        .getDate()).slice(-2) + " " +
                    ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2) + ":" +
                    ("0" + date.getSeconds()).slice(-2);
                this.datoscomm = {
                    qjs_user: this.idu,
                    qjs_business: this.actualBusiness,
                    qjs_queja: '',
                    qjs_response: '',
                    qjs_fecha_hora: formato,
                    qjs_status: '1'
                };
            },
            crearQueja() {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Una vez hecho el comentario, no podras eliminarlo o modificarlo!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, publicalo!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        var url = 'queja';
                        axios.post(url, this.datoscomm).then(res => {
                            this.datoscomm = {
                                qjs_user: '',
                                qjs_business: '',
                                qjs_queja: '',
                                qjs_response: '',
                                qjs_fecha_hora: '',
                                qjs_status: ''
                            };
                            Swal.fire('Buen trabajo!', 'El comentario se publico con exito', 'success');
                            this.getQuejas();
                            this.ModoB = 2;
                            this.botonR = true;
                        }).catch(function (error) {
                            var array = Object.values(error.response.data.errors);
                            array.forEach(element => Swal.fire(String(element)));
                        });     
                    }
                });
            },
            get_click(categ) {
                this.ModoB = 1;
                this.Chat = false;
                this.botonR = false;
                this.Categ = categ;
                // console.log(categ);
                this.getBusiness();
            },
            abrirChat() {
                $('#close').click();
                this.Chat = true;
            },
            abrirwhats() {
                $('#close').click();
            },
            emprendedor() {
                this.botonR = true;
                this.ModoB = 3;
                this.vendedor = false;
            },
            regresar() {
                this.ModoB = 1;
                this.botonR = false;
                this.Chat = false;
                this.vendedor = true;
                this.showQ = false;
                this.CQueja = false;
            },
            cerrar() {
                this.ModoB = 2;
                this.botonR = true;
            }
        }
    }

</script>
