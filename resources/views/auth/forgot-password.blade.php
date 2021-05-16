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
<div class="w-full max-w-xs m-auto  bg-indigo-100 rounded p-5" style="background-color : #262d3f">
    <header>
        <img src="https://pazly.dev/logo.png" class="w-20 mx-auto mb-5"
             alt="logo">
    </header>
    <div class="alert-banner mb-6 ">
        <ul class = "list-disc">
            @forelse($errors->all() as $error)
                <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white " title="close" for="banneralert">
                    <li class="ml-6">
                        {{$error}}
                    </li>
                </label>

            @empty

            @endforelse
        </ul>
    </div>
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
            <input class="w-full p-2 mb-6 bg-gray-800 focus:text-indigo-700 text-white border-b-2 border-indigo-500 outline-none focus:bg-gray-300" value="{{ old('email') }}" type="email" name="email" placeholder="Example@web.com">
        </div>
        <div>
            <input class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit">
        </div>
    </form>
</div>

</body>
</html>
