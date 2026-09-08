<template>
  <div class="h-full">
    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="glass-card p-6 rounded-2xl border border-white/10 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
        <p class="text-sm text-slate-400 font-medium mb-1">Active Jobs</p>
        <h3 class="text-3xl font-extrabold text-white">12</h3>
        <div class="mt-4 flex items-center text-sm text-emerald-400 font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
          +3 this week
        </div>
      </div>
      
      <div class="glass-card p-6 rounded-2xl border border-white/10 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
        <p class="text-sm text-slate-400 font-medium mb-1">Total Applications</p>
        <h3 class="text-3xl font-extrabold text-white">348</h3>
        <div class="mt-4 flex items-center text-sm text-emerald-400 font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
          +42 this week
        </div>
      </div>
      
      <div class="glass-card p-6 rounded-2xl border border-white/10 relative overflow-hidden group">
        <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
        <p class="text-sm text-slate-400 font-medium mb-1">Interviews Scheduled</p>
        <h3 class="text-3xl font-extrabold text-white">24</h3>
        <div class="mt-4 flex items-center text-sm text-rose-400 font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
          -2 this week
        </div>
      </div>
    </div>

    <!-- Recent Applications -->
    <div class="glass-card border border-white/10 rounded-2xl overflow-hidden">
      <div class="p-6 border-b border-white/10 flex items-center justify-between">
        <h2 class="text-lg font-bold text-white">Recent Applications</h2>
        <button class="text-sm text-blue-400 hover:text-blue-300 font-medium transition-colors">View All →</button>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-slate-900/50">
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Candidate Name</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Role Applied</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
              <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/5">
            <tr class="hover:bg-white/[0.02] transition-colors group">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white">JS</div>
                  <div>
                    <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors">John Smith</p>
                    <p class="text-xs text-slate-500">john.smith@example.com</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-slate-300">Frontend Developer</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Under Review</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right">
                <button class="text-slate-400 hover:text-white transition-colors bg-white/5 px-3 py-1.5 rounded-lg text-xs font-medium border border-white/5 hover:bg-white/10">Review</button>
              </td>
            </tr>
            <tr class="hover:bg-white/[0.02] transition-colors group">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white">EM</div>
                  <div>
                    <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors">Emily Mayer</p>
                    <p class="text-xs text-slate-500">emily.m@example.com</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <p class="text-sm text-slate-300">Backend Engineer</p>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Shortlisted</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right">
                <button class="text-slate-400 hover:text-white transition-colors bg-white/5 px-3 py-1.5 rounded-lg text-xs font-medium border border-white/5 hover:bg-white/10">Review</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
.glass-card {
  background: rgba(15, 23, 42, 0.45);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(12px);
}
</style>
