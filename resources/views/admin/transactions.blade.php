@extends('layouts.admin-panel')
@extends('templates.admin-header')
@extends('templates.admin-left-menu')
@section('title', 'Transactions')
@section('admin-content')
    <nav class="justify-start items-center text-gray text-sm m-20">
        <span><a href="/admin/">Admin Panel</a> / <a class="font-bold" href="/admin/transactions">Transactions</a></span>
    </nav>

    <div class="flex flex-col bg-white rounded-lg m-10">
        <div class="rounded-t-lg bg-oxford font-bold text-heather p-15 text-sm">Transactions</div>
        @isset($transactions)
            <table class="overflow-y-scroll md:overflow-hidden w-full text-center m-0">
                <thead class="bg-catskill_white">
                <tr class="h-50">
                    <th>#</th>
                    <th>Transaction date</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="m-5 p-10">{{ $transaction->id }}</td>
                        <td>{{ date("F jS, Y", strtotime($transaction->created_at)) }}</td>
                        <td><a href="{{ route('orders.show', $transaction->order->id ) }}">Order #{{ $transaction->order->id }}</a></td>
                        <td>
                            @switch($transaction->status)
                                @case(0)
                                <span class="text-green">Confirmed</span>
                                @break
                                @case(1)
                                <span class="text-red">Refunded</span>
                                @break
                            @endswitch
                        </td>
                        <td>${{ $transaction->order->price() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="flex justify-center items-center">
                {{ $transactions->links() }}
            </div>
        @endisset
    </div>

@endsection
