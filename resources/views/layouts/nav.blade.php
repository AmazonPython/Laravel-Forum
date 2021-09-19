<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">@lang('messages.nav_browse') <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ url('threads') }}" class="dropdown-item">@lang('messages.nav_all_threads')</a></li>
                        @auth
                            <li><a href="{{ url('threads' . '?by=' . auth()->user()->name) }}" class="dropdown-item">@lang('messages.nav_my_threads')</a></li>
                        @endauth
                        <li><a href="{{ url('threads' . '?popular=1') }}" class="dropdown-item">@lang('messages.nav_popular_threads')</a></li>
                        <li><a href="{{ url('threads' . '?unanswered=1') }}" class="dropdown-item">@lang('messages.nav_unanswered_threads')</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('threads/create') }}" class="nav-link">@lang('messages.nav_new_thread')</a></li>
                <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">@lang('messages.nav_channels') <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($channels as $channel)
                            <li>
                                <a href="{{ url('threads/' . $channel->slug) }}" class="dropdown-item">{{ $channel->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">@lang('messages.auth_login')</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">@lang('messages.auth_register')</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">
                                @lang('messages.auth_home')
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                @lang('messages.auth_logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                    @php $locale = session()->get('locale'); @endphp
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('en')
                                <img src="{{ asset('images/en.png') }}" width="30px" height="20x"> English
                                @break
                                @default
                                <img src="{{ asset('images/zh-CN.png') }}" width="30px" height="20x"> 中文
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('lang', 'zh-CN') }}">
                                <img src="{{ asset('images/zh-CN.png') }}" width="30px" height="20x"> Chinese
                            </a>
                            <a class="dropdown-item" href="{{ route('lang', 'en') }}">
                                <img src="{{ asset('images/en.png') }}" width="30px" height="20x"> English
                            </a>
                        </div>
                    </li>
                <!-- 切换语言列表结束 -->
            </ul>
        </div>
    </div>
</nav>
