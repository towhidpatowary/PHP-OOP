<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 font-bold text-purple-700 text-2xl">AdminPanel</div>
            <nav class="mt-8">
                <a href="?action=index" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">Dashboard</a>
                <a href="?action=user_list" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">Users List</a>
                <a href="?action=create_user" class="block py-3 px-6 text-gray-700 hover:bg-purple-100">Create User</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-purple-700">                
                <?php 
                    $action = $_GET['action'] ?? 'index';
                    switch ($action) {
                        case 'user_list':
                            echo "User List";
                        break;
                        case 'create_user':
                            echo "Create User";
                        break;
                        default :
                            echo "Dashboard";
                        break;
                    }
                ?>
                </h1>
                <div class="flex items-center gap-4">
                    <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    <div
                        class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">
                        SR</div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6 space-y-6">