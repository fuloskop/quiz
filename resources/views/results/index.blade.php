@extends('layouts')


@section('content')
    <div class="overflow-x-auto">
        <div class="flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">

                <div class="bg-gray-800 shadow-md rounded my-6">
                    <table class="w-full text-left rounded-lg">
                        <thead>
                        <tr class="bg-gray-700 text-gray-200 border border-b-0">
                            <th class="py-3 px-6 text-left">Kurum</th>
                            <th class="py-3 px-6 text-left">FullName</th>
                            <th class="py-3 px-6 text-left">E-mail</th>
                            <th class="py-3 px-6 text-left">Phone</th>
                            <th class="py-3 px-6 text-left">Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($results as $result)

                            <tr class="w-full bg-gray-600 text-gray-200 font-light whitespace-no-wrap border border-b-0">
                                <td class="pl-4 py-4">
                                    {{$result->kurum_id}}
                                </td>


                                <td class="pl-4 py-4">
                                    {{$result->fullname}}
                                </td>
                                <td class="pl-4 py-4">
                                    {{$result->email}}
                                </td>
                                <td class="pl-4 py-4">
                                    {{$result->phone}}
                                </td>

                                <td class="pl-10 py-4">
                                    <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    <a href="{{route('result',$result->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                </div>
                {{ $results->links() }}
            </div>
        </div>


    </div>

@endsection
