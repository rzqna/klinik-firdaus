<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <a href="{{ route('datakaryawan.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-green-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 group-hover:text-green-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" />
                        </svg>
                        Data Karyawan
                    </a>
                </li>

                {{-- Modul Baru: Data Entri (Dropdown) --}}
                <li class="mb-3">
                    <a href="#" id="data-entri-toggle" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700 rounded-md transition-colors duration-200 group justify-between" aria-expanded="false" aria-controls="data-entri-submenu">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-cyan-500 group-hover:text-cyan-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                            Data Entri
                        </span>
                        {{-- Icon panah untuk dropdown --}}
                        <svg id="data-entri-arrow" class="h-4 w-4 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <ul id="data-entri-submenu" class="submenu pl-8 mt-2 space-y-2">
                        <li>
                            <a href="{{ route('kriteria.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-purple-700 rounded-md transition-colors duration-200 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-purple-500 group-hover:text-purple-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                                Kriteria
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subkriteria.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-orange-700 rounded-md transition-colors duration-200 group">
                                {{-- Ganti SVG ini dengan ikon yang cocok untuk sub kriteria --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                </svg>
                                Sub Kriteria
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jabatan.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-yellow-700 rounded-md transition-colors duration-200 group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-yellow-500 group-hover:text-yellow-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                                Jabatan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pekerjaan.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-teal-700 rounded-md transition-colors duration-200 group">
                                {{-- Ganti SVG ini dengan ikon yang cocok untuk pekerjaan --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-teal-500 group-hover:text-teal-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
                                </svg>
                                Pekerjaan
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Akhir Modul Data Entri --}}

                <li class="mb-3">
                    <a href="{{ route('penilaian.index') }}" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-orange-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V7a1 1 0 011-1zm10 0H6a1 1 0 000 2h7a1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Penilaian Karyawan
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
