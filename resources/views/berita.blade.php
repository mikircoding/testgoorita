<x-app-layout>
    <div class="mt-6 bg-gray-50">
        <div class=" px-10 py-2 mx-auto">
            <h2 class="text-2xl mt-4 text-gray-600 font-bold text-center">Semua Berita</h2>
            <div class=" h-full grid-cols-12 gap-10 pb-10 mt-8 sm:mt-16">
                <div class="grid grid-cols-12 col-span-12 gap-7">
                    @foreach ($berita_public as $berita)
                        <div
                            class="flex flex-col items-start col-span-12 overflow-hidden rounded-xl md:col-span-6 lg:col-span-4">
                            <a href="{{ route('berita.detail', encrypt($berita->id)) }}"
                                class="block transition duration-200 ease-out transform hover:scale-110">
                                <img class="object-cover w-full shadow-sm h-full"
                                    src="{{ asset('storage/image/' . $berita->image) }}" />

                            </a>
                            <div
                                class="relative flex flex-col items-start px-6 bg-white border border-t-0 border-gray-200 py-7 rounded-b-2xl">
                                <div
                                    class="bg-indigo-400 absolute top-0 -mt-3  items-center px-3 py-1.5 leading-none w-auto  rounded-full text-xs font-medium uppercase text-white inline-block">
                                    <span>{{ $berita->published_date }}</span>
                                </div>
                                <h2
                                    class="text-base text-gray-600 font-bold sm:text-lg md:text-xl py-3 hover:underline">
                                    <a
                                        href="{{ route('berita.detail', encrypt($berita->id)) }}">{{ $berita->title }}</a>
                                </h2>
                                <h2 class="text-base text-gray-500 font-medium">
                                    {{ $berita->short_description }}
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $berita_public->links('pagination::simple-tailwind') }}
        </div>
    </div>
</x-app-layout>
