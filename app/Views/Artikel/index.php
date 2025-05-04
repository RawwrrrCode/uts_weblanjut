<!-- app/Views/artikel/dashboard.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 bg-blue-800 text-white p-4">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <nav class="space-y-2">
                <a href="/" class="block py-2 px-4 rounded hover:bg-blue-700">Home</a>
                <a href="/artikel" class="block py-2 px-4 rounded hover:bg-blue-700 mt-4">Artikel</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <header class="mb-6">
                <h1 class="text-3xl font-semibold">Selamat Datang</h1>
                <p class="text-gray-600">Berikut adalah ringkasan dan daftar artikel Anda.</p>
            </header>

            <!-- Daftar Artikel -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">Daftar Artikel</h2>

                <?php if (!empty($artikel)) : ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow">
                            <thead>
                                <tr class="bg-blue-800 text-white text-left">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Judul</th>
                                    <th class="px-4 py-2">Isi</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($artikel as $item) : ?>
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="px-4 py-2"><?= esc($item['id']); ?></td>
                                        <td class="px-4 py-2"><?= esc($item['judul']); ?></td>
                                        <td class="px-4 py-2"><?= esc(substr($item['isi'], 0, 100)); ?>...</td>
                                        <td class="px-4 py-2 space-x-2">
                                            <a href="javascript:void(0)" onclick="openDetailModal(<?= $item['id']; ?>)" class="text-blue-600 hover:underline">Lihat</a>
                                            <a href="javascript:void(0)" onclick="openEditModal(<?= $item['id']; ?>)" class="text-yellow-600 hover:underline">Edit</a>
                                            <button onclick="openDeleteModal(<?= $item['id']; ?>, '<?= esc($item['judul'], 'js'); ?>')" class="text-red-600 hover:underline bg-transparent border-none cursor-pointer p-0">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p class="text-gray-600">Tidak ada artikel untuk ditampilkan.</p>
                <?php endif; ?>

                <!-- Tombol Tambah Artikel -->
                <button onclick="openCreateModal()" class="mt-6 bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Artikel
                </button>
            </section>
        </main>
    </div>

    <!-- Modal Tambah Artikel -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-semibold mb-4">Tambah Artikel</h2>
            <form action="/artikel/store" method="post" class="space-y-4">
                <input type="text" name="judul" placeholder="Judul" class="w-full p-2 border rounded" required>
                <textarea name="isi" placeholder="Isi artikel" class="w-full p-2 border rounded h-32" required></textarea>
                <input type="date" name="tanggal_publikasi" class="w-full p-2 border rounded">
                <input type="text" name="status" placeholder="Status (publish/draft)" class="w-full p-2 border rounded">
                <input type="text" name="author" placeholder="Penulis" class="w-full p-2 border rounded">
                <input type="text" name="meta_deskripsi" placeholder="Meta Deskripsi" class="w-full p-2 border rounded">
                <input type="text" name="kata_kunci" placeholder="Kata Kunci" class="w-full p-2 border rounded">

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Artikel -->
    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl max-h-[90vh] overflow-y-auto">
            <button onclick="closeDetailModal()" class="mb-4 text-red-600 hover:underline">Tutup</button>
            <h2 id="detailJudul" class="text-xl font-semibold mb-2"></h2>
            <p id="detailTanggal" class="text-sm text-gray-500 mb-4"></p>
            <div id="detailIsi" class="prose max-w-none whitespace-pre-wrap"></div>
        </div>
    </div>

    <!-- Modal Edit Artikel -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-semibold mb-4">Edit Artikel</h2>
            <form id="editForm" method="post" class="space-y-4">
                <input type="hidden" name="id" id="editId">
                <input type="text" name="judul" id="editJudul" placeholder="Judul" class="w-full p-2 border rounded" required>
                <textarea name="isi" id="editIsi" placeholder="Isi artikel" class="w-full p-2 border rounded h-32" required></textarea>
                <input type="date" name="tanggal_publikasi" id="editTanggal" class="w-full p-2 border rounded">
                <input type="text" name="status" id="editStatus" placeholder="Status (publish/draft)" class="w-full p-2 border rounded">
                <input type="text" name="author" id="editAuthor" placeholder="Penulis" class="w-full p-2 border rounded">
                <input type="text" name="meta_deskripsi" id="editMeta" placeholder="Meta Deskripsi" class="w-full p-2 border rounded">
                <input type="text" name="kata_kunci" id="editKataKunci" placeholder="Kata Kunci" class="w-full p-2 border rounded">

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4 text-red-600">Konfirmasi Hapus</h2>
            <p id="deleteMessage" class="mb-6">Apakah Anda yakin ingin menghapus artikel ini?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <form id="deleteForm" method="post" action="" class="inline">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Modal dan AJAX -->
    <script>
        // Modal Tambah Artikel
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            document.getElementById('createModal').classList.add('flex');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.remove('flex');
            document.getElementById('createModal').classList.add('hidden');
        }

        // Modal Detail Artikel
        function openDetailModal(id) {
            fetch('/artikel/get/' + id)
                .then(response => {
                    if (!response.ok) throw new Error('Artikel tidak ditemukan');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('detailJudul').textContent = data.judul;
                    document.getElementById('detailTanggal').textContent = 'Dipublikasikan pada: ' + data.tanggal_publikasi;
                    document.getElementById('detailIsi').textContent = data.isi;

                    const modal = document.getElementById('detailModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                })
                .catch(err => alert(err.message));
        }

        function closeDetailModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Modal Edit Artikel
        function openEditModal(id) {
            fetch('/artikel/get/' + id)
                .then(response => {
                    if (!response.ok) throw new Error('Artikel tidak ditemukan');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('editId').value = data.id;
                    document.getElementById('editJudul').value = data.judul;
                    document.getElementById('editIsi').value = data.isi;
                    document.getElementById('editTanggal').value = data.tanggal_publikasi;
                    document.getElementById('editStatus').value = data.status;
                    document.getElementById('editAuthor').value = data.author;
                    document.getElementById('editMeta').value = data.meta_deskripsi;
                    document.getElementById('editKataKunci').value = data.kata_kunci;

                    const modal = document.getElementById('editModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                })
                .catch(err => alert(err.message));
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // Submit form edit via AJAX
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('editId').value;
            const formData = new FormData(this);

            fetch('/artikel/update/' + id, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Gagal memperbarui artikel');
                return response.text();
            })
            .then(() => {
                alert('Artikel berhasil diperbarui');
                closeEditModal();
                location.reload(); // reload halaman agar data terbaru tampil
            })
            .catch(err => alert(err.message));
        });

        // Modal Hapus Artikel
        function openDeleteModal(id, judul) {
            const modal = document.getElementById('deleteModal');
            const message = document.getElementById('deleteMessage');
            const form = document.getElementById('deleteForm');

            message.textContent = `Apakah Anda yakin ingin menghapus artikel berjudul "${judul}"?`;
            form.action = `/artikel/delete/${id}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>
