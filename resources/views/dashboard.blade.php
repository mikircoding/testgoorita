<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!--logout-->
                    <form method="POST" action="{{ route('logout') }}" class="py-3">
                        @csrf
                        <a :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>

                    <hr />
                    <a href="{{ route('dashboard.create') }}"
                        class="font-medium text-blue-600 dark:text-blue-500 underline">Create</a>
                    <br />


                    <!--table CRUD-->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Short Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Published Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $data)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            <a href="{{ route('dashboard.show', encrypt($data->id)) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                {{ $data->title }}</a>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $data->short_description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $data->published_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('storage/image/' . $data->image) }}" />
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('dashboard.destroy', encrypt($data->id)) }}"
                                                method="POST">
                                                <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    href="{{ route('dashboard.edit', encrypt($data->id)) }}">Edit</a>
                                                |
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    type="submit"
                                                    onclick="return confirm('Apa kamu yakin akan hapus?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <br>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
