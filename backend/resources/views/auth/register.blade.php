 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Peminjaman Alat</title>
    <!-- Memuat Tailwind CSS melalui CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS untuk Animasi Masuk (Full Transition) -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>
<!-- Background Gradient Modern -->
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 flex items-center justify-center min-h-screen antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Card Container dengan Glassmorphism & Shadow -->
    <div class="animate-fade-in-up w-full max-w-md bg-white/80 backdrop-blur-xl p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-white/60 transform transition-all duration-500 hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)]">

        <!-- Header Layout -->
        <div class="text-center mb-8">
            <!-- Gradient Text -->
            <h3 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-indigo-800 mb-2">Selamat Datang Di SIMPEL</h3>
            <p class="text-sm text-slate-500 font-medium">Silakan Daftar untuk mengakses sistem</p>
        </div>

        <!-- Alert Error Session -->
        @if(session('error'))
            <div class="mb-5 p-4 text-sm text-red-800 bg-red-50 border border-red-200 rounded-2xl flex items-center justify-between shadow-sm transition-all" id="alert-error">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('error') }}</span>
                </div>
                <button onclick="document.getElementById('alert-error').remove()" class="text-red-500 hover:text-red-800 font-bold ml-4">✕</button>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-5 p-4 text-sm text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between shadow-sm transition-all" id="alert-success">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('alert-success').remove()" class="text-emerald-500 hover:text-emerald-800 font-bold ml-4">✕</button>
            </div>
        @endif

        <!-- Alert Error Validasi -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50/80 backdrop-blur-sm border-l-4 border-red-500 text-red-700 rounded-r-xl text-sm shadow-sm transform transition-all hover:scale-[1.02]">
                <div class="flex items-center mb-2 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    Terdapat kesalahan:
                </div>
                <ul class="list-disc pl-7 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Input Nama Lengkap -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Nama Lengkap</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Email Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="badrul@gmail.com">
                </div>
            </div>

            <!-- Input Email -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Email Address</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Email Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="Badrul@example.com">
                </div>
            </div>

            <!-- Input Password -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Password</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Lock Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" name="password" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Input konfirmasi Password -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Konfirmasi Password</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Lock Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" name="password_confirmation" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="••••••••">
                </div>
            </div>

            <!-- Input konfirmasi Password -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">No Telepon</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Lock Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="text" name="no_hp" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="+62xxxxxxxxxxxx">
                </div>
            </div>

            <!-- Input alamat -->
            <div class="group relative">
                <label class="block text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Alamat</label>
                <div class="relative flex items-center">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                        <!-- SVG Lock Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="text" name="alamat" required
                           class="w-full pl-12 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl text-slate-800 outline-none transition-all duration-300 focus:bg-white focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 hover:border-slate-300 shadow-sm"
                           placeholder="Masukan Alamat">
                </div>
            </div>

            <p class="text-center ">
                <a href="{{ route('login')}} " class="text-slate-700 text-sm font-semibold mb-2 transition-colors group-focus-within:text-indigo-600">Sudah Punya akun <span class="text-blue-600">Masuk</span></a>
            </p>

            <!-- Tombol Submit -->
            <div class="pt-2">
                <button type="submit"
                        class="group w-full flex justify-center items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-indigo-500/50 active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span>Daftar Sekarang</span>
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>

        </form>
        
    </div>

</body>
</html>