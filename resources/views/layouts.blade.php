<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Drag and drop js
    <script src="{{asset('js/dnd.js')}}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script> -->

    <!-- dragdroptests start -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>
    <script src="{{ asset('js/jquery.dad.min.js') }}"></script>

    <!-- dragdroptests stop -->




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
    <title>Quiz</title>
</head>
<body class="bg-gray-800">

<nav class="text-gray-100 bg-gray-900 body-font shadow w-full">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a
            class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center lg:items-center lg:justify-center mb-4 md:mb-0">
            <img src="https://pazly.dev/logo.png" style="height: 40px; margin-top: 10px; margin-bottom: 10px;"
                 alt="logo">

            <span class="ml-3 text-xl">Quizest</span>
        </a>
        <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
            <a
              href="{{route('quiz.index')}}"  class="mr-5 hover:text-blue-500 cursor-pointer border-b border-transparent hover:border-blue-600">Quizzes</a>
            <a href="{{route('check_quiz')}}" class="mr-5 hover:text-blue-500 cursor-pointer border-b border-transparent hover:border-blue-600">Sınava Gir</a>
            <a  href="{{route('results')}}" class="mr-5 hover:text-blue-500 cursor-pointer border-b border-transparent hover:border-blue-600">Sonuçlar</a>
            <a
                class="mr-5 hover:text-blue-500 cursor-pointer border-b border-transparent hover:border-blue-600">Contact</a>
            <a href="{{route('invite.index')}}"
                class="mr-5 hover:text-blue-500 cursor-pointer border-b border-transparent hover:border-blue-600">Davetler</a>


        </nav>


        <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            @guest
                <a href="{{route('login')}}"
                   class="bg-blue-700 hover:bg-blue-500 text-white ml-4 py-2 px-3 rounded-lg">
                    Login
                </a>
                <a href="{{route('register')}}"
                   class="bg-blue-700 hover:bg-blue-500 text-white ml-4 py-2 px-3 rounded-lg">
                    Register
                </a>
            @endguest
            @auth

                <div class="flex justify-center">
                    <!-- Dropdown -->
                    <div class="relative">
                        <button class="bg-blue-700 hover text-white mr-4 py-2 px-3 rounded-lg"
                                 id="profiledropbtn" >
                            Merhaba {{Auth::user()->username}}
                        </button>
                        <!-- Dropdown Body -->
                        <div class="absolute right-0 w-40 mt-2 py-2 bg-white border rounded shadow-xl hidden"
                             id="profiledrop">
                            <a href="{{route('profile')}}"
                               class="transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-purple-500 hover:text-white">Settings</a>
                            <div class="py-2">
                                <hr></hr>
                            </div>
                            <a href="{{route('logout')}}"
                               class="transition-colors duration-200 block px-4 py-2 text-normal text-gray-900 rounded hover:bg-purple-500 hover:text-white">
                                Logout
                            </a>
                        </div>
                        <!-- // Dropdown Body -->
                    </div>
                    <!-- // Dropdown -->
                </div>


            @endauth
        </div>
    </div>
</nav>


    @yield('content')


<div class="grid fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
    <!-- Danger -->

    <div id="errordiv" class='inline-flex items-center text-white max-w-sm w-full bg-red-400 shadow-md rounded-lg overflow-hidden mx-auto' style="display:none">
        <div class='w-10 border-r px-2'>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                </path>
            </svg>
        </div>

        <div class='flex-1 items-center px-2 py-3'>


            <div class='mx-3'>
                <p id="error_msg" >{!! \Session::get('error')!!}</p>
            </div>
        </div>
    </div>

        <!-- succes -->
    <div id="successdiv"  class='inline-flex items-center text-white max-w-sm w-full bg-green-400 shadow-md rounded-lg overflow-hidden mx-auto' style="display:none">
        <div class=' w-10 border-r px-2'>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                </path>
            </svg>
        </div>

        <div class='flex-1 items-center px-2 py-3'>
            <div class='mx-3'>
                <p id="success_msg">{!! \Session::get('success') !!}</p>
            </div>
        </div>
    </div>


</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script>
    $("#profiledropbtn").click(function(e){
        $("#profiledrop").toggle();
        e.stopPropagation();
    });

    $("#profiledrop").click(function(e){
        e.stopPropagation();
    });

    $(document).click(function(){
        $("#profiledrop").hide();
    });
</script>

<script>
    @if(Session::has('success'))
    $('#successdiv').fadeIn().delay(3000).fadeOut();
        @elseif(Session::has('error'))
        $('#errordiv').fadeIn().delay(3000).fadeOut();
        @endif

</script>


</body>
</html>
