<header id='header'>
    <div id='header__title'>
        <img id='header__logo' src="/img/icon.png" alt="logo">
        <h1>Dashboard Dados Covid19</h1>
    </div>
    <div id='header__menu'>
        <div id='header__links'>
            <a href="/country/{{$country}}">Quadro geral</a>
            <a href="/report/{{$country}}">Relatório</a>
            <a href="/pdf/{{$country}}">Dados</a>
        </div>
        @auth
            <p>Olá, {{ Auth::user()->name }}</p>        
        @endauth
        <form action="/logout" method="POST">
            @csrf
            <button type='submit' class='button__logout'>Logout</button>
        </form>
    </div>
</header>