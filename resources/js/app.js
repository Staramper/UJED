
import './bootstrap';
import './alertas';
import { createApp } from 'vue';

import 'https://kit.fontawesome.com/c68c2b230c.js';
import 'https://code.jquery.com/jquery-3.7.0.js';
import 'https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js';
import 'https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js';

import 'https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js';
import 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js';
import pdfMake from "https://esm.sh/pdfmake";
import 'https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js';
import 'https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js';

pdfMake.fonts = {
    Roboto: {
      normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Regular.ttf',
      bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Medium.ttf',
      italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-Italic.ttf',
      bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/fonts/Roboto/Roboto-MediumItalic.ttf'
    },
  }

import mitt from 'mitt';
const emitter = mitt();

const app = createApp({});

app.config.globalProperties.emitter = emitter;

import NegocioComponent from './components/NegocioComponent.vue';
app.component('negocio-component', NegocioComponent);

import ProductoComponent from './components/ProductoComponent.vue';
app.component('producto-component', ProductoComponent);

import UserTable from './components/UserTable.vue';
app.component('user-table', UserTable);

import BusinessTable from './components/BusinessTable.vue';
app.component('business-table', BusinessTable);

import ProductTable from './components/ProductTable.vue';
app.component('product-table', ProductTable);

import QuejaTable from './components/QuejaTable.vue';
app.component('queja-table', QuejaTable);

import menuLater from './components/menuLater.vue';
app.component('menu-later', menuLater);

import ChatComponent from './components/ChatComponent.vue';
app.component('chat-component', ChatComponent);

import ChatClientComponent from './components/ChatClientComponent.vue';
app.component('chat-client', ChatClientComponent);

import ProductView from './components/ProductView.vue';
app.component('product-view', ProductView);

import OrderComponent from './components/OrderComponent.vue';
app.component('orders-component', OrderComponent);

import CartComponent from './components/CartComponent.vue';
app.component('cart-component', CartComponent);

import AccountComponent from './components/AccountComponent.vue';
app.component('account-component', AccountComponent);

app.mount('#app');


