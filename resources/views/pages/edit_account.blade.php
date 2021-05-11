@extends('layouts.layout')

@section('title', 'Edit Account')
@section('pageType', 'website')

@section('content')

<!--Delete Account button-->
@include('partials.profile.delete')
<h2 class="page-title">Edit account</h2>
<hr />
<!--Form-->
<form class="row gx-0" method="POST" action="{{ route('update_user') }}">
  @csrf
  @method('PATCH')

    <div id="right-col" class="col-md-4 p-2">
      <!-- User picture -->
      <h3>Profile Picture</h3>
      <div class="d-flex flex-column gap-3 align-items-center justify-content-start h-100 mt-4">
        <img src="{{ asset('/images/user.jpg') }}" id="profile-picture" class="img-thumbnail rounded w-75 h-auto"
          alt="User profile picture" />
        <!-- Upload image input-->
        <div class="input-group" style="max-width: 300px">
          <input id="upload" type="file" onchange="readURL(this);" class="form-control" />
        </div>
        <!--Apply Changes button-->
        <button type="submit" class="btn btn-success" type="button">Apply Changes</button>
      </div>
    </div>
    <div class="col-md px-1 gap-2">
      <!-- Settings -->
      <div class="container p-2">
        <div class="d-flex flex-row justify-content-between">
          <h3>Settings</h3>
          <!--Delete Account button-->
          <button class="btn btn-danger m-0" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"
            aria-controls="deleteModal" aria-expanded="false" aria-label="Open delete account box">
            Delete Account
          </button>
        </div>
        <div class="row">
          <div class="col-sm">
            <!-- Email -->
            <div class="input-group mb-2">
              <label for="email" class="form-label"><b>Email</b></label>
              <div class="input-group has-validation">
                <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                  id="email" placeholder={{ $user->email }} />
                <!-- Error -->
                @if ($errors->has('email'))
                  <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
              </div>
            </div>
            <!-- Username -->
            <div class="input-group mb-2">
              <label for="username" class="form-label"><b>Username</b></label>
              <div class="input-group has-validation">
                <input type="text" name="username"
                  class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="" id="username"
                  placeholder={{ $user->username }} />
                <!-- Error -->
                @if ($errors->has('username'))
                  <div class="invalid-feedback">
                    {{ $errors->first('username') }}
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm">
            <!-- Password -->
            <div class="input-group mb-2">
              <label for="password" class="form-label"><b>Password</b></label>
              <div class="input-group has-validation">
                <input type="password" name="password"
                  class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="" id="password"
                  placeholder="Enter new password..." />
                <!-- Error -->
                @if ($errors->has('password'))
                  <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                  </div>
                @endif
              </div>
            </div>
            <!-- Repeated Password -->
            <div class="input-group mb-2">
              <label for="password" class="form-label"><b>Confirm Password</b></label>
              <div class="input-group has-validation">
                <input type="password" name="password-confirmation"
                  class="form-control {{ $errors->has('password-confirmation') ? 'is-invalid' : '' }}" value=""
                  id="password-confirmation" placeholder="Enter password confirmation..." />
                <!-- Error -->
                @if ($errors->has('password-confirmation'))
                  <div class="invalid-feedback">
                    {{ $errors->first('password-confirmation') }}
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Public Information -->
      <div class="container p-2 border-top">
        <h3>Public Information</h3>
        <!-- First Name -->
        <div class="input-group mb-2">
          <label for="first-name" class="form-label"><b>First Name</b></label>
          <div class="input-group has-validation">
            <input type="text" name="first-name"
              class="form-control {{ $errors->has('first-name') ? 'is-invalid' : '' }}" value="" id="first-name"
              placeholder="{{ $user->name }}" />
            <!-- Error -->
            @if ($errors->has('first-name'))
              <div class="invalid-feedback">{{ $errors->first('first-name') }}</div>
            @endif
          </div>
        </div>
        <!-- Last Name -->
        <div class="input-group mb-2">
          <label for="last-name" class="form-label"><b>Last Name</b></label>
          <div class="input-group has-validation">
            <input type="text" name="last-name"
              class="form-control {{ $errors->has('last-name') ? 'is-invalid' : '' }}" value="" id="last-name"
              placeholder="TODO" />
            <!-- Error -->
            @if ($errors->has('last-name'))
              <div class="invalid-feedback">{{ $errors->first('last-name') }}</div>
            @endif
          </div>
        </div>
        <!-- About -->
        <div class="input-group mb-2">
          <label for="about" class="form-label"><b>About</b></label>
          <div class="input-group has-validation">
            <textarea name="about" class="form-control{{ $errors->has('about') ? 'is-invalid' : '' }}" id="about"
              placeholder="{{ $user->about }}" maxlength="500"></textarea>
            <!-- Error -->
            @if ($errors->has('about'))
              <div class="invalid-feedback">{{ $errors->first('about') }}</div>
            @endif
          </div>
        </div>
      </div>
    </div>
    </div>
  </form>
@stop
