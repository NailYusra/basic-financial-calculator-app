@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4 text-gray-100">Daftar Transaksi</h1>

    @if(session('success'))
        <div class="bg-green-900 text-green-200 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('transactions.create') }}" class="bg-blue-500 hover:bg-blue-400 text-gray-100 px-4 py-2 rounded mb-4 inline-block shadow">Tambah Transaksi</a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 p-4 rounded shadow">
            <h2 class="text-sm font-semibold text-green-800">Total Pemasukan</h2>
            <p class="text-2xl font-bold text-green-900">Rp {{ number_format($totalIncome) }}</p>
        </div>

        <div class="bg-red-100 p-4 rounded shadow">
            <h2 class="text-sm font-semibold text-red-800">Total Pengeluaran</h2>
            <p class="text-2xl font-bold text-red-900">Rp {{ number_format($totalExpense) }}</p>
        </div>

        <div class="bg-blue-100 p-4 rounded shadow">
            <h2 class="text-sm font-semibold text-blue-800">Saldo Akhir</h2>
            <p class="text-2xl font-bold text-blue-900">Rp {{ number_format($balance) }}</p>
        </div>
    </div>

    <form method="GET" class="mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <label for="month" class="block text-sm font-medium text-white mb-1">Bulan</label>
                <select name="month" id="month" class="border border-gray-700 bg-gray-900 text-gray-100 p-2 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold">
                    <option value="" class="font-normal">Semua</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }} class="font-normal">
                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-200 mb-1">Tahun</label>
                <select name="year" id="year" class="border border-gray-700 bg-gray-900 text-gray-100 p-2 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold">
                    <option value="" class="font-normal">Semua</option>
                    @for ($y = now()->year; $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }} class="font-normal">{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="pt-5">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded shadow font-semibold transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Filter
                </button>
            </div>
        </div>
    </form>

    <table class="w-full border-collapse border border-gray-700 bg-gray-900">
        <thead>
            <tr>
                <th class="border border-gray-700 px-4 py-2 text-gray-200 bg-gray-800">Tanggal</th>
                <th class="border border-gray-700 px-4 py-2 text-gray-200 bg-gray-800">Tipe</th>
                <th class="border border-gray-700 px-4 py-2 text-gray-200 bg-gray-800">Jumlah</th>
                <th class="border border-gray-700 px-4 py-2 text-gray-200 bg-gray-800">Deskripsi</th>
                <th class="border border-gray-700 px-4 py-2 text-gray-200 bg-gray-800">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $tx)
                <tr class="hover:bg-gray-800">
                    <td class="border border-gray-700 px-4 py-2 text-gray-100">{{ $tx->date->format('d M Y') }}</td>
                    <td class="border border-gray-700 px-4 py-2 text-gray-100">{{ ucfirst($tx->type) }}</td>
                    <td class="border border-gray-700 px-4 py-2 text-gray-100">{{ number_format($tx->amount, 0, ',', '.') }}</td>
                    <td class="border border-gray-700 px-4 py-2 text-gray-100">{{ $tx->description }}</td>
                    <td class="border border-gray-700 px-4 py-2 text-gray-100 text-center">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('transactions.edit', $tx->id) }}" class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 px-3 py-1 rounded shadow text-sm">Edit</a>
                            <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-500 text-gray-100 px-3 py-1 rounded shadow text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-200 bg-gray-800">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4 text-gray-200">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
