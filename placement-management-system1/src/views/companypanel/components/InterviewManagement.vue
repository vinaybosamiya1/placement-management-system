<template>
  <div class="h-full">
    <div class="glass-card border border-white/10 rounded-2xl p-6 relative overflow-hidden">
      <!-- Decorative Background Gradient -->
      <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -ml-20 -mb-20"></div>

      <div class="flex justify-between items-center mb-6 relative z-10">
        <div>
          <h2 class="text-xl font-bold text-white mb-1">Upcoming Interviews</h2>
          <p class="text-sm text-slate-400">Manage and schedule candidate interviews.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 px-4 rounded-xl shadow-lg transition-all flex items-center gap-2 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
          Schedule Interview
        </button>
      </div>

      <div class="space-y-4 relative z-10">
        <!-- Empty / No interviews state -->
        <div class="border border-white/10 rounded-xl p-6 bg-slate-900/30 flex items-center gap-4 hover:border-blue-500/30 transition-colors group">
          <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex flex-col items-center justify-center text-blue-400 border border-blue-500/20">
            <span class="text-xs font-bold uppercase">Oct</span>
            <span class="text-xl font-extrabold">24</span>
          </div>
          <div class="flex-1">
            <h4 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">Technical Round - Frontend Dev</h4>
            <p class="text-sm text-slate-400 mt-1 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              10:00 AM - 11:00 AM (EST)
            </p>
          </div>
          <div class="flex items-center gap-3 border-l border-white/10 pl-6">
             <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-sm font-bold text-white shadow-sm">
                AS
             </div>
             <div>
               <p class="text-sm font-medium text-white">Alice Smith</p>
               <p class="text-xs text-blue-400">Candidate</p>
             </div>
          </div>
          <div class="pl-6">
            <button class="bg-white/5 hover:bg-white/10 text-white font-medium py-2 px-4 border border-white/10 rounded-lg transition-colors text-sm">
              Join Link
            </button>
          </div>
        </div>

        <div class="border border-white/10 rounded-xl p-6 bg-slate-900/30 flex items-center gap-4 hover:border-blue-500/30 transition-colors group">
          <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex flex-col items-center justify-center text-blue-400 border border-blue-500/20">
            <span class="text-xs font-bold uppercase">Oct</span>
            <span class="text-xl font-extrabold">25</span>
          </div>
          <div class="flex-1">
            <h4 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors">HR Round - Backend Eng</h4>
            <p class="text-sm text-slate-400 mt-1 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              02:00 PM - 02:30 PM (EST)
            </p>
          </div>
          <div class="flex items-center gap-3 border-l border-white/10 pl-6">
             <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-sm font-bold text-white shadow-sm">
                JD
             </div>
             <div>
               <p class="text-sm font-medium text-white">John Doe</p>
               <p class="text-xs text-blue-400">Candidate</p>
             </div>
          </div>
          <div class="pl-6">
            <button class="bg-white/5 hover:bg-white/10 text-white font-medium py-2 px-4 border border-white/10 rounded-lg transition-colors text-sm">
              Join Link
            </button>
          </div>
        </div>
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
