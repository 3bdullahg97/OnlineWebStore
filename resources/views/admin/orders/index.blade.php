@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Orders')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-20">
        <span><a href="{{ route('admin') }}">Admin Panel</a> / <a class="font-bold" href="{{ route('admin.orders') }}">Orders</a></span>
    </nav>
    <div class="flex flex-col bg-white rounded-lg m-10">
        <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Orders</div>
        @isset($orders)
            <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>#</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                        <td>
                            @switch($order->status)
                                @case(0)
                                <span class="text-dark_blue">Pending</span>
                                @break
                                @case(1)
                                <span class="text-green">Completed</span>
                                @break
                                @default
                                <span class="text-red">{{ $order->status() }}</span>
                                @endswitch
                        </td>
                        <td class="flex flex-col md:flex-row justify-center items-center text-heather">
                            @if($order->status == 0)
                                <form action="{{ route('orders.complete', $order->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button title="Complete order" onclick="return confirm('Are you sure?')" class="bg-oxford p-10 rounded-lg m-5"><span class="fas fa-check-circle"></span></button>
                                </form>
                            <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <button title="Cancel order" onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg m-5 text-white"><span class="fas fa-times-circle"></span></button>
                            </form>

                            @endif
                                <a title="View order" href="{{ route('admin.orders.show', $order->id) }}" class="bg-dark_blue text-white p-10 rounded-lg m-5"><span class="fas fa-eye"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="flex justify-center items-center">
                {{ $orders->links() }}
            </div>
        @endisset
    </div>
@endsection
