<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Medic Healthcare Solutions
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-black">
  <header class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto">
   <div class="flex items-center space-x-2">
    <div class="font-extrabold text-xl">
     MEDIC.
    </div>
   </div>
   <nav class="hidden md:flex space-x-8 text-sm font-semibold text-gray-700">
   @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="text-blue-600 inline-block px-5 py-1.5 dark:text-[#EDEDEC] order border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="text-blue-600 inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
   </nav>
  </header>
  <main class="max-w-7xl mx-auto px-6 mt-10 md:mt-20 flex flex-col items-center">
   <section class="w-full max-w-md text-center">
    <h1 class="font-extrabold text-3xl md:text-5xl leading-tight">
     Medical
     <br/>
     Healthcare
     <br/>
     Solutions
    </h1>
    <p class="text-xs text-gray-600 mt-2">
     Health is the condition of wisdom and the sign is cheerfulness
    </p>
    <div class="flex items-center space-x-2 mt-6 max-w-xs mx-auto">
     <div class="h-px bg-gray-300 flex-grow">
     </div>
     <div class="h-px bg-gray-300 flex-grow">
     </div>
    </div>
   </section>
     <section class="w-full max-w-4xl mt-16 md:mt-24 mx-auto">
   <h2 class="font-semibold text-xl mb-8 text-center">
    Services
   </h2>
   <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="group bg-white border border-gray-200 rounded-xl p-6 flex flex-col justify-between min-h-[160px] cursor-pointer hover:bg-black hover:text-white transition-colors duration-300">
     <div>
      <h3 class="font-semibold text-lg leading-snug">
       Make an Appointment
      </h3>
     </div>
     <div class="flex items-center space-x-3 mt-6">
      <a href="/dashboard" class="text-white bg-blue-600 group-hover:bg-white group-hover:text-black hover:bg-blue-700 text-xs font-semibold rounded-full px-4 py-1 transition-colors duration-300">
    Learn More
    </a>
     </div>
    </div>
    <div class="group bg-white border border-gray-200 rounded-xl p-6 flex flex-col justify-between min-h-[160px] cursor-pointer hover:bg-black hover:text-white transition-colors duration-300">
     <div>
      <h3 class="font-semibold text-lg leading-snug">
       Hospital Management System
      </h3>
     </div>
     <div class="flex items-center space-x-3 mt-6 text-xs">
       <a href="/dashboard" class="text-white bg-blue-600 group-hover:bg-white group-hover:text-black hover:bg-blue-700 text-xs font-semibold rounded-full px-4 py-1 transition-colors duration-300">
        Learn More
        </a>
     </div>
    </div>
    <div class="group bg-white border border-gray-200 rounded-xl p-6 flex flex-col justify-between min-h-[160px] cursor-pointer hover:bg-black hover:text-white transition-colors duration-300">
     <div>
      <h3 class="font-semibold text-lg leading-snug">
       E-Medical Reporting
      </h3>
     </div>
     <div class="flex items-center space-x-3 mt-6 text-xs">
      <a href="/dashboard" class="text-white bg-blue-600 group-hover:bg-white group-hover:text-black hover:bg-blue-700 text-xs font-semibold rounded-full px-4 py-1 transition-colors duration-300">
        Learn More
    </a>
     </div>
    </div>
   </div>
  </section>
  </main>
   @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
 </body>
</html>


