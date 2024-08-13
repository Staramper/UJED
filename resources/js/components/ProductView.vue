<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col text-center my-autox">
                    <img :src="'storage/' + pimg " class="img-fluid rounded">
                </div>
                <div class="col-6 text-start">
                    <div class="row">
                        <div class="col">
                            <p class="fs-1">
                                {{ ptitle }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ pdesc }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="fs-1 fw-light">
                                ${{ pprice }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">Cantidad</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" @click.prevent="restar()">-</button>
                                <input type="button" disabled class="btn btn-primary" v-model="this.cantidad">
                                <button type="button" class="btn btn-primary" @click.prevent="sumar()">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-lg" @click.prevent="agregar()">
                            <i class="fa-solid fa-cart-shopping"></i> Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as alertas from '../alertas';
    export default {
        props: {
            pid: {
                type: String,
                default: 0,
                required: true
            },
            ptitle: {
                type: String,
                default: '',
                required: true
            },
            pdesc: {
                type: String,
                default: '',
                required: true
            },
            pprice: {
                type: String,
                default: '',
                required: true
            },
            pimg: {
                type: String,
                default: '',
                required: true
            },
        },
        mounted() {
        },
        data() {
            return{
                cantidad: 1,
                datosCarrito: {pid: '', amount: ''},
            }
        },
        methods: {
            sumar(){
                this.cantidad ++;
            },
            restar(){
                this.cantidad > 1 ? this.cantidad-- : null
            },
            agregar(){
                this.datosCarrito = {pid : this.pid, amount : this.cantidad};
                axios.put('agregar_carrito',this.datosCarrito).then(res => {
                    this.agregarC();
                }).catch(function (error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => Swal.fire(String(element)));
                });
            },
            agregarC(){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Producto agregado con exito",
                    text: "¿Quieres ver tu carrito?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ir a mi carrito!",
                    cancelButtonText: "Seguir comprando",
                    reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    window.location.href = '/cart';
            }
                })
            }
        },
    }

</script>
