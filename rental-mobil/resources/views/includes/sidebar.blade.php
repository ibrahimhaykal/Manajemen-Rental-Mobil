<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Data</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Mobil
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('car.index') }}">Semua Mobil</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
<div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
Pelanggan
<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
<a class="nav-link collapsed" href="{{ route('user.index') }}">
Pelanggan
</a>
</nav>
</div>
                <div class="sb-sidenav-menu-heading">Transaksi</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransactions" aria-expanded="false" aria-controls="collapseTransactions">
                    <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt"></i></div>
                    Transaksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTransactions" aria-labelledby="headingTransactions" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('rentals.index') }}">Peminjaman</a>
                    <a class="nav-link" href="{{ route('returns.index') }}">Pengembalian</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Profile</div>
                <a class="nav-link" href="{{ route('profile.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Profile
                </a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
<div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i
</div>
Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
            </div>
        </div>
        <div class="sb-sidenav-footer">
        <div class="small">Logged in as: {{ Auth::user()->name }}</div>
        </div>
    </nav>
</div>
