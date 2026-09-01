<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans flex flex-col relative overflow-x-hidden">
    <!-- Ambient Background Lighting -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
      <div
        class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] rounded-full bg-blue-600/15 blur-[140px] animate-[pulse_10s_ease-in-out_infinite]">
      </div>
      <div
        class="absolute top-[40%] right-[-10%] w-[35vw] h-[35vw] rounded-full bg-indigo-600/10 blur-[130px] animate-[pulse_12s_ease-in-out_infinite_2s]">
      </div>
    </div>

    <!-- Sticky Header Navbar -->
    <Navbar class="relative z-50" />

    <!-- Main Workspace Layout -->
    <div class="flex-1 flex flex-col md:flex-row relative z-10 overflow-hidden">
      <!-- Left Sidebar Navigation (Profile Tab Active) -->
      <LeftSidesection activeTab="Profile" />

      <!-- Main Profile Content View -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto max-h-[calc(100vh-80px)] space-y-6">
        <div class="max-w-7xl mx-auto space-y-6">

          <!-- Back Link Header -->
          <div class="flex items-center justify-between">
            <router-link to="/dashboard">
              <button
                class="cursor-pointer inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-blue-400 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
              </button>
            </router-link>
            <span class="text-xs text-slate-400">Profile Status: Active</span>
          </div>

          <!-- Header / Profile Summary Banner Card -->
          <div
            class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden group">
            <div class="absolute right-0 top-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
              <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">

                <!-- Student Avatar -->
                <div v-if="student.firstName"
                  class="w-24 h-24 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 border border-white/20 flex items-center justify-center text-white text-3xl font-black uppercase shadow-xl flex-shrink-0">
                  {{ student.firstName[0] }}{{ student.lastName ? student.lastName[0] : '' }}
                </div>
                <div v-else
                  class="w-24 h-24 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-blue-400 text-3xl font-black uppercase shadow-xl flex-shrink-0">
                  ST
                </div>

                <!-- Name & Academic Stream -->
                <div>
                  <div class="flex flex-wrap justify-center sm:justify-start items-center gap-3">
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                      {{ user.full_name || 'Student Name' }}
                    </h1>
                    <span
                      class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                      {{ student.placementStatus || 'Eligible for Drives' }}
                    </span>
                  </div>

                  <p class="text-slate-300 text-sm mt-1">
                    {{ student.branch || 'BCA' }} • Batch of {{ student.completedYear || 2026 }}
                  </p>
                  <p class="text-slate-400 text-xs mt-0.5">Roll No: {{ student.rollNo }}</p>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="flex flex-wrap justify-center gap-3">
                <button @click="downloadResume"
                  class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 text-xs font-bold text-slate-200 bg-slate-800/80 border border-slate-700 rounded-xl hover:bg-slate-800 hover:text-white transition-all shadow-md active:scale-95">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  Resume.pdf
                </button>

                <router-link to="/editprofile">
                  <button
                    class="cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-xl shadow-lg shadow-blue-500/25 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Profile
                  </button>
                </router-link>
              </div>
            </div>
          </div>

          <!-- Main Layout Grid -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Contact & Quick Info -->
            <div class="space-y-6">

              <!-- Contact Info Card -->
              <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 space-y-4 shadow-xl">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Contact Details</h2>

                <div class="space-y-3.5 text-xs">
                  <div class="flex items-center gap-3 text-slate-300">
                    <div
                      class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <span class="truncate font-semibold">{{ student.email }}</span>
                  </div>

                  <div class="flex items-center gap-3 text-slate-300">
                    <div
                      class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                    </div>
                    <span class="font-semibold">{{ student.phone }}</span>
                  </div>

                  <div class="flex items-center gap-3 text-slate-300">
                    <div
                      class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                    </div>
                    <span class="font-semibold">{{ student.location }}</span>
                  </div>
                </div>

                <!-- Professional Links -->
                <div class="border-t border-slate-800/80 pt-4 space-y-2.5">
                  <a :href="student.socials.linkedin" target="_blank"
                    class="flex items-center gap-3 text-xs font-semibold text-slate-300 hover:text-blue-400 transition-colors p-2 rounded-xl bg-slate-950 border border-slate-800">
                    <svg class="w-4 h-4 text-blue-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                      <path
                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                    </svg>
                    <span>LinkedIn Profile</span>
                  </a>
                  <a :href="student.socials.github" target="_blank"
                    class="flex items-center gap-3 text-xs font-semibold text-slate-300 hover:text-white transition-colors p-2 rounded-xl bg-slate-950 border border-slate-800">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                    </svg>
                    <span>GitHub Repository</span>
                  </a>
                </div>
              </div>

              <!-- Academic Summary Card -->
              <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 space-y-4 shadow-xl">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Academic Performance</h2>

                <div class="grid grid-cols-2 gap-3">
                  <div class="p-3.5 bg-blue-500/10 rounded-2xl border border-blue-500/20 text-center">
                    <p class="text-[10px] text-blue-300 font-bold uppercase">Current CGPA</p>
                    <p class="text-2xl font-black text-white mt-1">{{ student.academics.cgpa }}</p>
                  </div>

                  <div class="p-3.5 bg-emerald-500/10 rounded-2xl border border-emerald-500/20 text-center">
                    <p class="text-[10px] text-emerald-300 font-bold uppercase">Active Backlogs</p>
                    <p class="text-2xl font-black text-white mt-1">{{ student.academics.backlogs }}</p>
                  </div>

                  <div class="p-3.5 bg-slate-950 rounded-2xl border border-slate-800 text-center">
                    <p class="text-[10px] text-slate-400 font-bold uppercase">Class 12th</p>
                    <p class="text-base font-bold text-slate-200 mt-1">{{ student.academics.twelfth }}%</p>
                  </div>

                  <div class="p-3.5 bg-slate-950 rounded-2xl border border-slate-800 text-center">
                    <p class="text-[10px] text-slate-400 font-bold uppercase">Class 10th</p>
                    <p class="text-base font-bold text-slate-200 mt-1">{{ student.academics.tenth }}%</p>
                  </div>
                </div>
              </div>

            </div>

            <!-- Right Column: Skills & Detailed Profile Overview -->
            <div class="lg:col-span-2 space-y-6">

              <!-- Technical & Soft Skills Card -->
              <div
                class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 shadow-xl">
                <h3 class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                  Technical & Professional Skills
                </h3>

                <div class="flex flex-wrap gap-2.5 pt-2">
                  <span v-for="(skill, index) in student.skills" :key="index"
                    class="px-3.5 py-2 bg-slate-950 border border-slate-800 text-blue-200 rounded-xl text-base font-semibold hover:border-blue-500/40 hover:text-white transition-all shadow-sm">
                    ⚡ {{ skill }}
                  </span>
                </div>
              </div>

              <!-- Placement Cell Clearance & Guidelines Card -->
              <div
                class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 shadow-xl">
                <h3 class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                  Placement Verification Status
                </h3>

                <div class="space-y-3 text-xs text-slate-300">
                  <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950 border border-slate-800">
                    <span class="font-medium">Academic Marksheets Verified</span>
                    <span class="text-emerald-400 font-bold">✓ Complete</span>
                  </div>

                  <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950 border border-slate-800">
                    <span class="font-medium">Resume Verification</span>
                    <span class="text-emerald-400 font-bold">✓ Approved</span>
                  </div>

                  <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-950 border border-slate-800">
                    <span class="font-medium">NOC / Eligibility Certificate</span>
                    <span class="text-blue-400 font-bold">Valid for 2026</span>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import Navbar from './navbar.vue';
import LeftSidesection from './leftsidesection.vue';
import axios from 'axios';

const user = ref({});
// for Resume
const currentResumeName = ref('');
const resumeUrl = ref('');

const router = useRouter();

const student = ref({
  firstName: '',
  lastName: '',
  rollNo: '2022BCA1024',
  branch: 'Bachelor of Computer Applications (BCA)',
  completedYear: 2026,
  placementStatus: 'Eligible for Drives',
  email: 'student@college.edu',
  phone: '+91 98765 43210',
  location: 'Surat, Gujarat',
  socials: {
    linkedin: 'https://linkedin.com',
    github: 'https://github.com'
  },
  academics: {
    cgpa: 'None',
    backlogs: '0',
    twelfth: 'None',
    tenth: 'None'
  },
  skills: [
    'JavaScript', 'Vue.js', 'PHP', 'MySQL', 'Tailwind CSS', 'Python', 'Git & GitHub', 'REST APIs'
  ]
});



onMounted(async () => {
  try {
    const res = await axios.get("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php", {
      withCredentials: true,
    });

    if (res.data && res.data.success && res.data.user) {
      user.value = res.data.user;
      student.value.email = user.value.email || student.value.email;
      student.value.phone = user.value.phone_number || student.value.phone;
      student.value.location = user.value.current_location || student.value.location;

      student.value.academics.cgpa = user.value.cgpa
      student.value.academics.backlogs = user.value.backlogs
      student.value.academics.twelfth = user.value.twelfth_percentage
      student.value.academics.tenth = user.value.tenth_percentage

      student.value.socials.github = user.value.github_url
      student.value.socials.linkedin = user.value.linkedin_url
      // console.log(user.value.skills)

      if(user.value.skills){
        student.value.skills = user.value.skills
      }

      // console.log(user.value)

      if (user.value.full_name) {
        const parts = user.value.full_name.trim().split(" ");
        student.value.firstName = parts[0];
        student.value.lastName = parts[1] || '';
      }
    }
  } catch (err) {
    console.log("User profile info fetch fallback");
  }

  resumeUrl.value = 'http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/' + user.value.resume_path
  // console.log(resumeUrl)
});
const downloadResume = () => {
  if (!resumeUrl.value) {
    alert("Resume not available");
    return;
  }
  window.open(resumeUrl.value, '_blank')

};
</script>