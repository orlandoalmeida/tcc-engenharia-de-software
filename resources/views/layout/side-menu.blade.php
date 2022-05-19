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
                        <i class="feather-home"></i><span>Início</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-user"></i><span>Usuários</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a id="menu-usuarios-index" href="{{route('usuario.index')}}">Listar Usuários</a></li>
                        <li><a id="menu-usuarios-create" href="{{route('usuario.create')}}">Novo Usuário</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
