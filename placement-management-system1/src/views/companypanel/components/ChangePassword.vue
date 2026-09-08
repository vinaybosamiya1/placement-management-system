<template>
  <div class="max-w-xl mx-auto mt-10">
    <div class="glass-card border border-white/10 rounded-2xl p-8">
      <div class="flex items-center gap-4 mb-8">
        <div class="p-3 bg-indigo-500/10 rounded-xl text-indigo-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
        </div>
        <div>
          <h2 class="text-2xl font-bold text-white">Change Password</h2>
          <p class="text-sm text-slate-400">Ensure your account uses a long, random password to stay secure.</p>
        </div>
      </div>

      <form class="space-y-5" @submit.prevent>
        <div class="form-group">
          <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Current Password</label>
          <input type="password" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all" />
        </div>

        <div class="form-group">
          <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">New Password</label>
          <input type="password" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all" />
        </div>

        <div class="form-group">
          <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Confirm New Password</label>
          <input type="password" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all" />
        </div>

        <div class="pt-4 flex justify-end">
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 px-8 rounded-xl shadow-[0_4px_14px_0_rgba(79,70,229,0.39)] transition-all">Update Password</button>
        </div>
      </form>
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
