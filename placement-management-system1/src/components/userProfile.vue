<template>
    <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-7">

            <!-- Header / Profile Summary Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <!-- Avatar -->
                        <div
                            class="relative w-24 h-24 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold uppercase shadow-inner">
                            {{ student.firstName[0] }}{{ student.lastName[0] }}
                            <!-- <span class="absolute bottom-1 right-1 w-4 h-4 rounded-full border-2 border-white"
                                :class="statusColorClass"></span> -->
                        </div>
                        <!-- Name & Basic Info -->
                        <div class="text-center sm:text-left">
                            <div class="flex flex-wrap justify-center sm:justify-start items-center gap-2">
                                <h1 class="text-2xl justify-center text-center font-bold text-slate-800">{{ student.firstName }} {{student.lastName }}</h1>
                                <!-- <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold"
                                    :class="statusBadgeClass">
                                    {{ student.placementStatus }}
                                </span> -->
                            </div>
                            <p class="text-slate-500 text-sm mt-1">{{ student.branch }} | Batch of {{ student.completedYear }}</p>
                            <!-- <p class="text-slate-400 text-xs mt-1">Roll No: {{ student.rollNo }}</p> -->
                        </div>

                    </div>
                    <!-- Action Buttons -->
                    <!-- <div class="flex flex-wrap justify-center md:justify-end gap-3"> -->
                    <div class="flex flex-wrap justify-center gap-3">
                        <button @click="downloadResume"
                            class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Resume.pdf
                        </button>
                        <button @click="toggleEdit"
                            class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Contact & Quick Links -->
                <div class="space-y-6">
                    <!-- Contact Details Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Contact
                            Information</h2>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm truncate">{{ student.email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm">{{ student.phone }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400 shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">{{ student.location }}</span>
                            </div>
                        </div>

                        <!-- Social/Professional Links -->
                        <div class="border-t border-slate-100 mt-6 pt-6 space-y-3">
                            <a :href="student.socials.linkedin" target="_blank"
                                class="flex items-center gap-3 text-slate-600 hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                                <span class="text-sm font-medium">LinkedIn Profile</span>
                            </a>
                            <a :href="student.socials.github" target="_blank"
                                class="flex items-center gap-3 text-slate-600 hover:text-slate-900 transition-colors">
                                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                                </svg>
                                <span class="text-sm font-medium">GitHub Repository</span>
                            </a>
                        </div>
                    </div>

                    <!-- Academic Performance Overview -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Academic Summary</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-indigo-50/50 rounded-xl border border-indigo-100/50 text-center">
                                <p class="text-xs text-slate-500 font-medium uppercase">Current CGPA</p>
                                <p class="text-2xl font-bold text-indigo-600 mt-1">{{ student.academics.cgpa }}</p>
                            </div>
                            <div class="p-4 bg-emerald-50/50 rounded-xl border border-emerald-100/50 text-center">
                                <p class="text-xs text-slate-500 font-medium uppercase">Backlogs</p>
                                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ student.academics.backlogs }}</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                <p class="text-xs text-slate-500 font-medium uppercase">Class 12th</p>
                                <p class="text-lg font-semibold text-slate-700 mt-1">{{ student.academics.twelfth }}%
                                </p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-center">
                                <p class="text-xs text-slate-500 font-medium uppercase">Class 10th</p>
                                <p class="text-lg font-semibold text-slate-700 mt-1">{{ student.academics.tenth }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Academic details, Projects & Job Tracking -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Tab Navigation -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-2 flex gap-1">
                        <button v-for="tab in tabs" :key="tab.id" @click="activeTab = tab.id"
                            class="cursor-pointer flex-1 py-2 px-3 text-sm font-medium rounded-xl transition-all duration-200"
                            :class="activeTab === tab.id ? 'bg-indigo-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50'">
                            {{ tab.name }}
                        </button>
                    </div>

                    <!-- Tab Content 1: Overview & Projects -->
                    <div v-if="activeTab === 'profile'" class="space-y-6">
                        <!-- Key Skills Card -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4">Technical & Soft Skills</h3>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="(skill, index) in student.skills" :key="index"
                                    class="px-3 py-2 bg-slate-100 text-slate-700 rounded-lg text-xs font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    {{ skill }}
                                </span>
                            </div>
                        </div>

                        <!-- Projects Section -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            
                            <h3 class="text-lg font-semibold text-slate-800 mb-4">Key Projects</h3>

                            <div class="space-y-6">
                                <div v-for="(project, index) in student.projects" :key="index" class="relative pl-6 border-l-2 border-indigo-100 group">
                                    <div class="absolute -left-1.5 top-1.5 w-2.5 h-2.5 rounded-full bg-indigo-500 group-hover:scale-125 transition-transform"></div>
                                    <div class="flex justify-between items-start gap-4">
                                        <h4 class="font-semibold text-slate-800 text-base">{{ project.title }}</h4>
                                        <span class="text-xs text-indigo-600 font-medium bg-indigo-50 px-2 py-0.5 rounded">{{project.techStack }}</span>
                                    </div>
                                    <p class="text-slate-500 text-sm mt-1.5 leading-relaxed">{{ project.description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content 2: Application Tracker -->
                    <!-- <div v-if="activeTab === 'applications'" class="space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-slate-800">Job Applications</h3>
                                <span
                                    class="text-xs text-indigo-600 font-semibold bg-indigo-50 px-2.5 py-1 rounded-full">
                                    {{ student.applications.length }} Active
                                </span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr
                                            class="border-b border-slate-100 text-xs text-slate-400 uppercase tracking-wider font-semibold">
                                            <th class="pb-3 font-medium">Company</th>
                                            <th class="pb-3 font-medium">Role</th>
                                            <th class="pb-3 font-medium">Applied Date</th>
                                            <th class="pb-3 font-medium text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <tr v-for="(app, index) in student.applications" :key="index"
                                            class="group hover:bg-slate-50/50 transition-colors">
                                            <td
                                                class="py-4 font-semibold text-slate-800 text-sm flex items-center gap-2">
                                                <span
                                                    class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-bold text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors text-xs">
                                                    {{ app.company[0] }}
                                                </span>
                                                {{ app.company }}
                                            </td>
                                            <td class="py-4 text-slate-600 text-sm">{{ app.role }}</td>
                                            <td class="py-4 text-slate-400 text-xs">{{ app.appliedDate }}</td>
                                            <td class="py-4 text-right">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold"
                                                    :class="getAppStatusClass(app.status)">
                                                    {{ app.status }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'

// Active Tab management
const activeTab = ref('profile')
const tabs = [
    { id: 'profile', name: 'Profile Overview' },
    // { id: 'applications', name: 'Applications Track' }
]

// Mock data structured to easily integrate with an API later
const student = ref({
    firstName: 'Aarav',
    lastName: 'Sharma',
    rollNo: '2022CSE1024',
    branch: 'Computer Science & Engineering',
    completedYear: 2026,
    placementStatus: 'Placed', // Options: 'Placed', 'Eligible', 'Unplaced', 'In-Process'
    email: 'aarav.sharma@college.edu',
    phone: '+91 98765 43210',
    location: 'Mumbai, Maharashtra',
    socials: {
        linkedin: 'https://linkedin.com',
        github: 'https://github.com'
    },
    academics: {
        cgpa: '8.92',
        backlogs: '0',
        twelfth: '92.4',
        tenth: '95.0'
    },
    skills: [
        'JavaScript', 'Vue.js', 'Node.js', 'Tailwind CSS', 'Python', 'SQL', 'Git & GitHub', 'Data Structures'
    ],
    // projects: [
    //     {
    //         title: 'College Placement Portal',
    //         techStack: 'Vue 3, Tailwind, Node.js',
    //         description: 'Developed a feature-rich portal helping college admin coordinate coordinate campus drives and enabling students to streamline job applications.'
    //     },
    //     {
    //         title: 'E-Commerce Analytics Engine',
    //         techStack: 'Python, Flask, PostgreSQL',
    //         description: 'Engineered a dashboard utilizing modern REST APIs to retrieve and analyze localized product prices and buyer reviews.'
    //     }
    // ],
    
    // applications: [
    //     { company: 'Google', role: 'Software Engineering Intern', appliedDate: 'Feb 12, 2026', status: 'In Interview' },
    //     { company: 'Microsoft', role: 'SWE - DevDiv', appliedDate: 'Jan 24, 2026', status: 'Offered' },
    //     { company: 'Stripe', role: 'Frontend Engineer', appliedDate: 'Dec 15, 2025', status: 'Applied' },
    //     { company: 'Uber', role: 'Systems Engineer', appliedDate: 'Nov 02, 2025', status: 'Rejected' }
    // ]
})

// Placement Status colors mapping
const statusBadgeClass = computed(() => {
    const status = student.value.placementStatus
    if (status === 'Placed') return 'bg-emerald-50 text-emerald-700 border border-emerald-100'
    if (status === 'In-Process') return 'bg-amber-50 text-amber-700 border border-amber-100'
    if (status === 'Eligible') return 'bg-indigo-50 text-indigo-700 border border-indigo-100'
    return 'bg-slate-50 text-slate-700 border border-slate-100'
})

const statusColorClass = computed(() => {
    const status = student.value.placementStatus
    if (status === 'Placed') return 'bg-emerald-500'
    if (status === 'In-Process') return 'bg-amber-500'
    if (status === 'Eligible') return 'bg-indigo-500'
    return 'bg-slate-400'
})

// Dynamic class evaluator for table applications
const getAppStatusClass = (status) => {
    if (status === 'Offered') return 'bg-emerald-50 text-emerald-700'
    if (status === 'In Interview') return 'bg-blue-50 text-blue-700'
    if (status === 'Applied') return 'bg-slate-100 text-slate-600'
    if (status === 'Rejected') return 'bg-rose-50 text-rose-600'
    return 'bg-slate-50 text-slate-500'
}

// Dummy handler definitions
const toggleEdit = () => {
    alert('Trigger edit modal/navigation from here.')
}

const downloadResume = () => {
    alert('Initiate file download or open PDF link here.')
}
</script>

<style scoped>
/* Scoped custom animations or scroll behaviors can go here */
</style>