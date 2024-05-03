<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                {{-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li> --}}
                {{-- Kiểm tra người dùng đã đăng nhập hay chưa --}}
                @auth
                    {{-- Hiển thị liên kết Logout nếu đã đăng nhập --}}
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('logout') }}">Logout</a></li>
                @else
                    {{-- Hiển thị liên kết Login nếu chưa đăng nhập --}}
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
