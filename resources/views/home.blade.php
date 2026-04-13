<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Inventaris</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-5 md:p-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Barang Baru</h1>
            <a href="{{ route('inventory.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
        </div>

        <form action="{{ route('inventory.store') }}" method="POST" class="space-y-4">
            @csrf <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Barang</label>
                    <input type="text" name="sku" required class="mt-1 w-full p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="name" required class="mt-1 w-full p-2 border rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jumlah stok</label>
                    <input type="text" name="unit" placeholder="Pcs" class="mt-1 w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 w-full p-2 border rounded-md bg-white">
                        <option value="Elektronik">elektronik</option>
                        <option value="Alat Kantor">pakaian</option>
                        <option value="aksesoris">aksesoris</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="description" rows="3" class="mt-1 w-full p-2 border rounded-md"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-md hover:bg-blue-700 transition">
                    Simpan Data Barang
                </button>
            </div>
        </form>
    </div>
</body>
</html>