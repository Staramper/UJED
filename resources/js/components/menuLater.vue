<template>
    <div>
        <li class="nav-header">Categorias</li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('%')">
                <i class="fa-solid fa-bars"></i>
                <p> Todos los productos</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('1')">
                <i class="fa-solid fa-utensils"></i>
                <p> Alimentos y bebidas</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('2')">
                <i class="fa-solid fa-shirt"></i>
                <p> Prendas</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('3')">
                <i class="fa-solid fa-glasses"></i>
                <p> Artículos Personales</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('4')">
                <i class="fa-solid fa-laptop"></i>
                <p> Electrónicos</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('5')">
                <i class="fa-solid fa-person-rays"></i>
                <p> Accesorios</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('6')">
                <i class="fa-solid fa-chalkboard-user"></i>
                <p> Asesorías</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('7')">
                <i class="fa-solid fa-hands"></i>
                <p> Artesanías</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('8')">
                <i class="fa-solid fa-toolbox"></i>
                <p> Servicios</p>
            </a></li>

        <li class="nav-item px-2">
            <a href="#" class="nav-link" @click.prevent="setCateg('9')">
                <i class="fa-solid fa-truck"></i>
                <p> Envíos</p>
            </a></li>
            
    </div>
</template>

<script>
    export default {
        // props: {

        //     },
        //},
        mounted() {},
        data() {
            return {}
        },
        methods: {
            setCateg(ncat){
                 this.emitter.emit('categ', ncat);
                //  console.log(ncat);
            },
        }
    }

</script>
