<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans overflow-hidden flex relative">
    <!-- Animated Glowing Background Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-blue-600/20 blur-[120px] animate-[pulse_8s_ease-in-out_infinite]"></div>
      <div class="absolute bottom-[-10%] right-[-10%] w-[45vw] h-[45vw] rounded-full bg-teal-500/15 blur-[120px] animate-[pulse_10s_ease-in-out_infinite_2s]"></div>
      <div class="absolute top-[30%] right-[15%] w-[35vw] h-[35vw] rounded-full bg-orange-500/10 blur-[100px] animate-[pulse_12s_ease-in-out_infinite_4s]"></div>
    </div>

    <!-- Sidebar -->
    <aside class="w-64 border-r border-white/10 bg-slate-900/50 backdrop-blur-xl relative z-10 hidden md:flex flex-col">
      <div class="p-6 border-b border-white/10 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
          C
        </div>
        <div>
          <h2 class="font-bold text-lg tracking-wide text-white">CompanyPanel</h2>
          <p class="text-xs text-blue-300">Employer Portal</p>
        </div>
      </div>
      
      <nav class="flex-1 p-4 space-y-1 overflow-y-auto custom-scrollbar">
        
        <!-- Dashboard -->
        <button @click="currentView = 'DashboardHome'" :class="[currentView === 'DashboardHome' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
          Dashboard
        </button>

        <!-- Company Profile -->
        <button @click="currentView = 'CompanyProfile'" :class="[currentView === 'CompanyProfile' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
          Company Profile
        </button>

        <!-- Job Management -->
        <button @click="currentView = 'JobManagement'" :class="[currentView === 'JobManagement' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
          Job Management
        </button>

        <!-- Applicants -->
        <button @click="currentView = 'ApplicantsList'" :class="[currentView === 'ApplicantsList' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
          Applicants
        </button>

        <!-- Interview Management -->
        <button @click="currentView = 'InterviewManagement'" :class="[currentView === 'InterviewManagement' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
          Interview Mgt.
        </button>

        <!-- Notifications -->
        <button @click="currentView = 'NotificationsView'" :class="[currentView === 'NotificationsView' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
          Notifications
        </button>

        <!-- Change Password -->
        <button @click="currentView = 'ChangePassword'" :class="[currentView === 'ChangePassword' ? 'bg-blue-600/20 text-blue-400 border-blue-500/30' : 'text-slate-400 hover:text-white hover:bg-white/5 border-transparent']" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-medium border transition-all mt-1 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
          Change Password
        </button>

      </nav>

      <div class="p-4 border-t border-white/10">
        <button @click="logout" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 hover:text-rose-300 transition-all font-medium border border-rose-500/20">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col relative z-10 overflow-hidden">
      <!-- Header -->
      <header class="h-20 border-b border-white/10 bg-slate-900/30 backdrop-blur-md flex items-center justify-between px-8">
        <h1 class="text-2xl font-bold text-white tracking-tight">
          {{ formatTitle(currentView) }}
        </h1>
        <div class="flex items-center gap-4">
          <button class="p-2 text-slate-400 hover:text-white transition-colors bg-white/5 rounded-full border border-white/5 hover:bg-white/10 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-slate-900"></span>
          </button>
          <div class="w-10 h-10 rounded-full bg-gradient-to-r from-teal-400 to-blue-500 border-2 border-white/20 p-0.5 cursor-pointer">
            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Company" alt="Avatar" class="w-full h-full rounded-full bg-slate-800" />
          </div>
        </div>
      </header>

      <!-- Content Area -->
      <div class="flex-1 p-8 overflow-y-auto custom-scrollbar">
        <!-- Dynamic Component Rendering -->
        <Transition name="fade" mode="out-in">
          <component :is="activeComponent" />
        </Transition>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';

// Import all sub-components
import DashboardHome from './components/DashboardHome.vue';
import CompanyProfile from './components/CompanyProfile.vue';
import JobManagement from './components/JobManagement.vue';
import ApplicantsList from './components/ApplicantsList.vue';
import InterviewManagement from './components/InterviewManagement.vue';
import NotificationsView from './components/NotificationsView.vue';
import ChangePassword from './components/ChangePassword.vue';

const router = useRouter();

// State
const currentView = ref('DashboardHome');

// Component Mapping
const componentsMap = {
  DashboardHome,
  CompanyProfile,
  JobManagement,
  ApplicantsList,
  InterviewManagement,
  NotificationsView,
  ChangePassword
};

const activeComponent = computed(() => componentsMap[currentView.value]);

const formatTitle = (val) => {
  if (val === 'DashboardHome') return 'Overview';
  if (val === 'InterviewManagement') return 'Interview Management';
  if (val === 'NotificationsView') return 'Notifications';
  return val.replace(/([A-Z])/g, ' $1').trim();
};

const logout = () => {
  localStorage.removeItem('isLoggedIn');
  localStorage.removeItem('userRole');
  router.push('/login');
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: rgba(15, 23, 42, 0.1);
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease, transform 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
