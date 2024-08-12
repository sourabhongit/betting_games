@extends('backend.layouts.main')
@section('content')
    <!-- content @s -->
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="float-left">
                <h4 class="nk-block-title">Transactions</h4>
            </div>
            <div class="nk-block-des text-right">
                <a href="{{ route('user.wallet.create') }}"><button class="btn btn-primary"><em class="icon ni ni-plus"></em>&nbsp Update Wallet</button></a>
            </div>
        </div>
    </div>
    <x-alert />
    <!-- content @s -->
    <div class="card card-preview">
        <div class="card-inner">
            <!-- content @s -->
            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col">#</th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Wallet ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Amount</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Wallet Balance</span></th>
                    </tr>
                </thead>
                <tbody>
                @php $sno = 1 @endphp
                @foreach($transactions as $trns)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col"> {{ $sno++ }} </td>
                        <td class="nk-tb-col"> {{ $trns->wallet->user->name }} </td>
                        <td class="nk-tb-col"> {{ $trns->wallet->id }} </td>
                        <td class="nk-tb-col"> {{ $trns->amount }} </td>
                        <td class="nk-tb-col"> {{ $trns->type }} </td>
                        <td class="nk-tb-col"> {{ $trns->wallet_balance }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- content @s
        -->
    @endsection
