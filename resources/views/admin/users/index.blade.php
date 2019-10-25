@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Users')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm mb-20 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a class="font-bold" href="/admin/users">Users</a></span>
    </nav>
    <div class="flex flex-col bg-white rounded-lg m-10">
        <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Brands table</div>
        @isset($users)
            <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>Name</th>
                    <th>Orders</th>
                    <th>Reg. date</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="{{ $user->id === 1 ? 'text-red' : '' }}"><a href="/admin/users/{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</a></td>
                        <td>{{ count($user->orders) }}</td>
                        <td>{{ date("F jS, Y", strtotime($user->created_at)) }}</td>
                        <td class="flex flex-col md:flex-row justify-center items-center text-white">
                            @if($user->id !== 1)
                            <form action= method="post">@csrf @method('delete')
                                <button onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg m-5"><span class="fas fa-trash-alt"></span></button></form>
                                @else
                                <div class="p-10 m-5">.</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        @endisset
    </div>
@endsection
