@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', "$user->first_name User")
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="/admin/">Admin Panel</a> / <a href="/admin/users">Users</a> / <a
                href="admin/users/{{ $user->id }}" class="font-bold">{{ $user->first_name }}</a></span>

@endsection
