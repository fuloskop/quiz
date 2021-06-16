@extends('layouts')


@section('content')

    <div class="w-full px-96 mx-auto  ">
        <form class="bg-gray-800" action="{{route('question.store',$quiz) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="title " class="mt-5">
                <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Quiz
                    Oluştur</label>
            </div>
            <div class="col-span-6 bg-blue-500  sm:col-span-3 p-2 rounded-b-lg pb-14">
                <div class="col-span-6 m-2 sm:col-span-4">

                    @forelse($errors->all() as $error)
                        <div class="alert-banner  ">
                            <input type="checkbox" class="hidden" id="banneralert">
                            <label
                                class="close rounded-lg cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white"
                                title="close" for="banneralert">
                                {{$error}}
                            </label>
                        </div>
                    @empty
                    @endforelse
                </div>

                <div class="col-span-6 ml-2 my-4 sm:col-span-4">
                    <label for="quiz_title" class=" text-sm font-medium text-gray-800">Quiz Başlığı :</label>
                    <label
                        class="mt-1 w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{$quiz->quiz_title}}</label>
                </div>

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="file" class="block text-sm font-medium text-gray-800">Soruya ait dosyalar :</label>

                        <input type="file" id="imgInp" name="file">
                        <img id="blah" src="#" alt="your image" />
                    </div>

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="question" class="block text-sm font-medium text-gray-800">Eklenecek soru
                        :</label>
                    <textarea type="text" name="question_title" id="question_title"
                              class="mt-1 block  w-11/12  pt-2 pb-10 px-3 border border-gray-800 text-white bg-gray-800 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="chose1" class="block text-sm font-medium text-gray-800">Seçenek 1 :</label>
                    <label class="inline-flex items-center mt-3">
                        <input name="answer" value="1" type="radio" class="form-radio text-gray-600">
                    </label>
                    <input type="text" name="chose1" id="chose1"
                           class="mt-1 w-11/12 py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="chose2" class="block text-sm font-medium text-gray-800">Seçenek 2 :</label>
                    <label class="inline-flex items-center mt-3">
                        <input name="answer" value="2" type="radio" class="form-radio text-gray-600">
                    </label>
                    <input type="text" name="chose2" id="chose2"
                           class="mt-1 w-11/12 py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="chose3" class="block text-sm font-medium text-gray-800">Seçenek 3 :</label>
                    <label class="inline-flex items-center mt-3">
                        <input name="answer" value="3" type="radio" class="form-radio text-gray-600">
                    </label>
                    <input type="text" name="chose3" id="chose3"
                           class="mt-1 w-11/12 py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="chose4" class="block text-sm font-medium text-gray-800">Seçenek 4 :</label>
                    <label class="inline-flex items-center mt-3">
                        <input name="answer" value="4" type="radio" class="form-radio text-gray-600">
                    </label>
                    <input type="text" name="chose4" id="chose4"
                           class="mt-1 w-11/12 py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>


                <div class="float-right">
                    <button class="bg-blue-700 hover text-white m-2 p-2 rounded-lg" type="submit">Soru Ekle</button>
                </div>

            </div>


        </form>
    </div>

    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

@endsection
