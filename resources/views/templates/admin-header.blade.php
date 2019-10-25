@section('admin-header')
    <div class="h-70 text-heather bg-oxford w-full flex justify-between items-center text-2xl p-20 md:justify-end">
        <div class="md:hidden">
            <span class="fas fa-bars" onclick="openLeftMenu('admin-left-menu', 'admin-main')"></span>
        </div>

        <div>
            <a class="fas fa-sign-out-alt" href="{{ route('logout') }}"></a>
        </div>

    </div>
@endsection
