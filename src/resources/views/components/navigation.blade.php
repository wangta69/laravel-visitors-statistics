<nav id="sidebar">
  <div class="sidebar-header">
    <h3><a href="{{ route('admin.visitors.dashboard') }}">OnStory</a></h3>
    <strong>ON</strong>
  </div>

  <ul class="list-unstyled components" id="navbar-sidebar">

    <li>
      <a href="#member-sub-menu" data-bs-toggle="collapse" 
        aria-expanded="{{ request()->routeIs(['admin.visitors*']) ? 'true' : 'false' }}"
        class="dropdown-toggle">
          <i class="fa-solid fa-user"></i>
           방문자통계
      </a>
      <ul class="collapse list-unstyled {{ request()->routeIs(['admin.visitors*']) ? 'show' : '' }}" id="member-sub-menu">
       <li class="{{ request()->routeIs(['admin.visitors.dashboard']) ? 'current-page' : '' }}">
          <a href="{{ route('admin.visitors.dashboard') }}">dashboard</a>
        </li>  
        <li class="{{ request()->routeIs(['admin.visitors.log']) ? 'current-page' : '' }}">
            <a href="{{ route('admin.visitors.log') }}">log</a>
          </li>
        </ul>
    </li>

    
  </ul>
  contact us <a href="mailto:wangta69@gmail.com"><i class="fa-regular fa-envelope"></i></a>
</nav>
