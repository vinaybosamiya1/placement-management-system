<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    
    <!-- Stat 1: Hiring Drives -->
    <div class="relative overflow-hidden bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-blue-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 shadow-xl group">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-500/10 rounded-full blur-xl group-hover:bg-blue-500/20 transition-all"></div>
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Hiring Drives</span>
        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
      </div>
      <p class="text-3xl font-black text-white mt-4 tracking-tight">{{ drivesCount }}</p>
      <span class="text-xs text-emerald-400 font-semibold flex items-center gap-1.5 mt-2">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Active placement drives
      </span>
    </div>

    <!-- Stat 2: Applied Applications -->
    <div class="relative overflow-hidden bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-purple-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 shadow-xl group">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-purple-500/10 rounded-full blur-xl group-hover:bg-purple-500/20 transition-all"></div>
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Applied</span>
        <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
      </div>
      <p class="text-3xl font-black text-white mt-4 tracking-tight">{{ applicationsCount }}</p>
      <span class="text-xs text-purple-300 font-semibold flex items-center gap-1.5 mt-2">
        <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span> Submitted applications
      </span>
    </div>

    <!-- Stat 3: Shortlisted -->
    <div class="relative overflow-hidden bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-amber-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 shadow-xl group">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-500/10 rounded-full blur-xl group-hover:bg-amber-500/20 transition-all"></div>
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Shortlisted</span>
        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        </div>
      </div>
      <p class="text-3xl font-black text-white mt-4 tracking-tight">{{ shortlistedCount }}</p>
      <span class="text-xs text-amber-300 font-semibold flex items-center gap-1.5 mt-2">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Interview stage
      </span>
    </div>

    <!-- Stat 4: Offers -->
    <div class="relative overflow-hidden bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-emerald-500/50 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1 shadow-xl group">
      <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl group-hover:bg-emerald-500/20 transition-all"></div>
      <div class="flex items-center justify-between">
        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Offers Received</span>
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
        </div>
      </div>
      <p class="text-3xl font-black text-white mt-4 tracking-tight">{{ offersCount }}</p>
      <span class="text-xs text-emerald-400 font-semibold flex items-center gap-1.5 mt-2">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Job offers confirmed
      </span>
    </div>

  </div>
</template>

<script setup>
defineProps({
  drivesCount: { type: Number, default: 0 },
  applicationsCount: { type: Number, default: 0 },
  shortlistedCount: { type: Number, default: 0 },
  offersCount: { type: Number, default: 0 }
});
</script>
