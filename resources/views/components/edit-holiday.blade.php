<x-app-layout>
    <x-slot name="header"></x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <p class="text-2xl font-bold">Edit Holiday</p>
            <a href="/" class="hidden">
                <x-core.icons.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>


        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form action="{{ route('holidays-crud.update', $holidays->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if (session()->has('message'))
                <div class="bg-green-200 border-t-4 border-green-400 rounded-b text-green-500 px-4 py-3 shadow-md flex items-center mb-3"
                    role="alert">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold">{{ session()->get('message') }}</p>
                    </div>
                </div>
            @endif

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-core.input id="name" class="block mt-1 w-full" type="text" name="name"
                    value="{{ $holidays->name }}" required autofocus />
            </div>

            <!-- Hire Date -->
            <div class="mt-4">
                <x-label for="startDate" :value="__('Hire Date')" />
                <div class="datepicker relative form-floating mb-3 xl:w-96">
                    <input datepicker datepicker-format="yyyy/mm/dd" type="date" id="startDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Select date" name="startDate" value="{{ $holidays->startDate }}" required>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="endDate" :value="__('Hire Date')" />
                <div class="datepicker relative form-floating mb-3 xl:w-96">
                    <input datepicker datepicker-format="yyyy/mm/dd" type="date" id="endDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Select date" name="endDate" value="{{ $holidays->endDate }}" required>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-core.button class="ml-4" id="submit" name="button">

                    {{ __('Update') }}

                </x-core.button>
                <x-core.button class="ml-4">
                    <a class=" " href="{{ route('holidays-crud') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-core.button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
