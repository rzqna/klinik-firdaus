<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0; /* Menghilangkan margin default body */
            overflow-x: hidden; /* Mencegah scroll horizontal saat sidebar terbuka di layar kecil */
        }
        #sidebar {
            transition: transform 0.3s ease-in-out;
            z-index: 40; /* Pastikan sidebar di atas konten lain */
        }
        #sidebar.hidden-sidebar {
            transform: translateX(-100%);
        }
        #content {
            transition: margin-left 0.3s ease-in-out;
        }
        /* Styling untuk overlay gelap */
        #sidebar-overlay {
            display: none; /* Sembunyikan secara default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay tetap gelap untuk kontras */
            z-index: 30; /* Di bawah sidebar tapi di atas konten */
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
        }
        #sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Styling untuk tombol hamburger */
        .hamburger-icon div {
            width: 25px;
            height: 3px;
            background-color: white; /* Batang ikon tetap putih agar kontras dengan tombol biru */
            margin: 5px 0;
            transition: 0.3s;
        }

        .hamburger-icon.open .bar1 {
            transform: rotate(-45deg) translate(-5px, 6px);
        }
        .hamburger-icon.open .bar2 {
            opacity: 0;
        }
        .hamburger-icon.open .bar3 {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* Styling untuk Dropdown/Submenu */
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .submenu.open {
            max-height: 500px; /* Cukup besar untuk menampung semua item submenu */
        }
    </style>
</head>
<body class="bg-gray-100">
    <button id="open-sidebar-button" class="fixed top-4 left-4 z-50 p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 lg:hidden" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="sidebar">
        <div class="hamburger-icon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </button>

    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-white text-gray-800 p-6 shadow-lg hidden-sidebar lg:translate-x-0 lg:shadow-none border-r border-gray-300">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">Klinik Firdaus</h1>
            <button id="close-sidebar-button" class="lg:hidden text-gray-500 hover:text-gray-700" aria-label="Tutup menu navigasi">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav>
            <ul>
                <li class="mb-3">
                    <a href="{{ route('dashboard.admin') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500 group-hover:text-blue-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="/logout" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-red-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-red-500 group-hover:text-red-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                        </svg>
                        Keluar
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div id="sidebar-overlay"></div>

    @yield('content')
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const openSidebarButton = document.getElementById('open-sidebar-button');
        const closeSidebarButton = document.getElementById('close-sidebar-button');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const hamburgerIcon = openSidebarButton.querySelector('.hamburger-icon');

        // Dropdown elements
        const dataEntriToggle = document.getElementById('data-entri-toggle');
        const dataEntriSubmenu = document.getElementById('data-entri-submenu');
        const dataEntriArrow = document.getElementById('data-entri-arrow');

        function openSidebar() {
            sidebar.classList.remove('hidden-sidebar');
            sidebar.classList.add('translate-x-0');
            if (window.innerWidth < 1024) { // lg breakpoint Tailwind
                sidebarOverlay.classList.add('active');
                content.style.marginLeft = '0';
            } else {
                requestAnimationFrame(() => {
                    content.style.marginLeft = sidebar.offsetWidth + 'px';
                });
            }
            hamburgerIcon.classList.add('open');
            openSidebarButton.setAttribute('aria-expanded', 'true');
        }

        function closeSidebar() {
            sidebar.classList.add('hidden-sidebar');
            sidebar.classList.remove('translate-x-0');
            sidebarOverlay.classList.remove('active');
            if (window.innerWidth >= 1024) {
                 content.style.marginLeft = '0';
            }
            hamburgerIcon.classList.remove('open');
            openSidebarButton.setAttribute('aria-expanded', 'false');
        }

        openSidebarButton.addEventListener('click', (e) => {
            e.stopPropagation();
            if (sidebar.classList.contains('hidden-sidebar')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        closeSidebarButton.addEventListener('click', (e) => {
            e.stopPropagation();
            closeSidebar();
        });

        sidebarOverlay.addEventListener('click', () => {
            closeSidebar();
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { // lg breakpoint
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                sidebarOverlay.classList.remove('active');
                hamburgerIcon.classList.remove('open');
                openSidebarButton.setAttribute('aria-expanded', 'false');

                requestAnimationFrame(() => {
                    content.style.marginLeft = sidebar.offsetWidth + 'px';
                });

            } else { // Smaller than lg
                if (!sidebar.classList.contains('hidden-sidebar')) {
                    sidebarOverlay.classList.add('active');
                } else {
                    sidebarOverlay.classList.remove('active');
                    content.style.marginLeft = '0';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                requestAnimationFrame(() => {
                    content.style.marginLeft = sidebar.offsetWidth + 'px';
                });
                openSidebarButton.setAttribute('aria-expanded', 'true');
            } else {
                sidebar.classList.add('hidden-sidebar');
                content.style.marginLeft = '0';
                openSidebarButton.setAttribute('aria-expanded', 'false');
            }

            // Set initial state for dropdown based on current URL if any submenu item is active
            const currentPath = window.location.pathname;
            const submenuLinks = dataEntriSubmenu.querySelectorAll('a');
            let isSubmenuActive = false;
            submenuLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    isSubmenuActive = true;
                }
            });

            if (isSubmenuActive) {
                dataEntriSubmenu.classList.add('open');
                dataEntriToggle.setAttribute('aria-expanded', 'true');
                dataEntriArrow.classList.add('rotate-90'); // Rotate arrow if open
            }
        });

        // Toggle dropdown functionality
        dataEntriToggle.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior
            dataEntriSubmenu.classList.toggle('open');
            const isExpanded = dataEntriToggle.getAttribute('aria-expanded') === 'true';
            dataEntriToggle.setAttribute('aria-expanded', !isExpanded);
            dataEntriArrow.classList.toggle('rotate-90'); // Rotate arrow on click
        });
    </script>
</body>
</html>
