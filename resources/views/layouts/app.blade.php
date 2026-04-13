<!DOCTYPE html>
<html>
<head>
    <title>Pinjam Dulu Bos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-xl font-bold border-b border-gray-700">
            Pinjam Dulu Bos
        </div>

        <nav class="flex-1 p-4 space-y-2">

            @if(auth()->user()->role == 'admin')
                <a href="/admin/dashboard"
                   class="block px-4 py-2 rounded hover:bg-gray-700">
                   📊 Dashboard
                </a>

                <a href="{{ route('admin.alat.index') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-700">
                   📦 Data Alat
                </a>

                <a href="{{ route('admin.peminjaman.index') }}"
                   class="block px-4 py-2 rounded hover:bg-gray-700">
                   📋 Peminjaman & Approval
                </a>
            @endif

            @if(auth()->user()->role == 'petugas')
                <a href="/petugas/dashboard"
                   class="block px-4 py-2 rounded hover:bg-gray-700">
                   📊 Dashboard
                </a>

                <a href="/petugas/peminjaman"
                   class="block px-4 py-2 rounded hover:bg-gray-700">
                   📋 Approval
                </a>
            @endif

        </nav>

        <div class="p-4 border-t border-gray-700">
            <div class="mb-3 text-sm">
                Login sebagai:
                <div class="font-semibold">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4">
            <h1 class="text-xl font-semibold">
                @yield('title')
            </h1>
        </header>

        <!-- Content -->
        <main class="p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>