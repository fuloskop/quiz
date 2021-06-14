@extends('layouts')


@section('content')
    <div class="overflow-x-auto">
        <div class="flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="float-right">
                    <a href="{{route('invite.create')}}">
                        <button class="bg-blue-700 hover text-white m-2 p-2 rounded-lg">Add Invite</button>
                    </a>

                </div>
                <div class="bg-gray-800 shadow-md rounded my-6">
                    <table class="w-full text-left rounded-lg">
                        <thead>
                        <tr class="bg-gray-700 text-gray-200 border border-b-0">
                            <th class="py-3 px-6 text-left">Kurum</th>
                            <th class="py-3 px-6 text-center">Sahibi</th>
                            <th class="py-3 px-6 text-center">Kullanımlar</th>
                            <th class="py-3 px-6 text-center">Geçerlilik Süresi</th>
                            <th class="py-3 px-6 text-center">Uniqe Davet Kodu</th>
                            <th class="py-3 px-6 text-center">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($Invites as $invite)

                            <tr class="w-full bg-gray-600 text-gray-200 font-light whitespace-no-wrap border border-b-0">
                                <td class="pl-4 text-left py-4">
                                    {{$invite->kurum->kurum_adi}}
                                </td>


                                <td class="pl-4 text-center py-4">
                                    {{$invite->user->name}}
                                </td>
                                <td class="pl-2 text-center py-4">
                                    {{$invite->count}}
                                </td>
                                <td class="pl-2 text-center py-4">
                                    @isset($invite->invite_finished_at)
                                        @if(\Carbon\Carbon::parse($invite->invite_finished_at)->isPast())
                                            Zamanı Doldu. Geçersiz!
                                        @else
                                            {{\Carbon\Carbon::parse($invite->invite_finished_at)->diffForHumans()}}
                                        @endif
                                    @endisset

                                    @empty($invite->invite_finished_at)
                                            ∞
                                    @endempty

                                </td>

                                <td class="pl-4 text-center py-4">
                                    {{$invite->uniqe_id}}
                                </td>

                                <td class="pr-0 text-right py-4">
                                    <div class="flex item-center justify-center">

                                        <form method="POST" action="{{route('invite.destroy',$invite->id)}}" class="-mt-1">
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
                {{ $Invites->links() }}
            </div>
        </div>


    </div>

@endsection
