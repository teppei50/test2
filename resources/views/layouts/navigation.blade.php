<header class="bg-gray-800 text-gray-200">
    <div class="container mx-auto p-3">
        <div class="flex items-center justify-between">
            <a class="text-lg hover:text-gray-300" href="{{ route('gallerys.index') }}">
                {{ config('app.name') }}
            </a>
            <div>
                @if (Auth::check())
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="text-sm hover:text-gray-400">{{ auth()->user()->name }}</button>
                    </x-slot>
                    <x-slot name="content">
                       <x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left">ログアウト</button>
                            </form>
                       </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @else
                <a class="text-sm hover:text-gray-400" href="{{ route('login') }}">ログイン</a>
                <a class="text-sm hover:text-gray-400 ml-4" href="{{ route('register') }}">会員登録</a>
                @endif
            </div>
        </div>
    </div>
</header>