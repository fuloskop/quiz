@extends('layouts')


@section('content')

    <div class="w-full px-96 mx-auto  ">
        <form class="bg-gray-800" method="POST" action="{{route('quiz.update',$quiz) }}">
            @csrf
            @method('PUT')
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

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="quiz_title" class="block text-sm font-medium text-gray-800">Quiz Başlığı :</label>
                    <input type="text" name="quiz_title" id="quiz_title" value="{{old('quiz_title') ?? $quiz->quiz_title }}"
                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="quiz_description" class="block text-sm font-medium text-gray-800">Quiz Açıklaması
                        :</label>
                    <textarea type="text" name="quiz_description" id="quiz_description"
                              class="mt-1 block w-full pt-2 pb-10 px-3 border border-gray-800 text-white bg-gray-800 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $quiz->quiz_description }}</textarea>
                </div>

                <div class="col-span-6 mx-2 mb-4 mt-4 sm:col-span-4">
                    <label for="quiz_status" class="block text-sm font-medium text-gray-800">Şuanki Quiz Durumu:
                        @if($quiz->quiz_status=='draft')
                            <span class="text-sm bg-yellow-500 text-white rounded-full px-2 py-1 m-2">Taslak</span>
                        @elseif($quiz->quiz_status=='publish')
                            <span class="text-sm bg-green-500 text-white rounded-full px-2 py-1 m-2">Yayında</span>
                        @elseif($quiz->quiz_status=='passive')
                            <span class="text-sm bg-red-500 text-white rounded-full px-2 py-1 m-2">Süresi dolmuş</span>
                        @endif
                    </label>

                </div>

                <div class="col-span-6 m-2 sm:col-span-4">
                    <label for="quiz_status" class="block mb-2 text-sm font-medium text-gray-800">Quiz Durumu Değiştir :</label>
                    <select id="quiz_status" name="quiz_status"
                            class="block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @if($quiz->quiz_status=='draft')
                        <option value="draft" selected>Taslak</option>
                            <option value="publish">Yayında</option>
                            <option value="passive">Süresi dolmuş</option>
                        @elseif($quiz->quiz_status=='publish')
                            <option value="draft">Taslak</option>
                        <option value="publish" selected>Yayında</option>
                            <option value="passive">Süresi dolmuş</option>
                        @elseif($quiz->quiz_status=='passive')
                            <option value="draft">Taslak</option>
                            <option value="publish">Yayında</option>
                        <option value="passive" selected>Süresi dolmuş</option>
                        @endif
                    </select>
                </div>

                <div class="m-2 space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="finish_date" name="finish_date" autocomplete="off" type="checkbox"
                                   @if($quiz->quiz_finished_at!=null)
                                   checked
                                   @endif
                                   class="focus:ring-blue-500 bg-gray-800 h-4 w-4 text-blue-600 border-gray-800 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="finish_date" class="font-medium text-gray-800">Bitiş tarihi olacak mı?</label>
                        </div>
                    </div>
                </div>

                <div id="finish_date_div" class="col-span-6 m-2 sm:col-span-4 hidden">
                    <label for="date" class="block text-sm font-medium text-gra y-800">Bitiş Tarihi :</label>
                    <input type="datetime-local" name="date" id="date" class=" mt-1 block  w-full py-2 px-3 border text-white
                    border-gray-800 rounded-md shadow-sm focus:outline-none
                    focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-800 disabled:opacity-80"
                           value="{{ date('Y-m-d\TH:i', strtotime($quiz->quiz_finished_at)) }}" hidden disabled>
                </div>
                <div class="float-right">
                    <button class="bg-blue-700 hover text-white m-2 p-2 rounded-lg" type="submit">Sınav Güncelle</button>
                </div>

            </div>


        </form>
    </div>

    <script>


        function checkboxStatus() {
            if ($('#finish_date').is(':checked') == true) {
                $('#date').prop("hidden", false);
                $('#date').prop("disabled", false);
                $('#finish_date_div').show();
            } else {
                $('#date').prop("hidden", true);
                $('#date').prop("disabled", true);
                $('#finish_date_div').hide();
            }
        }

        checkboxStatus();

        // Enable-Disable text input when checkbox is checked or unchecked
        $('#finish_date').change(checkboxStatus);
    </script>
@endsection

