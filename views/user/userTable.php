<div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700"><?= $user['id'] ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $user['name'] ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900"><?= $user['phone'] ?></td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <a href=<?= "?action=user_edit&id={$user['id']}" ?> class="text-indigo-600 hover:text-indigo-900 px-2">Edit</a>
                            <a href=<?= "?action=delete_user&id={$user['id']}" ?> class="text-red-600 hover:text-red-900 px-2">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>