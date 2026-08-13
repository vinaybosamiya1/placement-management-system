<template>
  <div class="space-y-6 max-w-7xl mx-auto">
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
      <div>
        <h1 class="text-2xl font-black text-white tracking-tight">My Submitted Applications</h1>
        <p class="text-xs text-slate-400">Track application status and interview stages</p>
      </div>
      <span class="text-xs font-black text-blue-300 px-4 py-2 rounded-2xl bg-blue-500/15 border border-blue-500/30 shadow-inner">
        Total Applications: {{ applications.length }}
      </span>
    </div>

    <!-- Applications Table Card -->
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-300">
          <thead class="bg-slate-950/80 text-slate-400 uppercase tracking-widest text-[10px] font-black border-b border-slate-800">
            <tr>
              <th class="p-5">Company & Role</th>
              <th class="p-5">Package (CTC)</th>
              <th class="p-5">Applied Date</th>
              <th class="p-5">Current Status</th>
              <th class="p-5">Progress</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-800/60 font-medium">
            <tr v-for="app in applications" :key="app.id" class="hover:bg-slate-800/40 transition-colors">
              <td class="p-5">
                <div class="font-extrabold text-white text-sm">{{ app.company }}</div>
                <div class="text-slate-400 text-xs mt-0.5">{{ app.role }}</div>
              </td>
              <td class="p-5 font-bold text-blue-300 text-sm">{{ app.ctc }}</td>
              <td class="p-5 text-slate-400">{{ app.appliedDate }}</td>
              <td class="p-5">
                <span :class="getStatusBadgeClass(app.status)" class="px-3 py-1 rounded-full border text-xs font-extrabold shadow-sm">
                  {{ app.status }}
                </span>
              </td>
              <td class="p-5">
                <div class="w-40 bg-slate-950 h-2.5 rounded-full overflow-hidden p-0.5 border border-slate-800">
                  <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full transition-all duration-700" 
                       :style="{ width: ((app.currentStep + 1) * 25) + '%' }"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  applications: { type: Array, required: true },
  getStatusBadgeClass: { type: Function, required: true }
});
</script>
