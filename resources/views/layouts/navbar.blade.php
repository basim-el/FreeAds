<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FreeAds</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('annonces.index') }}">Annonces</a>
        </li>
        @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('annonces.create') }}">Créer annonce</a>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('profil', ['id' => Auth::id()]) }}">Profil</a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link nav-link">Déconnexion</button>
            </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
