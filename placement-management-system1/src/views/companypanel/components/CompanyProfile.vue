<template>
  <div class="max-w-7xl mx-auto space-y-6">
    <!-- Breadcrumb / Back Link (Only in Edit Mode) -->
    <div v-if="isEditing" class="flex items-center justify-between">
      <button @click="isEditing = false" class="cursor-pointer inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-blue-400 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to Profile
      </button>
      <span class="text-xs text-slate-400">Edit Mode</span>
    </div>

    <!-- VIEW MODE -->
    <div v-if="!isEditing" class="space-y-6">
      <!-- Header / Profile Summary Banner Card -->
      <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
          <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">
            <!-- Company Avatar -->
            <div class="w-24 h-24 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 border border-white/20 flex items-center justify-center text-white text-4xl font-black uppercase shadow-xl flex-shrink-0">
              {{ companyData.name.charAt(0) }}
            </div>
            
            <!-- Name & Industry -->
            <div>
              <div class="flex flex-wrap justify-center sm:justify-start items-center gap-3">
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                  {{ companyData.name }}
                </h1>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
                  Verified Employer
                </span>
              </div>
              <p class="text-slate-300 text-sm mt-1">{{ companyData.industry }}</p>
              <p class="text-slate-400 text-xs mt-0.5">
                <a :href="companyData.website" target="_blank" class="hover:text-blue-400 transition-colors">{{ companyData.website }}</a>
              </p>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-wrap justify-center gap-3">
            <button @click="isEditing = true" class="cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-xl shadow-lg shadow-blue-500/25 transition-all active:scale-95">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit Profile
            </button>
          </div>
        </div>
      </div>

      <!-- Main Layout Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Contact & Quick Info -->
        <div class="space-y-6">
          <!-- Contact Info Card -->
          <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 space-y-4 shadow-xl">
            <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest">HR Contact Details</h2>

            <div class="space-y-3.5 text-xs">
              <div class="flex items-center gap-3 text-slate-300">
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <span class="truncate font-semibold">{{ companyData.hrName }}</span>
              </div>
              
              <div class="flex items-center gap-3 text-slate-300">
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
                <span class="truncate font-semibold">{{ companyData.hrEmail }}</span>
              </div>

              <div class="flex items-center gap-3 text-slate-300">
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                </div>
                <span class="font-semibold">{{ companyData.hrPhone }}</span>
              </div>

              <div class="flex items-center gap-3 text-slate-300">
                <div class="w-8 h-8 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center flex-shrink-0 border border-blue-500/20">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <span class="font-semibold">{{ companyData.location }}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column: Details & Overview -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Description Card -->
          <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 space-y-4 shadow-xl">
            <h3 class="text-lg font-extrabold text-white tracking-tight flex items-center gap-2">
              <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
              About Company
            </h3>
            <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
              {{ companyData.description }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- EDIT MODE -->
    <div v-else class="space-y-6">
      <!-- Page Title Card -->
      <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
          <h1 class="text-2xl font-black text-white tracking-tight">Edit Company Profile</h1>
          <p class="text-slate-400 text-xs mt-1">Update your company details and recruiter contact information.</p>
      </div>

      <!-- Main Split Layout -->
      <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
          <!-- Left: Section Tabs -->
          <div class="lg:col-span-1 space-y-2">
              <button v-for="tab in formTabs" :key="tab.id" @click="activeFormTab = tab.id"
                  class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition-all duration-200 cursor-pointer"
                  :class="activeFormTab === tab.id
                      ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-extrabold shadow-lg shadow-blue-500/20'
                      : 'bg-slate-900/40 text-slate-300 border border-slate-800/80 hover:bg-slate-800/80 hover:text-white'">
                  <span v-html="tab.icon" class="w-4 h-4 shrink-0" :class="activeFormTab === tab.id ? 'text-white' : 'text-blue-400'"></span>
                  {{ tab.name }}
              </button>
          </div>

          <!-- Right: Form Area -->
          <div class="lg:col-span-3">
              <form @submit.prevent="saveProfile" class="bg-slate-900/60 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-800 text-slate-100 overflow-hidden">
                  
                  <!-- Header of Form Section -->
                  <div class="border-b border-slate-800 p-6 bg-slate-950/40">
                      <h2 class="text-lg font-bold text-white">
                          {{ formTabs.find(t => t.id === activeFormTab)?.name }}
                      </h2>
                      <p class="text-xs text-slate-400 mt-0.5">Please fill out all relevant fields accurately.</p>
                  </div>

                  <!-- 1. COMPANY INFORMATION FORM -->
                  <div v-show="activeFormTab === 'company'" class="p-6 space-y-6">
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Company Name</label>
                              <input type="text" v-model="companyData.name" required
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Industry</label>
                              <input type="text" v-model="companyData.industry" required
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                      </div>

                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Website</label>
                              <input type="url" v-model="companyData.website"
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Headquarters Location</label>
                              <input type="text" v-model="companyData.location" placeholder="City, State"
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                      </div>

                      <div>
                          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">About Company</label>
                          <textarea rows="4" v-model="companyData.description"
                              class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200 resize-y"></textarea>
                      </div>
                  </div>

                  <!-- 2. HR CONTACT FORM -->
                  <div v-show="activeFormTab === 'hr'" class="p-6 space-y-6">
                      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">HR Manager Name</label>
                              <input type="text" v-model="companyData.hrName" required
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                          <div>
                              <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Contact Number</label>
                              <input type="tel" v-model="companyData.hrPhone" required
                                  class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                          </div>
                      </div>

                      <div>
                          <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Email Address</label>
                          <input type="email" v-model="companyData.hrEmail" required
                              class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none transition-all duration-200" />
                      </div>
                  </div>

                  <!-- Sticky Footer Actions -->
                  <div class="border-t border-slate-800 p-6 bg-slate-950/80 flex items-center justify-between">
                      <div v-if="message" class="flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                          <span>{{ message }}</span>
                      </div>
                      <span v-else></span>

                      <div class="flex gap-3">
                          <button type="button" @click="isEditing = false" class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-800 bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-bold transition-all">
                              Cancel
                          </button>
                          <button type="submit" :disabled="isSaving" class="cursor-pointer px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 disabled:opacity-50 text-white text-xs font-black shadow-lg shadow-blue-500/25 transition-all flex items-center gap-2">
                              <svg v-if="isSaving" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                              {{ isSaving ? 'Saving...' : 'Save Changes' }}
                          </button>
                      </div>
                  </div>

              </form>
          </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isEditing = ref(false);
const isSaving = ref(false);
const message = ref('');

const companyData = ref({
  name: 'Acme Corporation',
  industry: 'Technology & Software',
  website: 'https://acmecorp.example.com',
  location: 'San Francisco, CA',
  description: 'Acme Corporation is a leading provider of innovative software solutions. We specialize in developing cutting-edge platforms that empower businesses to scale securely.',
  hrName: 'Anjali Desai',
  hrEmail: 'hr@acmecorp.example.com',
  hrPhone: '+1 (555) 123-4567'
});

const activeFormTab = ref('company');

const formTabs = [
    {
        id: 'company',
        name: 'Company Details',
        icon: `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>`
    },
    {
        id: 'hr',
        name: 'HR Contact Info',
        icon: `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>`
    }
];

const saveProfile = async () => {
    isSaving.value = true;
    
    // Simulate API call
    setTimeout(() => {
        isSaving.value = false;
        message.value = 'Profile updated successfully!';
        
        setTimeout(() => {
            message.value = '';
            isEditing.value = false;
        }, 2000);
    }, 1000);
};
</script>
