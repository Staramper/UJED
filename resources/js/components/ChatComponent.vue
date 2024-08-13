<template>
    <div class="container shadow">
        <div class="row">
            <div class="col-3 bg-dark">
                <div>
                    Panel
                </div>
            </div>
            <div class="col-9 bg-success">
                Chats
            </div>
        </div>
        <div class="row h-pantalla">
            <div class="col-3">
                <div class="d-flex align-items-center"  v-for="chat in chats">
                    <p class="p-1" 
                    @click.prevent="selectChat( idu==chat.cht_orig ? chat.cht_dest : chat.cht_orig, chat.cht_business)"> 
                        {{ idu==chat.cht_orig ? chat.ndes : chat.norg }}</p>
                </div>
            </div>
            <div class="col-9 d-block align-items-end">
                <div class="overflow-auto" id="wp1">
                    <div class="p-2 ps-4 pt-3 shadow" v-for="message in messages">
                        <div class="rowx">{{ message.norg + ' - ' + message.cht_fecha_hora }}</div>
                        <div class="rowx ps-4 fw-bold">{{ message.cht_message }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row offset-3">
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
                var url = 'chat';
                axios.get(url).then(res => {
                    this.chats = res.data;
                });
            },
            selectChat(chat, business){
                this.datosChat.cht_dest = chat;
                this.datosChat.cht_business = business;
                var url = 'chat/' + chat;
                axios.get(url).then(res => {
                    this.messages = res.data;
                });
            },
            sendMsg(){
                var url = 'chat';
                axios.post(url, this.datosChat).then(res => {
                    this.datosChat.cht_message = '';    
                    this.selectChat(this.datosChat.cht_dest, this.datosChat.cht_business);
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
    .h-pantalla {
    height: 70vh;
    }

    #wp1{
        max-height: 400px;
        height: 400px;
    }
</style>