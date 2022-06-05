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

                <li id="menu-clientes">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="far fa-handshake"></i><span>Clientes</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-clientes-index"><a href="{{route('cliente.index')}}">Listar Clientes</a></li>
                        <li id="menu-clientes-create"><a href="{{route('cliente.create')}}">Novo Cliente</a></li>
                    </ul>
                </li>

                <li id="menu-produtos">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-gift"></i><span>Produtos</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-produtos-index"><a href="{{route('produto.index')}}">Listar Produtos</a></li>
                        <li id="menu-produtos-create"><a href="{{route('produto.create')}}">Novo Produto</a></li>
                    </ul>
                </li>

                <li id="menu-contas">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-money"></i><span>Contas a Pagar e Receber</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-contas-index"><a href="{{route('conta.index')}}">Listar Contas</a></li>
                        <li id="menu-contas-create"><a href="{{route('conta.create')}}">Novo Conta</a></li>
                    </ul>
                </li>

                <li id="menu-vendas">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-shopping-cart"></i><span>PDV</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-vendas-index"><a href="{{route('venda.index')}}">Listar Vendas</a></li>
                        <li id="menu-vendas-create"><a href="{{route('venda.create')}}">Nova Venda</a></li>
                        <li id="menu-vendas-relatorio"><a href="{{route('venda.relatorio')}}">Relatório de Vendas</a></li>
                    </ul>
                </li>
                <hr>                
                <li id="menu-funcionarios">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-users"></i><span>Funcionários</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-funcionarios-index"><a href="{{route('funcionario.index')}}">Listar Funcionários</a></li>
                        <li id="menu-funcionarios-create"><a href="{{route('funcionario.create')}}">Novo Funcionário</a></li>
                    </ul>
                </li>

                <li id="menu-usuarios">
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fa fa-user"></i><span>Usuários</span></a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li id="menu-usuarios-index"><a href="{{route('usuario.index')}}">Listar Usuários</a></li>
                        <li id="menu-usuarios-create"><a href="{{route('usuario.create')}}">Novo Usuário</a></li>
                    </ul>
                </li>

                <?php if(isset($_GET['debug'])): ?>
                <hr>
                <li class="text-center"><h4 class="text-white">Popular Dados</h4></li>
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

                    <a href="{{ route('produto.seed') }}" class="waves-effect">
                        <i class="fas fa-gift"></i><span>Criar Produtos</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
