<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans flex flex-col relative overflow-x-hidden">
    
    <!-- Ambient Glowing Background Lights -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
      <!-- <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] rounded-full bg-blue-600/15 blur-[140px] animate-[pulse_10s_ease-in-out_infinite]"></div>
      <div class="absolute bottom-[-10%] left-[20%] w-[45vw] h-[45vw] rounded-full bg-teal-500/10 blur-[150px] animate-[pulse_14s_ease-in-out_infinite_4s]"></div>
      <div class="absolute top-[40%] right-[-10%] w-[35vw] h-[35vw] rounded-full bg-indigo-600/10 blur-[130px] animate-[pulse_12s_ease-in-out_infinite_2s]"></div> -->

      <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] rounded-full bg-blue-600/15 blur-[150px] "></div>
      <div class="absolute bottom-[-10%] left-[20%] w-[45vw] h-[45vw] rounded-full bg-teal-500/10 blur-[160px] "></div>
      <div class="absolute top-[40%] right-[-10%] w-[35vw] h-[35vw] rounded-full bg-indigo-600/10 blur-[140px] "></div>
    </div>

    <!-- Sticky Navbar Header -->
    <Navbar class="relative z-50" />

    <!-- Main Workspace Layout -->
    <div class="flex-1 flex flex-col md:flex-row relative z-10 overflow-hidden">
      <!-- Left Sidebar Navigation -->
      <LeftSidesection :activeTab="activeTab" />

      <!-- Main Dashboard Content Area -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto max-h-[calc(100vh-80px)] space-y-8">
        
        <!-- ================= TAB 1: DASHBOARD OVERVIEW ================= -->
        <div v-if="activeTab === 'Dashboard'" class="space-y-8 max-w-7xl mx-auto">
          <!-- Hero Welcome & Profile Banner -->
          <StudentHeroBanner 
            :student="student" 
            :drivesCount="drives.length" 
            :profileCompletion="profileCompletion" 
            @explore-drives="navigateToTab('Job Listing')" 
          />

          <!-- Quick Stats Cards Grid -->
          <StudentStatCards 
            :drivesCount="drives.length" 
            :applicationsCount="applications.length" 
            :shortlistedCount="shortlistedCount" 
            :offersCount="offersCount" 
          />

          <!-- Section: Drives + Notice Board -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <StudentFeaturedDrives 
              class="lg:col-span-2" 
              :drives="drives" 
              :totalDrives="drives.length" 
              :isApplied="isApplied" 
              @apply="applyForDrive" 
              @view-all="navigateToTab('Job Listing')" 
            />

            <StudentTpoNotices :notices="notices" />
          </div>

          <!-- Application Progress Stepper -->
          <StudentProgressStepper 
            :applications="applications" 
            :getStatusBadgeClass="getStatusBadgeClass" 
            @view-details="navigateToTab('My Application')" 
          />
        </div>

        <!-- ================= TAB 2: JOB LISTINGS ================= -->
        <StudentJobListings 
          v-else-if="activeTab === 'Job Listing'" 
          :filteredDrives="filteredDrives" 
          v-model:searchQuery="searchQuery" 
          :isApplied="isApplied" 
          @apply="applyForDrive" 
        />

        <!-- ================= TAB 3: MY APPLICATIONS ================= -->
        <StudentApplicationsTable 
          v-else-if="activeTab === 'My Application'" 
          :applications="applications" 
          :getStatusBadgeClass="getStatusBadgeClass" 
        />

        <!-- ================= TAB 4: RESET PASSWORD ================= -->
        <!-- <StudentResetPassword 
          v-else-if="activeTab === 'Reset Password'" 
        /> -->
        <StudentResetPassword 
          v-else-if="activeTab === 'Forget Password'" 
          
        />

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Navbar from './navbar.vue';
import LeftSidesection from './leftsidesection.vue';
import StudentHeroBanner from './student/StudentHeroBanner.vue';
import StudentStatCards from './student/StudentStatCards.vue';
import StudentFeaturedDrives from './student/StudentFeaturedDrives.vue';
import StudentTpoNotices from './student/StudentTpoNotices.vue';
import StudentProgressStepper from './student/StudentProgressStepper.vue';
import StudentJobListings from './student/StudentJobListings.vue';
import StudentApplicationsTable from './student/StudentApplicationsTable.vue';
// import StudentResetPassword from './student/StudentResetPassword.vue';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

const activeTab = ref('Dashboard');

function updateActiveTabFromRoute(path) {
  if (path === '/job-listings') {
    activeTab.value = 'Job Listing';
  } else if (path === '/my-applications') {
    activeTab.value = 'My Application';
  } else if (path === '/set-password' || path === '/reset-password' || path === '/forget-password') {
    // activeTab.value = 'Reset Password';
    activeTab.value = 'Forget Password';
  } else {
    activeTab.value = 'Dashboard';
  }
}

watch(() => route.path, (newPath) => {
  updateActiveTabFromRoute(newPath);
}, { immediate: true });

function navigateToTab(tabName) {
  if (tabName === 'Job Listing') {
    router.push('/job-listings');
  } else if (tabName === 'My Application') {
    router.push('/my-applications');
  }
  //  else if (tabName === 'Reset Password') {
  //   router.push('/set-password');
  // }
   else {
    router.push('/dashboard');
  }
}

const searchQuery = ref('');

const student = ref({
  name: 'Student',
  cgpa: '8.4',
  course: 'BCA Final Year'
});

const profileCompletion = ref(85);

const drives = ref([
  {
    id: 1,
    company: 'TechCorp Solutions',
    logoText: 'TC',
    role: 'Associate Software Engineer',
    ctc: '₹6.5 LPA',
    location: 'Bangalore / Remote',
    deadline: '15 Aug 2026',
    minCgpa: '7.0',
    branches: ['BCA', 'B.Tech', 'MCA'],
    description: 'We are hiring freshers for software development in Node.js, Vue.js, and Cloud Infrastructure.'
  },
  {
    id: 2,
    company: 'DataMetrics AI',
    logoText: 'DM',
    role: 'Junior Data Analyst',
    ctc: '₹5.8 LPA',
    location: 'Pune / Hyderabad',
    deadline: '20 Aug 2026',
    minCgpa: '6.5',
    branches: ['BCA', 'B.Sc IT', 'MCA'],
    description: 'Join our analytics team to build SQL dashboards, Python ML pipelines, and data reporting tools.'
  },
  {
    id: 3,
    company: 'CloudScale Inc.',
    logoText: 'CS',
    role: 'DevOps Trainee',
    ctc: '₹7.2 LPA',
    location: 'Mumbai / Onsite',
    deadline: '25 Aug 2026',
    minCgpa: '7.5',
    branches: ['B.Tech', 'MCA'],
    description: 'Looking for enthusiastic engineers familiar with Linux, Docker, CI/CD pipelines, and AWS.'
  }
]);

const applications = ref([
  {
    id: 101,
    driveId: 1,
    company: 'TechCorp Solutions',
    role: 'Associate Software Engineer',
    ctc: '₹6.5 LPA',
    appliedDate: '02 Aug 2026',
    status: 'Shortlisted for Interview',
    currentStep: 2
  },
  {
    id: 102,
    driveId: 2,
    company: 'DataMetrics AI',
    role: 'Junior Data Analyst',
    ctc: '₹5.8 LPA',
    appliedDate: '04 Aug 2026',
    status: 'Under Review',
    currentStep: 0
  }
]);

const notices = ref([
  {
    id: 1,
    category: 'Drive Update',
    date: 'Today',
    title: 'TechCorp Online Aptitude Round Link Released',
    content: 'All shortlisted BCA candidates check your registered email for exam link.'
  },
  {
    id: 2,
    category: 'Guideline',
    date: 'Yesterday',
    title: 'Resume Verification Deadline',
    content: 'Ensure your profile and updated resume PDF is uploaded before applying to CloudScale drive.'
  }
]);

const shortlistedCount = computed(() => applications.value.filter(a => a.status.includes('Shortlisted')).length);
const offersCount = computed(() => applications.value.filter(a => a.status.includes('Offer')).length);

const filteredDrives = computed(() => {
  if (!searchQuery.value.trim()) return drives.value;
  const q = searchQuery.value.toLowerCase();
  return drives.value.filter(d => 
    d.company.toLowerCase().includes(q) || 
    d.role.toLowerCase().includes(q)
  );
});

// function handleTabChange(tabName) {
  // navigateToTab(tabName);
// }

function isApplied(driveId) {
  return applications.value.some(a => a.driveId === driveId);
}

function applyForDrive(drive) {
  applications.value.push({
    id: Date.now(),
    driveId: drive.id,
    company: drive.company,
    role: drive.role,
    ctc: drive.ctc,
    appliedDate: new Date().toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' }),
    status: 'Under Review',
    currentStep: 0
  });
}

function getStatusBadgeClass(status) {
  if (status.includes('Offer') || status.includes('Selected')) {
    return 'bg-emerald-500/15 text-emerald-300 border-emerald-500/30';
  } else if (status.includes('Shortlisted') || status.includes('Interview')) {
    return 'bg-amber-500/15 text-amber-300 border-amber-500/30';
  } else if (status.includes('Rejected')) {
    return 'bg-rose-500/15 text-rose-300 border-rose-500/30';
  }
  return 'bg-blue-500/15 text-blue-300 border-blue-500/30';
}

onMounted(async () => {
  updateActiveTabFromRoute(route.path);
  try {
    const res = await axios.get("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php", {
      withCredentials: true
    });
    if (res.data && res.data.success && res.data.user) {
      student.value.name = res.data.user.full_name || student.value.name;
    }
  } catch(err) {
    console.log("Student user info fetch fallback");
  }
});
</script>
