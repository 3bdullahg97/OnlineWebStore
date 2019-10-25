@section('left-menu')
    <div id="left-menu" class="hidden flex flex-col w-full bg-oxford justify-start items-center h-screen">
        <div class="logo bg-mirage w-full flex items-center justify-around text-heather p-15 font-bold text-spindle text-lg">
                <div class="m-5"><a href="{{ auth()->id() === 1?  route('admin') : route('home') }}"><span class="fas fa-user"></span></a></div>
                <div class="m-5"><a href="{{ route('logout') }}"><span class="fas fa-sign-out-alt"></span></a></div>
                <div onclick="closeLeftMenu('left-menu', 'main')" class="m-5"><span class="fas fa-times"></span></div>
        </div>

        <form class="flex w-5/6 h-50 bg-catskill_white m-10 rounded-lg text-gray">
            <input type="text" class="w-5/6 bg-catskill_white rounded-l-lg p-5" name="search" placeholder="Search ...">
            <button class="w-1/6"><span class="fas fa-search"></span></button>
        </form>

        <ul class="flex flex-col text-heather p-20 font-bold justify-start">
            <li class="m-5 p-5"><a href="">COMPUTER HARDWARE</a></li>
            <li class="m-5 p-5"><a href="">PC & LAPTOPS</a></li>
            <li class="m-5 p-5"><a href="">GAMING</a></li>
            <li class="m-5 p-5"><a href="">PRINTERS & SCANNERS</a></li>
        </ul>
    </div>
@endsection


