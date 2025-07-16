@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 bg-gray-900">
    <h1 class="text-xl font-bold mb-4 text-white">Tambah Transaksi Baru</h1>

    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-gray-200" for="type">Tipe Transaksi</label>
            <select name="type" id="type" class="border border-gray-700 bg-gray-800 text-white p-2 w-full">
                <option value="income">Pemasukan</option>
                <option value="expense">Pengeluaran</option>
            </select>
            @error('type') <p class="text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-200" for="amount">Jumlah</label>
            <input type="number" name="amount" id="amount" class="border border-gray-700 bg-gray-800 text-white p-2 w-full" required>
            @error('amount') <p class="text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-200" for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="border border-gray-700 bg-gray-800 text-white p-2 w-full"></textarea>
            @error('description') <p class="text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-200" for="date">Tanggal</label>
            <input type="date" name="date" id="date" class="border border-gray-700 bg-gray-800 text-white p-2 w-full" required>
            @error('date') <p class="text-red-400">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
