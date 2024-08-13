<template>
    <div class="container">
        <div class="row text-center">
            <div class="offset-md-2 col-8">
                <div class="card px-2">
                    <div class="fs-1 card-title">Verificacion de la cuenta</div>
                    <div class="card-text">
                        <h4>Te enviaremos un correo electrónico para verificar que eres tú.</h4>
                        <button type="button" class="btn btn-primary my-3" @click.prevent="correo()">Enviar Correo</button>
                    <div class="row mx-auto my-3">
                        <form action="" class="row d-flex justify-content-around">
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                    <button type="button" class="btn btn-success my-4" @click.prevent="verificar()">Confirmar cuenta</button>
                    </div>
                    <div class="card-footer">
                        <a href="#">Si no recibiste ningun correo haz click aqui para recibir ayuda</a>
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
        },
        mounted() {
        },
        data() {
            return{
            }
        },
        methods: {
            correo(){
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Correo enviado con exito!',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            verificar(){
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Cuenta verificada!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        },
    }

</script>

