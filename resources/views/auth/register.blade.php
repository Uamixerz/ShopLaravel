@extends('layouts.app')

@section('content')
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Create
                                        Account</h3></div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0 ">
                                                    @include('component.inputAdmin', ['name' => 'firstName', 'type'=>"text", 'labelInfo' => 'First name'])
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    @include('component.inputAdmin', ['name' => 'lastName', 'type'=>"text", 'labelInfo' => 'Last name'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            @include('component.inputAdmin', ['name' => 'phone', 'type'=>"text", 'labelInfo' => 'Phone number'])
                                        </div>

                                        <div class="form-floating mb-3">
                                            @include('component.inputAdmin', ['name' => 'email', 'type'=>"email", 'labelInfo' => 'Email'])
                                        </div>


                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                @include('component.inputAdmin', ['name' => 'password', 'type'=>"password", 'labelInfo' => 'Password'])
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           name="password_confirmation" required
                                                           autocomplete="new-password" placeholder="Confirm password"/>
                                                    <label for="password-confirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary btn-block">Create Account
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{route('login')}}">Have an account? Go to login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    </body>
@endsection
