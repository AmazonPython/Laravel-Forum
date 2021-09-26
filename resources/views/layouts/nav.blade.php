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
                    <!--通知栏-->
                    <li class="nav-item dropdown">
                        <a href="{{ url('/profiles/{user}/notifications') }}" class="btn btn-default btn-sm mt-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                            </svg>
                            @if(auth()->user()->unreadNotifications->count() > 99)
                                <span class="badge badge-light">99+</span>
                            @else
                                <span class="badge badge-light">{{ auth()->user()->unreadNotifications->count() ? auth()->user()->unreadNotifications->count() : '' }}</span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="card-body">
                                @forelse(auth()->user()->unreadnotifications as $notification)
                                    <a href="{{ $notification['data']['link'] }}" style="text-decoration: none;color: #212529;">
                                        {{ $notification['data']['message'] }}
                                    </a>
                                    <a class="badge badge-success float-right" href="{{ url('/profiles/' . Auth::user()->name . '/notifications/' . $notification->id) }}">
                                        @lang('messages.threads_subscribe_notices_mark')
                                    </a><hr>
                                @empty
                                    <a class="dropdown-item">@lang('messages.threads_subscribe_notices')</a>
                                @endforelse
                            </div>
                        </div>
                    </li>
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
                    <!-- 切换语言列表 -->
                    @php $locale = session()->get('locale'); @endphp
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @switch($locale)
                                @case('en')
                                    <img src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/en.png" width="30px" height="20x"> English
                                @break
                                @default
                                    <img src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/zh-CN.png" width="30px" height="20x"> 中文
                            @endswitch
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('lang', 'zh-CN') }}">
                                <img src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/zh-CN.png" width="30px" height="20x"> 中文
                            </a>
                            <a class="dropdown-item" href="{{ route('lang', 'en') }}">
                                <img src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/en.png" width="30px" height="20x"> English
                            </a>
                        </div>
                    </li>
            </ul>
        </div>
    </div>
</nav>
