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
                    <label for="quiz_description" class="block text-lg font-medium text-gray-800">Quiz Uniq Id :

                        {{ $quiz->uniqe_id }}</label>
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
                       href="{{route('quiz.edit', $quiz)}}">Sınav Düzenle</a>
                    <a class="bg-blue-700 hover text-white m-2 p-2 rounded-lg"
                       href="{{route('question.index', $quiz)}}">Soru Düzenle</a>
                </div>

                <div class="col-span-6 mx-2 mb-4 mt-4 sm:col-span-4">
                    <div class="flex items-start">
                        <div class="text-lg">
                                <label for="finish_date" class="font-medium text-gray-800">Toplam soru sayısı:  {{count($quiz->questions)}}  </label>
                        </div>
                    </div>
                </div>




                @foreach($quiz->questions as $question)
                    <div class="box bg-blue-300 m-4 pb-2"  name="{{$question->id}}">
                        <div class="col-span-6 m-2 sm:col-span-4">
                            <label class=" text-lg font-medium text-gray-800">Soru
                                : {{ $question->question_title }}</label>


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


    </div>
@endsection

