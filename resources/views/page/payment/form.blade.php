@extends('index')

@section('content')
    <div class="mt-10 mx-10">
        <h3 class="text-2xl font-bold">Tambah Pegawai</h3>
        
        @if ($errors->any())
            <div class="mt-10 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';" aria-label="Close">
                    <svg class="fill-current h-6 w-6 text-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
                </button>
                <h4 class="font-bold text-lg">{{ session('error') }}</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ $urlFormAction }}" method="POST">
            @csrf
            <div class="mt-10 grid grid-cols-2 gap-5 gap-y-5">
                <div>
                    <label for="month" class="block mb-2 text-sm font-medium">Bulan</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="month" id="month" value="{{ $action == 'update' ? $data->month : old('month') }}">
                </div>
                <div>
                    <label for="year" class="block mb-2 text-sm font-medium">Tahun</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="year" id="year" value="{{ $action == 'update' ? $data->year : old('year') }}">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-40">Submit</button>
            </div>
        </form>
    </div>
@endsection