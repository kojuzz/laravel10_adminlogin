<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">

        <a href="{{ route("admin.dashboard") }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <x-svg icon="vuexy" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Admin Panel</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        {{-- Dashboard --}}
        <li class="menu-item">
            <a href="{{ route("admin.dashboard") }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Leaflet Maps">Dashboard</div>
            </a>
        </li>

        <!-- Info -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Forms & Tables">Info</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-grid"></i>
                <div data-i18n="Info">Info</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route("admin.admin-list") }}" class="menu-link">
                        <div data-i18n="Admins">View Admins</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="tables-datatables-advanced.html" class="menu-link">
                        <div data-i18n="About">About</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Welcome Page -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Charts & Maps">Welcome Page</span>
        </li>
        <li class="menu-item">
            <a href="{{ route("welcome") }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-map"></i>
                <div data-i18n="Leaflet Maps">Welcome Page</div>
            </a>
        </li>

    </ul>
</aside>
