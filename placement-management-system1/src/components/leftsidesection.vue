<template>
    <aside class="h-full min-h-[calc(100vh-80px)] w-full md:w-64 lg:w-72
           bg-slate-950/70  border-r border-slate-800/80 flex flex-col justify-between
           py-6 px-4 shadow-2xl z-40 transition-all duration-300 backdrop-blur-xl">
        
        <div class="space-y-6">
          <div class="px-2">
            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 block mb-1">Navigation Menu</span>
            <div class="h-0.5 w-6 bg-blue-500 rounded-full"></div>
          </div>

          <ul class="space-y-4">
            <li v-for="(item, index) in leftsideItems" :key="index" 
                @click="handleClick(item.title)" 
                :class="[
                  activeTab === item.title
                    ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-extrabold shadow-lg shadow-blue-500/25 border-l-4 border-blue-400 translate-x-1'
                    : 'bg-slate-900/40 text-slate-300 border border-slate-800/50 hover:bg-slate-800/80 hover:text-white hover:border-blue-500/30 hover:translate-x-1'
                ]"
                class="group relative w-full flex items-center justify-between rounded-xl px-4 py-3.5 cursor-pointer text-sm font-medium transition-all duration-300">
                
                <div class="flex items-center gap-3.5">
                  <component :is="item.logo" class="h-5 w-5 transition-transform duration-300 group-hover:scale-110" 
                             :class="activeTab === item.title ? 'text-white' : 'text-blue-400 group-hover:text-blue-300'" />
                  <span>{{ item.title }}</span>
                </div>

                <span v-if="activeTab === item.title" class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            </li>
          </ul>
        </div>

        <!-- Sidebar Bottom Footer Info -->
        <div class="px-2 pt-6 border-t border-slate-800/80">
          <div class="bg-gradient-to-b from-slate-900 to-slate-950 p-3.5 rounded-2xl border border-slate-800 flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
            <div>
              <h4 class="text-xs font-bold text-slate-200">TPO Support Desk</h4>
              <p class="text-[10px] text-slate-400">Need help with drives?</p>
            </div>
          </div>
        </div>

    </aside>
</template>

<script setup>
import { h } from 'vue';
import DashboardIcon from "../assets/svg/leftPanel-icon/dashboard-fill.svg";
import JobListing from "../assets/svg/leftPanel-icon/briefcase-2-line.svg";
import applicationIcon from "../assets/svg/leftPanel-icon/file-list-fill.svg";
import profileIcon from "../assets/svg/leftPanel-icon/user-fill.svg";
import logoutIcon from "../assets/svg/leftPanel-icon/logout-box-r-line.svg";
import axios from "axios";
import { useRouter } from "vue-router";

const KeyIcon = {
  render() {
    return h('svg', { xmlns: 'http://www.w3.org/2000/svg', fill: 'none', viewBox: '0 0 24 24', stroke: 'currentColor', 'stroke-width': '2' }, [
      h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z' })
    ]);
  }
};

const props = defineProps({
  activeTab: {
    type: String,
    default: "Dashboard"
  }
});

const emit = defineEmits(["tab-selected"]);

const router = useRouter();

const leftsideItems = [
    { logo: DashboardIcon, title: "Dashboard" },
    { logo: JobListing, title: "Job Listing" },
    { logo: applicationIcon, title: "My Application" },
    { logo: profileIcon, title: "Profile" },
    { logo: KeyIcon, title: "Set / Reset Password" },
    { logo: logoutIcon, title: "Logout" },
];

const Logout = async () => {
    try {
        await axios.post("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/logout.php", {}, { withCredentials: true });
    } catch(e) {
        console.error("Logout error:", e);
    }
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('userRole');
    router.push('/login');
};

const handleClick = (title) => {
    if (title === "Logout") {
        Logout();
    } else if (title === "Profile") {
        router.push('/profile');
    } 
    // else if (title === "Reset Password") {
    //     router.push('/set-password');
    //     emit("tab-selected", "Reset Password");
    // }
    else if (title === "Reset Password") {
        router.push('/forget-password');
        emit("tab-selected", "Forget Password");
    }
     else if (title === "Dashboard") {
        router.push('/dashboard');
        emit("tab-selected", "Dashboard");
    } else if (title === "Job Listing") {
        router.push('/job-listings');
        emit("tab-selected", "Job Listing");
    } else if (title === "My Application") {
        router.push('/my-applications');
        emit("tab-selected", "My Application");
    }
};
</script>