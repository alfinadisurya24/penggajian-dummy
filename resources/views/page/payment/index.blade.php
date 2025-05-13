@extends('index')

@section('content')
    <div class="mt-10 mx-10">
        @if(session('message') && session('alert-type'))
            @php
                $alertType = session('alert-type');
                $alertColors = [
                    'success' => 'bg-green-100 border-green-400 text-green-700',
                    'error' => 'bg-red-100 border-red-400 text-red-700',
                    'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
                    'info' => 'bg-blue-100 border-blue-400 text-blue-700',
                ];
                $alertClass = $alertColors[$alertType] ?? $alertColors['info'];
            @endphp
            <div class="border px-4 py-3 rounded relative mb-4 {{ $alertClass }}" role="alert">
                <strong class="font-bold capitalize">{{ $alertType }}! </strong>
                <span class="block sm:inline">{{ session('message') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';" aria-label="Close">
                    <svg class="fill-current h-6 w-6 text-current" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/></svg>
                </button>
            </div>
        @endif
        <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded" href="{{ route('payment.create') }}">Tarik Penggajian</a>
        <table class="min-w-full divide-y divide-gray-300 my-10">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        NIP
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jabatan
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gaji
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Bulan
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tahun
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Cetak PDF
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->nip }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->position }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->salary }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->month }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $item->year }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('pdf-penggajian', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Cetak Penggajian</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                Tidak ada data
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-4">
            {{ $data->links('components.pagination') }}
        </div>
    </div>
@endsection