<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <title>Login</title>
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
                Login Sistem
            </h2>
        </div>
        {{-- @if ($errors->any())
            <div class="mb-4 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <form action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" autocomplete="email" required class="form-input block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <input type="password" name="password" autocomplete="password" required class="form-input block w-full rounded-md border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
            </div>
            <div class="mb-3">
                @if ($errors->any())
                    <div class="mb-6 text-red-700 text-sm mt-1 ">
                        @foreach ($errors->all() as $error)
                        <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition duration-150 ease-in-out">
                    Masuk
                </button>

            </div>
        </form>
    </div>
    </div>
</body>
</html>


