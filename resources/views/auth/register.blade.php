@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Don\'t have an account? Register here.') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-right">{{ __('Register as?') }}</label>
                            <div class="col-md-7">
                                <select class="form-control form-control-select @error('role') is-invalid @enderror" id="role" name="role" placeholder="">
                                    <option value="" selected disabled>Select Role</option>
                                    @foreach($roleOpt as $role)
                                    <option value="{{ $role->id }}" @if($role->id == old('role')) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus maxlength="100">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-7">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" maxlength="50">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" maxlength="50">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact-number" class="col-md-3 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-7">
                                <input id="contact-number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" maxlength="20">

                                @error('contact_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="form-group-position" class="form-group row">
                            <label for="position" class="col-md-3 col-form-label text-md-right">{{ __('Position') }}</label>

                            <div class="col-md-7">
                                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" maxlength="100">

                                @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="form-group-official-station" class="form-group row">
                            <label for="official-station" class="col-md-3 col-form-label text-md-right">{{ __('Official Station') }}</label>

                            <div class="col-md-7">
                                <input id="official-station" type="text" class="form-control @error('official_station') is-invalid @enderror" name="official_station" value="{{ old('official_station') }}" maxlength="100">

                                @error('official_station')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="form-group-monthly-salary" class="form-group row">
                            <label for="monthly-salary" class="col-md-3 col-form-label text-md-right">{{ __('Monthly Salary') }}</label>

                            <div class="col-md-7">
                                <input id="monthly-salary" type="text" class="form-control amount @error('monthly_salary') is-invalid @enderror" name="monthly_salary" value="{{ old('monthly_salary') }}" maxlength="12">

                                @error('monthly_salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" maxlength="32">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" maxlength="32">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-3">
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link pl-0" href="{{ route('login') }}">
                                    {{ __('Already have an account?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $( document ).ready(function() {
        $("#form-group-position").hide();
        $("#form-group-official-station").hide();
        $("#form-group-monthly-salary").hide();

        $("#role").change(function() {
            if ($(this).val() == '3') {
                $("#form-group-position").show();
                $("#form-group-official-station").show();
                $("#form-group-monthly-salary").show();
            } else {
                $("#form-group-position").hide();
                $("#form-group-official-station").hide();
                $("#form-group-monthly-salary").hide();
                $("#position").val('').trigger("chosen:updated");
                $("#official-station").val('').trigger("chosen:updated");
                $("#monthly-salary").val('').trigger("chosen:updated");
            }
        }); 
    });    
</script>
@endpush