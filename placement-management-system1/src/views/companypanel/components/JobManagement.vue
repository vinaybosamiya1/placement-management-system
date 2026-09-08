<template>
  <div class="h-full flex flex-col">
    <!-- Tabs Header -->
    <div class="flex items-center gap-2 mb-6 border-b border-white/10 pb-4">
      <button 
        v-for="tab in ['My Jobs', 'Post Job', 'Edit Job', 'Close Job']" 
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

    <!-- Active Content Area -->
    <div class="flex-1 overflow-y-auto">
      
      <!-- My Jobs View -->
      <div v-if="activeTab === 'My Jobs'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Job Card Example -->
        <div v-for="i in 3" :key="i" class="glass-card p-6 rounded-2xl border border-white/10 hover:border-blue-500/30 transition-all group">
          <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-blue-500/10 rounded-lg text-blue-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-wider">Active</span>
          </div>
          <h3 class="text-lg font-bold text-white mb-1 group-hover:text-blue-400 transition-colors">Frontend Developer</h3>
          <p class="text-xs text-slate-400 mb-4 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            Remote / San Francisco
          </p>
          <div class="flex items-center justify-between border-t border-white/5 pt-4 mt-2">
            <div class="text-xs text-slate-300"><strong class="text-white">42</strong> Applicants</div>
            <button class="text-xs font-medium text-blue-400 hover:text-white transition-colors">Manage →</button>
          </div>
        </div>
      </div>

      <!-- Post Job View -->
      <div v-if="activeTab === 'Post Job'" class="glass-card max-w-3xl border border-white/10 rounded-2xl p-8">
        <h3 class="text-xl font-bold text-white mb-6">Create New Job Posting</h3>
        <form class="space-y-5">
          <div class="form-group">
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Job Title</label>
            <input type="text" placeholder="e.g. Senior Software Engineer" class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all" />
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
              <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Location Type</label>
              <select class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all appearance-none">
                <option>Remote</option>
                <option>On-site</option>
                <option>Hybrid</option>
              </select>
            </div>
            <div class="form-group">
              <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Employment Type</label>
              <select class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all appearance-none">
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Contract</option>
                <option>Internship</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 block">Job Description</label>
            <textarea rows="5" placeholder="Describe the role and responsibilities..." class="w-full bg-slate-900/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all resize-none"></textarea>
          </div>

          <div class="pt-2">
            <button type="button" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-xl shadow-[0_4px_14px_0_rgba(37,99,235,0.39)] transition-all">Publish Job</button>
          </div>
        </form>
      </div>

      <!-- Edit / Close placeholders -->
      <div v-if="activeTab === 'Edit Job' || activeTab === 'Close Job'" class="flex flex-col items-center justify-center h-64 text-center">
        <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4 border border-white/10">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">Select a Job to {{ activeTab.split(' ')[0] }}</h3>
        <p class="text-sm text-slate-400">Please choose a job from the "My Jobs" list to modify its status.</p>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const activeTab = ref('My Jobs');
</script>

<style scoped>
.glass-card {
  background: rgba(15, 23, 42, 0.45);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(12px);
}
</style>
