<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link @if(Request::is('/')) active @endif" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::is('categories/create')) active @endif" aria-current="page" href="{{ route('categories.create') }}">Add Categeory</a>
          </li>
        <li class="nav-item">
          <a class="nav-link @if(Request::is('categories')) active @endif" aria-current="page" href="{{ route('categories.index') }}">All Categeory</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(Request::is('products/create')) active @endif" aria-current="page" href="{{ route('products.create') }}">Add New Product</a>
          </li>
        <li class="nav-item">
          <a class="nav-link @if(Request::is('products')) active @endif" aria-current="page" href="{{ route('products.index') }}">All Product</a>
        </li>
      </ul>
    </div>
  </nav>
