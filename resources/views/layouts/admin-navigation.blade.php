<nav class="navbar navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <span class="navbar-brand fs-6 fw-bold">
            {{ $title }}
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets.index') }}"><i class="fas fa-list me-2"></i></i></i>チケット一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('how-to') }}"><i class="fas fa-book me-2"></i>受付フロー</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('qr-code') }}"><i class="fas fa-qrcode me-2"></i>QRコード</a>
                </li>
                <!-- Authentication Links -->
                <li class="">
                    <hr class="mx-0 my-1">
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>ログイン</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-in-alt me-2"></i>ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>