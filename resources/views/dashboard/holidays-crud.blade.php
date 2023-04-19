<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' NMC Holidays') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto min-h-screen w-full py-6">
        <div class="bg-white flex lg:justify-center py-10 overflow-auto">
            <table>
                <tr class="font-bold">
                    <td>Name</td>
                    <td>Start Date </td>
                    <td>End Date </td>
                    <td>Edit </td>
                    <td>
                        @if (request()->has('trashed'))
                            Restore
                        @else
                            Remove
                        @endif
                    </td>
                </tr>
                @foreach ($holidays as $holiday)
                    <tr>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ $holiday->startDate }}</td>
                        <td>{{ $holiday->endDate }}</td>
                        <td>
                            <a href="{{ route('edit-holiday', $holiday->id) }}">
                                <button
                                    class="py-2 px-4 w-full flex justify-center hover:bg-gray-500 hover:text-white rounded text-gray-500">
                                    <x-core.icons.edit-user />
                                </button>
                            </a>
                        </td>
                        <td>
                            @if (request()->has('trashed'))
                                <a href="{{ route('holidays-crud.restore', $holiday->id) }}"
                                    class="text-green-400 w-full hover:bg-green-500 hover:text-white px-4 py-2 rounded-md">Restore</a>
                            @else
                                <form method="POST" action="{{ route('holidays-crud.destroy', $holiday->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit"
                                        class="px-4 py-2 w-full  hover:text-white hover:bg-red-500 rounded text-red-500">
                                        <x-core.icons.trash />
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="bg-white flex flex-wrap gap-4 justify-center py-10">
            <div class="block">
                <a href="{{ route('holidays') }}"
                    class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">
                    {{ __('Add Holidays') }}
                </a>
            </div>
            @if (request()->has('trashed'))
                <div>
                    <a href="{{ route('holidays-crud.index') }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">View All
                        Holidays</a>
                    <a href="{{ route('holidays-crud.restoreAll') }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">Restore All</a>
                </div>
            @else
                <div class="block">
                    <a href="{{ route('holidays-crud.index', ['trashed' => 'holiday']) }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">View Deleted
                        Holidays</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
