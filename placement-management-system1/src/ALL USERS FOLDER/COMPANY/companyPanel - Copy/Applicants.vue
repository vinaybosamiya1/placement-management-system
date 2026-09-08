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

const getStatusColor = (status) => {
  switch(status) {
    case 'Selected': return 'status-green';
    case 'Shortlisted': return 'status-orange';
    case 'Rejected': return 'status-red';
    default: return 'status-blue';
  }
};
</script>

<template>
  <div class="applicants-container">
    <div class="page-header">
      <div>
        <h2>Applicant Tracking</h2>
        <p>Review and manage student applications for your job postings.</p>
      </div>
      <div class="search-bar">
        <i class="ri-search-line"></i>
        <input type="text" placeholder="Search by name, degree, or role...">
      </div>
    </div>

    <!-- Filters -->
    <div class="filters-container">
      <button 
        v-for="filter in filters" 
        :key="filter"
        class="filter-btn"
        :class="{ active: activeFilter === filter }"
        @click="activeFilter = filter"
      >
        {{ filter }}
      </button>
    </div>

    <!-- Applicants Table -->
    <div class="table-card fade-in">
      <table class="data-table">
        <thead>
          <tr>
            <th>Applicant Name</th>
            <th>Academic Details</th>
            <th>Applied Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="applicant in filteredApplicants" :key="applicant.id">
            <td>
              <div class="applicant-profile">
                <div class="avatar">{{ applicant.name.charAt(0) }}</div>
                <div>
                  <div class="fw-600">{{ applicant.name }}</div>
                  <div class="text-muted text-sm">{{ applicant.email }}</div>
                </div>
              </div>
            </td>
            <td>
              <div class="fw-500">{{ applicant.degree }}</div>
              <div class="text-muted text-sm">CGPA: {{ applicant.cgpa }}</div>
            </td>
            <td>{{ applicant.appliedFor }}</td>
            <td>
              <span class="status-badge" :class="getStatusColor(applicant.status)">
                {{ applicant.status }}
              </span>
            </td>
            <td>
              <div class="actions-group">
                <button class="icon-btn" title="View Resume"><i class="ri-file-text-line"></i></button>
                <div class="dropdown">
                  <button class="icon-btn" title="Update Status"><i class="ri-more-2-fill"></i></button>
                  <!-- Mock Dropdown Menu -->
                </div>
              </div>
            </td>
          </tr>
          <tr v-if="filteredApplicants.length === 0">
            <td colspan="5" class="empty-state">
              <i class="ri-inbox-line"></i>
              <p>No applicants found for the selected filter.</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.applicants-container {
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
  margin-bottom: 0.5rem;
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

.search-bar {
  display: flex;
  align-items: center;
  background: rgba(10, 15, 28, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.5rem 1rem;
  border-radius: 8px;
  width: 300px;
}

.search-bar i {
  color: #9ca3af;
  margin-right: 0.5rem;
}

.search-bar input {
  background: transparent;
  border: none;
  color: #fff;
  width: 100%;
  font-family: inherit;
  font-size: 0.9rem;
}

.search-bar input:focus {
  outline: none;
}

.filters-container {
  display: flex;
  gap: 1rem;
  margin-bottom: 0.5rem;
}

.filter-btn {
  background: rgba(17, 24, 39, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: #9ca3af;
  padding: 0.5rem 1.25rem;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.filter-btn:hover {
  background: rgba(255, 255, 255, 0.05);
  color: #e5e7eb;
}

.filter-btn.active {
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  border-color: rgba(59, 130, 246, 0.3);
}

.table-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  overflow: hidden;
}

.data-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.data-table th {
  padding: 1rem 1.5rem;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #9ca3af;
  background: rgba(0, 0, 0, 0.2);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.data-table td {
  padding: 1rem 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  vertical-align: middle;
  color: #f3f4f6;
  font-size: 0.95rem;
}

.data-table tbody tr {
  transition: background 0.2s;
}

.data-table tbody tr:hover {
  background: rgba(255, 255, 255, 0.02);
}

.applicant-profile {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.avatar {
  width: 36px;
  height: 36px;
  background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 0.9rem;
}

.fw-600 { font-weight: 600; }
.fw-500 { font-weight: 500; }
.text-muted { color: #9ca3af; }
.text-sm { font-size: 0.8rem; }

.status-badge {
  font-size: 0.75rem;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-weight: 600;
}

.status-green {
  background: rgba(16, 185, 129, 0.15);
  color: #10b981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-orange {
  background: rgba(245, 158, 11, 0.15);
  color: #fbbf24;
  border: 1px solid rgba(245, 158, 11, 0.3);
}

.status-red {
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  border: 1px solid rgba(239, 68, 68, 0.3);
}

.status-blue {
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  border: 1px solid rgba(59, 130, 246, 0.3);
}

.actions-group {
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

.empty-state {
  text-align: center;
  padding: 3rem !important;
  color: #9ca3af;
}

.empty-state i {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  display: block;
  opacity: 0.5;
}
</style>
