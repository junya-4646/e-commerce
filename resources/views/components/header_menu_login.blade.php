<section class="section">
    <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
      <div class="w-container">
        <a href="#" class="w-nav-brand">
          <img src="{{ asset('images/Educure.png') }}" class="image-4">
        </a>
        <nav role="navigation" class="w-nav-menu">
          <a href="{{ route('home') }}" class="w-nav-link">Home</a>
          <a href="{{ route('itemlist') }}" class="w-nav-link">Item</a>
          
          <a href="#" 
            class="w-nav-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Log out
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

          <a href="{{ route('cart') }}" class="w-nav-link">cart</a>
        </nav>
        <div class="w-nav-button">
          <div class="icon-2 w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
</section>
