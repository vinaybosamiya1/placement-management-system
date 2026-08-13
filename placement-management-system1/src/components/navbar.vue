<template>
  <header class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-slate-800/80 text-white shadow-xl transition-all duration-300">
    <nav class="flex items-center justify-between h-16 sm:h-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

      <!-- Logo + Title -->
      <div class="flex items-center gap-3 min-w-0">
        <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-500 p-0.5 shadow-lg shadow-blue-500/20 flex items-center justify-center flex-shrink-0">
          <div class="w-full h-full bg-slate-950 rounded-[14px] flex items-center justify-center overflow-hidden p-1">
            <img src="../assets/img/placement management system.png" alt="Logo" class="w-full h-full object-contain drop-shadow" />
          </div>
        </div>

        <div>
          <h1 class="font-extrabold tracking-tight text-base sm:text-lg lg:text-xl bg-gradient-to-r from-white via-slate-100 to-blue-300 bg-clip-text text-transparent truncate">
            Placement Portal
          </h1>
          <p class="text-[10px] text-blue-400 font-semibold tracking-wider uppercase hidden sm:block">
            Student Management Suite
          </p>
        </div>
      </div>

      <!-- Right Action Controls -->
      <div class="flex items-center gap-3 sm:gap-5">

        <!-- Notification Bell -->
        <div class="relative group">
          <button type="button" class="h-10 w-10 sm:h-11 sm:w-11 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/50 flex items-center justify-center cursor-pointer transition-all duration-300 hover:bg-slate-800 hover:scale-105 active:scale-95 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300 group-hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span>
            </span>
          </button>
        </div>

        <!-- User Profile Pill -->
        <router-link to="/profile">
          <div class="flex items-center gap-3 rounded-2xl border border-slate-800/80 bg-slate-900/90 hover:bg-slate-800/90 hover:border-blue-500/40 transition-all duration-300 cursor-pointer p-1.5 pr-4 shadow-lg group">
            
            <div class="h-9 w-9 sm:h-10 sm:w-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-sm flex items-center justify-center shadow-md uppercase">
              {{ userInitials }}
            </div>

            <div class="hidden md:block text-left">
              <h2 class="text-xs font-bold text-slate-100 group-hover:text-blue-300 transition-colors leading-tight">
                {{ user.full_name || 'Student Account' }}
              </h2>
              <span class="text-[11px] font-medium text-emerald-400 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> BCA Student
              </span>
            </div>
          </div>
        </router-link>

      </div>

    </nav>
  </header>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const user = ref({ full_name: 'Student' });

const userInitials = computed(() => {
  if (!user.value.full_name) return 'ST';
  const parts = user.value.full_name.trim().split(' ');
  if (parts.length >= 2) {
    return (parts[0][0] + parts[1][0]).toUpperCase();
  }
  return parts[0].substring(0, 2).toUpperCase();
});

onMounted(async () => {
  try {
    const res = await axios.get("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php", {
      withCredentials: true,
    });

    if (res.data && res.data.success && res.data.user) {
      user.value = res.data.user;
    }
  } catch (err) {
    console.log("Navbar user fetch fallback");
  }
});
</script>
