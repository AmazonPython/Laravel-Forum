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
                        <li>
                            <a href="{{ url('/threads') }}" class="dropdown-item">
                                <i class="fas fa-sticky-note"></i> @lang('messages.nav_all_threads')
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ url('threads' . '?by=' . auth()->user()->name) }}" class="dropdown-item">
                                    <i class="fas fa-user-tag"></i> @lang('messages.nav_my_threads')
                                </a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ url('threads' . '?popular=1') }}" class="dropdown-item">
                                <i class="fas fa-fire"></i> @lang('messages.nav_popular_threads')
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('threads' . '?unanswered=1') }}" class="dropdown-item">
                                <i class="far fa-question-circle"></i> @lang('messages.nav_unanswered_threads')
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('threads/create') }}" class="nav-link">
                        <i class="fas fa-paint-brush"></i> @lang('messages.nav_new_thread')
                    </a>
                </li>
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
            <!-- 搜索 -->
            <form class="form-inline" id="searchInput" role="search" method="get" action="{{ route('user.search') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search" required>
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-lock"></i> @lang('messages.auth_login')
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-unlock"></i> @lang('messages.auth_register')
                            </a>
                        </li>
                    @endif
                @else
                    <!--通知栏-->
                    <li class="nav-item dropdown">
                        <a href="{{ url('/profiles/{user}/notifications') }}" class="btn btn-default btn-sm mt-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span><i class="fas fa-bell fa-lg"></i></span>
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
                            <img src="{{ Auth::user()->avatar ?: Auth::user()->defaultAvatar() }}" style="border-radius: 500px; width: 30px;" alt="{{ Auth::user()->name }} Avatar">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">
                                <i class="fas fa-user"></i> @lang('messages.auth_home')
                            </a>
                            @if (Auth::user()->isAdmin)
                                <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">
                                    <i class="fas fa-tachometer-alt"></i> @lang('messages.admin_dashboard')
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> @lang('messages.auth_logout')
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
