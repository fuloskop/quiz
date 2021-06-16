@extends('layouts')


@section('content')

    <div class="w-full px-96 mx-auto  ">
        <div id="title " class="mt-5">
            <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Quiz
                İncele</label>
        </div>
        <div class="col-span-6 bg-blue-500  sm:col-span-3 p-2 rounded-b-lg pb-14">
            <div class="col-span-6 m-2 sm:col-span-4">
                <label for="quiz_title" class="block text-lg font-medium text-gray-800">Quiz Kurumu : {{$quiz->kurum->kurum_adi}}</label>
            </div>

            <div class="col-span-6 m-2 sm:col-span-4">
                <label for="quiz_title" class="block text-lg font-medium text-gray-800">Quiz Başlığı : {{ $quiz->quiz_title }}</label>

            </div>

            <div class="col-span-6 m-2 sm:col-span-4">
                <label for="quiz_description" class="block text-lg font-medium text-gray-800">Quiz Açıklaması :

                    {{ $quiz->quiz_description }}</label>
            </div>

            <div class="col-span-6 mx-2 mb-4 mt-4 sm:col-span-4">
                <label for="quiz_status" class="block text-lg font-medium text-gray-800">Şuanki Quiz Durumu:
                    @if($quiz->quiz_status=='draft')
                        <span class="text-lg bg-yellow-500 text-white rounded-full px-3 py-1 m-2">Taslak</span>
                    @elseif($quiz->quiz_status=='publish')
                        <span class="text-lg bg-green-500 text-white rounded-full px-3 py-1 m-2">Yayında</span>
                    @elseif($quiz->quiz_status=='passive')
                        <span class="text-lg bg-red-500 text-white rounded-full px-3 py-1 m-2">Süresi dolmuş</span>
                    @endif
                </label>

            </div>


            <div class="col-span-6 mx-2 mb-4 mt-4 sm:col-span-4">
                <div class="flex items-start">
                    <div class="text-lg">
                        @if($quiz->quiz_finished_at==null)
                            <label for="finish_date" class="font-medium text-gray-800">Bitiş tarihi yok.</label>
                        @else
                            <label for="finish_date" class="font-medium text-gray-800">Bitiş tarihi : {{$quiz->quiz_finished_at}}</label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="float-right">
                <a class="bg-blue-700 hover text-white m-2 p-2 rounded-lg"
                   href="{{route('quiz.edit', $quiz)}}">Sınavı Düzenle</a>
            </div>
            <div class="col-span-6 mx-2 mb-4 mt-4 sm:col-span-4">
                <div class="flex items-start">
                    <div class="text-lg">
                        <label for="finish_date" class="font-medium text-gray-800">Toplam soru sayısı:  {{count($quiz->questions)}}</label>
                    </div>
                </div>
            </div>
            <div class="containerx col-span-6 mx-2 mb-4 mt-4 pb-10 sm:col-span-4 border border-black">
                <div class="">
                    <div class="text-lg">
                        <label for="finish_date" class="font-medium text-gray-800">Sorular:</label>
                    </div>
                </div>
                <div class="demo">
                    @foreach($quiz->questions as $question)
                        <div class="box bg-blue-300 m-4 pb-2" data-question-id="{{$question->id}}" name="{{$question->id}}">
                            <div class="col-span-6 m-2 sm:col-span-4">
                                <label class=" text-lg font-medium text-gray-800">Soru
                                    : {{ $question->question_title }}</label>
                                <div class="w-4 mr-2 m-2 transform hover:text-blue-500 hover:scale-110 float-right"><!-- silme tuşu   -->
                                    <form method="POST" action="{{ route('question.destroy',['quiz' => $quiz,'question' => $question])  }}" class="-mt-1">
                                        <button type="submit">
                                            <div class="w-4 transform hover:text-blue-500 hover:scale-110">
                                                @csrf
                                                @method('DELETE')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div class="w-4 mr-2 m-2 transform hover:text-blue-500 hover:scale-110 float-right">
                                    <a href="{{ route('question.edit',['quiz' => $quiz,'question' => $question])  }}"><!-- edit tuşu   -->

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>

                                    </a>
                                </div>
                            </div>


                            <div class="col-span-6 m-4 sm:col-span-4 @if($question->answer==1) bg-blue-500 @endif">
                                <label id="1" class="block text-lg font-medium text-gray-800 ">Cevap 1 :

                                    {{$question->chose1}}</label>
                            </div>
                            <div class="col-span-6 m-4 sm:col-span-4  @if($question->answer==2) bg-blue-500 @endif">
                                <label id="2" class="block text-lg font-medium text-gray-800">Cevap 2 :

                                    {{$question->chose2}}</label>
                            </div>
                            <div class="col-span-6 m-4 sm:col-span-4  @if($question->answer==3) bg-blue-500 @endif">
                                <label id="3" class="block text-lg font-medium text-gray-800">Cevap 3 :

                                    {{$question->chose3}}</label>
                            </div>
                            <div class="col-span-6 m-4  sm:col-span-4  @if($question->answer==4) bg-blue-500 @endif">
                                <label id="4" class="block text-lg font-medium text-gray-800">Cevap 4 :

                                    {{$question->chose4}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="float-right">
                    <a class="bg-blue-700 hover text-white m-2 p-2 rounded-lg"
                       href="{{route('question.create', $quiz)}}">Soru Ekle</a>
                </div>
            </div>

        </div>


        <script>
            $('.demo').dad();

            $(".demo").on("dadDrop", function (e, droppedElement) {
                items = $('.box')
                var names = [];

                items.each(function(i){
                    names[i] = $(this).data('questionId')
                });

                $.ajax({
                    type: "GET",
                    url: "/change-question-order",
                    data: {names},
                    cache: false,

                    success: function(data,response,jqxhr){
                        console.log(response)
                        $("#successdiv").show('slow').delay(3000).fadeOut();
                        $('#success_msg').text('Sıralama başarı ile güncellendi');
                    }
                });
            })



        </script>

    </div>


@endsection

