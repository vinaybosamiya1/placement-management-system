<script setup>
import { ref, computed } from 'vue';

const activeFilter = ref('All');
const filters = ['All', 'Shortlisted', 'Rejected', 'Selected'];

const applicants = ref([
  { id: 1, name: 'Rahul Sharma', email: 'rahul@example.com', degree: 'BCA', cgpa: '8.5', appliedFor: 'Associate Software Engineer', status: 'Under Review' },
  { id: 2, name: 'Priya Patel', email: 'priya@example.com', degree: 'MCA', cgpa: '9.2', appliedFor: 'Frontend Developer', status: 'Shortlisted' },
  { id: 3, name: 'Amit Kumar', email: 'amit@example.com', degree: 'B.Tech', cgpa: '7.8', appliedFor: 'Associate Software Engineer', status: 'Rejected' },
  { id: 4, name: 'Neha Singh', email: 'neha@example.com', degree: 'BCA', cgpa: '8.9', appliedFor: 'Data Analyst Intern', status: 'Selected' },
  { id: 5, name: 'Vikram Gupta', email: 'vikram@example.com', degree: 'MCA', cgpa: '8.1', appliedFor: 'Frontend Developer', status: 'Under Review' }
]);

const filteredApplicants = computed(() => {
  if (activeFilter.value === 'All') return applicants.value;
  return applicants.value.filter(a => {
    if (activeFilter.value === 'Selected' && a.status === 'Selected') return true;
    if (activeFilter.value === 'Rejected' && a.status === 'Rejected') return true;
    if (activeFilter.value === 'Shortlisted' && a.status === 'Shortlisted') return true;
    return false;
  });
});

const getStatusBadgeClass = (status) => {
  if (status === 'Selected') {
    return 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30';
  } else if (status === 'Shortlisted') {
    return 'bg-amber-500/15 text-amber-300 border-amber-500/30';
  } else if (status === 'Rejected') {
    return 'bg-rose-500/15 text-rose-300 border-rose-500/30';
  }
  return 'bg-blue-500/15 text-blue-300 border-blue-500/30';
};
</script>

<template>
  <div class="space-y-6 w-full max-w-7xl mx-auto">
    <!-- Page Header Card -->
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-xl">
      <div>
        <h2 class="text-2xl font-black text-white tracking-tight">Applicant Tracking</h2>
        <p class="text-xs text-slate-400 mt-1">Review and manage student applications for your job postings.</p>
      </div>
      <div class="flex items-center bg-slate-950/50 border border-slate-800 rounded-2xl px-4 py-2.5 w-full sm:w-auto shadow-inner">
        <i class="ri-search-line text-slate-400 mr-2 text-lg"></i>
        <input type="text" placeholder="Search by name, degree, or role..." class="bg-transparent border-none text-white text-sm font-medium focus:outline-none w-full sm:w-72 placeholder-slate-500">
      </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-3">
      <button 
        v-for="filter in filters" 
        :key="filter"
        @click="activeFilter = filter"
        :class="[
          'px-5 py-2.5 rounded-2xl text-xs font-black transition-all border shadow-sm',
          activeFilter === filter 
            ? 'bg-blue-500/15 text-blue-300 border-blue-500/30' 
            : 'bg-slate-900/60 text-slate-400 border-slate-800 hover:bg-slate-800 hover:text-slate-300'
        ]"
      >
        {{ filter }}
      </button>
    </div>

    <!-- Applicants Table Card -->
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-300">
          <thead class="bg-slate-950/80 text-slate-400 uppercase tracking-widest text-[10px] font-black border-b border-slate-800">
            <tr>
              <th class="p-5">Applicant Name</th>
              <th class="p-5">Academic Details</th>
              <th class="p-5">Applied Role</th>
              <th class="p-5">Status</th>
              <th class="p-5 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-800/60 font-medium">
            <tr v-for="applicant in filteredApplicants" :key="applicant.id" class="hover:bg-slate-800/40 transition-colors">
              <td class="p-5">
                <div class="flex items-center gap-3">
                  <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-900 to-blue-600 flex items-center justify-center text-white font-bold shadow-inner">
                    {{ applicant.name.charAt(0) }}
                  </div>
                  <div>
                    <div class="font-extrabold text-white text-sm">{{ applicant.name }}</div>
                    <div class="text-slate-400 text-[11px] mt-0.5">{{ applicant.email }}</div>
                  </div>
                </div>
              </td>
              <td class="p-5">
                <div class="font-bold text-white text-sm">{{ applicant.degree }}</div>
                <div class="text-slate-400 text-[11px] mt-0.5">CGPA: <span class="text-blue-300 font-bold">{{ applicant.cgpa }}</span></div>
              </td>
              <td class="p-5 text-slate-300 font-bold">{{ applicant.appliedFor }}</td>
              <td class="p-5">
                <span :class="getStatusBadgeClass(applicant.status)" class="px-3 py-1 rounded-full border text-[11px] font-extrabold shadow-sm inline-block">
                  {{ applicant.status }}
                </span>
              </td>
              <td class="p-5 text-right">
                <div class="flex items-center justify-end gap-2">
                  <button class="w-8 h-8 rounded-xl bg-slate-800/50 text-slate-400 hover:text-white hover:bg-slate-700 border border-slate-700/50 flex items-center justify-center transition-all" title="View Resume">
                    <i class="ri-file-text-line"></i>
                  </button>
                  <button class="w-8 h-8 rounded-xl bg-slate-800/50 text-slate-400 hover:text-white hover:bg-slate-700 border border-slate-700/50 flex items-center justify-center transition-all" title="Update Status">
                    <i class="ri-more-2-fill"></i>
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="filteredApplicants.length === 0">
              <td colspan="5" class="p-12 text-center text-slate-500">
                <i class="ri-inbox-line text-4xl mb-3 block opacity-50"></i>
                <p class="font-medium text-sm">No applicants found for the selected filter.</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
