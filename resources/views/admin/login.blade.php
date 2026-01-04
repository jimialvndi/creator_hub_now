<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - UNTAN Creator Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E5BFF',
                        accent: '#FFF200',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-primary min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-primary mb-2">Admin Login</h1>
                <p class="text-gray-600">UNTAN Creator Hub</p>
            </div>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <p>{{ $errors->first() }}</p>
            </div>
            @endif

            <form action="{{ route('admin.authenticate') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none transition"
                        required
                    >
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-primary focus:outline-none transition"
                        required
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition"
                >
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-primary hover:text-blue-700 font-semibold">
                    ← Back to Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>
