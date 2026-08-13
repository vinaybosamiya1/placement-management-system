<template>
  <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900/90 via-indigo-950/80 to-slate-900 border border-blue-500/30 p-6 sm:p-8 md:p-10 shadow-2xl backdrop-blur-2xl group">
    <div class="absolute right-0 top-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-blue-500/20 transition-all duration-700"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
      <div class="space-y-3 max-w-2xl">
        <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-500/15 border border-blue-400/30 text-xs font-bold text-blue-300 shadow-inner">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
          Placement Season 2026 • BCA Stream
        </div>
        
        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight leading-tight">
          Welcome back, <span class="bg-gradient-to-r from-blue-400 via-teal-300 to-indigo-300 bg-clip-text text-transparent">{{ student.name || 'Student' }}</span> 👋
        </h1>
        
        <p class="text-slate-300 text-sm leading-relaxed">
          You have <strong class="text-white font-bold">{{ drivesCount }} active campus placement drives</strong> available for your branch. Track your applications and interview schedules below.
        </p>

        <div class="flex flex-wrap items-center gap-3 pt-2">
          <button @click="$emit('explore-drives')" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-500/25 active:scale-95 transition-all duration-300 flex items-center gap-2 cursor-pointer">
            <span>Explore Placement Drives</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
          <router-link to="/profile" class="px-4 py-2.5 bg-slate-900/80 hover:bg-slate-800 border border-slate-700/80 text-slate-300 hover:text-white font-semibold text-xs rounded-xl transition-all">
            View Profile Summary
          </router-link>
        </div>
      </div>

      <!-- Profile Completion Widget -->
      <div class="w-full lg:w-80 bg-slate-950/70 border border-white/10 rounded-2xl p-5 backdrop-blur-md shadow-xl flex flex-col justify-between">
        <div class="flex items-center justify-between text-xs font-extrabold mb-3">
          <span class="text-slate-300 flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            Profile Readiness
          </span>
          <span class="text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20 font-black">{{ profileCompletion }}%</span>
        </div>
        
        <div class="w-full bg-slate-900 h-3 rounded-full overflow-hidden p-0.5 border border-slate-800">
          <div class="bg-gradient-to-r from-blue-500 via-teal-400 to-emerald-400 h-full rounded-full transition-all duration-1000 shadow-md" :style="{ width: profileCompletion + '%' }"></div>
        </div>

        <p class="text-[11px] text-slate-400 mt-2.5 leading-snug">
          Upload your updated resume PDF to achieve 100% eligibility score.
        </p>

        <router-link to="/editprofile" class="mt-4 w-full py-2 bg-blue-600/20 hover:bg-blue-600/30 border border-blue-500/40 text-blue-300 font-bold text-xs rounded-xl text-center transition-all flex items-center justify-center gap-1">
          <span>Edit Profile & Resume</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  student: { type: Object, required: true },
  drivesCount: { type: Number, default: 0 },
  profileCompletion: { type: Number, default: 0 }
});

defineEmits(['explore-drives']);
</script>
