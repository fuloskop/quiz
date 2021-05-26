@extends('layouts')


@section('content')
    <div class="overflow-x-auto">
        <div class="flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-5/6 mb-3">
                <div class="float-right">
                    <a href="{{route('quiz.create')}}">
                        <button class="bg-blue-700 hover text-white m-2 p-2 rounded-lg">Add Quiz</button>
                    </a>

                </div>

                <div class="bg-gray-800 shadow-md rounded my-6">
                    <table class="w-full text-left rounded-lg">
                        <thead>
                        <tr class="bg-gray-700 text-gray-200 border border-b-0">
                            <th class="py-3 px-6 text-left">Kurum</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">FinishTime</th>
                            <th class="py-3 pl-4 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($quizzes as $quiz)


                            <tr class="w-full bg-gray-600 text-gray-200 font-light whitespace-no-wrap border border-b-0">

                                <td class="pl-4 py-4">
                                    {{$quiz->kurum->kurum_adi}}
                                </td>
                                <td class="pl-4 py-4">{!! strlen($quiz->quiz_title)<35 ? $quiz->quiz_title : (substr($quiz->quiz_title, 0, 35)) !!}</td>

                                <td class="text-center">
                                    @if($quiz->quiz_status=='draft')
                                        <span
                                            class="text-sm bg-yellow-500 text-white rounded-full px-2 py-1 ">Taslak</span>
                                    @elseif($quiz->quiz_status=='publish')
                                        <span class="text-sm bg-green-500 text-white rounded-full px-2 py-1 mx-8">Yayında</span>
                                    @elseif($quiz->quiz_status=='passive')
                                        <span class="text-sm bg-red-500 text-white rounded-full px-2 py-1 mx-8">Süresi dolmuş</span>
                                    @endif

                                </td>
                                <td class="text-center">


                                    @isset($quiz->quiz_finished_at)
                                        {{\Carbon\Carbon::parse($quiz->quiz_finished_at)->diffForHumans()}}
                                    @endisset

                                    @empty($quiz->quiz_finished_at)
                                        Süre belirtilmemiş.
                                    @endempty

                                </td>
                                <td class="py-3 pl-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                            <a href="{{ route('quiz.show',['quiz' => $quiz])  }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            </a>
                                        </div>

                                        <div class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                            <a href="{{ route('quiz.edit',['quiz' => $quiz])  }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </a>
                                        </div>
                                        <form method="POST" action="{{route('quiz.destroy',$quiz->id)}}" class="-mt-1">
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
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                </div>
                {{ $quizzes->links() }}
            </div>
        </div>


    </div>

@endsection
