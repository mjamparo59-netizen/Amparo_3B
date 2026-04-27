<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Notes App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    /* Prevents the white background when typing */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
        -webkit-text-fill-color: white !important;
        -webkit-box-shadow: 0 0 0px 1000px #4a5568 inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }

    /* Ensures the background stays dark when focused */
    input:focus, textarea:focus {
        background-color: #4a5568 !important;
        color: white !important;
    }
</style>
</head>
<body class="bg-[#1e1e1e] min-h-screen flex justify-center p-4">

    <div class="w-full max-w-md">
        
        <div class="mt-8 mb-8 text-center">
            <h1 class="text-white text-3xl font-bold uppercase tracking-wider">Register</h1>
        </div>

        <div class="bg-[#333b47] p-6 rounded-2xl shadow-xl border border-gray-700/30">
            
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus 
                        placeholder="Full Name"
                        class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        placeholder="Email Address"
                        class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <input type="password" name="password" required 
                        placeholder="Password"
                        class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <div>
                    <input type="password" name="password_confirmation" required 
                        placeholder="Confirm Password"
                        class="w-full bg-[#4a5568] border-none text-white placeholder-gray-400 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>

                <button type="submit" 
                    class="w-full bg-[#2563eb] hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition duration-200 uppercase tracking-wide">
                    Register
                </button>
            </form>

            <div class="mt-6 text-center border-t border-gray-700/30 pt-4">
                <p class="text-sm text-gray-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-semibold">
                        Login here
                    </a>
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-4 p-4 bg-red-900/30 border border-red-500/50 rounded-xl">
                <ul class="text-red-400 text-sm list-none text-center">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</body>
</html>