@section('admin-left-menu')
    <div id="admin-left-menu" class="hidden md:flex w-full md:w-1/6 flex-col bg-oxford justify-start items-center">
        <div class="logo bg-mirage w-full flex items-center justify-around text-heather h-70 font-bold text-spindle text-lg">
            <div><a href="/"><span class="fas fa-reply"></span></a></div>
            <a href="/" class="flex flex-col justify-center items-center text-xl text-spindle font-bold">Online<span class="text-sm">WebStore</span></a>
            <div onclick="closeLeftMenu('admin-left-menu', 'admin-main')" class="m-5 md:hidden"><span class="fas fa-times"></span></div>
            <div class="hidden md:flex"></div>
        </div>

        <ul class="flex flex-col text-heather p-20 font-bold justify-start text-sm">
            <li class="m-5 p-5 {{ Request::path() === 'admin' ? 'text-spindle' : '' }}">
                <a href="{{ route('admin') }}"><span class="fas fa-chart-pie mr-15"></span>Dashboard</a>
            </li>
            <li class="m-5 p-5 {{  preg_match('(admin/categories*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('categories.create') }}">
                    <span class="fas fa-tags mr-15"></span>Categories</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(admin/items*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('items.create') }}">
                    <span class="fas fa-database mr-15"></span>Items</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(admin/brands*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('brands.create') }}">
                    <span class="fas fa-building mr-15"></span>Brands</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(admin/users*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('users') }}">
                    <span class="fas fa-users mr-15"></span>Users</a>
            </li>

            <li class="m-5 p-5 {{ Request::path() === 'admin/notifications' ? 'text-spindle' : '' }}"><a href="">
                    <span class="fas fa-bell mr-15"></span>Notifications</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(admin/orders*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('admin.orders') }}">
                    <span class="fa fa-list-ul mr-15"></span>Orders</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(admin/transactions*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('transactions') }}">
                    <span class="fas fa-exchange-alt mr-15"></span>Transactions</a>
            </li>

            <li class="m-5 p-5 {{ Request::path() === 'admin/payments' ? 'text-spindle' : '' }}"><a href="">
                    <span class="fas fa-credit-card mr-15"></span>Payments</a>
            </li>

            <li class="m-5 p-5 {{ Request::path() === 'admin/shipping' ? 'text-spindle' : '' }}"><a href="">
                    <span class="fas fa-truck mr-15"></span>Shipping</a>
            </li>

            <li class="m-5 p-5 {{ Request::path() === 'admin/settings' ? 'text-spindle' : '' }}"><a href="">
                    <span class="fas fa-cogs mr-15"></span>Site Settings</a>
            </li>
        </ul>

    </div>
@endsection
