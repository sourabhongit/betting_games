@extends('backend.layouts.main')
@section('content')
    <!-- content @s -->
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="float-left">
                <h4 class="nk-block-title">Games</h4>
            </div>
            <div class="nk-block-des text-right">
                <a href="{{ route('game.create') }}"><button class="btn btn-primary"><em class="icon ni ni-plus"></em>&nbsp Add
                        Game</button></a>
            </div>
        </div>
    </div>
    <x-alert />
    <!-- content @s
        -->
        <div class="card card-preview">
            <div class="card-inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col">#</th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Description</span></th>
                                                <th class="nk-tb-col tb-col-md"><span class="sub-text">Action</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $sno = 1 @endphp
                                            @forelse($games as $key=>$game)
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col">
                                                        {{ $sno++ }}
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        {{ ucwords($game->name) }}
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        {{ ucwords($game->description) }}
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <a href={{ route('game.edit', $game->id) }}><em
                                                                class="icon ni ni-edit"></em></a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="nk-tb-item">
                                                    <td colspan="5" class="text-center p-2">No Records Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
