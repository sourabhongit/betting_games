<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('dashboard') }}"><em class="icon ni ni-linux"
                    style="color: white; font-size: 30px"></em></a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link"><span class="nk-menu-icon"><em
                                    class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub"><a href="#" class="nk-menu-link nk-menu-toggle"><span
                                class="nk-menu-icon"><em class="icon ni ni-user"></em></span><span
                                class="nk-menu-text">User</span></a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item"><a href="{{ route('user.index') }}" class="nk-menu-link"><span
                                        class="nk-menu-icon"><em class="icon ni ni-users"></em></span><span
                                        class="nk-menu-text">Users</span></a></li>
                            <li class="nk-menu-item"><a href="{{ route('transactions') }}" class="nk-menu-link"><span
                                        class="nk-menu-icon"><em class="icon ni ni-swap-v"></em></span><span
                                        class="nk-menu-text">Transaction</span></a></li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('head.tail.results.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-puzzle"></em></span>
                            <span class="nk-menu-text">Head Tail Results</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('dragon.tiger.results.index') }}" class="nk-menu-link"><span class="nk-menu-icon"><em class="icon ni ni-puzzle"></em></span>
                            <span class="nk-menu-text">Dragon Tiger Results</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
