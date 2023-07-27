<x-app-layout>
    <div class="mx-auto py-10">
        <div class="flex flex-col-reverse md:flex-row">
            <div class="mx-2 md:w-1/2 text-white my-8 md:my-44 md:ml-36">
                <h2 class="text-3xl md:text-5xl pb-2">Gaming</h2>
                <h1 class="font-bold text-5xl md:text-7xl pb-2">Playstation <span class="animate-pulse duration-500">Center</span></h1>
                <p class="pb-3">Kami adalah layanan rental PlayStation terkemuka yang menawarkan pengalaman gaming yang
                    tak terlupakan bagi para pecinta game. Di sini, Anda dapat menikmati beragam koleksi game terbaru
                    dan klasik dari berbagai genre yang dapat memuaskan hasrat gaming Anda..</p>
                <a href="/home"
                    class="bg-gray-100 hover:bg-white text-blue-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block w-32 text-center mx-auto md:mx-0 md:w-auto animate-fadein">Booking</a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-11">
                <img src="{{ asset('assets/images/Playstation.png') }}" alt=""
                    class="w-80 h-auto mx-auto hover:scale-150 hover:-rotate-12 transition duration-500">
            </div>
        </div>
    </div>    
</x-app-layout>
