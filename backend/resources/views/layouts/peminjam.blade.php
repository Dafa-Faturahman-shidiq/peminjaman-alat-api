<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMPEL - Peminjam Alat')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <!-- NAVBAR PEMINJAM -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <!-- Logo & Menu Utama -->
                <div class="flex items-center gap-8">
                    <a href="{{ route('peminjam.katalog.index') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md shadow-indigo-500/20">
                            S
                        </div>
                        <span class="font-extrabold text-slate-800 tracking-tight text-lg">SIMPEL</span>
                    </a>

                    <!-- Navigation Links (Desktop) -->
                    <div class="hidden sm:flex sm:space-x-2">
                        <a href="{{ route('peminjam.katalog.index') }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('peminjam.katalog.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Katalog Alat
                        </a>

                        <a href="{{ route('peminjam.riwayat.index') }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('peminjam.riwayat.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Riwayat Peminjaman Saya
                        </a>

                        <a href="{{ route('profile.edit') }}" 
                           class="px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-100' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profil Saya
                        </a>
                    </div>
                </div>

                <!-- User Info & Logout -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile.edit') }}" class="hidden md:flex items-center gap-2.5 group">
                        @if(auth()->user()?->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto" class="w-8 h-8 rounded-full object-cover border border-indigo-200">
                        @else
                            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold text-xs flex items-center justify-center border border-indigo-200">
                                {{ strtoupper(substr(auth()->user()?->name ?? 'P', 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex flex-col text-right">
                            <span class="text-xs font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">{{ auth()->user()->name ?? 'Peminjam' }}</span>
                            <span class="text-[10px] text-slate-400 capitalize">{{ auth()->user()->role ?? 'peminjam' }}</span>
                        </div>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 text-xs font-bold transition-all flex items-center gap-1.5 border border-slate-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>

            </div>

            <!-- Mobile Navigation -->
            <div class="sm:hidden flex border-t border-slate-100 py-2 gap-2">
                <a href="{{ route('peminjam.katalog.index') }}" 
                   class="flex-1 py-2 text-center rounded-lg text-xs font-bold {{ request()->routeIs('peminjam.katalog.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">
                    Katalog
                </a>
                <a href="{{ route('peminjam.riwayat.index') }}" 
                   class="flex-1 py-2 text-center rounded-lg text-xs font-bold {{ request()->routeIs('peminjam.riwayat.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">
                    Riwayat
                </a>
                <a href="{{ route('profile.edit') }}" 
                   class="flex-1 py-2 text-center rounded-lg text-xs font-bold {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600' }}">
                    Profil
                </a>
            </div>
        </div>
    </nav>

    <!-- CONTENT WRAPPER -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-400">
        SIMPEL &copy; {{ date('Y') }} - Sistem Peminjaman Alat Sekolah
    </footer>

</body>
</html>