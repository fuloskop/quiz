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
    <form  method="post" action="{{route('password.update')}}">
        @csrf
        <input name="token" value="{{$token}}" hidden>
        <input name="email" value="{{$email}}" hidden>
        <div>
            <label class="pr-5 mb-2 text-indigo-500" for="password">Password</label><span class="text-sm" id='messagepass'></span>
            <input class="w-full m-1 p-2 mb-6 bg-gray-800 focus:text-indigo-700 text-white border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="password" id="password" name="password" onkeyup='check();'>
        </div>
        <div>
            <label class="block mb-2 text-indigo-500" for="password_confirmation">Password Confirmation</label>
            <input class="w-full m-1 p-2 mb-6 bg-gray-800 focus:text-indigo-700 text-white border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="password" id="password_confirmation" name="password_confirmation" onkeyup='check();'>
        </div>

        <div>
            <input class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit">
        </div>
    </form>
</div>

<script>
    var check = function () {
        if (document.getElementById('password').value ==
            document.getElementById('password_confirmation').value) {
            document.getElementById('messagepass').style.color = 'green';
            document.getElementById('messagepass').innerHTML = '(matching)';
            document.getElementById("submit").disabled = false;
        } else {
            document.getElementById('messagepass').style.color = 'red';
            document.getElementById('messagepass').innerHTML = '(not matching)';
            document.getElementById("submit").disabled = true;
        }
    }
</script>
</body>
</html>
