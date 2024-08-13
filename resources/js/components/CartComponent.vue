<template >
    <div v-if="modo==1" class="container">
        
        <div class="row">
            <div class="col">
                <div class="text-center">
                        <p class="display-4 text-primary shadow p-3">Mi carrito</p>
                    </div>
            </div>
        </div>

        <div v-if="this.carts==''" class="row">
            <div class="col-lg-6 mx-auto card p-2">
                <div class="col text-center">
                    <h2>No tinenes nada en tu carrito</h2>
                    <h2>¿Quieres ver nuestros productos?</h2>
                    <button type="button" class="btn btn-primary btn-lg" @click.prevent="home()">
                    <i class="fa-solid fa-house"></i> Ver productos!</button>
                </div> 
            </div>
        </div>
        
        <div v-else class="row">

            <div class="col-md-5">
                    <div class="card p-2" id="RCompra">
                        <h2 class="text-center">Resumen de compra</h2>
                        <hr>
                        <div class="card-text mb-1">
                            <h5>Cantidad de productos: {{ total.totalProducts }}</h5>
                        </div>
                        <div class="card-footer">
                            <h3 class="col-12 my-3">Total: {{ total.totalAmount }}.00</h3>
                            <div class="col-12">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="button" @click.prevent="targeta()">Continuar con la compra</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-md-7 card p-2">
                <h2 class="text-center">Productos</h2>
                <hr>
                    <div class="card mt-1" v-for="cart in carts">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h2 class="card-title">{{ cart.prd_title }}</h2>
                                    <p class="card-text">{{ cart.prd_desc }} </p>
                                    <p class="card-text fs-4 fw-light">${{ cart.prd_price }} </p>
                                    <div class="d-grid gap-2">
                                        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-primary" @click.prevent="restar(cart)">-</button>
                                            <input type="button" disabled class="btn btn-primary" v-model= cart.amount>
                                            <button type="button" class="btn btn-primary" @click.prevent="sumar(cart)">+</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger my-1" @click.prevent="eliminar(cart)">
                                        <i class="fa-solid fa-trash"></i></button>
                                </div>
                                <div class="col-6 text-center">
                                    <img :src="'storage/' + cart.prd_picture" class="img-fluid rounded" width="170" height="170">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="modo==2" class="caontainer">
        <div class="row">
            <div class="col">
                <div class="text-center">
                        <p class="display-4 text-primary shadow p-3">Completa y confirma tu direccion de entrega</p>
                    </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                <form method="post">
                    <div class="card-body">
                        <div class="form-text mb-1 text-danger">Los campos con un asterisco rojo, son obligatorios.</div>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="cp" class="form-label"><span class="text-danger">* </span>CP</label>
                                    <input type="text" class="form-control" id="cp" aria-describedby="cpHelp" placeholder="Código Postal"
                                    v-model="domicilio.cp">
                                </div>
                                <div class="mb-3">
                                    <label for="municipality" class="form-label"><span class="text-danger">* </span>Municipio</label>
                                    <input type="text" class="form-control" id="municipality" aria-describedby="municipalityHelp" placeholder="Municipio del dominilio"
                                    v-model="domicilio.municipality">
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label"><span class="text-danger">* </span>Calle</label>
                                    <input type="text" class="form-control" id="street" aria-describedby="streetHelp" placeholder="Calle del domicilio"
                                    v-model="domicilio.street">
                                </div>             
                                <div class="mb-3">
                                    <label for="interior_number" class="form-label">Número interior</label>
                                    <input type="text" class="form-control" id="interior_number" aria-describedby="interior_numberHelp" placeholder="Número interior del domicilio"
                                    v-model="domicilio.interior_number">
                                </div>          
                                
                                
                                
                            </div>
                            <div class="col-6">

                                <div class="mb-3">
                                    <label for="state" class="form-label"><span class="text-danger">* </span>Estado</label>
                                    <input type="text" class="form-control" id="state" aria-describedby="stateHelp" placeholder="Estado de domicilio"
                                    v-model="domicilio.state">
                                </div>
                                <div class="mb-3">
                                    <label for="cologne" class="form-label">Colonia</label>
                                    <input type="text" class="form-control" id="cologne" aria-describedby="cologneHelp" placeholder="Colonia del domicilio"
                                    v-model="domicilio.cologne">
                                </div>
                                <div class="mb-3">
                                    <label for="outer_number" class="form-label"><span class="text-danger">* </span>Número exterior</label>
                                    <input type="text" class="form-control" id="outer_number" aria-describedby="outer_numberHelp" placeholder="Número exterior del domicilio"
                                    v-model="domicilio.outer_number">
                                </div>  

                            </div>

                        </div>
                        
                    </div>

                    <div class="card-footer ms-auto text-end">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button> -->

                        <button type="submit" class="btn btn-success" @click.prevent="exito()" 
                        v-if="domicilio.cp != '' && domicilio.state != '' && domicilio.municipality != '' && domicilio.street != '' 
                        && domicilio.outer_number != ''">Guardar Cambios</button>
                    
                        <button type="submit" class="btn btn-success disabled" 
                        v-if="domicilio.cp == '' || domicilio.state == '' || domicilio.municipality == '' || domicilio.street == '' 
                        || domicilio.outer_number == ''">Guardar Cambios</button>
                    
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>


</template>

<script>
import * as alertas from '../alertas';
import { loadStripe } from '@stripe/stripe-js';

    export default {
        props: {
            id: {
                type: String,
                default: '',
                required: true
            },
        },
        mounted() {
            this.getCarrito();
            // console.log(this.carts);
            // this.cantidad = this.cart.amount;
        },
        data() {
            return{
                domicilio: [],
                carts: [],
                total: 0,
                amount: 0,
                datos:[],
                cantidad: 0,
                modo: 1,
                pedido: [],
            }
        },
        methods: {
            getCarrito(){
                var url = 'getcarrito';
                axios.get(url).then(res => {
                    this.carts = res.data.carts;
                    this.total = res.data.total;
                    // console.log(this.carts);
                });
            },
            sumar(datos){
                this.amount = datos.amount;
                this.amount++;
                this.datos = {amount: this.amount};
                axios.put('sumar_carrito/' + datos.id, this.datos).then(res => {
                    // console.log(res);
                    this.getCarrito();
                })
            },
            restar(datos){
                this.amount = datos.amount;
                this.amount > 1 ? this.amount-- : null
                this.datos = {amount: this.amount};
                axios.put('restar_carrito/' + datos.id, this.datos).then(res => {
                    // console.log(res);
                    this.getCarrito();
                })
            },
            targeta(){
                this.modo = 2;
                this.getDom();
            },
            getDom(){
                    axios.get('get_dom').then(res => {
                        this.domicilio = res.data;
                    });
            },
            home(){
                window.location.href = '/home';
            },
            async exito() {
                try {
                    await axios.put('edit_dom/' + this.id, this.domicilio);
                    const response = await axios.post('/create-checkout-session');
                    const sessionId = response.data.id;
                    const stripe = Stripe(import.meta.env.VITE_STRIPE_PUBLIC_KEY);
                    const { error } = await stripe.redirectToCheckout({ sessionId });

                    if (error) {
                        console.error('Error al redirigir a Stripe:', error);
                    } else {
                        // Aquí puedes redirigir al usuario a mostrarcompra si todo fue exitoso
                        window.location.href = 'orders';
                    }
                } catch (error) {
                    console.error('Error al crear la sesión de pago:', error);
                }
            },
            eliminar(datos){
                console.log(datos);
                Swal.fire({
                title: '¿Estas seguro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminalo!',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.value) {
                    axios.delete('eliminar_carrito/' + datos.id).then(res => {
                    this.getCarrito();
                    Swal.fire('Eliminado!','El producto ha sido borrado con exito','success');
                })
            }
                })
            },
        },
    }

</script>

