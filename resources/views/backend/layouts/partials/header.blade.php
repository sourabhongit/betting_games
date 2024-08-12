<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <!-- .nk-header-news -->
            <div class="nk-header-tools p-0">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                @if (auth()->user())
                                <div class="user-avatar sm">
                                    {{ ucfirst(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                @else
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                @endif
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    @if (auth()->user())
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->name }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                            </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- main header @e -->
@push('custom-js')
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert-dismissible").fadeTo(2000, 0).slideUp(2000, function() {});
        }, 4000); // Change alert duration according to your needs
    });
</script>
@endpush