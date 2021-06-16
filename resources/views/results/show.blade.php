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

            <div class="box bg-blue-300 m-4 pb-2"  >
                <label class=" text-lg font-medium text-gray-800">
                Öğrenci bilgileri:
                </label>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label class=" text-lg font-medium text-gray-800">Öğrenci ismi
                        : {{ $result->fullname }}</label>
                </div>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label class=" text-lg font-medium text-gray-800">Öğrenci telefon
                        : {{ $result->phone }}</label>
                </div>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label class=" text-lg font-medium text-gray-800">Öğrenci E-mail
                        : {{ $result->email }}</label>

                </div>
            </div>

                <div class="box bg-blue-300 m-4 pb-2"  >
                    <label class=" text-lg font-medium text-gray-800">
                        Öğrenci Sınav Sonucu:
                    </label>
                    <div class="col-span-6 m-2 sm:col-span-4">
                        <label class=" text-lg font-medium text-gray-800">Doğru cevap
                            : {{ $correct }}/{{ $totalquestions }}</label>
                    </div>
                        <div class="col-span-6 m-2 sm:col-span-4">
                        <label class=" text-lg font-medium text-gray-800">Yanlış cevap
                            : {{ $totalquestions-$correct }}/{{ $totalquestions }}</label>
                        </div>
                            <div class="col-span-6 m-2 sm:col-span-4">
                        <label class=" text-lg font-medium text-gray-800">Aldığı puan
                            : {{ number_format($finalescore, 1) }}</label>


                    </div>


                </div>

            <div class="box bg-blue-300 m-4 pb-2"  >
                <div class="col-span-6 m-2 sm:col-span-4 pt-2">
                    <label class=" text-lg font-medium text-gray-800">
                    @foreach($questions as $question)
                            <div class="bg-blue-600 m-2 p-2"  >
                                {{$question->question_title}}
                                <div class="col-span-6 m-4 sm:col-span-4 @if($question->answer==1) bg-blue-500 @endif ">
                                    <label id="1" class="block text-lg font-medium text-gray-800 ">
                                        <input name="{{$question->id}}" type="radio" class="form-radio text-gray-600"
                                               @if(isset($answers[0][$question->id])&&$answers[0][$question->id]==1)
                                                        checked
                                                    @endif
                                         disabled>
                                        Cevap 1 :
                                        {{$question->chose1}}</label>
                                </div>
                                <div class="col-span-6 m-4 sm:col-span-4  @if($question->answer==2) bg-blue-500 @endif">

                                    <label id="2" class="block text-lg font-medium text-gray-800">
                                        <input name="{{$question->id}}" type="radio" class="form-radio text-gray-600"   @if(isset($answers[0][$question->id])&&$answers[0][$question->id]==2)
                                        checked
                                               @endif  disabled>
                                        Cevap 2 :

                                        {{$question->chose2}}</label>
                                </div>
                                <div class="col-span-6 m-4 sm:col-span-4  @if($question->answer==3) bg-blue-500 @endif">
                                    <label id="3" class="block text-lg font-medium text-gray-800">
                                        <input name="{{$question->id}}" type="radio" class="form-radio text-gray-600" @if(isset($answers[0][$question->id])&&$answers[0][$question->id]==3)
                                        checked
                                               @endif disabled>
                                        Cevap 3 :

                                        {{$question->chose3}}</label>
                                </div>
                                <div class="col-span-6 m-4  sm:col-span-4  @if($question->answer==4) bg-blue-500 @endif">
                                    <label id="4" class="block text-lg font-medium text-gray-800">
                                        <input name="{{$question->id}}" type="radio" class="form-radio text-gray-600" @if(isset($answers[0][$question->id])&&$answers[0][$question->id]==4)
                                        checked
                                               @endif   disabled>
                                        Cevap 4 :

                                        {{$question->chose4}}</label>
                                </div>
                            </div>



                    @endforeach

                    </label>


                </div>


            </div>



        </div>


    </div>
@endsection

