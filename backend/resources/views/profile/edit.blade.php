@extends(auth()->user()->role === 'peminjam' ? 'layouts.peminjam' : 'layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">

    @if(session('success'))
        <div class="mb-6 p-4 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
        <h2 class="text-xl font-extrabold text-slate-800 mb-1">Pengaturan Profil</h2>
        <p class="text-xs text-slate-500 mb-6">Perbarui informasi pribadi dan foto profil akun kamu.</p>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Avatar & Upload Foto -->
            <div class="flex items-center gap-6 pb-6 border-b border-slate-100">
                <div class="relative">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500 shadow-sm">
                    @else
                        <div class="w-20 h-20 rounded-full bg-indigo-100 text-indigo-700 font-extrabold text-xl flex items-center justify-center border-2 border-indigo-200">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Foto Profil</label>
                    <input type="file" name="foto_profil" accept="image/*"
                        class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-1">Format: JPG, JPEG, PNG (Maksimal 2MB)</p>
                    @error('foto_profil') <small class="text-rose-600 text-[11px] font-semibold block mt-1">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nama -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-3 py-2 text-xs font-medium border border-slate-300 rounded-xl outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    @error('name') <small class="text-rose-600 text-[11px] font-semibold block mt-1">{{ $message }}</small> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-3 py-2 text-xs font-medium border border-slate-300 rounded-xl outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    @error('email') <small class="text-rose-600 text-[11px] font-semibold block mt-1">{{ $message }}</small> @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">No. HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                        class="w-full px-3 py-2 text-xs font-medium border border-slate-300 rounded-xl outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    @error('no_hp') <small class="text-rose-600 text-[11px] font-semibold block mt-1">{{ $message }}</small> @enderror
                </div>

                <!-- Role (Disabled) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Peran / Role</label>
                    <input type="text" value="{{ ucfirst($user->role) }}" disabled
                        class="w-full px-3 py-2 text-xs font-medium border border-slate-200 bg-slate-100 rounded-xl text-slate-500 capitalize cursor-not-allowed">
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                <textarea name="alamat" rows="3"
                    class="w-full px-3 py-2 text-xs font-medium border border-slate-300 rounded-xl outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat') <small class="text-rose-600 text-[11px] font-semibold block mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection