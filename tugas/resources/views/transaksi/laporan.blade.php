<x-app-layout>

    <div class="py-12">
        <div class="max-w-[90%] mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Judul Halaman --}}
            <div
                class="flex items-center justify-between gap-2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m32-2v-2a4 4 0 00-4-4h-3a4 4 0 00-4 4v2M9 21h12a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-900">Laporan Analisis Transaksi</h1>
                </div>

                <a href="{{ route('transaksi.index') }}"
                    class="inline-flex items-center gap-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold rounded-md shadow-sm transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Form Filter --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <form action="{{ route('transaksi.laporan') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Dari
                            Tanggal</label>
                        <input type="date" name="dari"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            value="{{ request('dari') }}">
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Sampai
                            Tanggal</label>
                        <input type="date" name="sampai"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                            value="{{ request('sampai') }}">
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Status</label>
                        <select name="status"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua</option>
                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam
                            </option>
                            <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Anggota</label>
                        <select name="anggota_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">Semua Anggota</option>
                            @foreach ($anggotaList as $agt)
                                <option value="{{ $agt->id }}"
                                    {{ request('anggota_id') == $agt->id ? 'selected' : '' }}>{{ $agt->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2 flex gap-2">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-md shadow-sm transition-colors duration-150">
                            Filter
                        </button>
                        <a href="{{ route('transaksi.laporan.pdf', request()->all()) }}"
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md shadow-sm transition-colors duration-150">
                            PDF
                        </a>
                    </div>
                </form>
            </div>

            {{-- Widget Summary Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 flex flex-col justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi Sesuai
                        Filter</span>
                    <span class="text-3xl font-extrabold text-blue-600 mt-2">{{ $totalTransaksi }}</span>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500 flex flex-col justify-between">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Denda Terkumpul</span>
                    <span class="text-3xl font-extrabold text-red-600 mt-2">Rp
                        {{ number_format($totalDenda, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Tabel Hasil Laporan --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Kode
                                </th>
                                <th class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Anggota
                                </th>
                                <th class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Buku
                                </th>
                                <th class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Tgl
                                    Pinjam</th>
                                <th class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Status
                                </th>
                                <th
                                    class="px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">
                                    Denda</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($transaksis as $trx)
                                <tr class="hover:bg-gray-50/80 transition-colors">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-mono text-pink-600 bg-pink-50/50 rounded px-1.5 py-0.5 inline-block my-2 mx-4">
                                        {{ $trx->kode_transaksi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ $trx->anggota->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $trx->buku->judul ?? "Buku tidak ditemukan" }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($trx->status == 'Dipinjam')
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-amber-100 text-amber-800">{{ $trx->status }}</span>
                                        @else
                                            <span
                                                class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-green-100 text-green-800">{{ $trx->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-red-600 font-bold">Rp
                                        {{ number_format($trx->denda, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-10 text-center text-sm text-gray-400 bg-gray-50/30">
                                        Data riwayat transaksi kosong atau tidak ditemukan pada filter ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
