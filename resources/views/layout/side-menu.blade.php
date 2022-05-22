<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div class="navbar-brand-box">
            <a href="{{ route('dash') }}" class="logo">
                <i class="feather-airplay"></i>
                <span>
                    ERP
                </span>
            </a>
        </div>
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ route('dash') }}" class="waves-effect">
                        <i class="fa fa-home"></i><span>Início</span>
                    </a>
                </li>

                <li id="menu-usuarios">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-user"></i><span>Usuários</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-usuarios-index"><a href="{{route('usuario.index')}}">Listar Usuários</a></li>
                        <li id="menu-usuarios-create"><a href="{{route('usuario.create')}}">Novo Usuário</a></li>
                    </ul>
                </li>

                <li id="menu-funcionarios">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-users"></i><span>Funcionários</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-funcionarios-index"><a href="{{route('funcionario.index')}}">Listar Funcionários</a></li>
                        <li id="menu-funcionarios-create"><a href="{{route('funcionario.create')}}">Novo Funcionário</a></li>
                    </ul>
                </li>

                <li id="menu-clientes">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="far fa-handshake"></i><span>Clientes</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-clientes-index"><a href="{{route('cliente.index')}}">Listar Clientes</a></li>
                        <li id="menu-clientes-create"><a href="{{route('cliente.create')}}">Novo Cliente</a></li>
                    </ul>
                </li>

                <?php if(isset($_GET['debug'])): ?>
                <hr>
                <li>
                    <a href="{{ route('usuario.seed') }}" class="waves-effect">
                        <i class="fas fa-user-plus"></i><span>Criar Usuários</span>
                    </a>

                    <a href="{{ route('funcionario.seed') }}" class="waves-effect">
                        <i class="fas fa-user-plus"></i><span>Criar funcionários</span>
                    </a>

                    <a href="{{ route('cliente.seed') }}" class="waves-effect">
                        <i class="fas fa-user-plus"></i><span>Criar Clientes</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
