<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/#top"><img src="{{ asset('assets/img/navbar-logo.svg') }}" alt="..." /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="/#services">３つの約束</a></li>
                <li class="nav-item"><a class="nav-link" href="/#portfolio">商品紹介</a></li>
                <li class="nav-item"><a class="nav-link" href="/#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/#team">職人紹介</a></li>
                @if($user)
                <li class="nav-item"><a class="nav-link" href="/logout">ログアウト</a></li>
                @else
                <li class="nav-item"><a class="nav-link" href="/register">会員登録</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">ログイン</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>