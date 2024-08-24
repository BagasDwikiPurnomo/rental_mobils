<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        customBlue: '#1e3a8a', // Dark blue color
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100 p-8">
    <div class="container mx-auto max-w-lg bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold mb-6 text-customBlue">
            <?php echo isset($user) ? 'Edit User' : 'Create User'; ?>
        </h1>

        <form method="post" action="<?php echo isset($user) ? base_url('User/User_controller/update/'.$user['user_id']) : base_url('User/User_controller/store'); ?>" class="space-y-4">
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-2">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo isset($user) ? $user['username'] : ''; ?>" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-customBlue">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-customBlue">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                <input type="password" name="password" id="password" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-customBlue">
            </div>

            <div>
                <label for="role" class="block text-gray-700 font-semibold mb-2">Role:</label>
                <select name="role" id="role"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-customBlue">
                    <option value="admin" <?php echo isset($user) && $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo isset($user) && $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit"
                    class="px-4 py-2 bg-customBlue text-white rounded-lg hover:bg-blue-700 transition">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
