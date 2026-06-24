<template>
  <main class="">
    <nav class="bg-blue-600 text-white h-20 px-8 flex justify-between items-center shadow-md">
      
      <div class="flex items-center gap-1 cursor-pointer">
        <div class="h-25 w-25 flex items-center justify-center text-center relative top-2">
          <img src="../img/placement management system.png" alt="Logo" class="flex justify-center items-center text-center  ">
        </div>
        
        <h1 class="text-2xl font-bold text-white tracking-wide">
          Placement Management System
        </h1>
      </div>

      <div class="flex items-center gap-8">
        
        <div class="notification h-12 w-12 rounded-full bg-blue-500 flex items-center justify-center cursor-pointer hover:bg-blue-800 transition border-3 border-blue-900">
          <img src="../svg/notification-3-fill.svg" alt="Notification" class="h-8 w-8 p-1">
        </div>

        <button class="flex items-center gap-3 p-2 pr-3 rounded-full bg-white/5  hover:bg-white/15 border-3 border-blue-800  cursor-pointer">
          <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow-sm overflow-hidden p-1.5 ">
            <img src="../svg/user-2-line.svg" alt="User Icon" class="h-full w-full opacity-80">
          </div>
          
          <div class="hidden md:block text-left">
            <h2 class="text-sm font-semibold leading-tight group-hover:text-blue-50 transition-colors">
              Abhay Parmar
            </h2>
            <p class="text-xs text-blue-200 mt-0.5">
              BCA Final Year
            </p>
          </div>
        </button>

      </div>
    </nav>
  </main>
</template>