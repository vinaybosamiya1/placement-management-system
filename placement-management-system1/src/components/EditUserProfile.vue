<template>
    <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto space-y-7">
            
            <!-- Breadcrumb / Back Link -->
            <div class="flex items-center justify-between">
                <router-link to="/profile">
                    <button class="cursor-pointer inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Profile
                    </button>
                </router-link>
                <span class="text-xs text-slate-400">Last updated: Just now</span>
            </div>

            <!-- Page Title -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-slate-800">Edit Your Profile</h1>
                <p class="text-slate-500 text-sm mt-1">Update your personal details, academic scores, skills, and projects visible to recruiters.</p>
            </div>

            <!-- Main Split Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                
                <!-- Left: Section Tabs -->
                <div class="lg:col-span-1 space-y-2">
                    <button v-for="tab in formTabs" :key="tab.id" @click="activeFormTab = tab.id"
                        class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
                        :class="activeFormTab === tab.id 
                            ? 'bg-indigo-50 text-indigo-700 font-semibold' 
                            : 'text-slate-600 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-100'">
                        <span v-html="tab.icon" class="w-5 h-5 shrink-0" :class="activeFormTab === tab.id ? 'text-indigo-600' : 'text-slate-400'"></span>
                        {{ tab.name }}
                    </button>
                </div>

                <!-- Right: Form Area -->
                <div class="lg:col-span-3">
                    <form @submit.prevent="saveProfile" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        
                        <!-- Header of Form Section -->
                        <div class="border-b border-slate-100 p-6">
                            <h2 class="text-lg font-bold text-slate-800">
                                {{ formTabs.find(t => t.id === activeFormTab)?.name }}
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">Please fill out all relevant fields accurately.</p>
                        </div>

                        <!-- 1. PERSONAL INFORMATION FORM -->
                        <div v-show="activeFormTab === 'personal'" class="p-6 space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">First Name</label>
                                    <input type="text" v-model="student.firstName" required
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Last Name</label>
                                    <input type="text" v-model="student.lastName" required
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Roll Number</label>
                                    <input type="text" v-model="student.rollNo"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Branch</label>
                                    <select v-model="student.branch"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200">
                                        <option value="Computer Science & Engineering">Computer Science & Engineering</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Electronics & Communication">Electronics & Communication</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Passing Batch (Year)</label>
                                    <input type="number" v-model="student.completedYear"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone Number</label>
                                    <input type="tel" v-model="student.phone"
                                        class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Current Location</label>
                                <input type="text" v-model="student.location" placeholder="City, State"
                                    class="mt-1 block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                            </div>

                            <hr class="border-slate-100" />

                            <!-- RESUME UPLOAD SECTION -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Resume (PDF)</label>
                                
                                <!-- Show current uploaded resume info if available -->
                                <div v-if="currentResumeName" class="mt-2 flex items-center justify-between p-3 bg-indigo-50/50 border border-indigo-100 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs font-semibold text-slate-700">Current Resume</p>
                                            <p class="text-xs text-indigo-600 truncate max-w-[200px] sm:max-w-sm">{{ currentResumeName }}</p>
                                        </div>
                                    </div>
                                    <span class="text-[10px] bg-indigo-100 text-indigo-700 font-bold px-2 py-0.5 rounded uppercase">Stored</span>
                                </div>

                                <!-- Drag & Drop / Click Zone -->
                                <div class="mt-3 relative border-2 border-dashed rounded-2xl p-6 transition-all duration-200 flex flex-col items-center justify-center text-center cursor-pointer"
                                    :class="selectedFile 
                                        ? 'border-indigo-500 bg-indigo-50/20' 
                                        : 'border-slate-200 hover:border-indigo-400 bg-slate-50/50 hover:bg-slate-50'">
                                    
                                    <input type="file" accept="application/pdf" @change="handleFileChange" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10" />
                                    
                                    <div class="space-y-2 pointer-events-none">
                                        <!-- PDF Icon Indicator -->
                                        <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mx-auto text-slate-400"
                                             :class="{ 'text-indigo-600': selectedFile }">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        
                                        <!-- File info or prompt -->
                                        <div class="text-xs">
                                            <span v-if="!selectedFile" class="font-medium text-slate-600">
                                                <span class="text-indigo-600 font-semibold underline">Click to upload</span> or drag and drop
                                            </span>
                                            <span v-else class="font-semibold text-indigo-700 block truncate max-w-[250px] sm:max-w-md">
                                                New file: {{ selectedFile.name }}
                                            </span>
                                            <p class="text-[11px] text-slate-400 mt-1">PDF format only (Max. 5MB). This will overwrite the old resume.</p>
                                        </div>

                                        <!-- Preview File Metadata if newly selected -->
                                        <div v-if="selectedFile" class="inline-flex items-center gap-1 bg-indigo-100/50 text-indigo-800 text-[10px] px-2.5 py-0.5 rounded-full font-semibold">
                                            Size: {{ (selectedFile.size / 1024 / 1024).toFixed(2) }} MB
                                            <button type="button" @click.stop.prevent="clearSelectedFile" class="ml-1 text-slate-500 hover:text-indigo-900 focus:outline-none font-bold text-xs pointer-events-auto">
                                                &times;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. ACADEMICS & SOCIALS FORM -->
                        <div v-show="activeFormTab === 'academics'" class="p-6 space-y-6">
                            
                            <!-- Academic Overview Row -->
                            <div>
                                <h3 class="text-sm font-semibold text-indigo-600 mb-3 uppercase tracking-wider">Academic Marks</h3>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Current CGPA</label>
                                        <input type="text" v-model="student.academics.cgpa"
                                            class="mt-1 block w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Active Backlogs</label>
                                        <input type="number" v-model="student.academics.backlogs"
                                            class="mt-1 block w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Class 12th (%)</label>
                                        <input type="text" v-model="student.academics.twelfth"
                                            class="mt-1 block w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">Class 10th (%)</label>
                                        <input type="text" v-model="student.academics.tenth"
                                            class="mt-1 block w-full rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                    </div>
                                </div>
                            </div>

                            <hr class="border-slate-100" />

                            <!-- Social Profiles Row -->
                            <div>
                                <h3 class="text-sm font-semibold text-indigo-600 mb-3 uppercase tracking-wider">Social Links</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">LinkedIn URL</label>
                                        <div class="mt-1 flex rounded-xl shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-slate-200 bg-slate-50 text-slate-500 text-sm">
                                                linkedin.com/in/
                                            </span>
                                            <input type="text" v-model="student.socials.linkedin"
                                                class="block w-full min-w-0 rounded-r-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-medium">GitHub Profile URL</label>
                                        <div class="mt-1 flex rounded-xl shadow-sm">
                                            <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-slate-200 bg-slate-50 text-slate-500 text-sm">
                                                github.com/
                                            </span>
                                            <input type="text" v-model="student.socials.github"
                                                class="block w-full min-w-0 rounded-r-xl border border-slate-200 px-3 py-2 text-sm text-slate-800 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none transition-all duration-200" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- 3. SKILLS & PROJECTS FORM -->
                        <div v-show="activeFormTab === 'skills_projects'" class="p-6 space-y-6">
                            
                            <!-- Skills Badge Input -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Technical & Soft Skills</label>
                                <div class="flex flex-wrap gap-2 p-3 border border-slate-200 rounded-xl min-h-[50px] items-center">
                                    <span v-for="(skill, index) in student.skills" :key="index"
                                        class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-semibold">
                                        {{ skill }}
                                        <button type="button" @click="removeSkill(index)" class="cursor-pointer hover:text-indigo-900 focus:outline-none font-bold">
                                            &times;
                                        </button>
                                    </span>
                                    <input type="text" v-model="newSkillInput" @keydown.enter.prevent="addSkill" @keydown.comma.prevent="addSkill"
                                        placeholder="Type skill and press Enter"
                                        class="flex-1 min-w-[120px] text-xs text-slate-800 placeholder-slate-400 focus:outline-none py-1" />
                                </div>
                                <p class="text-slate-400 text-[11px] mt-1.5">Press Enter or type a comma to generate a new tag.</p>
                            </div>

                            <hr class="border-slate-100" />

                            <!-- Dynamic Projects Manager -->
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Key Projects</label>
                                    <button type="button" @click="addNewProject"
                                        class="cursor-pointer inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 border border-indigo-100 rounded-lg hover:bg-indigo-100 transition-colors">
                                        + Add Project
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <div v-for="(project, index) in student.projects" :key="index" 
                                        class="p-4 border border-slate-100 bg-slate-50/50 rounded-xl relative group">
                                        
                                        <!-- Remove Project Button -->
                                        <button type="button" @click="removeProject(index)"
                                            class="cursor-pointer absolute top-4 right-4 text-slate-400 hover:text-rose-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3 pr-8">
                                            <div>
                                                <label class="block text-xs text-slate-400 font-medium">Project Title</label>
                                                <input type="text" v-model="project.title" placeholder="e.g. Placement Portal" required
                                                    class="mt-1 block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-indigo-500 focus:outline-none transition-all duration-200" />
                                            </div>
                                            <div>
                                                <label class="block text-xs text-slate-400 font-medium">Tech Stack Used</label>
                                                <input type="text" v-model="project.techStack" placeholder="e.g. Vue 3, Node.js" required
                                                    class="mt-1 block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-indigo-500 focus:outline-none transition-all duration-200" />
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-slate-400 font-medium">Short Description</label>
                                            <textarea rows="2" v-model="project.description" placeholder="Explain the key highlights of this project..." required
                                                class="mt-1 block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs text-slate-800 focus:border-indigo-500 focus:outline-none transition-all duration-200"></textarea>
                                        </div>
                                    </div>

                                    <!-- Empty State for Projects -->
                                    <div v-if="student.projects.length === 0" class="text-center py-6 border border-dashed border-slate-200 rounded-xl">
                                        <p class="text-slate-400 text-sm">No projects listed. Showcase your coding builds here.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Sticky Footer Actions -->
                        <div class="border-t border-slate-100 p-6 bg-slate-50/50 flex items-center justify-between">
                            <span v-if="saveSuccess" class="text-emerald-600 text-xs font-semibold flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Saved successfully!
                            </span>
                            <span v-else></span>

                            <div class="flex gap-3">
                                <button type="button" @click="goBack"
                                    class="cursor-pointer px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold transition-all">
                                    Cancel
                                </button>
                                <button type="submit" :disabled="isSaving"
                                    class="cursor-pointer px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white text-sm font-semibold shadow-sm transition-all flex items-center gap-2">
                                    <svg v-if="isSaving" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
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
import { ref, onMounted } from 'vue'
import axios from 'axios'

const goBack = () => {
    alert('Going back to profile view.')
}

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

// State management
const isSaving = ref(false)
const saveSuccess = ref(false)
const newSkillInput = ref('')

// File Upload Specific States
const selectedFile = ref(null)
const currentResumeName = ref('')

// Initialize standard responsive mock state which maps onto your current profile components
const student = ref({
    firstName: '',
    lastName: '',
    rollNo: '',
    branch: '',
    completedYear: null,
    phone: '',
    location: '',
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
    student.value.skills.splice(index, 1)
}

// Projects modifiers methods
const addNewProject = () => {
    student.value.projects.push({
        title: '',
        techStack: '',
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
            
            // Hydrating first name and last name split
            if (user.full_name) {
                const parts = user.full_name.split(" ");
                student.value.firstName = parts[0] || '';
                student.value.lastName = parts.slice(1).join(" ") || '';
            }
            
            // Set dynamic placeholders if backend returned empty
            student.value.rollNo = user.roll_no || '2022CSE1024';
            student.value.branch = user.branch || 'Computer Science & Engineering';
            student.value.completedYear = user.completed_year || 2026;
            student.value.phone = user.phone || '+91 98765 43210';
            student.value.location = user.location || 'Mumbai, Maharashtra';
            student.value.academics = user.academics || { cgpa: '8.92', backlogs: '0', twelfth: '92.4', tenth: '95.0' };
            student.value.skills = user.skills || ['JavaScript', 'Vue.js', 'Node.js', 'Tailwind CSS', 'Python'];
            student.value.projects = user.projects || [
                { title: 'College Placement Portal', techStack: 'Vue 3, Tailwind, Node.js', description: 'Developed a feature-rich portal helping college admin coordinate campus drives.' }
            ];

            // Load existing filename if saved on the user model (e.g. user.resume_name)
            currentResumeName.value = user.resume_name || 'resume_aarav.pdf';
        }
    } catch (err) {
        console.error("Error retrieving student database settings", err);
    }
})

// Save profile POST method using FormData for multi-part file uploads
const saveProfile = async () => {
    isSaving.value = true
    saveSuccess.value = false

    try {
        const formData = new FormData()
        
        // Append text fields
        formData.append('fullName', `${student.value.firstName} ${student.value.lastName}`.trim())
        formData.append('rollNo', student.value.rollNo)
        formData.append('branch', student.value.branch)
        formData.append('completedYear', student.value.completedYear)
        formData.append('phone', student.value.phone)
        formData.append('location', student.value.location)
        
        // Serialize object data to JSON strings (so PHP $_POST receives readable strings)
        formData.append('socials', JSON.stringify(student.value.socials))
        formData.append('academics', JSON.stringify(student.value.academics))
        formData.append('skills', JSON.stringify(student.value.skills))
        formData.append('projects', JSON.stringify(student.value.projects))

        // Append the new PDF file to override the old file if chosen
        if (selectedFile.value) {
            formData.append('resume', selectedFile.value)
        }

        const res = await axios.post(
            "http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/updateUser.php", 
            formData, 
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                withCredentials: true
            }
        );

        if (res.data.success) {
            saveSuccess.value = true
            
            // If we successfully saved a new file, update the active label and clear selection state
            if (selectedFile.value) {
                currentResumeName.value = selectedFile.value.name
                selectedFile.value = null
            }

            setTimeout(() => {
                saveSuccess.value = false
            }, 3000)
        }
    } catch (error) {
        console.error("Save operational system error:", error)
        alert('An unexpected error occurred while saving. Please try again.')
    } finally {
        isSaving.value = false
    }
}
</script>

<style scoped>
/* Optional custom CSS styles */
</style>