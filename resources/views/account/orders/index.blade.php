@extends('layouts.user-panel')
@section('title', 'Home page')
@extends('templates.home-header')
@extends('templates.home-left-menu')
@section('user-content')
    <nav class="justify-start items-center text-gray text-sm m-10 mt-20 ml-25">
        <span><a href="{{ route('home') }}"><span class="fas fa-home m-10"></span>Home</a> / <a class="font-bold" href="{{ route('account.orders') }}">Orders</a></span>
    </nav>

    <div class="flex flex-col bg-white rounded-lg m-10">
        <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Your orders</div>
        @isset($orders)
            <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>Order#</th>
                    <th>Status</th>
                    <th>Reg. date</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><a href="/orders/{{ $order->id }}">{{ $order->id }}</a></td>
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
                        <td>{{ date("F jS, Y", strtotime($order->created_at)) }}</td>
                        <td class="flex flex-col md:flex-row justify-center items-center text-white">
                            @if($order->status == 0)
                                <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button title="Cancel order" onclick="return confirm('Are you sure?')" class="bg-red p-10 rounded-lg m-5"><span class="fas fa-trash-alt"></span></button>
                                </form>
                            @endif
                                <a title="View order" href="{{ route('account.orders.show', $order->id) }}" class="bg-dark_blue text-white p-10 rounded-lg m-5"><span class="fas fa-eye"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $orders->links() }}
        @endisset
    </div>

    @endsection
