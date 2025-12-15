<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="navbar-nav flex-row order-md-last">
      
      <div class="d-none d-md-flex">
        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="toggleTheme(event)">
          <i id="icon-moon" class="ti ti-moon" style="font-size: 1.5rem;"></i>
        </a>
        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom" onclick="toggleTheme(event)">
          <i id="icon-sun" class="ti ti-sun" style="font-size: 1.5rem; display: none;"></i>
        </a>
        
        {{-- <div class="nav-item dropdown d-none d-md-flex me-3">
            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                <i class="ti ti-palette" style="font-size: 1.5rem;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Warna Tema</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                        <button class="list-group-item" onclick="changeColor('#0054a6')">🔵 Default Blue</button>
                        <button class="list-group-item" onclick="changeColor('#d63939')">🔴 Red</button>
                        <button class="list-group-item" onclick="changeColor('#2fb344')">🟢 Green</button>
                        <button class="list-group-item" onclick="changeColor('#f76707')">🟠 Orange</button>
                        <button class="list-group-item" onclick="changeColor('#5f3dc4')">🟣 Purple</button>
                    </div>
                </div>
            </div>
        </div> --}}
      </div>
      <li class="nav-item dropdown">
    <a class="nav-link" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="ti ti-palette"></i>
        </span>
        <span class="nav-link-title d-md-none d-lg-inline-block">
            Tema
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-end p-2">
        <div class="row g-2" style="width: 300px;">
            
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#206bc4')">
                    <span class="badge bg-blue text-blue-fg w-100 py-2">Blue</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#4299e1')">
                    <span class="badge bg-azure text-azure-fg w-100 py-2">Azure</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#4263eb')">
                    <span class="badge bg-indigo text-indigo-fg w-100 py-2">Indigo</span>
                </button>
            </div>

            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#ae3ec9')">
                    <span class="badge bg-purple text-purple-fg w-100 py-2">Purple</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#d6336c')">
                    <span class="badge bg-pink text-pink-fg w-100 py-2">Pink</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#d63939')">
                    <span class="badge bg-red text-red-fg w-100 py-2">Red</span>
                </button>
            </div>

            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#f76707')">
                    <span class="badge bg-orange text-orange-fg w-100 py-2">Orange</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#f59f00')">
                    <span class="badge bg-yellow text-yellow-fg w-100 py-2">Yellow</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#74b816')">
                    <span class="badge bg-lime text-lime-fg w-100 py-2">Lime</span>
                </button>
            </div>

            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#2fb344')">
                    <span class="badge bg-green text-green-fg w-100 py-2">Green</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#0ca678')">
                    <span class="badge bg-teal text-teal-fg w-100 py-2">Teal</span>
                </button>
            </div>
            <div class="col-4">
                <button class="btn p-0 border-0 w-100" onclick="updateColor('#17a2b8')">
                    <span class="badge bg-cyan text-cyan-fg w-100 py-2">Cyan</span>
                </button>
            </div>

        </div>
    </div>
</li>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url('https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}')"></span>
          <div class="d-none d-xl-block ps-2">
            <div>{{ Auth::user()->name ?? 'Guest' }}</div>
            <div class="mt-1 small text-secondary">Administrator</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="#" class="dropdown-item">Profile</a>
          <a href="#" class="dropdown-item">Settings</a>
          <div class="dropdown-divider"></div>
          
          <a href="#" class="dropdown-item text-danger" onclick="confirmLogout()">Logout</a>
        </div>
      </div>
    </div>
    
    <div class="collapse navbar-collapse" id="navbar-menu">
      </div>
  </div>
</header>