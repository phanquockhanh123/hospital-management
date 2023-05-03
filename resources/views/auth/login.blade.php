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

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Mật khẩu') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="d-flex items-center justify-content-between mt-4 text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}"
                    style="margin-right: 20px;">
                    {{ __('Bạn chưa có tài khoản?') }}
                </a>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
                @endif


            </div>

            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="text-lg py-3 block mt-1 w-full">
                    <div class="text-center inline-block">{{ __('Đăng nhập') }}</div>
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>