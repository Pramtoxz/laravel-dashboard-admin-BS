<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>@yield('title', 'Dashboard')</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css" />
    
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root { 
          --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; 
      }
      body {
          --tblr-primary: var(--custom-primary-color, #0054a6);
          --tblr-btn-color: #ffffff;
      }
      .btn-primary {
          background-color: var(--tblr-primary) !important;
          border-color: var(--tblr-primary) !important;
      }
      .text-primary {
          color: var(--tblr-primary) !important;
      }
    </style>
  </head>
  <body id="main-body">
    <div class="page">
      @include('layouts.sidebar')
      
      <div class="page-wrapper">
        
      @include('layouts.navbar') 

        <div class="page-header d-print-none">
            <div class="container-xl">
                 </div>
        </div>
        
        <div class="page-body">
          <div class="container-xl">
             @yield('content') 
          </div>
        </div>

        @include('layouts.footer')
        
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.setAttribute('data-bs-theme', 'dark');
                toggleIcons('dark');
            } else {
                document.body.setAttribute('data-bs-theme', 'light');
                toggleIcons('light');
            }
            const savedColor = localStorage.getItem('primary_color');
            if (savedColor) {
                document.documentElement.style.setProperty('--custom-primary-color', savedColor);
            }
        });
        function toggleTheme(e) {
            e.preventDefault();
            const currentTheme = document.body.getAttribute('data-bs-theme');
            
            if (currentTheme === 'dark') {
                document.body.setAttribute('data-bs-theme', 'light');
                localStorage.setItem('theme', 'light');
                toggleIcons('light');
            } else {
                document.body.setAttribute('data-bs-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                toggleIcons('dark');
            }
        }
        function toggleIcons(mode) {
            const moon = document.getElementById('icon-moon');
            const sun = document.getElementById('icon-sun');
            if(!moon || !sun) return; 

            if (mode === 'dark') {
                moon.style.display = 'none';
                sun.style.display = 'inline-block';
            } else {
                sun.style.display = 'none';
                moon.style.display = 'inline-block';
            }
        }

        function changeColor(colorHex) {
            document.documentElement.style.setProperty('--custom-primary-color', colorHex);
            localStorage.setItem('primary_color', colorHex);
        }
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer:1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif

        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Anda harus login kembali untuk mengakses halaman ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        }
    </script>
  <script>
    function hexToRgb(hex) {
        hex = hex.replace(/^#/, '');
        let bigint = parseInt(hex, 16);
        return ((bigint >> 16) & 255) + ", " + ((bigint >> 8) & 255) + ", " + (bigint & 255);
    }
    function updateColor(hex) {
        const root = document.documentElement;
        const rgb = hexToRgb(hex);
        root.style.setProperty('--tblr-primary', hex);
        root.style.setProperty('--tblr-primary-rgb', rgb);
        root.style.setProperty('--bs-primary', hex);
        root.style.setProperty('--bs-primary-rgb', rgb);
        root.style.setProperty('--tblr-link-color', hex);
        const sidebar = document.querySelector('.navbar-vertical');
        if (sidebar) {
            sidebar.style.backgroundColor = hex;
            sidebar.setAttribute('data-bs-theme', 'dark');
            sidebar.style.setProperty('--tblr-border-color', 'rgba(255,255,255,0.2)');
            sidebar.style.setProperty('border-right', '1px solid rgba(255, 255, 255, 0.2)', 'important');
            sidebar.style.setProperty('box-shadow', 'inset -1px 0 0 0 rgba(255, 255, 255, 0.2)', 'important');
        }
        const topNavbar = document.querySelector('header.navbar');
        if (topNavbar) {
            topNavbar.style.backgroundColor = hex;
            topNavbar.setAttribute('data-bs-theme', 'dark');
            
            topNavbar.style.setProperty('border-bottom', '1px solid rgba(255, 255, 255, 0.2)', 'important');
            topNavbar.style.setProperty('box-shadow', 'inset 0 -1px 0 0 rgba(255, 255, 255, 0.2)', 'important');
        }
        localStorage.setItem('user_primary_color', hex);
    }
    document.addEventListener("DOMContentLoaded", function() {
        const savedColor = localStorage.getItem('user_primary_color');
        if (savedColor) {
            updateColor(savedColor);
        } else {
            updateColor('#206bc4');
        }
    });
</script>
   </body>
</html>