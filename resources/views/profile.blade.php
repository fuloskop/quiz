@extends('layouts')


@section('content')
    <div class="overflow-x-auto">
        <div class="flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-5/6 mb-3">
                <div id="title" class="mt-5">
                    <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Profil İşlemleri</label>
                </div>

                <div class="col-span-6 bg-blue-500  sm:col-span-3 p-2 rounded-b-lg pb-14">
                    <div class="alert-banner mb-6 ">
                        <ul class = "list-disc">
                            @forelse($errors->all() as $error)
                                <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white " title="close" for="banneralert">
                                    <li class="ml-6">
                                        {{$error}}
                                    </li>
                                </label>

                            @empty

                            @endforelse
                        </ul>
                    </div>
                    <div class="w-full lg:w-full mb-3">
                        <div id="title" class="mt-5">
                            <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Şifre değiştirme</label>
                        </div>
                        <div class="col-span-6 bg-blue-400  sm:col-span-3 p-2 rounded-b-lg pb-14">


                            <form method="post" action="{{route('profile.passchange')}}">
                                @csrf
                                <div class="col-span-6 m-2 sm:col-span-4">
                                    <label for="old_pass" class="block text-sm font-medium text-gray-800">Eski Şifre :</label>
                                    <input type="password" name="old_pass" id="old_pass"
                                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 m-2 sm:col-span-4">
                                    <label for="password" class="block text-sm font-medium text-gray-800">Yeni Şifre :</label>
                                    <input type="password" name="password" id="password"
                                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 m-2 sm:col-span-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-800">Yeni Şifre Tekrar :</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <input class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 mb-6 rounded float-right" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full lg:w-full mb-3">
                        <div id="title" class="mt-5">
                            <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Mail değiştirme</label>
                        </div>
                        <div class="col-span-6 bg-blue-400  sm:col-span-3 p-2 rounded-b-lg pb-14">
                            <label class="block text-sm font-medium text-gray-800">Kullanıcının Kayıtlı E-Maili : {{ \Illuminate\Support\Facades\Auth::user()->email }}</label>
                            <form method="post" action="{{route('profile.mailchange')}}">
                                @csrf
                                <div class="col-span-6 m-2 sm:col-span-4">
                                    <label for="password" class="block text-sm font-medium text-gray-800">Şifre :</label>
                                    <input type="password" name="password" id="password"
                                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="col-span-6 m-2 sm:col-span-4">
                                    <label for="new_email" class="block text-sm font-medium text-gray-800">Yeni Mail :</label>
                                    <input type="text" name="new_email" id="new_email"
                                           class="mt-1 block w-full py-2 px-3 border border-gray-800 text-white bg-gray-800 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <input class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 mb-6 rounded float-right" type="submit">
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="w-full lg:w-full mb-3">
                        <div id="title" class="mt-5">
                            <label for="country" class="block bg-blue-600 p-2 rounded-t-lg font-medium text-gray-800">Kullanıcı adıdeğiştirme</label>
                        </div>
                        <div class="col-span-6 bg-blue-400  sm:col-span-3 p-2 rounded-b-lg pb-14">


                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

@endsection
