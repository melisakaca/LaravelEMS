<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>
    <div class="w-full max-w-7xl mx-auto my-10 border-b p-5 bg-white">
        <div class="mb-10 font-bold">Public Holidays</div>
        <div class="grid md:grid-cols-5 gap-x-3 gap-y-5">
            <div class="block">
                <a href="{{ route('holidays') }}" class="px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">
                    {{ __('Add Holidays') }}
                </a>
            </div>
            <div class="block">
                <a href="{{ route('holidays-crud') }}"
                    class="px-3 py-2 hover:bg-gray-700 bg-gray-900 text-white rounded-md">
                    {{ __('View Holidays') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
