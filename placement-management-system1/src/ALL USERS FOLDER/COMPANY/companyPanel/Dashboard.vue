<script setup>
import { ref } from 'vue';

const stats = ref([
  { title: 'Active Jobs', value: '3', subtext: 'Currently hiring', icon: 'ri-briefcase-4-line', color: 'blue' },
  { title: 'Applications', value: '142', subtext: 'Across all jobs', icon: 'ri-file-text-line', color: 'indigo' },
  { title: 'Shortlisted', value: '24', subtext: 'Pending interviews', icon: 'ri-star-line', color: 'amber' },
  { title: 'Hired', value: '5', subtext: 'This season', icon: 'ri-checkbox-circle-line', color: 'emerald' }
]);

const recentApplications = ref([
  { name: 'Rahul Sharma', role: 'Associate Software Engineer', status: 'Under Review', statusColor: 'blue' },
  { name: 'Priya Patel', role: 'Frontend Developer', status: 'Shortlisted', statusColor: 'amber' },
  { name: 'Amit Kumar', role: 'Associate Software Engineer', status: 'Rejected', statusColor: 'rose' }
]);
</script>

<template>
  <div class="space-y-8 w-full max-w-7xl mx-auto">
    <!-- Welcome Banner -->
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-8 rounded-3xl shadow-xl flex flex-col md:flex-row justify-between gap-8 relative overflow-hidden group">
      <!-- Background subtle glow -->
      <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-blue-600/10 rounded-full blur-[80px] -mr-20 -mt-20 pointer-events-none group-hover:bg-blue-600/20 transition-all duration-1000"></div>

      <div class="flex-1 z-10">
        <span class="inline-block px-3 py-1 bg-blue-500/15 text-blue-400 border border-blue-500/30 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
          Placement Season 2026
        </span>
        <h1 class="text-3xl font-black text-white tracking-tight mb-2">
          Welcome back, <span class="text-blue-400">TechCorp Solutions</span> <span class="inline-block origin-[70%_70%] animate-[wave_2.5s_infinite]">👋</span>
        </h1>
        <p class="text-slate-400 text-sm max-w-xl mb-6 leading-relaxed">
          You have <strong class="text-slate-200">3 active job postings</strong> across multiple branches. Track your applications and interview schedules below.
        </p>
        <div class="flex flex-wrap gap-4">
          <button class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-2.5 px-6 rounded-2xl flex items-center gap-2 shadow-lg shadow-blue-500/25 transition-all hover:-translate-y-0.5">
            Post a New Job <i class="ri-arrow-right-line"></i>
          </button>
          <button class="bg-slate-800/50 hover:bg-slate-800 border border-slate-700 text-slate-300 font-bold py-2.5 px-6 rounded-2xl transition-all">
            View Company Profile
          </button>
        </div>
      </div>
      
      <div class="bg-slate-950/50 border border-slate-800/80 p-5 rounded-2xl w-full md:w-72 z-10 shadow-inner flex flex-col justify-center">
        <div class="flex justify-between items-center mb-3">
          <div class="flex items-center gap-2 text-slate-300 font-bold text-sm">
            <i class="ri-user-star-line text-blue-400 text-lg"></i>
            Profile Readiness
          </div>
          <span class="text-emerald-400 font-black">85%</span>
        </div>
        <div class="w-full bg-slate-900 h-2 rounded-full overflow-hidden mb-3 border border-slate-800">
          <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-full rounded-full w-[85%] shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
        </div>
        <p class="text-xs text-slate-400 mb-4">Complete your company profile to attract top talent.</p>
        <button class="w-full bg-transparent border border-slate-700 hover:bg-slate-800 text-slate-300 text-xs font-bold py-2 rounded-xl transition-colors">
          Edit Profile
        </button>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <div v-for="stat in stats" :key="stat.title" class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-5 rounded-3xl shadow-lg hover:-translate-y-1 hover:border-slate-700 transition-all group">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">{{ stat.title }}</h3>
          <div :class="[`bg-${stat.color}-500/15 text-${stat.color}-400`, 'w-10 h-10 rounded-2xl flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform']">
            <i :class="stat.icon"></i>
          </div>
        </div>
        <div class="text-3xl font-black text-white mb-1">{{ stat.value }}</div>
        <div class="flex items-center gap-1.5 text-xs font-medium text-slate-500">
          <i :class="[`text-${stat.color}-400`, 'ri-record-circle-fill text-[10px]']"></i>
          {{ stat.subtext }}
        </div>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Recent Applications -->
      <div class="lg:col-span-2 bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl shadow-xl flex flex-col">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-800/80">
          <div class="flex items-center gap-2">
            <i class="ri-file-list-3-line text-blue-400 text-xl"></i>
            <h3 class="text-lg font-black text-white">Recent Applications</h3>
          </div>
          <a href="#" class="text-xs font-bold text-blue-400 hover:text-blue-300 hover:underline flex items-center">
            View All <i class="ri-arrow-right-s-line ml-0.5"></i>
          </a>
        </div>
        
        <div class="flex flex-col gap-3 flex-1">
          <div v-for="(app, index) in recentApplications" :key="index" class="flex items-center gap-4 p-3 bg-slate-950/30 border border-slate-800/50 rounded-2xl hover:bg-slate-800/40 transition-colors group">
            <div class="w-10 h-10 rounded-full bg-slate-800 text-slate-300 flex items-center justify-center font-bold shadow-inner group-hover:bg-slate-700 transition-colors">
              {{ app.name.charAt(0) }}
            </div>
            <div class="flex-1">
              <h4 class="text-sm font-bold text-white mb-0.5">{{ app.name }}</h4>
              <p class="text-xs text-slate-400 font-medium">{{ app.role }}</p>
            </div>
            <div :class="[
                'px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border shadow-sm',
                `bg-${app.statusColor}-500/15 text-${app.statusColor}-400 border-${app.statusColor}-500/30`
              ]">
              {{ app.status }}
            </div>
          </div>
        </div>
      </div>

      <!-- Notice Board -->
      <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl shadow-xl flex flex-col">
        <div class="flex items-center gap-2 mb-6 pb-4 border-b border-slate-800/80">
          <i class="ri-notification-badge-line text-amber-400 text-xl"></i>
          <h3 class="text-lg font-black text-white">TPO Notice Board</h3>
        </div>
        <div class="flex flex-col gap-5 flex-1">
          <div class="group cursor-pointer">
            <div class="flex justify-between items-center mb-2">
              <span class="px-2 py-0.5 bg-rose-500/15 text-rose-400 border border-rose-500/30 rounded text-[9px] font-black uppercase tracking-widest">Important</span>
              <span class="text-[10px] font-bold text-slate-500">Today</span>
            </div>
            <h4 class="text-sm font-bold text-slate-200 mb-1 group-hover:text-blue-400 transition-colors">Pre-placement Talk Schedule</h4>
            <p class="text-xs text-slate-400 leading-relaxed font-medium">Please confirm your availability for the pre-placement talk next week.</p>
          </div>
          <div class="w-full h-px bg-slate-800/50"></div>
          <div class="group cursor-pointer">
            <div class="flex justify-between items-center mb-2">
              <span class="px-2 py-0.5 bg-blue-500/15 text-blue-400 border border-blue-500/30 rounded text-[9px] font-black uppercase tracking-widest">Update</span>
              <span class="text-[10px] font-bold text-slate-500">Yesterday</span>
            </div>
            <h4 class="text-sm font-bold text-slate-200 mb-1 group-hover:text-blue-400 transition-colors">Resume Verification Complete</h4>
            <p class="text-xs text-slate-400 leading-relaxed font-medium">All BCA and MCA student resumes have been verified for the upcoming drive.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@keyframes wave {
  0% { transform: rotate(0deg); }
  10% { transform: rotate(14deg); }
  20% { transform: rotate(-8deg); }
  30% { transform: rotate(14deg); }
  40% { transform: rotate(-4deg); }
  50% { transform: rotate(10deg); }
  60% { transform: rotate(0deg); }
  100% { transform: rotate(0deg); }
}
</style>
