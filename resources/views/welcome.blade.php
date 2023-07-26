<x-app-layout>
    <div class="container mx-auto p-4 py-12 bg-cover bg-fixed bg-center h-full overflow-hidden"
        style="background-image: url('{{ asset('/assets/images/bg.png') }}');">
        <div class="flex flex-col-reverse md:flex-row">
            <div class="md:w-1/2 text-white my-8 md:my-44 md:ml-40">
                <h2 class="text-5xl pb-2">Gaming</h2>
                <h1 class="font-bold text-7xl pb-2 animate-pulse duration-150">Playstation Center</h1>
                <p class="pb-3">Kami adalah layanan rental PlayStation terkemuka yang menawarkan pengalaman gaming yang tak terlupakan bagi para pecinta game. Di sini, Anda dapat menikmati beragam koleksi game terbaru dan klasik dari berbagai genre yang dapat memuaskan hasrat gaming Anda..</p>
                <a href="/home"
                    class="bg-gray-100 hover:bg-white text-blue-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block w-32 text-center mx-auto md:mx-0 md:w-auto">Booking</a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-12 md:ml-12">
                <img src="{{ asset('assets/images/Playstation.png') }}" alt=""
                    class="w-80 h-auto mx-auto hover:scale-150 hover:-rotate-45 transition duration-300 ">
            </div>
        </div>
    </div>
</x-app-layout>
