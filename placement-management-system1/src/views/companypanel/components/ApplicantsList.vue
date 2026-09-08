<template>
  <div class="h-full flex flex-col">
    <!-- Tabs Header -->
    <div class="flex items-center gap-2 mb-6 border-b border-white/10 pb-4">
      <button 
        v-for="tab in ['All Applicants', 'Shortlisted', 'Selected', 'Rejected']" 
        :key="tab"
        @click="activeTab = tab"
        :class="[
          activeTab === tab 
            ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' 
            : 'text-slate-400 border-transparent hover:text-white hover:bg-white/5'
        ]"
        class="px-4 py-2 rounded-xl text-sm font-medium border transition-all">
        {{ tab }}
      </button>
    </div>

    <!-- Data Table -->
    <div class="glass-card flex-1 border border-white/10 rounded-2xl overflow-hidden flex flex-col">
      <div class="p-4 border-b border-white/10 flex justify-between items-center bg-slate-900/30">
        <div class="relative w-64">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
          <input type="text" placeholder="Search candidates..." class="w-full bg-slate-950/50 border border-white/10 rounded-lg pl-10 pr-4 py-2 text-sm text-white focus:outline-none focus:border-blue-500 transition-colors" />
        </div>
        <button class="flex items-center gap-2 text-sm text-slate-300 hover:text-white bg-white/5 px-4 py-2 rounded-lg border border-white/5 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
          Filter
        </button>
      </div>
      
      <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-900/50">
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Candidate Name</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Applied For</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Applied On</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/5">
            <!-- Dummy Data Rows -->
            <tr v-for="i in 5" :key="i" class="hover:bg-white/[0.02] transition-colors group">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-500 flex items-center justify-center text-xs font-bold text-white shadow-sm">
                    A{{ i }}
                  </div>
                  <div>
                    <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors">Applicant {{ i }}</p>
                    <p class="text-xs text-slate-500">applicant{{ i }}@example.com</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-slate-300">Software Engineer</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-slate-400">Oct {{ 10 + i }}, 2026</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span v-if="activeTab === 'All Applicants'" class="px-3 py-1 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wider">Reviewing</span>
                <span v-else-if="activeTab === 'Shortlisted'" class="px-3 py-1 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 uppercase tracking-wider">Shortlisted</span>
                <span v-else-if="activeTab === 'Selected'" class="px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-wider">Selected</span>
                <span v-else class="px-3 py-1 rounded-full text-[10px] font-bold bg-rose-500/10 text-rose-400 border border-rose-500/20 uppercase tracking-wider">Rejected</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right">
                <button class="text-slate-400 hover:text-white transition-colors bg-white/5 px-3 py-1.5 rounded-lg text-xs font-medium border border-white/5 hover:bg-white/10">View Profile</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const activeTab = ref('All Applicants');
</script>

<style scoped>
.glass-card {
  background: rgba(15, 23, 42, 0.45);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(12px);
}
</style>
