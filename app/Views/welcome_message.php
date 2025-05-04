<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <main class="flex-1 p-6 overflow-auto">
      <!-- Header -->
      <header class="mb-6">
        <h1 class="text-3xl font-semibold">Selamat Datang</h1>
      </header>
      <!-- Daftar Artikel -->
      <section>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php if (!empty($artikel)): ?>
            <?php foreach ($artikel as $item): ?>
              <div class="bg-white p-5 rounded shadow hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-xl font-bold mb-3"><?= esc($item['judul']); ?></h3>
                <p class="text-gray-700 mb-4"><?= nl2br(esc($item['isi'])); ?></p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-gray-600">Tidak ada artikel untuk ditampilkan.</p>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </div>
</body>

</html>
