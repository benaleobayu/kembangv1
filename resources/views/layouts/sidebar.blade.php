<div class="flex-shrink-0 p-3" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 text-decoration-none border-bottom">
        <span class="fs-5 ms-3 fw-semibold">CMS</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                Customers Center
            </button>
            <div class="collapse  {{ Request::is('customers*', 'subscribers*') ? 'show' : '' }}" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    @can('Read Customers')
                    <li>
                        <a href="/customers" class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('customers*') ? 'active' : '' }}">Customers</a>
                    </li>    
                    @endcan
                    @can('Read Langganan')
                    <li>
                        <a href="/subscribers" class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('subscribers*') ? 'active' : '' }}">Data Langganan</a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        <li>
            <a href="/riders"
                class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('riders*') ? 'active' : '' }}"
                style="padding: 6px 12px">Data Riders</a>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Orders
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="/orders"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('orders*') ? 'active' : '' }}">Data
                            Pesanan</a></li>
                    <li><a href="/paydrivers"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('paydrivers*') ? 'active' : '' }}">Ongkos
                            Rider</a></li>
                    <li><a href="/paycustomers"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('paycustomers*') ? 'active' : '' }}">Tagihan
                            Customers</a></li>
                    <li><a href="/documentation"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('documentation*') ? 'active' : '' }}">Dokumentasisss
                            Pesanan</a></li>
                </ul>
            </div>
        </li>
     
        @can('read Admin')
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#settings-collapse" aria-expanded="false">
                Settings
            </button>
            <div class="collapse {{ Request::is('admin*', 'roles*', 'regencies*', 'flowers*') ? 'show' : '' }}"
                id="settings-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li> <a href="/admin"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('admin*') ? 'active' : '' }}"
                            style="padding: 6px 12px">Admin</a></li>
                    <li> <a href="/roles"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('roles*') ? 'active' : '' }}"
                            style="padding: 6px 12px">Roles</a></li>
                    <li> <a href="/regencies"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('regencies*') ? 'active' : '' }}"
                            style="padding: 6px 12px">List Regency</a></li>
                    <li><a href="/flowers"
                            class="link-body-emphasis d-inline-flex text-decoration-none rounded {{ Request::is('flowers*') ? 'active' : '' }}"
                            style="padding: 6px 12px">List Bunga</a> </li>
                </ul>
            </div>
        </li>
        @else
        @endcan
        <li class="border-top my-3"></li>

        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                Account
            </button>
            <div class="collapse" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#"
                            class="link-body-emphasis link-dark d-inline-flex text-decoration-none rounded">New...</a>
                    </li>
                    <li><a href="#"
                            class="link-body-emphasis link-dark d-inline-flex text-decoration-none rounded">Profile</a>
                    </li>
                    <li><a href="#"
                            class="link-body-emphasis link-dark d-inline-flex text-decoration-none rounded">Settings</a>
                    </li>
                    <li><a href="/logout"
                            class="link-body-emphasis link-dark d-inline-flex text-decoration-none rounded">Sign out</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<div class="b-example-divider b-example-vr"></div>
