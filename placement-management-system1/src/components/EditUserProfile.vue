<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans flex flex-col relative overflow-x-hidden">
    <!-- Ambient Background Lighting -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
      <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] rounded-full bg-blue-600/15 blur-[140px] animate-[pulse_10s_ease-in-out_infinite]"></div>
      <div class="absolute top-[40%] right-[-10%] w-[35vw] h-[35vw] rounded-full bg-indigo-600/10 blur-[130px] animate-[pulse_12s_ease-in-out_infinite_2s]"></div>
    </div>

    <!-- Sticky Header Navbar -->
    <Navbar class="relative z-50" />

    <!-- Main Workspace Layout -->
    <div class="flex-1 flex flex-col md:flex-row relative z-10 overflow-hidden">
      <!-- Left Sidebar Navigation (Profile Active) -->
      <LeftSidesection activeTab="Profile" />

      <!-- Main Form Content Area -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto max-h-[calc(100vh-80px)] space-y-6">
        <div class="max-w-5xl mx-auto space-y-6">

            <!-- Breadcrumb / Back Link -->
            <div class="flex items-center justify-between">
                <router-link to="/profile">
                    <button class="cursor-pointer inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-blue-400 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Profile
                    </button>
                </router-link>
                <span class="text-xs text-slate-400">Edit Mode</span>
            </div>

            <!-- Page Title Card -->
            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl">
                <h1 class="text-2xl font-black text-white tracking-tight">Edit Your Student Profile</h1>
                <p class="text-slate-400 text-xs mt-1">Update your personal details, academic scores, skills, and resume visible to campus recruiters.</p>
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
                        <span v-html="tab.icon" class="w-4 h-4 shrink-0"
                            :class="activeFormTab === tab.id ? 'text-white' : 'text-blue-400'"></span>
                        {{ tab.name }}
                    </button>
                </div>

                <!-- Right: Form Area -->
                <div class="lg:col-span-3">
                    <form  @submit.prevent="saveProfile"
                        class="bg-slate-900/60 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-800 text-slate-100 overflow-hidden">

                        <!-- Header of Form Section -->
                        <div class="border-b border-slate-100 p-6">
                            <h2 class="text-lg font-bold text-slate-800">
                                {{formTabs.find(t => t.id === activeFormTab)?.name}}
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">Please fill out all relevant fields accurately.</p>
                        </div>

                        <!-- 1. PERSONAL INFORMATION FORM -->
                        <div v-show="activeFormTab === 'personal'" class="p-6 space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">First
                                        Name</label>
                                    <input type="text" v-model="student.firstName" required
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Last
                                        Name</label>
                                    <input type="text" v-model="student.lastName" required
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Roll
                                        Number</label>
                                    <input type="text" v-model="student.rollNo"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Branch</label>
                                    <select v-model="student.branch"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200">
                                        <option value="Computer Science & Engineering">Computer Science & Engineering
                                        </option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Electronics & Communication">Electronics & Communication</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Passing
                                        Batch (Year)</label>
                                    <input type="number" v-model="student.completedYear"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone
                                        Number</label>
                                    <input type="tel" v-model="student.phone"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Current
                                    Location</label>
                                <input type="text" v-model="student.location" placeholder="City, State"
                                    class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                            </div>

                            <hr class="border-slate-800" />

                            <!-- RESUME UPLOAD SECTION -->
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Resume (PDF)</label>

                                <!-- Show current uploaded resume info if available -->
                                <a :href="'http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/' + currentResumeName" target="_blank">
                                    <div v-if="currentResumeName" class="mt-2 flex items-center justify-between p-3.5 bg-slate-950 border border-blue-500/30 rounded-2xl shadow-md">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center border border-blue-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-white">Current Uploaded Resume</p>
                                                <p class="text-xs text-blue-300 font-semibold truncate max-w-[200px] sm:max-w-sm">{{ resumeName }}</p>
                                            </div>
                                        </div>
                                        <span class="text-[10px] bg-emerald-500/20 text-emerald-300 font-bold px-2.5 py-1 rounded-full border border-emerald-500/30 uppercase">Active PDF</span>
                                    </div>
                                </a>

                                <!-- Drag & Drop Zone -->
                                <div class="mt-3 relative border-2 border-dashed border-slate-700 hover:border-blue-500/50 bg-slate-950/60 hover:bg-slate-900/60 rounded-2xl p-6 transition-all duration-200 flex flex-col items-center justify-center text-center cursor-pointer">
                                    <input type="file" accept="application/pdf" @change="handleFileChange" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />

                                    <div class="space-y-2 pointer-events-none">
                                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mx-auto text-blue-400 shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>

                                        <div class="text-xs">
                                            <span v-if="!selectedFile" class="font-medium text-slate-300">
                                                <span class="text-blue-400 font-bold underline">Click to upload</span> or drag and drop new resume
                                            </span>
                                            <span v-else class="font-bold text-blue-300 block truncate max-w-[250px] sm:max-w-md">
                                                New file selected: {{ selectedFile.name }}
                                            </span>
                                            <p class="text-[11px] text-slate-400 mt-1">PDF format only (Max. 5MB).</p>
                                        </div>

                                        <div v-if="selectedFile" class="inline-flex items-center gap-1 bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[10px] px-2.5 py-0.5 rounded-full font-bold">
                                            Size: {{ (selectedFile.size / 1024 / 1024).toFixed(2) }} MB
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. ACADEMICS & SOCIALS FORM -->
                        <div v-show="activeFormTab === 'academics'" class="p-6 space-y-6">
                            <div>
                                <h3 class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-3">Academic Performance</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Current CGPA</label>
                                        <input type="text" v-model="student.academics.cgpa" class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Active Backlogs</label>
                                        <input type="number" v-model="student.academics.backlogs" class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Class 12th (%)</label>
                                        <input type="text" v-model="student.academics.twelfth" class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Class 10th (%)</label>
                                        <input type="text" v-model="student.academics.tenth" class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                    </div>
                                </div>
                            </div>

                            <hr class="border-slate-800" />

                            <!-- Social Profiles Row -->
                            <div>
                                <h3 class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-3">Social & Professional Links</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">LinkedIn URL</label>
                                        <div class="mt-1 flex rounded-xl shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-slate-800 bg-slate-950 text-slate-400 text-xs font-medium">
                                                <img src="../../public/linkedin.png" class="w-8 h-7 rounded-full"alt="">
                                            </span>
                                            <input type="text" v-model="student.socials.linkedin" class="block w-full min-w-0 rounded-r-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">GitHub Profile URL</label>
                                        <div class="mt-1 flex rounded-xl shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-slate-800 bg-slate-950 text-slate-400 text-xs font-medium">
                                                
                                                <img src="../../public/github.gif" class="w-8 h-7 rounded-full"alt="">
                                            </span>
                                            <input type="text" v-model="student.socials.github" class="block w-full min-w-0 rounded-r-xl border border-slate-800 bg-slate-950 px-3 py-2.5 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. SKILLS & PROJECTS FORM -->
                        <div v-show="activeFormTab === 'skills_projects'" class="p-6 space-y-6">

                            <!-- Skills Badge Input -->
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Technical & Soft Skills</label>
                                <div class="flex flex-wrap gap-2 p-3 bg-slate-950 border border-slate-800 rounded-2xl min-h-[55px] items-center">
                                    <span v-for="(skill, index) in student.skills" :key="index" class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-500/15 text-blue-300 border border-blue-500/30 rounded-xl text-xs font-bold shadow-sm">
                                        {{ skill }}
                                        <button type="button" @click="removeSkill(index)" class="cursor-pointer hover:text-white font-bold">&times;</button>
                                    </span>
                                    <input type="text" id="skillsinput" v-model="newSkillInput" @keydown.enter.prevent="addSkill" @keydown.comma.prevent="addSkill" placeholder="Type Skill & Press Enter" value="" class="flex-1 min-w-[140px] text-sm text-white placeholder-slate-500 bg-transparent focus:outline-none py-1" />
                                </div>
                                <p class="text-slate-400 text-[11px] mt-1.5">Press Enter or comma to create skill tag.</p>
                            </div>

                            <hr class="border-slate-800" />

                            <!-- Projects Manager -->
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Key Projects</label>
                                    <button type="button" @click="addNewProject" class="cursor-pointer inline-flex items-center gap-1.5 px-3.5 py-1.5 text-xs font-bold text-white bg-blue-600 hover:bg-blue-500 rounded-xl shadow-md transition-all active:scale-95">
                                        + Add Project
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <div v-for="(project, index) in student.projects" :key="index" class="p-4 border border-slate-800 bg-slate-950/80 rounded-2xl relative">
                                        <button type="button" @click="removeProject(index)" class="cursor-pointer absolute top-4 right-4 text-slate-400 hover:text-rose-400 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3 pr-8">
                                            <div>
                                                <label class="block text-xs text-slate-400 font-medium">Project Title</label>
                                                <input type="text" v-model="project.title" placeholder="Placement Portal" required class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                            </div>
                                            <div>
                                                <label class="block text-xs text-slate-400 font-medium">Tech Stack</label>
                                                <input type="text" v-model="project.techStack" placeholder="Vue 3, Node.js" required class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-xs text-slate-400 font-medium">Project Url | Link</label>
                                            <input type="text" v-model="project.link" placeholder="Project Url | Link" required class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none" />
                                        </div>
                                        <div>
                                            <label class="block text-xs text-slate-400 font-medium">Description</label>
                                            <textarea rows="2" v-model="project.description" placeholder="Project details..." required class="mt-1 block w-full rounded-xl border border-slate-800 bg-slate-950 px-3 py-2 text-xs text-white focus:border-blue-500 focus:outline-none"></textarea>
                                        </div>
                                    </div>

                                    <div v-if="student.projects.length === 0" class="text-center py-6 border border-dashed border-slate-800 rounded-2xl bg-slate-950/40">
                                        <p class="text-slate-400 text-xs font-semibold">No projects added yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sticky Footer Actions -->
                        <div class="border-t border-slate-800/80 p-6 bg-slate-950/80 flex items-center justify-between">
                            <Transition name="shake">
                                <div v-if="message" :class="[messageType === 'success' ? 'text-emerald-400 border border-emerald-500/30 bg-emerald-950/40' : 'text-rose-400 border border-rose-800 bg-rose-950/40']" class="message-banner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>{{ message }}</span>
                                </div>
                                <span v-else></span>
                            </Transition>

                            <div class="flex gap-3">
                                <router-link to="/profile">
                                    <button type="button" class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-800 bg-slate-900 hover:bg-slate-800 text-slate-300 text-xs font-bold transition-all">
                                        Cancel
                                    </button>
                                </router-link>
                                <button type="submit" :disabled="isSaving" class="cursor-pointer px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 disabled:opacity-50 text-white text-xs font-black shadow-lg shadow-blue-500/25 transition-all flex items-center gap-2">
                                    <svg v-if="isSaving" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    {{ saveButtonText }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRouter, RouterLink } from "vue-router";
import Navbar from './navbar.vue';
import LeftSidesection from './leftsidesection.vue';
import axios from 'axios'

const router = useRouter();



// Sidebar settings tabs
const activeFormTab = ref('personal')
const formTabs = [
    {
        id: 'personal',
        name: 'Personal Details',
        icon: `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>`
    },
    {
        id: 'academics',
        name: 'Academics & Socials',
        icon: `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>`
    },
    {
        id: 'skills_projects',
        name: 'Skills & Projects',
        icon: `<svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>`
    }
]
// msg
const messageType = ref("");
const message = ref("");

const showMessage = (text, type = "success", duration = 3000) => {
    message.value = text;
    messageType.value = type;

    setTimeout(() => {
        message.value = "";
    }, duration);
};

// State management
const isSaving = ref(false)
const saveSuccess = ref(false)
const newSkillInput = ref('')

// File Upload Specific States
const selectedFile = ref(null)
const currentResumeName = ref('')
const resumeName = ref('')
const saveButtonText = ref("Save Changes");
const originalStudent = ref(null);

// Initialize standard responsive mock state which maps onto your current profile components
const student = ref({
    firstName: '',
    lastName: '',
    rollNo: '',
    branch: '',
    completedYear: null,
    phone: '',
    location: '',
    resume_path:'',
    socials: {
        linkedin: '',
        github: ''
    },
    academics: {
        cgpa: '',
        backlogs: '0',
        twelfth: '',
        tenth: ''
    },
    skills: [],
    projects: []
})

// Skills modifier methods
const addSkill = () => {
    const cleanedSkill = newSkillInput.value.trim().replace(/,$/, '')

    if (cleanedSkill && !student.value.skills.includes(cleanedSkill)) {
        student.value.skills.push(cleanedSkill)
    }
    newSkillInput.value = ''
}

const removeSkill = (index) => {
    const a = student.value.skills.splice(index, 1)
    console.log(a)
    console.log(student.value)

}

// Projects modifiers methods
const addNewProject = () => {
    student.value.projects.push({
        title: '',
        techStack: '',
        link: '',
        description: ''
    })
}

const removeProject = (index) => {
    student.value.projects.splice(index, 1)
}

// File Upload Handler with local validation (PDF & size < 5MB)
const handleFileChange = (e) => {
    const file = e.target.files[0]
    if (!file) return

    if (file.type !== 'application/pdf') {
        alert('Only PDF files are supported.')
        e.target.value = '' // Clear input
        return
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('The resume file size must be less than 5 MB.')
        e.target.value = ''
        return
    }

    selectedFile.value = file
}

const clearSelectedFile = () => {
    selectedFile.value = null
}

// Fetch current values
onMounted(async () => {
    try {
        const res = await axios.get("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php", {
            withCredentials: true,
        });

        if (res.data.success) {
            const user = res.data.user;
            console.log(user)

            // Hydrating first name and last name split
            if (user.full_name) {
                const parts = user.full_name.split(" ");
                student.value.firstName = parts[0] || '';
                student.value.lastName = parts.slice(1).join(" ") || '';

            }

            // Set dynamic placeholders if backend returned empty
            // console.log(user)
            student.value.rollNo = user.roll_no || '2022CSE1024';
            student.value.branch = user.Branch || 'Computer Science & Engineering';
            student.value.completedYear = user.completed_year || 2026;
            student.value.phone = user.phone_number || '+91 98765 43210';
            student.value.location = user.current_location || 'Mumbai, Maharashtra';
            student.value.academics = user.academics || { cgpa: '8.92', backlogs: '0', twelfth: '92.4', tenth: '95.0' };
            student.value.skills = user.skills?? [''];
            
            // student.value.skills = user.skills;
            // student.resume_path = user.resume_path;
            // console.log(student.resume_path)
            
            student.value.projects = user.projects.map(project => ({
                title: project.ProjectTitle,
                techStack: project.TechStack,
                description: project.project_description,
                link: project.project_link
            }));
            
            // Load existing filename if saved on the user model (e.g. user.resume_name)
            currentResumeName.value = user.resume_path || 'Not available Any Resume';
            student.value.socials.github = user.github_url; //github
            student.value.socials.linkedin = user.linkedin_url; //linkedin

            student.value.academics.cgpa = user.cgpa
            student.value.academics.backlogs = user.backlogs
            student.value.academics.twelfth = user.twelfth_percentage
            student.value.academics.tenth = user.tenth_percentage
            // console.log(git)
            // console.log(student.value.academics)
            // const s = student.value.projects
            // console.log(s)

            
            resumeName.value = user.resume_path.split('/').pop().split('_').slice(2).join('_');
            // console.log(resumeName)
            // console.log(user.resume_path)
            // console.log(user.resume_path.split('/').pop().split('_'))
            // console.log(user.resume_path.split('/').pop().split('_').slice(2))
            // console.log(user.resume_path.split('/').pop().split('_').slice(2).join('_'))
            originalStudent.value = JSON.stringify(student.value);
            // console.log(originalStudent)
            // console.log(student.value)
        }
    } catch (err) {
        console.error("Error retrieving student database settings", err);
    }
})

// Save profile POST method using FormData for multi-part file uploads
const saveProfile = async () => {
    const currentStudent = JSON.stringify(student.value); //JSON.stringify()? :- It converts a JavaScript object into a string.
    if (currentStudent === originalStudent.value && !selectedFile.value) {

        showMessage("No changes detected.", "error");

        return;
    }

    isSaving.value = true
    saveSuccess.value = false
    saveButtonText.value = "Saving...";

    try {


        const formData = new FormData()

        // Append text fields
        formData.append('firstName', student.value.firstName)
        formData.append('lastName', student.value.lastName)
        formData.append('fullName', `${student.value.firstName} ${student.value.lastName}`.trim())
        formData.append('rollNo', student.value.rollNo)
        formData.append('branch', student.value.branch)
        formData.append('completedYear', student.value.completedYear)
        formData.append('phone', student.value.phone)
        formData.append('location', student.value.location)
        formData.append('cgpa',student.value.academics.cgpa)
        formData.append('backlogs',student.value.academics.backlogs)
        formData.append('twelfth',student.value.academics.twelfth)
        formData.append('tenth',student.value.academics.tenth)
        formData.append('github',student.value.socials.github)
        formData.append('linkedin',student.value.socials.linkedin)
        formData.append('skills',JSON.stringify(student.value.skills))
        formData.append('projects',JSON.stringify(student.value.projects))

        // formData.append('projects_title', JSON.stringify(student.value.projects.map(p => p.title)))
        // formData.append('projects_description', JSON.stringify(student.value.projects.map(p => p.description)))
        // formData.append('projects_link', JSON.stringify(student.value.projects.map(p => p.link)))
        // formData.append('projects_techStack', JSON.stringify(student.value.projects.map(p => p.techStack)))
        // formData.append('studentprofileId',student.value.studentprofileId)

        // // Serialize object data to JSON strings (so PHP $_POST receives readable strings)
        // formData.append('socials', JSON.stringify(student.value.socials))
        // formData.append('academics', JSON.stringify(student.value.academics))
        // formData.append('skills', JSON.stringify(student.value.skills))

        // Append the new PDF file to override the old file if chosen
        if (selectedFile.value) {
            formData.append('resume', selectedFile.value)
        }

        const res = await axios.post(
            "http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/updateUser.php",
            formData,
            {
                // headers: {
                //     'Content-Type': 'multipart/form-data'
                // },
                withCredentials: true
            }
        );
        // console.log(res.data)
        // console.log(res);

        if (res.data.success) {
            saveSuccess.value = true;

            showMessage("Profile updated successfully!", "success");
            saveButtonText.value = "Saving...";

            // Keep the button showing Saving... for 2 seconds
            await new Promise(resolve => setTimeout(resolve, 2000));

            saveButtonText.value = "Profile Updated ✓";

            // Show Profile Updated ✓ for 1.5 seconds
            await new Promise(resolve => setTimeout(resolve, 1500));

            saveButtonText.value = "Save Changes"
            console.log("Redirecting...");;

            router.push("/profile");

            // If we successfully saved a new file, update the active label and clear selection state
            // if (selectedFile.value) {
            //     currentResumeName.value = selectedFile.value.name
            //     // selectedFile.value = null
            // }





        }
    } catch (error) {
        console.error("Save operational system error:", error)
        showMessage(
            "Unable to update profile. Please try again.",
            "error"
        );
    } finally {
        isSaving.value = false
        if (!saveSuccess.value) {
            saveButtonText.value = "Save Changes";
        }
    }
}


</script>

<style scoped>
.shake-enter-active {
    animation: shake 0.5s ease;
}

@keyframes shake {

    0%,
    100% {
        transform: translateX(0);
    }

    20% {
        transform: translateX(-8px);
    }

    40% {
        transform: translateX(8px);
    }

    60% {
        transform: translateX(-5px);
    }

    80% {
        transform: translateX(5px);
    }
}

.message-banner {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
}

input[type="text"], input[type="email"], input[type="tel"], input[type="number"], input[type="url"], select, textarea {
    background-color: #020617 !important;
    border-color: #1e293b !important;
    color: #f8fafc !important;
}
input::placeholder, textarea::placeholder {
    color: #64748b !important;
}
#skillsinput::placeholder{
    color: #d7e8ff !important;
}
label {
    color: #94a3b8 !important;
}
h2, h3, h4 {
    color: #ffffff !important;
}
.border-b, .border-t, .border-slate-100, .border-slate-200 {
    border-color: #1e293b !important;
}
</style>