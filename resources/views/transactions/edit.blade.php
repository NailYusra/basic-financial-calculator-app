@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 text-gray-100">
    <h1 class="text-xl font-bold mb-4">Edit Transaksi</h1>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="type" class="block mb-1">Tipe Transaksi</label>
            <select name="type" id="type" class="border p-2 w-full bg-white text-gray-900">
                <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <div>
            <label for="amount" class="block mb-1">Jumlah</label>
            <input type="number" name="amount" value="{{ $transaction->amount }}" class="border p-2 w-full bg-white text-gray-900" required>
        </div>

        <div>
            <label for="description" class="block mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="border p-2 w-full bg-white text-gray-900">{{ $transaction->description }}</textarea>
        </div>

        <div>
            <label for="date" class="block mb-1">Tanggal</label>
            <input type="date" name="date" value="{{ $transaction->date }}" class="border p-2 w-full bg-white text-gray-900" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
