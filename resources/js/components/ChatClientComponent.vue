<template>
    <div class="container shadow">
        <div class="row">
            <div class="col bg-success">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center m-2 p-2 py-1 bg-light text-dark rounded">Chat</div>
                </div>
            </div>
        </div>
        <div class="row h-client">
            <div class="col-12 d-block align-items-end">
                <div class="overflow-auto" id="wp2">
                    <div class="p-2 ps-4 pt-3 shadow" v-for="message in messages">
                        <div class="row">{{ message.norg + ' - ' + message.cht_fecha_hora }}</div>
                        <div class="row ps-4 fw-bold">{{ message.cht_message }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Escribe tu mensaje" v-model="datosChat.cht_message">
                    <button class="btn btn-outline-success" @click.prevent="sendMsg()">Enviar</button>
                </div>
            </div>
        </div>
        </div>

</template>

<script>
    export default {
        props: {
            idu: {
                type: String,
                default: 0,
                required: true
            },
            idb: {
                type: String,
                default: 0,
                required: false
            },
            ids: {
                type: String,
                default: 0,
                required: false
            },
        },
        mounted() {
            this.getChat();
        },
        data() {
            return{
                chats: [],
                messages: [],
                datosChat: {
                    cht_message: '',
                    cht_dest: 0,
                    cht_business: 0,
                },
                id: '',
            }
        },
        methods: {
            getChat() {
                this.datosChat.cht_dest = this.ids;
                this.datosChat.cht_business = this.idb;
                var url = 'chatcli/' + this.idb + '/' + this.idu;
                axios.get(url).then(res => {
                    this.messages = res.data;
                    // console.log(res);
                });
            },
            selectChat(chat, business){
                var url = 'chat/' + chat;
                axios.get(url).then(res => {
                    this.messages = res.data;
                });
            },
            sendMsg(){
                var url = 'chat';
                axios.post(url, this.datosChat).then(res => {
                    // console.log(res);
                    this.datosChat.cht_message = '';    
                    this.getChat();
                }).catch(error => {
                    if (error.response.status === 422) {
                        var array = Object.values(error.response.data.errors);
                        array.forEach(element => Swal.fire(String(element)));
                    }
                });
            }
        },
    }

</script>

<style>
    .h-client {
    height: 60vh;
    }
    #wp2{
        max-height: 340px;
        height: 340px;
    }

</style>