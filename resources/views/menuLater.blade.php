        
    <ul class="nav nav-pills nav-sidebar flex-column">
        
        @switch(auth()->user()->role)
        @case('admin')
        <!-- Menus Administrador -->
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gear"></i>
                <p> Administración</p>
                <i class="fas fa-angle-left right"></i>
            </a>

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('adminUser') }}" class="nav-link">
                        <i class="fas fa-fw fa-user"></i>
                        <p> Usuarios</p>
                    </a></li>
            </ul>

            <!-- <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('negocio') }}" class="nav-link">
                        <i class="fa-solid fa-building"></i>
                        <p> Negocios</p>
                    </a></li>
            </ul> -->

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('producto') }}" class="nav-link">
                        <i class="fa-solid fa-tag"></i>
                        <p> Productos</p>
                    </a></li>
            </ul>

            <!-- <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('quejav') }}" class="nav-link">
                        <i class="fa-solid fa-face-smile-beam"></i>
                        <p> Comentarios</p>
                    </a></li>
            </ul>

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('chats') }}" class="nav-link">
                        <i class="fa-regular fa-comments"></i>
                        <p> Chats</p>
                    </a></li>
            </ul> -->

        </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('cart') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <p> Carrito</p>
        </a> 

        <li class="nav-item has-treeview">
            <a href="{{ route('orders') }}" class="nav-link">
            <i class="fa-solid fa-money-bill"></i>
            <p> Pedidos</p>
        </a>      
        
        <!-- <li class="nav-item has-treeview">
            <a href="{{ route('acount') }}" class="nav-link">
            <i class="fa-solid fa-globe"></i>
            <p> Cuenta</p>
        </a>       -->


        <menu-later></menu-later>

        @break

        <!-- Menus Socio -->
        @case('socio')

        <!-- <li class="nav-header">Emprendedores</li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-city"></i>
                <p> Socios</p>
                <i class="fas fa-angle-left right"></i>
            </a>

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('negocio') }}" class="nav-link">
                        <i class="fa-solid fa-building"></i>
                        <p> Mis Negocios</p>
                    </a></li>
            </ul>

            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item px-2">
                    <a href="{{ route('chats') }}" class="nav-link">
                        <i class="fa-regular fa-comments"></i>
                        <p> Mis Chats</p>
                    </a></li>
            </ul>
        </li>

        <li class="nav-header">Mi perfil</li>
        <li class="nav-item has-treeview">
            <a href="{{ route('quejav') }}" class="nav-link">
                <i class="fa-solid fa-face-tired"></i>
                <p> Quejas</p>
            </a>        
        </li> -->

        <li class="nav-item has-treeview">
            <a href="{{ route('cart') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <p> Carrito</p>
        </a> 

        <li class="nav-item has-treeview">
            <a href="{{ route('orders') }}" class="nav-link">
            <i class="fa-solid fa-money-bill"></i>
            <p> Pedidos</p>
        </a>      
        
        <!-- <li class="nav-item has-treeview">
            <a href="{{ route('acount') }}" class="nav-link">
            <i class="fa-solid fa-globe"></i>
            <p> Cuenta</p>
        </a>        -->

        <menu-later></menu-later>

        @break

        <!-- Menus Usuario -->
        @case('user')
        <!-- <li class="nav-header">Mi perfil</li>
        <li class="nav-item has-treeview">
            <a href="{{ route('quejav') }}" class="nav-link">
                <i class="fa-solid fa-face-tired"></i>
                <p> Quejas</p>
            </a>        
        </li> -->

        <li class="nav-item has-treeview">
            <a href="{{ route('cart') }}" class="nav-link">
            <i class="fa-solid fa-cart-shopping"></i>
            <p> Carrito</p>
        </a> 

        <li class="nav-item has-treeview">
            <a href="{{ route('orders') }}" class="nav-link">
            <i class="fa-solid fa-money-bill"></i>
            <p> Pedidos</p>
        </a>      

        <!-- <li class="nav-item has-treeview">
            <a href="{{ route('acount') }}" class="nav-link">
            <i class="fa-solid fa-globe"></i>
            <p> Cuenta</p>
        </a>       -->

        <menu-later></menu-later>

        @break

        @default

        @endswitch
        </li>
    </ul>
