<x-app-layout>
    <div class="mt-6 bg-gray-50">
        <div class=" px-10 py-6 mx-auto">
            <div class="max-w-6xl px-10 py-6 mx-auto bg-gray-50">
                <a href="#_" class="block transition duration-200 ease-out transform hover:scale-110">
                    <img class="object-cover w-full shadow-sm h-full"
                        src="{{ asset('storage/image/' . $berita->image) }}" />

                </a>
                <br />
                <div class="flex items-center justify-start mt-4 mb-4">
                    <a href="#" class="px-2 py-1 font-bold bg-red-400 text-white rounded-lg hover:bg-gray-500 mr-4">
                        {{ $berita->published_date }}
                    </a>

                </div>
                <div class="mt-2 ">
                    <a href="#"
                        class="sm:text-3xl md:text-3xl lg:text-3xl xl:text-4xl font-bold text-gray-600  hover:underline">
                        {{ $berita->title }}</a>
                </div>
                <div class="max-w-4xl px-10  mx-auto text-2xl text-gray-700 mt-4 rounded bg-gray-100">
                    <div>
                        <p class="mt-2 p-8">{{ $berita->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
