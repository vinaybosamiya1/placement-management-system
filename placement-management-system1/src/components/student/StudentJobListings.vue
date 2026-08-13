<template>
  <div class="space-y-6 max-w-7xl mx-auto">
    <!-- Header Banner & Search -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl shadow-xl">
      <div>
        <h1 class="text-2xl font-black text-white tracking-tight">Campus Placement Drives</h1>
        <p class="text-xs text-slate-400">Explore eligible company recruitment drives and apply instantly</p>
      </div>
      
      <div class="flex items-center gap-3">
        <div class="relative w-full sm:w-72">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <input :value="searchQuery" @input="$emit('update:searchQuery', $event.target.value)" type="text" placeholder="Search company or role..." 
                 class="w-full bg-slate-950 border border-slate-700/80 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 shadow-inner" />
        </div>
      </div>
    </div>

    <!-- Drives Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div v-for="drive in filteredDrives" :key="drive.id" 
           class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-blue-500/50 rounded-3xl p-6 space-y-5 flex flex-col justify-between transition-all duration-300 hover:shadow-2xl group">
        
        <div class="space-y-4">
          <div class="flex items-start justify-between gap-4">
            <div class="flex items-center gap-3.5">
              <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center text-xl font-black text-blue-400 shadow-lg group-hover:scale-105 transition-transform">
                {{ drive.logoText }}
              </div>
              <div>
                <h3 class="font-bold text-white text-lg group-hover:text-blue-300 transition-colors">{{ drive.company }}</h3>
                <p class="text-xs text-slate-400">{{ drive.location }}</p>
              </div>
            </div>

            <span class="text-xs font-black px-3 py-1 rounded-full bg-blue-500/15 text-blue-300 border border-blue-500/30 shadow-inner">
              {{ drive.ctc }}
            </span>
          </div>

          <div class="border-t border-slate-800/80 pt-4 space-y-2">
            <h4 class="font-extrabold text-slate-100 text-sm">{{ drive.role }}</h4>
            <p class="text-xs text-slate-400 leading-relaxed">{{ drive.description }}</p>
            
            <div class="flex flex-wrap gap-2 pt-2">
              <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-slate-950 border border-slate-800 text-slate-300">
                Min CGPA: {{ drive.minCgpa }}
              </span>
              <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg bg-slate-950 border border-slate-800 text-slate-300">
                Branches: {{ drive.branches.join(', ') }}
              </span>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between border-t border-slate-800/80 pt-4 text-xs font-semibold">
          <span class="text-slate-400">📅 Deadline: <strong class="text-slate-200">{{ drive.deadline }}</strong></span>
          
          <button v-if="!isApplied(drive.id)" @click="$emit('apply', drive)"
                  class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 active:scale-95 transition-all cursor-pointer">
            Apply Now
          </button>
          <span v-else class="px-4 py-2 bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 font-bold rounded-xl flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Applied
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  filteredDrives: { type: Array, required: true },
  searchQuery: { type: String, default: '' },
  isApplied: { type: Function, required: true }
});

defineEmits(['apply', 'update:searchQuery']);
</script>
