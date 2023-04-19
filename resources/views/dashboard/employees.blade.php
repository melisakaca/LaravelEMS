<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' NMC Employees') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto min-h-screen w-full py-6">
        <div class="bg-white flex lg:justify-center py-10 overflow-auto">
            <table>
                <tr class="font-bold">
                    <td>Name</td>
                    <td>Email </td>
                    <td>Role </td>
                    <td>Account Status </td>
                    <td>Position </td>
                    <td>Hire date </td>
                    <td>Edit </td>
                    <td>
                        @if (request()->has('trashed'))
                            Restore
                        @else
                            Remove
                        @endif
                    </td>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if ($user->account_status == 1)
                                active
                            @else
                                inactive
                            @endif
                        </td>
                        <td>{{ $user->position }}</td>
                        <td>{{ $user->joinDate }}</td>
                        <td>
                            <a href="{{ route('edit-user', $user->id) }}">
                                <button class="py-2 px-4 w-full flex justify-center hover:bg-gray-500 hover:text-white rounded text-gray-500">
                                    <x-core.icons.edit-user />
                                </button>
                            </a>
                        </td>
                        <td>
                            @if (request()->has('trashed'))
                                <a href="{{ route('employees.restore', $user->id) }}"
                                    class="text-green-400 w-full hover:bg-green-500 hover:text-white px-4 py-2 rounded-md">Restore</a>
                            @else
                                <form method="POST" action="{{ route('employees.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit"
                                        class="px-4 py-2 w-full  hover:text-white hover:bg-red-500 rounded text-red-500">
                                        <x-core.icons.remove-user />
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
                <a href="{{ route('add-user') }}"
                    class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">
                    {{ __('Add Employees') }}
                </a>
            </div>
            @if (request()->has('trashed'))
                <div>
                    <a href="{{ route('employees.index') }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">View All
                        Employees</a>
                    <a href="{{ route('employees.restoreAll') }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">Restore All</a>
                </div>
            @else
                <div class="block">
                    <a href="{{ route('employees.index', ['trashed' => 'users']) }}"
                        class="ml-3 px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">View Deleted
                        Employees</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
