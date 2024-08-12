@extends('backend.layouts.main')
@section('content')
    <!-- content @s -->
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div class="float-left">
                <h4 class="nk-block-title">Users</h4>
            </div>
            <div class="nk-block-des text-right">
                <a href="{{ route('user.create') }}"><button class="btn btn-primary"><em class="icon ni ni-plus"></em>&nbsp Add
                        User</button></a>
            </div>
        </div>
    </div>
    <x-alert />
    <!-- content @s -->
    <div class="card card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabItem1"><em
                            class="icon ni ni-users-fill d-none d-md-block"></em><span>Admin</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabItem2"><em
                            class="icon ni ni-user-list"></em><span>Users</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nk-block nk-block-lg">
                                <!-- content @s -->
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap nk-tb-list nk-tb-ulist"
                                            data-auto-responsive="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col">#</th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                                                    <th class="nk-tb-col d-md-none"><span class="sub-text">User</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Role</span></th>
                                                    <th class="nk-tb-col"><span class="sub-text">Actions</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $sno = 1 @endphp
                                                @forelse($users as $key=>$user)
                                                    @if ($user->hasRole('admin'))
                                                        <tr class="nk-tb-item">
                                                            <td class="nk-tb-col">
                                                                {{ $sno }}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                {{ ucwords($user->name) }}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <a
                                                                    href="mailto::{{ $user->email }}">{{ $user->email }}</a>
                                                            </td>
                                                            <td class="nk-tb-col d-md-none">
                                                                <span class="fw-bolder">Name </span> :
                                                                {{ ucwords($user->name) }}
                                                                <br />
                                                                <a
                                                                    href="mailto::{{ $user->email }}">{{ $user->email }}</a>
                                                                <br />
                                                                <span class="fw-bolder">Role </span> :
                                                                @php $roles = [];
                                                                    foreach ($user->roles as $role) {
                                                                        $roles[] = ucfirst($role->name);
                                                                    }
                                                                    $roleString = implode(', ', $roles);
                                                                @endphp
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                {{ $roleString }}
                                                            </td>
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <div class="drodown">
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                                        data-toggle="dropdown"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt">
                                                                            <li>
                                                                                <a
                                                                                    href="{{ route('user.edit', $user->id) }}"><em
                                                                                        class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);"
                                                                                    onclick="deleteUser('{{ $user->id }}','{{ $user->name }}')"><em
                                                                                        class="icon ni ni-trash"></em></span>Delete</a>
                                                                            </li>
                                                                            <li>
                                                                                <a
                                                                                    href="{{ route('user.show', $user->id) }}"><em class="icon ni ni-eye"></em><span>Show</span></a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        @php $sno++ @endphp
                                                    @endif
                                                @empty
                                                    <tr class="nk-tb-item">
                                                        <td colspan="4" class="text-center p-2">No Records Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card-preview -->
                                <!-- content @s -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tabItem2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="nk-block nk-block-lg">
                                <!-- content @s -->
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <table class="datatable-init nowrap nk-tb-list nk-tb-ulist"
                                            data-auto-responsive="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col">#</th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                                                    <th class="nk-tb-col d-md-none"><span class="sub-text">User</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Role</span></th>
                                                    <th class="nk-tb-col tb-col-md"><span class="sub-text">Balance</span></th>
                                                    <th class="nk-tb-col"><span class="sub-text">Actions</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $sno = 1 @endphp
                                                @forelse($users as $key=>$user)
                                                    @if ($user->hasRole('user'))
                                                        <tr class="nk-tb-item">
                                                            <td class="nk-tb-col">
                                                                {{ $sno }}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                {{ ucwords($user->name) }}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <a
                                                                    href="mailto::{{ $user->email }}">{{ $user->email }}</a>
                                                            </td>
                                                            <td class="nk-tb-col d-md-none">
                                                                <span class="fw-bolder">Name </span> :
                                                                {{ ucwords($user->name) }}
                                                                <br />
                                                                <a
                                                                    href="mailto::{{ $user->email }}">{{ $user->email }}</a>
                                                                <br />
                                                                <span class="fw-bolder">Role </span> :
                                                                @php $roles = [];
                                                                    foreach ($user->roles as $role) {
                                                                        $roles[] = ucfirst($role->name);
                                                                    }
                                                                    $roleString = implode(', ', $roles);
                                                                @endphp
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                {{ $roleString }}
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                            @if(isset($user->wallet->balance))
                                                                {{ $user->wallet->balance }}
                                                                @else
                                                                N/A
                                                                @endif
                                                            </td>
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <div class="drodown">
                                                                    <a href="javascript:void(0)"
                                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                                        data-toggle="dropdown"><em
                                                                            class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt">
                                                                            <li>
                                                                                <a
                                                                                    href="{{ route('user.edit', $user->id) }}"><em
                                                                                        class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="javascript: void(0);"
                                                                                    onclick="deleteUser('{{ $user->id }}','{{ $user->name }}')"><em
                                                                                        class="icon ni ni-trash"></em></span>Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- .nk-tb-item  -->
                                                        @php $sno++ @endphp
                                                    @endif
                                                @empty
                                                    <tr class="nk-tb-item">
                                                        <td colspan="4" class="text-center p-2">No Records Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card-preview -->
                                <!-- content @s
        -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="delete_form" style="display:none" method="post">
            @csrf
            @method('delete')
        </form>
        <script>
            function deleteUser(userId, userName) {
                event.preventDefault();
                var base_url = "{{ url('/') }}"
                if (confirm('Do you really want to delete ' + userName + '?')) {
                    var deleteForm = $('#delete_form');
                    deleteForm.attr('action', base_url + "/user/" + userId);
                    deleteForm.submit();
                }
            }
        </script>
        <script>
            function deleteUserPermanently(userId, userName) {
                event.preventDefault();
                var base_url = "{{ url('/') }}"
                if (confirm('Do you really want to delete ' + userName + '?')) {
                    var deleteForm = $('#delete_form');
                    deleteForm.attr('action', base_url + "/user/" + userId + '/force-delete');
                    deleteForm.submit();
                }
            }
        </script>
    @endsection
