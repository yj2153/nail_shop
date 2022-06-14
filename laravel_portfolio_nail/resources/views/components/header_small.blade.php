<div class="pos-f-t navbar-expand-sm">
  <nav class="navbar navbar-dark nailShop-bg p-0">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
 </nav>
  <div class="collapse nailShop-bg" id="navbarToggleExternalContent">
    <ul class="navbar-nav pl-2">
          <li class="nav-item">
            @guest
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#subNavbarToggleExternalContent" aria-controls="subNavbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span>{{ $user->name }}</span>
                </button>
            
              <div class="collapse nailShop-bg" id="subNavbarToggleExternalContent">
                <ul class="navbar-nav">
                  @if ($user->isAuthorityManager)
                    <li class="nav-item">
                      <a class="dropdown-item" href="{{ route('fullOrder.index') }}">{{ __('main.fullOrder title') }}</a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item" href="{{ route('item.create') }}">{{ __('main.sell title') }}</a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item" href="{{ route('gallery.create') }}">{{ __('main.gallery create') }}</a>
                    </li> 
                    <li class="nav-item">
                      <a class="dropdown-item" href="{{ route('fullcalendar.index') }}">{{ __('main.calendar title') }}</a>
                    </li> 
                  @endif
                  <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('main.profile title') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('cart.index') }}">{{ __('main.cart title') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('bought.index') }}">{{ __('main.bought title') }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                  </li>
                </ul>
              </div>
            @endguest
          </li> 
          
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('main.index') }}">{{ __('main.main title') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('item.index') }}">{{ __('main.item title') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('gallery.index') }}">{{ __('main.gallery title') }}</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('qna.index') }}">{{ __('main.qna title') }}</a>
          </li>
      </ul>
  </div>
   
</div>
