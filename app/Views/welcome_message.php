<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind Dashboard</title>
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
                <h1 class="text-3xl font-semibold">Welcome Back</h1>
                <p class="text-gray-600">Here is your dashboard overview.</p>
            </header>

            <!-- Grid Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">Users</h2>
                    <p class="text-2xl mt-2">1,250</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">Sales</h2>
                    <p class="text-2xl mt-2">$8,430</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-semibold">New Signups</h2>
                    <p class="text-2xl mt-2">320</p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>