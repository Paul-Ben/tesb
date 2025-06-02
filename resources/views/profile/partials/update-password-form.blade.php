{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}
<section class="container mt-4">
    <header class="mb-4">
        <h2 class="h4 font-weight-bold text-dark">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-muted small">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="form-control" autocomplete="current-password" required>
            @if($errors->updatePassword->get('current_password'))
                <div class="invalid-feedback d-block">
                    {{ implode(', ', $errors->updatePassword->get('current_password')) }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" 
                   class="form-control" autocomplete="new-password" required>
            @if($errors->updatePassword->get('password'))
                <div class="invalid-feedback d-block">
                    {{ implode(', ', $errors->updatePassword->get('password')) }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" 
                   type="password" class="form-control" autocomplete="new-password" required>
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="invalid-feedback d-block">
                    {{ implode(', ', $errors->updatePassword->get('password_confirmation')) }}
                </div>
            @endif
        </div>

        <div class="form-group d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success mb-0 py-1 px-2 fade show" role="alert" 
                     style="transition: opacity 0.5s ease;" id="passwordSavedAlert">
                    {{ __('Saved.') }}
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById('passwordSavedAlert').style.opacity = '0';
                        setTimeout(function() {
                            document.getElementById('passwordSavedAlert').remove();
                        }, 500);
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>