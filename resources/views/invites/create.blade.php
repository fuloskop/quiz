@extends('layouts')


@section('content')

    <div class="w-full px-96 mx-auto  ">
        <form class="bg-gray-800" method="POST" action="{{route('invite.store') }}">
            @csrf
            <div id="title " class="mt-5">
                <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Invite Oluştur</label>
            </div>
            <div class="col-span-6 bg-blue-500  sm:col-span-3 p-2 rounded-b-lg pb-14">
                <div class="col-span-6 m-2 sm:col-span-4">

                    @forelse($errors->all() as $error)
                        <div class="alert-banner  ">
                            <input type="checkbox" class="hidden" id="banneralert">
                            <label class="close rounded-lg cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white" title="close" for="banneralert">
                                {{$error}}
                            </label>
                        </div>
                    @empty
                    @endforelse
                </div>



                <div class="m-2 space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="finish_date" name="finish_date" autocomplete="off" type="checkbox" class="focus:ring-blue-500 bg-gray-800 h-4 w-4 text-blue-600 border-gray-800 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="finish_date" class="font-medium text-gray-800">Bitiş tarihi olacak mı?</label>
                        </div>
                    </div>
                </div>

                <div id="finish_date_div" class="col-span-6 m-2 sm:col-span-4 hidden" >
                    <label for="quiz_description" class="block text-sm font-medium text-gray-800">Bitiş Tarihi :</label>
                    <input type="datetime-local" name="date" id="date"  class=" mt-1 block w-full py-2 px-3 border text-white
                    border-gray-800 rounded-md shadow-sm focus:outline-none
                    focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-800 disabled:opacity-80" hidden disabled>
                </div>
                <div class="float-right">
                    <button class="bg-blue-700 hover text-white m-2 p-2 rounded-lg" type="submit">Add Invite</button>
                </div>

            </div>



        </form>
    </div>

    <script>


        function checkboxStatus() {
            if ($('#finish_date').is(':checked') == true) {
                $('#date').prop( "hidden", false );
                $('#date').prop( "disabled", false );
                $('#finish_date_div').show();
            } else {
                $('#date').prop( "hidden", true );
                $('#date').prop( "disabled", true );
                $('#finish_date_div').hide();
            }
        }

        checkboxStatus();

        // Enable-Disable text input when checkbox is checked or unchecked
        $('#finish_date').change(checkboxStatus);
    </script>
@endsection
