@section('header')
<div id="header" class="flex h-70 md:h-75 bg-oxford items-center justify-between p-15 text-heather text-2xl">
    <div onclick="openLeftMenu('left-menu', 'main')" class="md:hidden"><span class="fas fa-bars"></span></div>
    <div class="hidden md:flex text-xs items-center justify-start w-1/3 font-bold xl:text-sm">
        <a class="m-5" href="">Hardware</a>
        <a class="m-5" href="">Computers</a>
        <a class="m-5" href="">Gaming</a>
        <a class="m-5" href="">Printers</a>
    </div>
    <div class="w-1/3 flex justify-center">
        <div class="text-heather w-8/12 md:w-2/12 text-center font-bold text-xl flex justify-center items-center">
            <a href="/" class="flex flex-col hover:text-spindle">Online<span class="text-sm">WebStore</span></a>
        </div>
    </div>
    <a href="/cart" class="md:hidden"><span class="fas fa-shopping-cart"></span></a>

    <div class="hidden md:flex text-xs items-center justify-end w-1/3 font-bold xl:text-sm">
        <a href="{{ route('cart') }}" class="m-5"><span class="fas fa-shopping-cart"></span></a>
        @if(auth()->id())
        @if(auth()->id() === 1)
                <a class="m-5" href="{{ route('admin') }}">Admin Panel</a>
            @else
                <a class="m-5" href="{{ route('home') }}">Account</a>
            @endif
            <a class="m-5" href="{{ route('logout') }}">Logout</a>
            @else
            <a class="m-5" href="{{ route('login') }}">Login</a>
            <a class="m-5" href="{{ route('register') }}">Register</a>

        @endif
    </div>
</div>

<!-- End header -->
@endsection




















<!--


-->
