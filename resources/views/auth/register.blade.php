<x-guest-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card bg-light text-dark">
                    <div class="card-body">
                        <h4 class="card-title">Registrarse</h4>
                        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" class="form-control @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ old('name') }}" required autofocus
                                    autocomplete="name" />
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror"
                                    type="email" name="email" value="{{ old('email') }}" required
                                    autocomplete="username" />
                                <div class="invalid-feedback">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                    type="password" name="password" required autocomplete="new-password" />
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 d-flex justify-content-end">
                                <a href="{{ route('login') }}" class="me-2">{{ __('Already registered?') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</x-guest-layout>
