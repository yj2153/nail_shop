<div class="bg-white">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
                <a class="navbar-brand nav-link text-dark" style="font-size: 24px;" href="{{ route('main.index') }}">
                    {{ __('main.title') }}
                </a>
            <div class="d-flex">
                <select id="lang-select" class="form-select form-select-sm" aria-label=".form-select-sm example"
                onchange="var form = document.getElementById('lang-form');
                form.action = form.action.replace(':lang', this.value);
                form.submit();">
                    <option value="ko" {{ app()->getLocale() == 'ko' ? 'selected' : ''}}>한국어</option>
                        <option value="ja" {{ app()->getLocale() == 'ja' ? 'selected' : ''}}>日本語</option>
                    </select>
                <form id="lang-form" action="{{ route('lang.index', ':lang') }}" method="GET" class="d-none">
                </form>
            </div>
        </div>
    </nav>
</div>

@include('components.header_small')

<nav class="navbar navbar-expand-md navbar-light nailShop-bg p-0">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <a class="nav-link text-white" href="{{ route('main.index') }}">{{ __('main.main title') }}</a>
            <a class="nav-link text-white" href="{{ route('item.index') }}">{{ __('main.item title') }}</a>
            <a class="nav-link text-white" href="{{ route('gallery.index') }}">{{ __('main.gallery title') }}</a>
            <a class="nav-link text-white" href="{{ route('qna.index') }}">{{ __('main.qna title') }}</a>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (!empty($user->profile->avatar_file_name))
                            <img src="/storage/avatars/{{$user->profile->avatar_file_name}}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                        @else
                            <img src="/images/item-image-default.png" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                        @endif
                        {{ $user->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if ($user->isAuthorityManager)
                            <a class="dropdown-item" href="{{ route('fullOrder.index') }}">
                                <i class="fas fa-memo text-left" style="width: 30px"></i>{{ __('main.fullOrder title') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('item.create') }}">
                                <i class="fas fa-camera text-left" style="width: 30px"></i>{{ __('main.sell title') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('gallery.create') }}">
                                <i class="fas fa-image text-left" style="width: 30px"></i>{{ __('main.gallery create') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('fullcalendar.index') }}">
                                <i class="fas fa-calendar text-left" style="width: 30px"></i>{{ __('main.calendar title') }}
                            </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="far fa-address-card text-left" style="width: 30px"></i>{{ __('main.profile title') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart text-left" style="width: 30px"></i>{{ __('main.cart title') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('bought.index') }}">
                            <i class="fas fa-shopping-bag text-left" style="width: 30px"></i>{{ __('main.bought title') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-door-closed text-left" style="width: 30px"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
</div>
