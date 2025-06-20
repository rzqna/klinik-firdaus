<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Sidebar Light Mode - Colorful Icons</title>
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
    </style>
</head>
<body class="bg-gray-200">
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
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500 group-hover:text-blue-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-green-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 group-hover:text-green-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" />
                        </svg>
                        Data Karyawan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-purple-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-purple-500 group-hover:text-purple-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Kriteria & Sub Kriteria
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-orange-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-orange-500 group-hover:text-orange-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                             <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V7a1 1 0 011-1zm10 0H6a1 1 0 000 2h7a1 1 0 000-2z" clip-rule="evenodd" />
                        </svg>
                        Penilaian Karyawan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-red-700 rounded-md transition-colors duration-200 group">
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

    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Konten Utama</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                Ini adalah area konten utama. Ketika sidebar terbuka di layar besar, konten ini akan bergeser ke kanan.
                Di layar kecil, sidebar akan muncul sebagai overlay. Sidebar kini menggunakan tema terang dengan ikon berwarna.
            </p>
            <p class="text-gray-700 leading-relaxed">
                Anda bisa menambahkan berbagai elemen di sini. Coba ubah ukuran layar untuk melihat bagaimana sidebar dan konten beradaptasi.
                Tombol hamburger akan muncul di layar kecil untuk mengontrol visibilitas sidebar.
            </p>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">Kartu Informasi 1</h3>
                    <p class="text-blue-600">Beberapa teks contoh di dalam kartu. Ini membantu mengisi ruang dan menunjukkan bagaimana tata letak bekerja.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Kartu Informasi 2</h3>
                    <p class="text-green-600">Konten lain bisa ditempatkan di sini. Sidebar ini menggunakan Tailwind CSS untuk styling cepat.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const openSidebarButton = document.getElementById('open-sidebar-button');
        const closeSidebarButton = document.getElementById('close-sidebar-button');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const hamburgerIcon = openSidebarButton.querySelector('.hamburger-icon');

        function openSidebar() {
            sidebar.classList.remove('hidden-sidebar');
            sidebar.classList.add('translate-x-0');
            if (window.innerWidth < 1024) { // lg breakpoint Tailwind
                sidebarOverlay.classList.add('active');
                content.style.marginLeft = '0';
            } else {
                // Ensure sidebar offsetWidth is read after it's visible and transitions are applied
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
            // For large screens, reset margin if sidebar is programmatically closed
            // For small screens, margin is already 0 or handled by overlay
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
                // On large screens, sidebar should always be visible unless explicitly hidden by a different logic
                // For this setup, we assume it's part of the layout.
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                sidebarOverlay.classList.remove('active');
                hamburgerIcon.classList.remove('open'); // Ensure hamburger is in closed state
                openSidebarButton.setAttribute('aria-expanded', 'false'); // Hamburger is not used to control on LG

                // Recalculate margin after sidebar is ensured to be visible
                requestAnimationFrame(() => {
                     content.style.marginLeft = sidebar.offsetWidth + 'px';
                });

            } else { // Smaller than lg
                // If sidebar is open (not 'hidden-sidebar'), ensure overlay is active.
                if (!sidebar.classList.contains('hidden-sidebar')) {
                    sidebarOverlay.classList.add('active');
                } else {
                    // If sidebar is hidden, ensure overlay is not active and content margin is 0.
                    sidebarOverlay.classList.remove('active');
                    content.style.marginLeft = '0';
                }
                // Hamburger state (open/closed) is managed by click events, not directly by resize here.
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth >= 1024) {
                // Sidebar is shown by default on large screens, ensure content margin is set.
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                 requestAnimationFrame(() => { // Use rAF to ensure offsetWidth is correct after potential style applications
                    content.style.marginLeft = sidebar.offsetWidth + 'px';
                });
                openSidebarButton.setAttribute('aria-expanded', 'true'); // Technically, it's "open" by default
            } else {
                // Sidebar is hidden by default on small screens
                sidebar.classList.add('hidden-sidebar');
                content.style.marginLeft = '0';
                openSidebarButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login - Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Opsi untuk sedikit efek pada input field saat focus */
        .form-input:focus {
            border-color: #3b82f6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .company-logo {
            width: 48px; /* Sesuaikan ukuran logo jika perlu (mirip h-12) */
            height: 48px; /* Sesuaikan ukuran logo jika perlu (mirip w-12) */
            object-fit: contain; /* Atau 'cover', tergantung jenis logo */
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <div class="text-center mb-8">
            <img src="https://placehold.co/100x100/3B82F6/FFFFFF?text=LOGO" alt="Logo Perusahaan" class="mx-auto company-logo">
            <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                Selamat Datang Kembali!
            </h2>
        </div>

        <form action="#" method="POST">
            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                        Alamat Email atau Username
                    </label>
                    <div class="mt-2">
                        <input id="email" name="email" type="text" autocomplete="email" required
                               class="form-input block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out"
                               placeholder="nama@contoh.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                        Kata Sandi
                    </label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="form-input block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition duration-150 ease-in-out"
                               placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition duration-150 ease-in-out">
                        Masuk
                    </button>
                </div>
            </div>
        </form>

        </div>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        <!-- Tampilkan error validasi khusus email/password -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Evaluasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-secondary">
  <div class="bg-white container-sm col-6 border my-3 rounded px-5 py-3 pb-5">
    <h1>Halo!!</h1>
    <div>Selamat datang di halaman admin</div>
    <div><a href="/logout" class="btn btn-sm btn-secondary">Logout >></a></div>
    <div class="card mt-3">
      <ul class="list-group list-group-flush">
        @if (Auth::user()->role == 'admin')
        <li class="list-group-item">Menu Admin</li>
        @endif
        @if (Auth::user()->role == 'user')
        <li class="list-group-item">Menu User</li>
        @endif

      </ul>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
  </script>
</body>

</html>

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
    </style>
</head>
<body class="bg-gray-200">
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
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500 group-hover:text-blue-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-green-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 group-hover:text-green-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0012 11z" clip-rule="evenodd" />
                        </svg>
                        Data Karyawan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-purple-700 rounded-md transition-colors duration-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-purple-500 group-hover:text-purple-700 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1zm0 4a1 1 0 011-1h6a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        Kriteria & Sub Kriteria
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-100 hover:text-orange-700 rounded-md transition-colors duration-200 group">
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

    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Konten Utama</h2>
            <h3 class="text-xl font-bold mb-4 text-gray-800">Selamat Datang di Halaman Admin</h3>
            <p class="text-gray-700 leading-relaxed mb-4">
                Ini adalah area konten utama. Ketika sidebar terbuka di layar besar, konten ini akan bergeser ke kanan.
                Di layar kecil, sidebar akan muncul sebagai overlay. Sidebar kini menggunakan tema terang dengan ikon berwarna.
            </p>
            <p class="text-gray-700 leading-relaxed">
                Anda bisa menambahkan berbagai elemen di sini. Coba ubah ukuran layar untuk melihat bagaimana sidebar dan konten beradaptasi.
                Tombol hamburger akan muncul di layar kecil untuk mengontrol visibilitas sidebar.
            </p>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">Kartu Informasi 1</h3>
                    <p class="text-blue-600">Beberapa teks contoh di dalam kartu. Ini membantu mengisi ruang dan menunjukkan bagaimana tata letak bekerja.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-green-700 mb-2">Kartu Informasi 2</h3>
                    <p class="text-green-600">Konten lain bisa ditempatkan di sini. Sidebar ini menggunakan Tailwind CSS untuk styling cepat.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const openSidebarButton = document.getElementById('open-sidebar-button');
        const closeSidebarButton = document.getElementById('close-sidebar-button');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const hamburgerIcon = openSidebarButton.querySelector('.hamburger-icon');

        function openSidebar() {
            sidebar.classList.remove('hidden-sidebar');
            sidebar.classList.add('translate-x-0');
            if (window.innerWidth < 1024) { // lg breakpoint Tailwind
                sidebarOverlay.classList.add('active');
                content.style.marginLeft = '0';
            } else {
                // Ensure sidebar offsetWidth is read after it's visible and transitions are applied
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
            // For large screens, reset margin if sidebar is programmatically closed
            // For small screens, margin is already 0 or handled by overlay
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
                // On large screens, sidebar should always be visible unless explicitly hidden by a different logic
                // For this setup, we assume it's part of the layout.
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                sidebarOverlay.classList.remove('active');
                hamburgerIcon.classList.remove('open'); // Ensure hamburger is in closed state
                openSidebarButton.setAttribute('aria-expanded', 'false'); // Hamburger is not used to control on LG

                // Recalculate margin after sidebar is ensured to be visible
                requestAnimationFrame(() => {
                     content.style.marginLeft = sidebar.offsetWidth + 'px';
                });

            } else { // Smaller than lg
                // If sidebar is open (not 'hidden-sidebar'), ensure overlay is active.
                if (!sidebar.classList.contains('hidden-sidebar')) {
                    sidebarOverlay.classList.add('active');
                } else {
                    // If sidebar is hidden, ensure overlay is not active and content margin is 0.
                    sidebarOverlay.classList.remove('active');
                    content.style.marginLeft = '0';
                }
                // Hamburger state (open/closed) is managed by click events, not directly by resize here.
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth >= 1024) {
                // Sidebar is shown by default on large screens, ensure content margin is set.
                sidebar.classList.remove('hidden-sidebar');
                sidebar.classList.add('translate-x-0');
                 requestAnimationFrame(() => { // Use rAF to ensure offsetWidth is correct after potential style applications
                    content.style.marginLeft = sidebar.offsetWidth + 'px';
                });
                openSidebarButton.setAttribute('aria-expanded', 'true'); // Technically, it's "open" by default
            } else {
                // Sidebar is hidden by default on small screens
                sidebar.classList.add('hidden-sidebar');
                content.style.marginLeft = '0';
                openSidebarButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
</body>
</html>
