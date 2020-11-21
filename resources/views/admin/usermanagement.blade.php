@extends('admin.layouts.admin_master')

@section('title')
User-management
@endsection

@section('content')

<div class="card container-fluid">
    <div class="card-body">
        <h3 class="title-5 m-b-35"> Registered User Roles</h3>

        <div class="table-responsive">

            <table id="datatable" class="table  table-striped table-data2">
                <thead>
                    <tr>

                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>StaffID</th>
                        <th>Phone</th>
                        <th>Usertype</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $row)

                    <tr>
                        {{--to get the closet value or ID to the delete button--}}
                        <input type="hidden" class="delete_abc" value="{{ $row->id }}">
                        <td>{{ $row->id  }}</td>
                        <td>{{ $row->name  }}</td>
                        <td>
                            <span class="block-email">{{ $row->email }}</span>
                        </td>
                        <td class="desc">{{ $row->StaffID }}</td>
                        <td>{{ $row->phone }}</td>
                        
                        @if($row->usertype =='admin')
                            <td><span class="status--process">{{ $row->usertype }}</span></td>
                        @else
                            <td><span style="color: #4272d7;">{{ $row->usertype }}</span></td>
                        @endif

                        <td>
                            <div class="table-data-feature">
                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button> --}}
                                <a href="/role-edit/{{ $row->id }}"><button class="item" data-toggle="tooltip"
                                        data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button></a>
                                <button class="item a_pending_delete" data-toggle="tooltip" data-placement="top"
                                    title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button> --}}
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection

@section('scripts')
    
@endsection


