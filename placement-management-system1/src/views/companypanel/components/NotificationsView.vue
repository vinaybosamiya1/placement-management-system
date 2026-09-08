<template>
  <div class="max-w-3xl mx-auto">
    <div class="glass-card border border-white/10 rounded-2xl overflow-hidden">
      <div class="p-6 border-b border-white/10 flex justify-between items-center bg-slate-900/30">
        <h2 class="text-xl font-bold text-white">Notifications</h2>
        <button class="text-sm text-blue-400 hover:text-white transition-colors">Mark all as read</button>
      </div>

      <div class="divide-y divide-white/5">
        <div v-for="i in 4" :key="i" class="p-6 hover:bg-white/[0.02] transition-colors cursor-pointer flex gap-4">
          <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
          </div>
          <div>
            <h4 class="text-sm font-bold text-white mb-1">New Application Received</h4>
            <p class="text-sm text-slate-400">Alice Smith just applied for the Senior Developer position.</p>
            <p class="text-xs text-slate-500 mt-2">{{ i }} hour(s) ago</p>
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
