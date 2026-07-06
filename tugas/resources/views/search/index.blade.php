<x-app-layout>
    {{-- Slot Title --}}
    <x-slot name="title">
        Pencarian
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8" x-data="{ tab: 'buku' }">
                
                {{-- Header Pencarian --}}
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">Hasil Pencarian</p>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">
                        Menampilkan hasil untuk: <span class="text-blue-600">"{{ $keyword }}"</span>
                    </h2>
                </div>

                {{-- Tab Navigation --}}
                <div class="flex border-b border-gray-200 space-x-2 mb-6 overflow-x-auto">
                    <button @click="tab = 'buku'" :class="tab === 'buku' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm whitespace-nowrap transition-all duration-150 flex items-center gap-2">
                        <i class="bi bi-book"></i> Buku 
                        <span :class="tab === 'buku' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'" class="ml-1 px-2 py-0.5 rounded-full text-xs font-bold">
                            {{ $results['buku']->count() }}
                        </span>
                    </button>
                    
                    <button @click="tab = 'anggota'" :class="tab === 'anggota' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm whitespace-nowrap transition-all duration-150 flex items-center gap-2">
                        <i class="bi bi-people"></i> Anggota
                        <span :class="tab === 'anggota' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'" class="ml-1 px-2 py-0.5 rounded-full text-xs font-bold">
                            {{ $results['anggota']->count() }}
                        </span>
                    </button>
                    
                    <button @click="tab = 'transaksi'" :class="tab === 'transaksi' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm whitespace-nowrap transition-all duration-150 flex items-center gap-2">
                        <i class="bi bi-arrow-left-right"></i> Transaksi
                        <span :class="tab === 'transaksi' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'" class="ml-1 px-2 py-0.5 rounded-full text-xs font-bold">
                            {{ $results['transaksi']->count() }}
                        </span>
                    </button>
                </div>

                {{-- Tab Content --}}
                <div>
                    {{-- Tab Buku --}}
                    <div x-show="tab === 'buku'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-3">
                        @forelse($results['buku'] as $buku)
                            <div class="p-4 rounded-xl border border-gray-150 bg-white hover:border-blue-300 hover:shadow-sm transition-all duration-150">
                                <h6 class="text-base font-semibold text-gray-800">
                                    {!! str_ireplace($keyword, '<mark class="bg-yellow-200 text-gray-900 rounded px-0.5">'.$keyword.'</mark>', e($buku->judul)) !!}
                                </h6>
                                <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                    <span class="font-medium text-gray-600">{{ $buku->pengarang ?? $buku->penulis }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span>Stok: <strong class="{{ $buku->stok > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $buku->stok }}</strong></span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400">
                                <i class="bi bi-folder2-open text-3xl block mb-2"></i>
                                <p class="text-sm italic">Tidak ada buku yang cocok.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Tab Anggota --}}
                    <div x-show="tab === 'anggota'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-3" style="display: none;">
                        @forelse($results['anggota'] as $anggota)
                            <div class="p-4 rounded-xl border border-gray-150 bg-white hover:border-blue-300 hover:shadow-sm transition-all duration-150">
                                <h6 class="text-base font-semibold text-gray-800">
                                    {!! str_ireplace($keyword, '<mark class="bg-yellow-200 text-gray-900 rounded px-0.5">'.$keyword.'</mark>', e($anggota->nama)) !!}
                                </h6>
                                <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                    <span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded text-gray-600">{{ $anggota->nomor_anggota ?? $anggota->nim }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $anggota->email }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400">
                                <i class="bi bi-folder2-open text-3xl block mb-2"></i>
                                <p class="text-sm italic">Tidak ada anggota yang cocok.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Tab Transaksi --}}
                    <div x-show="tab === 'transaksi'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-3" style="display: none;">
                        @forelse($results['transaksi'] as $trx)
                            <div class="p-4 rounded-xl border border-gray-150 bg-white hover:border-blue-300 hover:shadow-sm transition-all duration-150">
                                <div class="flex items-center justify-between">
                                    <h6 class="text-sm font-mono font-bold text-blue-600">{{ $trx->kode_transaksi }}</h6>
                                    <span class="text-xs text-gray-400">{{ $trx->created_at?->format('d M Y') }}</span>
                                </div>
                                <div class="mt-2 text-sm text-gray-700">
                                    <span class="font-semibold text-gray-800">{{ $trx->anggota->nama }}</span> 
                                    <span class="text-gray-400 mx-1">meminjam</span> 
                                    <span class="italic text-gray-600">"{{ $trx->buku->judul }}"</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400">
                                <i class="bi bi-folder2-open text-3xl block mb-2"></i>
                                <p class="text-sm italic">Tidak ada transaksi yang cocok.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>