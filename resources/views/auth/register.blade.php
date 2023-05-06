<style>
    .min-h-screen.flex.flex-col.sm\:justify-center.items-center.pt-6.sm\:pt-0.bg-gray-100 {
        background-image: url('https://th.bing.com/th/id/R.099835ceeb7150d707db2cb4884caa15?rik=Emzh1DFL2dyA5w&riu=http%3a%2f%2fwww.absolutecorporatesolutions.com%2fimages%2fhospital-management-system-in-kenya.jpg&ehk=W0eoApf3XIv5O0riAQR0CHn8Iy8qDdMZ%2f6HxalQza9o%3d&risl=&pid=ImgRaw&r=0');
    }
    .text-center.inline-block {
        margin-left: 147px;
    }
</style>
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--
            <x-jet-authentication-card-logo /> --}}
            <img src="https://th.bing.com/th/id/R.7341cd8295fecb9385f968b1f56715a7?rik=mSAa%2bJFXDvBT7Q&pid=ImgRaw&r=0"
                alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8;height:150px;width:150px;border-radius:10px;">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Họ tên') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Mật khẩu') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Xác nhận mật khẩu') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-start mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Bạn đã có tài khoản?') }}
                </a>

                {{-- <x-jet-button class="ml-4">
                    {{ __('Đăng ký') }}
                </x-jet-button> --}}
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="text-lg py-3 block mt-1 w-full">
                    <div class="text-center inline-block">{{ __('Đăng ký') }}</div>
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>