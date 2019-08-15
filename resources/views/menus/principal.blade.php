
<nav class="navbar navbar-expand-lg navbar-dark  lead" style="background-color: #1e88e5;">
    <a class="navbar-brand" href="{{ url('/') }}">
        <i class="pacifico" >My Lend </i> &nbsp;<i class="fas fa-handshake fa-lg"></i>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item @if (Request::path()=="/") active @endif ">
          <a class="nav-link " href="{{ url('/') }}"> <i class="fas fa-home"></i> Inicio</a>
        </li>
        <li class="nav-item @if (Request::path()=="nosotros") active @endif ">
          <a class="nav-link " href="{{ url('/nosotros') }}"> <i class="fas fa-users"></i> Nosotros</a>
        </li>
        <li class="nav-item @if (Request::path()=="contacto") active @endif ">
          <a class="nav-link " href="{{ url('/contacto') }}"> <i class="fas fa-headset"></i> Contacto</a>
        </li>
        <li class="nav-item @if (Request::path()=="login") active @endif ">
          <a class="nav-link" href="{{ url('/login') }}"> <i class="fas fa-sign-in-alt"></i> Login </a>
        </li>
      </ul>
    </div>
  </nav>
