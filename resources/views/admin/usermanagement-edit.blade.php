@extends('admin.layouts.admin_master')

@section('title')
Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Registered User Roles </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/role-user-update/{{ $users->id }}" method="POST">
                                {{ csrf_field()  }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label >Name</label>
                                    <input type="text" name="username" value="{{ $users->name }}" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>Give Role</label>
                                    <select name="usertype" class="form-control">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="hr">HR</option>
                                        <option value="supervisor">Supervisor</option>\
                                        <option value="hod">HOD</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success"> Update</button>
                                <a href="/usermanagement" class="btn btn-danger"> Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    
@endsection