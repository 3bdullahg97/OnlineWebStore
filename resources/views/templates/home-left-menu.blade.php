@section('user-left-menu')
    <div id="user-left-menu" class="hidden md:flex w-full md:w-1/6 flex-col bg-oxford justify-start items-center">
        <div class="logo bg-mirage w-full flex items-center justify-around text-heather h-70 font-bold text-spindle text-lg">
            <div><a href="/"><span class="fas fa-reply"></span></a></div>
            <a href="/" class="flex flex-col justify-center items-center text-xl text-spindle font-bold">Online<span class="text-sm">WebStore</span></a>
            <div onclick="closeLeftMenu('user-left-menu', 'user-content')" class="m-5 md:hidden"><span class="fas fa-times"></span></div>
            <div class="hidden md:flex"></div>
        </div>

        <ul class="flex flex-col text-heather p-20 font-bold justify-start text-sm">
            <li class="m-5 p-5 {{ Request::path() === 'account' ? 'text-spindle' : '' }}">
                <a href="{{ route('home') }}"><span class="fas fa-home mr-15"></span>Home</a>
            </li>
            <li class="m-5 p-5 {{  preg_match('(orders*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('account.orders') }}">
                    <span class="fas fa-list-ul mr-15"></span>Orders</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(addresses*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('addresses') }}">
                    <span class="fas fa-map mr-15"></span>Addresses</a>
            </li>

            <li class="m-5 p-5 {{ preg_match('(settings*)', Request::path()) ? 'text-spindle' : '' }}"><a href="{{ route('settings') }}">
                    <span class="fas fa-cogs mr-15"></span>Account Settings</a>
            </li>
        </ul>

    </div>
@endsection
