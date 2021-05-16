<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tailwind CSS Login Form</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
</head>
<body class="flex h-screen bg-indigo-700">
<div class="w-full max-w-xs m-auto  bg-indigo-100 rounded p-5">
    <header>
        <img src="https://pazly.dev/logo.png" class="w-20 mx-auto mb-5"
             alt="logo">
    </header>
    @forelse($errors->all() as $error)
        <div class="alert-banner mb-6 ">
            <input type="checkbox" class="hidden" id="banneralert">
            <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white" title="close" for="banneralert">
                {{$error}}
            </label>
        </div>
    @empty
    @endforelse
    @if (session('success'))
        <div class="alert-banner mb-6 ">
            <input type="checkbox" class="hidden" id="banneralert">
            <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-green-500 shadow text-white" title="close" for="banneralert">
                {{session('success')}}
            </label>
        </div>
    @endif
    <form  method="post" action="{{route('password.email')}}">
        @csrf
        <div>
            <label class="block mb-2 text-indigo-500" for="email">E-Mail :</label>
            <input class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="email" name="email" placeholder="Example@web.com">
        </div>
        <div>
            <input class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit">
        </div>
    </form>
</div>

</body>
</html>
