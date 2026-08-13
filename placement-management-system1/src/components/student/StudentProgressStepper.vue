<template>
  <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-6 shadow-2xl">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
      <div>
        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
          <span class="w-2.5 h-2.5 rounded-full bg-purple-500 shadow-sm shadow-purple-500"></span>
          Application Progress Stepper
        </h2>
        <p class="text-xs text-slate-400">Real-time status updates of your applications</p>
      </div>
      <button @click="$emit('view-details')" class="text-xs font-bold text-purple-400 hover:text-purple-300 transition-colors cursor-pointer">
        View Full Details →
      </button>
    </div>

    <div class="space-y-4">
      <div v-for="app in applications" :key="app.id" class="bg-slate-950/70 border border-slate-800/80 rounded-2xl p-5 space-y-4 shadow-inner">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
          <div>
            <h3 class="font-bold text-white text-base">{{ app.company }} — {{ app.role }}</h3>
            <p class="text-xs text-slate-400">Applied on {{ app.appliedDate }} • Package: <span class="text-blue-300 font-semibold">{{ app.ctc }}</span></p>
          </div>
          <span :class="getStatusBadgeClass(app.status)" class="w-fit text-xs font-extrabold px-3 py-1 rounded-full border shadow-sm">
            {{ app.status }}
          </span>
        </div>

        <!-- Custom Stepper Steps -->
        <div class="grid grid-cols-4 gap-3 pt-2">
          <div v-for="(stepName, idx) in ['1. Applied', '2. Aptitude Test', '3. Interview', '4. Offer Letter']" :key="idx" 
               class="space-y-2">
            <div class="h-2 rounded-full transition-all duration-700 shadow"
                 :class="idx <= app.currentStep ? 'bg-gradient-to-r from-blue-500 to-indigo-500 shadow-blue-500/30' : 'bg-slate-800'"></div>
            <span class="text-[11px] font-bold block truncate" 
                  :class="idx <= app.currentStep ? 'text-blue-300' : 'text-slate-500'">
              {{ stepName }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  applications: { type: Array, required: true },
  getStatusBadgeClass: { type: Function, required: true }
});

defineEmits(['view-details']);
</script>
