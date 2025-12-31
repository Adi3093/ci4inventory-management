<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Inventory Management</div>
    </a>

    <!-- Stock -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('stock'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Stock Barang</span></a>
    </li>

    <!-- Mutasi -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Mutasi Barang
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('masuk'); ?>">
            <i class="fas fa-fw fa-download"></i>
            <span>Masuk</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('keluar'); ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Keluar</span></a>
    </li>

    <!-- Kelola Akun -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Kelola Akun
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin</span></a>
    </li>
    <!-- close disebar btn -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>