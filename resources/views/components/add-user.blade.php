<x-app-layout>
    <x-slot name="header"></x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <p class="text-2xl font-bold">Add Employee</p>
            <a href="/" class="hidden">
                <x-core.icons.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>


        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('add-user') }}">

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

            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-core.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-core.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />

                <x-core.input id="gender" class="block mt-1 w-full" type="text" name="gender" :value="old('gender')"
                    required />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />

                <x-core.input id="role" class="block mt-1 w-full lowercase" type="text" name="role" :value="old('role')"
                    required />
            </div>

            <!-- Account Status -->
            <div class="mt-4">
                <x-label for="account_status" :value="__('Account Status')" />

                <x-core.input id="account_status" class="block mt-1 w-full" type="number" name="account_status"
                    required />
            </div>

            <!-- Position -->
            <div class="mt-4">
                <x-label for="position" :value="__('Position')" />

                <x-core.input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')"
                    required />
            </div>

            <!-- Hire Date -->
            <div class="mt-4">
                <x-label for="joinDate" :value="__('Hire Date')" />
                <div class="datepicker relative form-floating mb-3 xl:w-96">
                    <input datepicker datepicker-format="yyyy/mm/dd" type="date" id="joinDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Select date" name="joinDate" :value="old('joinDate')" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-core.input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-core.input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-core.button class="ml-4">
                    {{ __('Add Employee') }}
                </x-core.button>
                <x-core.button class="ml-4">
                    <a class=" " href="{{ route('employees') }}">
                        {{ __('Cancel') }}
                    </a>
                </x-core.button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
