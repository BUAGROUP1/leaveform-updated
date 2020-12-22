@extends('hr.layouts.hr_master')

@section('content')
<div class="card container-fluid">
    <div class="card-body">
        <h3 class="title-5 m-b-35">Approved Forms</h3>

        <div class="table-responsive">

            <table id="datatable" class="table  table-striped table-data2">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Staff ID</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Applicant</th>
                        <th>Supervisor</th>
                        <th>HOD</th>
                        <th>HR</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($abc as $item)

                    <tr>
                        {{--to get the closet value or ID to the delete button--}}
                        <input type="hidden" class="delete_abc" value="{{ $item->id }}">
                        <td>{{ $item->name }}</td>
                        <td>
                            <span class="block-email">{{ $item->email }}</span>
                        </td>
                        <td class="desc">{{ $item->StaffID }}</td>
                        <td>{{ $item->department }}</td>
                        <td>{{ $item->updated_at }}</td>

                        @if($item->decl_sig =='approved')
                        <td><span class="status--process">{{ $item->decl_sig }}</span></td>
                        @else
                        <td><span class="status--denied">pending</span></td>
                        @endif

                        @if($item->super_sig =='approved')
                        <td><span class="status--process">{{ $item->super_sig }}</span></td>
                        @else
                        <td><span class="status--denied">pending</span></td>
                        @endif

                        @if($item->hod_sig =='approved')
                        <td><span class="status--process">{{ $item->hod_sig }}</span></td>
                        @else
                        <td><span class="status--denied">pending</span></td>
                        @endif

                        @if($item->hr_sig =='approved')
                        <td><span class="status--process">{{ $item->hr_sig }}</span></td>
                        @else
                        <td><span class="status--denied">pending</span></td>
                        @endif

                        <td>
                            <div class="table-data-feature">
                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button> --}}

                                <div>
                                    <i class="fa fa-ban ml-2"></i>
                                </div>
                                {{-- <button class="item hr_pending_delete" data-toggle="tooltip" data-placement="top"
                                    title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button> --}}
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

