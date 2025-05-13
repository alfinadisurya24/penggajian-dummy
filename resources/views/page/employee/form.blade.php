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
                    <label for="name" class="block mb-2 text-sm font-medium">Nama</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="name" id="name" value="{{ $action == 'update' ? $data->name : old('name') }}">
                </div>
                <div>
                    <label for="nip" class="block mb-2 text-sm font-medium">NIP</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="nip" id="nip" value="{{ $action == 'update' ? $data->nip : old('nip') }}">
                </div>
                <div>
                    <label for="position" class="block mb-2 text-sm font-medium">Jabatan</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="position" id="position" value="{{ $action == 'update' ? $data->position : old('position') }}">
                </div>
                <div>
                    <label for="salary" class="block mb-2 text-sm font-medium">Gaji</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="salary" id="salary" value="{{ $action == 'update' ? $data->salary : old('salary') }}">
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="email" name="email" id="email" value="{{ $action == 'update' ? $data->email : old('email') }}">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium">No Telepon</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="text" name="phone" id="phone" value="{{ $action == 'update' ? $data->phone : old('phone') }}">
                </div>
                <div>
                    <label for="gender" class="block mb-2 text-sm font-medium">Jenis Kelamin</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="gender" id="gender">
                        <option value="laki-laki" {{ ($action == 'update' ? $data->gender == 'laki-laki' : old('gender') == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ ($action == 'update' ? $data->gender == 'perempuan' : old('gender') == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="birth_date" class="block mb-2 text-sm font-medium">Tanggal Lahir</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="date" name="birth_date" id="birth_date" value="{{ $action == 'update' ? $data->birth_date : old('birth_date') }}">
                </div>
                <div class="col-span-2">
                    <label for="address" class="block mb-2 text-sm font-medium">Alamat</label>
                    <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="3" name="address" id="address">{{ $action == 'update' ? $data->address : old('address') }}</textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-40">Submit</button>
            </div>
        </form>
    </div>
    {{-- <div class="rounded d-flex flex-column mb-5">
        <label for="placement" class="form-label">Lokasi Penempatan</label>
        <input type="text" class="form-control" name="placement" id="placement" data-kt-autosize="true" value="{{ $action == 'update' ? $data->placement : old('placement') }}" />
    </div>
    <div class="rounded d-flex flex-column mb-5">
        <label for="type" class="form-label">Tipe Pekerjaan</label>
        <select class="form-control" name="type" id="type" data-kt-autosize="true">
            <option value="" selected disabled>Pilih Tipe Pekerjaan</option>
            @foreach ($constant::CAREER_TYPE_LABELS as $key => $item)
                <option value="{{$key}}" {{ ($action == 'update' ? $data->type == $key : old('type') == $key) ? 'selected' : '' }}>{{$item}}</option>
            @endforeach
        </select>
    </div> --}}
@endsection