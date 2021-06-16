<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>
    <!-- dragdroptests stop -->


    <title>Hello, world!</title>
</head>
<body class="bg-gray-800">
<nav class="relative select-none bg-blue-900 lg:flex lg:items-stretch w-full">
    <div class="lg:flex lg:items-stretch lg:flex-no-shrink lg:flex-grow">
        <div class="menu lg:flex lg:items-stretch lg:justify-end m-auto">
            @foreach($quiz->questions as $question)
            <a href="#{{$question->id}}" class="menu-btn flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark">Soru {{$loop->iteration}}</a>
            @endforeach
        </div>
    </div>
</nav>
<form method="get" action="{{route('finish',['quizcode'=>$quiz->uniqe_id,'token'=>$token])}}" >
<div class="demo">
    @foreach($quiz->questions as $question)
    <div class=" absolute w-full bg-gray-800 menu-content" id="{{$question->id}}" name="{{$question->id}}" @if(!$loop->first) style="visibility:hidden;" @endif>
        <div id="card" class="">
            <!-- container for all cards -->
            <div class="container  w-100 lg:w-4/5 mx-auto flex flex-col">
                <!-- card -->


                <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden
                                        bg-blue-500 p-2 rounded-t-lg font-medium text-gray-800 mt-4 w-100 mx-2">
                    <h2 class="font-semibold text-lg leading-tight truncate">{{ $question->question_title }}</h2>
                </div>
                <div v-for="card in cards" class="flex flex-col md:flex-row overflow-hidden
                                        bg-blue-300 rounded-b-lg shadow-xl  w-100 mx-2">

                    <!-- media -->
                    @isset($question->image)
                        <div class="h-64 w-auto md:w-1/2 border-r-2 border-b-2 border-blue-500">
                            <img class="inset-0 h-full w-full object-fill object-center " src="{{asset('files/'.$question->image['img'])}}" />
                        </div>
                    @endisset

                    <!-- content -->
                    <div class="w-full  py-4 px-6 text-gray-800 flex flex-col justify-between">
                        <p class="mt-2"><input name="{{$question->id}}" value="1" type="radio" class="form-radio text-gray-600"> {{ $question->chose1 }}</p>
                        <p class="mt-2"><input name="{{$question->id}}" value="2" type="radio" class="form-radio text-gray-600"> {{ $question->chose2 }}</p>
                        <p class="mt-2"><input name="{{$question->id}}" value="3" type="radio" class="form-radio text-gray-600"> {{ $question->chose3 }}</p>
                        <p class="mt-2"><input name="{{$question->id}}" value="4" type="radio" class="form-radio text-gray-600"> {{ $question->chose4 }}</p>
                        </p>
                    </div>
                </div><!--/ card-->
            </div><!--/ flex-->
        </div>
    </div>


    @endforeach
</div>
    <div class="w-full pb-80"></div>
    <button class="bg-blue-700 bg- hover text-white m-2 p-5 static rounded-lg lg:flex lg:items-stretch lg:justify-end m-auto" type="submit">Tamamla</button>
</form>

            @if(isset($quiz->quiz_finished_at))
                <div class="bg-blue-700 hover text-white m-2 p-5 absolute bottom-4 right-4 rounded-lg lg:flex lg:items-stretch lg:justify-end m-auto"><p id="countdown">{{\Carbon\Carbon::parse($quiz->quiz_finished_at)->diffForHumans()}}</p></div>
            @endif

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{$quiz->quiz_finished_at}}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        if(days==0&&hours==0&&minutes==0){
            document.getElementById("countdown").innerHTML = "Last "+ seconds + "s ";
        }else if(days==0&&hours==0){
            document.getElementById("countdown").innerHTML = "Last "+ minutes + "m " + seconds + "s ";
        }else if(days==0){
            document.getElementById("countdown").innerHTML = "Last "+ hours + "h "
                + minutes + "m " + seconds + "s ";
        }else{
            document.getElementById("countdown").innerHTML = "Last "+ days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";
        }

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
    }, 1000);

</script>
<script>
    var $content = $('.menu-content');

    function showContent(selector) {
        $content.css('visibility', 'hidden');
        $(selector).css('visibility', 'visible');
    }

    $('.menu').on('click', '.menu-btn', function(e) {
        showContent(e.currentTarget.hash);
        e.preventDefault();
        console.log('tıklandı');
    });

    // show '#about' content only on page load (if you want)
</script>

</body>

</html>
