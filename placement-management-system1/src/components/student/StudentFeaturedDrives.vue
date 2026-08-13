<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
          <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-sm shadow-blue-500"></span>
          Featured Hiring Drives
        </h2>
        <p class="text-xs text-slate-400">Top upcoming placement opportunities</p>
      </div>

      <button @click="$emit('view-all')" class="text-xs font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1 cursor-pointer">
        <span>View All ({{ totalDrives }})</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>

    <div class="space-y-4">
      <div v-for="drive in drives.slice(0, 3)" :key="drive.id" 
           class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 hover:border-blue-500/40 rounded-2xl p-5 transition-all duration-300 hover:shadow-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5 group">
        
        <div class="flex items-start sm:items-center gap-4">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center text-xl font-black text-blue-400 shadow-lg group-hover:scale-105 transition-transform flex-shrink-0">
            {{ drive.logoText }}
          </div>

          <div class="space-y-1">
            <div class="flex flex-wrap items-center gap-2">
              <h3 class="font-bold text-white text-base group-hover:text-blue-300 transition-colors">{{ drive.company }}</h3>
              <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                Eligible
              </span>
            </div>

            <p class="text-xs text-slate-400 font-medium">{{ drive.role }} • {{ drive.location }}</p>

            <div class="flex flex-wrap items-center gap-4 text-xs pt-1 font-semibold">
              <span class="text-blue-300 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ drive.ctc }}
              </span>
              <span class="text-slate-400 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Deadline: {{ drive.deadline }}
              </span>
            </div>
          </div>
        </div>

        <div class="w-full sm:w-auto flex items-center sm:flex-col items-end justify-between sm:justify-center gap-2 border-t sm:border-t-0 border-slate-800/80 pt-3 sm:pt-0">
          <button v-if="!isApplied(drive.id)" @click="$emit('apply', drive)" 
                  class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-500/20 active:scale-95 transition-all cursor-pointer">
            Apply Now
          </button>
          <span v-else class="px-3 py-1.5 bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 text-xs font-bold rounded-xl flex items-center gap-1.5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            Applied
          </span>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  drives: { type: Array, required: true },
  totalDrives: { type: Number, default: 0 },
  isApplied: { type: Function, required: true }
});

defineEmits(['apply', 'view-all']);
</script>
