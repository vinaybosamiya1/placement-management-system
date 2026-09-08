<script setup>
import { ref } from 'vue';

const activeTab = ref('myJobs');

const jobs = ref([
  { id: 1, title: 'Associate Software Engineer', type: 'Full Time', ctc: '6.5 LPA', location: 'Bangalore / Remote', deadline: '15 Aug 2026', applicants: 142, status: 'Active' },
  { id: 2, title: 'Frontend Developer', type: 'Full Time', ctc: '8.0 LPA', location: 'Pune', deadline: '20 Aug 2026', applicants: 85, status: 'Active' },
  { id: 3, title: 'Data Analyst Intern', type: 'Internship', ctc: '30k / month', location: 'Remote', deadline: '05 Aug 2026', applicants: 210, status: 'Closed' }
]);

const newJob = ref({
  title: '',
  type: 'Full Time',
  ctc: '',
  location: '',
  deadline: '',
  description: ''
});

const submitJob = () => {
  console.log('Posting job...', newJob.value);
  activeTab.value = 'myJobs';
};
</script>

<template>
  <div class="jobs-container">
    <div class="page-header">
      <div>
        <h2>Job Management</h2>
        <p>Create and manage your placement drives and job postings.</p>
      </div>
      <div class="tabs">
        <button class="tab-btn" :class="{ active: activeTab === 'myJobs' }" @click="activeTab = 'myJobs'">
          <i class="ri-briefcase-line"></i> My Jobs
        </button>
        <button class="tab-btn" :class="{ active: activeTab === 'postJob' }" @click="activeTab = 'postJob'">
          <i class="ri-add-line"></i> Post New Job
        </button>
      </div>
    </div>

    <!-- My Jobs View -->
    <div v-if="activeTab === 'myJobs'" class="jobs-list fade-in">
      <div v-for="job in jobs" :key="job.id" class="job-card">
        <div class="job-header">
          <div class="job-title-group">
            <h3>{{ job.title }}</h3>
            <span class="status-badge" :class="job.status === 'Active' ? 'active' : 'closed'">{{ job.status }}</span>
          </div>
          <div class="job-actions">
            <button class="icon-btn" title="Edit Job"><i class="ri-pencil-line"></i></button>
            <button class="icon-btn text-red" title="Close Job"><i class="ri-stop-circle-line"></i></button>
          </div>
        </div>
        
        <div class="job-meta">
          <span><i class="ri-map-pin-line"></i> {{ job.location }}</span>
          <span><i class="ri-money-rupee-circle-line"></i> {{ job.ctc }}</span>
          <span><i class="ri-time-line"></i> {{ job.type }}</span>
        </div>
        
        <div class="job-footer">
          <div class="deadline">
            <i class="ri-calendar-event-line"></i> Deadline: <strong>{{ job.deadline }}</strong>
          </div>
          <div class="applicants-count">
            <i class="ri-group-line"></i> {{ job.applicants }} Applicants
          </div>
          <button class="btn-outline btn-small">View Candidates</button>
        </div>
      </div>
    </div>

    <!-- Post Job Form -->
    <div v-if="activeTab === 'postJob'" class="post-job-form fade-in">
      <div class="form-card">
        <h3 class="card-title">Job Details</h3>
        <div class="grid-2-col">
          <div class="form-group col-span-2">
            <label>Job Title / Role</label>
            <input type="text" v-model="newJob.title" class="form-input" placeholder="e.g. Associate Software Engineer">
          </div>
          <div class="form-group">
            <label>Job Type</label>
            <select v-model="newJob.type" class="form-input">
              <option>Full Time</option>
              <option>Internship</option>
              <option>Contract</option>
            </select>
          </div>
          <div class="form-group">
            <label>Package (CTC) / Stipend</label>
            <input type="text" v-model="newJob.ctc" class="form-input" placeholder="e.g. 6.5 LPA">
          </div>
          <div class="form-group">
            <label>Location</label>
            <input type="text" v-model="newJob.location" class="form-input" placeholder="e.g. Bangalore / Remote">
          </div>
          <div class="form-group">
            <label>Application Deadline</label>
            <input type="date" v-model="newJob.deadline" class="form-input">
          </div>
          <div class="form-group col-span-2">
            <label>Job Description & Requirements</label>
            <textarea v-model="newJob.description" class="form-input" rows="5" placeholder="Enter roles, responsibilities, and eligibility criteria..."></textarea>
          </div>
        </div>
        
        <div class="form-actions mt-4">
          <button @click="activeTab = 'myJobs'" class="btn-secondary">Cancel</button>
          <button @click="submitJob" class="btn-primary">Post Job</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.jobs-container {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.fade-in {
  animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.page-header h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #fff;
  margin: 0 0 0.25rem 0;
}

.page-header p {
  color: #9ca3af;
  font-size: 0.9rem;
  margin: 0;
}

.tabs {
  display: flex;
  background: rgba(17, 24, 39, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 10px;
  padding: 0.25rem;
}

.tab-btn {
  background: transparent;
  color: #9ca3af;
  border: none;
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.2s;
}

.tab-btn.active {
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.tab-btn:hover:not(.active) {
  color: #e5e7eb;
}

/* My Jobs List */
.jobs-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
  gap: 1.5rem;
}

.job-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.5rem;
  transition: transform 0.2s, border-color 0.2s;
}

.job-card:hover {
  transform: translateY(-3px);
  border-color: rgba(59, 130, 246, 0.3);
}

.job-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
}

.job-title-group h3 {
  font-size: 1.15rem;
  font-weight: 600;
  color: #fff;
  margin: 0 0 0.5rem 0;
}

.status-badge {
  font-size: 0.7rem;
  padding: 0.2rem 0.6rem;
  border-radius: 20px;
  font-weight: 600;
  text-transform: uppercase;
}

.status-badge.active {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-badge.closed {
  background: rgba(156, 163, 175, 0.15);
  color: #9ca3af;
  border: 1px solid rgba(156, 163, 175, 0.3);
}

.job-actions {
  display: flex;
  gap: 0.5rem;
}

.icon-btn {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #d1d5db;
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}

.icon-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
}

.icon-btn.text-red:hover {
  background: rgba(239, 68, 68, 0.15);
  color: #ef4444;
  border-color: rgba(239, 68, 68, 0.3);
}

.job-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.job-meta span {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.85rem;
  color: #9ca3af;
}

.job-meta i {
  color: #60a5fa;
}

.job-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 1.25rem;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.deadline, .applicants-count {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.85rem;
  color: #d1d5db;
}

.applicants-count i {
  color: #f59e0b;
}

.btn-outline {
  background: transparent;
  color: #60a5fa;
  border: 1px solid rgba(59, 130, 246, 0.5);
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-outline:hover {
  background: rgba(59, 130, 246, 0.15);
}

/* Post Job Form */
.post-job-form {
  max-width: 800px;
}

.form-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 2rem;
}

.card-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #e5e7eb;
  margin: 0 0 1.5rem 0;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.grid-2-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.col-span-2 {
  grid-column: span 2;
}

.form-group label {
  display: block;
  font-size: 0.8rem;
  color: #9ca3af;
  margin-bottom: 0.5rem;
}

.form-input {
  width: 100%;
  background: rgba(10, 15, 28, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 0.8rem 1rem;
  color: #fff;
  font-family: inherit;
  font-size: 0.95rem;
  transition: border-color 0.2s, box-shadow 0.2s;
  box-sizing: border-box;
}

.form-input:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

select.form-input {
  appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 1em;
}

select.form-input option {
  background: #111827;
  color: #fff;
}

.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
}

.btn-primary {
  background: linear-gradient(90deg, #4f46e5 0%, #3b82f6 100%);
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-secondary {
  background: rgba(255, 255, 255, 0.05);
  color: #f3f4f6;
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-secondary:hover {
  background: rgba(255, 255, 255, 0.1);
}

.mt-4 { margin-top: 1.5rem; }
</style>
