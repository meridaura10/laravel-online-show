<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="d-flex justify-content-between py-4">

                <div>
                    <h4 class="text-white">@lang('views/layouts/header.nav')</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products.index') }}" class="text-white">@lang('views/layouts/header.products')</a></li>
                        <li><a href="{{ route('basket.index') }}" class="text-white">@lang('views/layouts/header.basket')</a></li>
                        @guest
                            <a href="{{ route('login') }}">@lang('views/layouts/header.login')</a>
                            <a href="{{ route('register') }}">@lang('views/layouts/header.register')</a>
                        @else
                            <li><a href="{{ route('orders.index') }}" class="text-white">@lang('views/layouts/header.order')</a></li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Вийти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest

                    </ul>
                </div>
                <div>
                    <h4 class="text-white">@lang('views/layouts/header.langChange')</h4>
                    <ul class="navbar-locales list-unstyled">
                        @foreach (localization()->getSupportedLocales() as $key => $locale)
                            <li class="{{ localization()->getCurrentLocale() == $key ? 'active  ' : '' }}">
                                <a class="" href="{{ localization()->getLocalizedURL($key) }}" rel="alternate"
                                    hreflang="{{ $key }}">
                                    {{ $locale->native() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if (auth()->user() && auth()->user()->role === 'admin')
                    <div>
                        <h4 class="text-white">@lang('views/layouts/header.admin')</h4>
                        <ul class="navbar-locales list-unstyled">
                            <li><a class="text-white" href="{{ route('admin.products.index') }}">адмін
                                    продуктів</a>
                            </li>
                            <li><a class="text-white" href="{{ route('admin.categories.index') }}">адмін
                                    категорій</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('products.index') }}" class="navbar-brand d-flex align-items-center">
                {{--                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg> --}}
                <strong>@lang('views/layouts/app.title')</strong>
            </a>
            {{-- @auth
                <div class="text-white">
                    @lang('views/layouts/header.yourName') <a class="fw-bold" href={{ route('user.show') }}>{{ auth()->user()->name }}</a>
                </div>
            @endauth --}}
            @livewire('components.search')
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
