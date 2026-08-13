<template>
  <div class="space-y-4">
    <div>
      <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 shadow-sm shadow-amber-500"></span>
        TPO Notice Board
      </h2>
      <p class="text-xs text-slate-400">Important placement notices</p>
    </div>

    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-2xl p-5 space-y-4 shadow-xl">
      <div v-for="notice in notices" :key="notice.id" class="border-b border-slate-800/80 pb-4 last:border-0 last:pb-0 space-y-1">
        <div class="flex items-center justify-between text-[11px] font-semibold text-slate-400">
          <span class="px-2 py-0.5 rounded bg-blue-500/10 text-blue-400 border border-blue-500/20">{{ notice.category }}</span>
          <span>{{ notice.date }}</span>
        </div>
        <h4 class="text-xs font-bold text-slate-100 hover:text-blue-300 transition-colors leading-snug cursor-pointer pt-1">
          {{ notice.title }}
        </h4>
        <p class="text-[11px] text-slate-400 leading-relaxed">{{ notice.content }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  notices: { type: Array, required: true }
});
</script>
