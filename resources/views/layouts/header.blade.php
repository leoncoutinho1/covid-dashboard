<header id='header'>
    <div id='header__title'>
        <img id='header__logo' src="./img/icon.png" alt="logo">
        <h1>Dashboard Dados Covid-19</h1>
    </div>
    <div id='header__menu'>
        @auth
            <p>Olá, {{ Auth::user()->name }}</p>        
        @endauth
        <form action="/logout" method="POST">
            @csrf
            <button type='submit' class='button__logout'>Logout</button>
        </form>
    </div>
</header>