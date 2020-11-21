@extends('users.layouts.users_master')

@section('title')
User Profile
@endsection

@section('content')

<div class="content ">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Profile")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="ubtn_profile_update" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', auth()->user()->name) }}">
                               
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="phone">{{__("Phone")}}</label>
                      <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ old('phone', auth()->user()->phone) }}">
                      
                    </div>
                  </div>
                </div>
              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="ubtn_profile_password" autocomplete="off">
              @csrf
              @method('put')
             
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Current Password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" placeholder="{{ __('Current Password') }}" type="password"  required>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" New password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                    
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="/img/bua_bg4.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
              <img class="avatar border-gray" src="/uploads/avatars/{{ auth()->user()->avatar }}" />
                <h5 class="title">{{ auth()->user()->name }}</h5>
              </a>
              <p class="description">
                  {{ auth()->user()->email }}
              </p>
            </div>
          </div>
            {{-- the update the user profile --}}
          <div>
            <form action="{{ url('u_profile_image_update') }}" method="POST" enctype="multipart/form-data">
              <label for="user_image" class="mx-4">Update profile picture</label><br>
              <input type="file" name="avatar" id="avatar" class="ml-4"/>
              <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
              <button type="submit" class="btn btn-primary btn-round mx-4 my-3 float-right">update</button>
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>

@endsection

@section('scripts')
    
@endsection
