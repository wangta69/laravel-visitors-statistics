<nav id="sidebar">
  <div class="sidebar-header">
    <h3><a href="{{ route('auth.admin.dashboard') }}">OnStory</a></h3>
    <strong>ON</strong>
  </div>

  <ul class="list-unstyled components" id="navbar-sidebar">
    {{-- 
    <li>
      <a href="#member-sub-menu" data-bs-toggle="collapse" 
        aria-expanded="{{ request()->routeIs(['auth.admin.users*', 'auth.admin.config*']) ? 'true' : 'false' }}"
        class="dropdown-toggle">
          <i class="fa-solid fa-user"></i>
          회원관리
      </a>
      <ul class="collapse list-unstyled {{ request()->routeIs(['auth.admin.users*', 'auth.admin.config*']) ? 'show' : '' }}" id="member-sub-menu">
        <li class="{{ request()->routeIs(['auth.admin.users*']) ? 'current-page' : '' }}">
          <a href="{{ route('auth.admin.users') }}">회원</a>
        </li>
        <li class="{{ request()->routeIs(['auth.admin.config*']) ? 'current-page' : '' }}">
          <a href="{{ route('auth.admin.config') }}">설정</a>
        </li>
      </ul>
    </li>
    --}}
    
  </ul>
  contact us <a href="mailto:wangta69@gmail.com"><i class="fa-regular fa-envelope"></i></a>
</nav>
