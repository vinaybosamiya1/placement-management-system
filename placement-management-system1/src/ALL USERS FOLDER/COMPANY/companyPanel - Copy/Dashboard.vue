<script setup>
import { ref } from 'vue';

const stats = ref([
  { title: 'Active Jobs', value: '3', subtext: 'Currently hiring', icon: 'ri-briefcase-4-line', color: '#3b82f6' },
  { title: 'Applications', value: '142', subtext: 'Across all jobs', icon: 'ri-file-text-line', color: '#8b5cf6' },
  { title: 'Shortlisted', value: '24', subtext: 'Pending interviews', icon: 'ri-star-line', color: '#f59e0b' },
  { title: 'Hired', value: '5', subtext: 'This season', icon: 'ri-checkbox-circle-line', color: '#10b981' }
]);

const recentApplications = ref([
  { name: 'Rahul Sharma', role: 'Associate Software Engineer', status: 'Under Review', statusColor: 'blue' },
  { name: 'Priya Patel', role: 'Frontend Developer', status: 'Shortlisted', statusColor: 'orange' },
  { name: 'Amit Kumar', role: 'Associate Software Engineer', status: 'Rejected', statusColor: 'red' }
]);
</script>

<template>
  <div class="dashboard-container">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
      <div class="banner-content">
        <span class="season-badge">Placement Season 2026</span>
        <h1>Welcome back, <span class="highlight">TechCorp Solutions</span> <span class="wave">👋</span></h1>
        <p>You have <strong>3 active job postings</strong> across multiple branches. Track your applications and interview schedules below.</p>
        <div class="banner-actions">
          <button class="btn-primary">Post a New Job <i class="ri-arrow-right-line"></i></button>
          <button class="btn-secondary">View Company Profile</button>
        </div>
      </div>
      <div class="profile-readiness">
        <div class="readiness-header">
          <i class="ri-user-star-line"></i>
          <span>Profile Readiness</span>
          <span class="score">85%</span>
        </div>
        <div class="progress-bar">
          <div class="progress" style="width: 85%"></div>
        </div>
        <p>Complete your company profile to attract top talent.</p>
        <button class="btn-outline">Edit Profile</button>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
      <div v-for="stat in stats" :key="stat.title" class="stat-card">
        <div class="stat-header">
          <h3>{{ stat.title }}</h3>
          <div class="icon-box" :style="{ backgroundColor: stat.color + '15', color: stat.color }">
            <i :class="stat.icon"></i>
          </div>
        </div>
        <div class="stat-value">{{ stat.value }}</div>
        <div class="stat-subtext">
          <i class="ri-record-circle-fill" :style="{ color: stat.color }"></i>
          {{ stat.subtext }}
        </div>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="dashboard-bottom">
      <!-- Recent Applications -->
      <div class="recent-apps section-card">
        <div class="section-header">
          <div class="title-group">
            <i class="ri-file-list-3-line" style="color: #3b82f6;"></i>
            <h3>Recent Applications</h3>
          </div>
          <a href="#" class="view-all">View All <i class="ri-arrow-right-s-line"></i></a>
        </div>
        
        <div class="apps-list">
          <div v-for="(app, index) in recentApplications" :key="index" class="app-item">
            <div class="app-avatar">{{ app.name.charAt(0) }}</div>
            <div class="app-info">
              <h4>{{ app.name }}</h4>
              <p>{{ app.role }}</p>
            </div>
            <div class="app-status" :class="`status-${app.statusColor}`">
              {{ app.status }}
            </div>
          </div>
        </div>
      </div>

      <!-- Notice Board -->
      <div class="notice-board section-card">
        <div class="section-header">
          <div class="title-group">
            <i class="ri-notification-badge-line" style="color: #f59e0b;"></i>
            <h3>TPO Notice Board</h3>
          </div>
        </div>
        <div class="notice-list">
          <div class="notice-item">
            <div class="notice-meta">
              <span class="tag">Important</span>
              <span class="date">Today</span>
            </div>
            <h4>Pre-placement Talk Schedule</h4>
            <p>Please confirm your availability for the pre-placement talk next week.</p>
          </div>
          <div class="notice-item">
            <div class="notice-meta">
              <span class="tag tag-blue">Update</span>
              <span class="date">Yesterday</span>
            </div>
            <h4>Resume Verification Complete</h4>
            <p>All BCA and MCA student resumes have been verified for the upcoming drive.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.dashboard-container {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Welcome Banner */
.welcome-banner {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 20px;
  padding: 2rem;
  display: flex;
  justify-content: space-between;
  gap: 2rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  position: relative;
  overflow: hidden;
}

.welcome-banner::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
  pointer-events: none;
}

.banner-content {
  flex: 1;
  z-index: 1;
}

.season-badge {
  display: inline-block;
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  margin-bottom: 1rem;
  border: 1px solid rgba(59, 130, 246, 0.3);
}

.banner-content h1 {
  font-size: 2rem;
  font-weight: 700;
  margin: 0 0 0.5rem 0;
  color: #fff;
}

.highlight {
  color: #60a5fa;
}

.wave {
  display: inline-block;
  animation: wave 2.5s infinite;
  transform-origin: 70% 70%;
}

@keyframes wave {
  0% { transform: rotate(0deg); }
  10% { transform: rotate(14deg); }
  20% { transform: rotate(-8deg); }
  30% { transform: rotate(14deg); }
  40% { transform: rotate(-4deg); }
  50% { transform: rotate(10deg); }
  60% { transform: rotate(0deg); }
  100% { transform: rotate(0deg); }
}

.banner-content p {
  color: #9ca3af;
  font-size: 0.95rem;
  line-height: 1.5;
  max-width: 600px;
  margin-bottom: 1.5rem;
}

.banner-actions {
  display: flex;
  gap: 1rem;
}

.btn-primary {
  background: linear-gradient(90deg, #4f46e5 0%, #3b82f6 100%);
  color: white;
  border: none;
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
  transition: all 0.2s;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4);
}

.btn-secondary {
  background: rgba(255, 255, 255, 0.05);
  color: #f3f4f6;
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.6rem 1.25rem;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-secondary:hover {
  background: rgba(255, 255, 255, 0.1);
}

.profile-readiness {
  background: rgba(10, 15, 28, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.05);
  padding: 1.25rem;
  border-radius: 16px;
  width: 280px;
  z-index: 1;
}

.readiness-header {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.85rem;
  color: #e5e7eb;
  margin-bottom: 0.75rem;
}

.readiness-header .score {
  margin-left: auto;
  color: #10b981;
  font-weight: 700;
}

.progress-bar {
  height: 6px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  overflow: hidden;
  margin-bottom: 0.75rem;
}

.progress {
  height: 100%;
  background: #10b981;
  border-radius: 10px;
}

.profile-readiness p {
  font-size: 0.75rem;
  color: #9ca3af;
  margin-bottom: 1rem;
}

.btn-outline {
  width: 100%;
  background: transparent;
  color: #9ca3af;
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.5rem;
  border-radius: 6px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-outline:hover {
  background: rgba(255, 255, 255, 0.05);
  color: #fff;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.25rem;
}

.stat-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  padding: 1.5rem;
  border-radius: 16px;
  transition: transform 0.2s, border-color 0.2s;
}

.stat-card:hover {
  transform: translateY(-5px);
  border-color: rgba(255, 255, 255, 0.15);
}

.stat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.stat-header h3 {
  font-size: 0.8rem;
  text-transform: uppercase;
  color: #9ca3af;
  margin: 0;
  letter-spacing: 0.5px;
}

.icon-box {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
}

.stat-value {
  font-size: 2rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 0.5rem;
}

.stat-subtext {
  font-size: 0.75rem;
  color: #6b7280;
  display: flex;
  align-items: center;
  gap: 0.4rem;
}

/* Bottom Section */
.dashboard-bottom {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 1.5rem;
}

.section-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.5rem;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.25rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.title-group {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.title-group h3 {
  font-size: 1rem;
  font-weight: 600;
  color: #e5e7eb;
  margin: 0;
}

.title-group i {
  font-size: 1.1rem;
}

.view-all {
  font-size: 0.8rem;
  color: #60a5fa;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.view-all:hover {
  text-decoration: underline;
}

/* Applications List */
.apps-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.app-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.75rem;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 10px;
  transition: background 0.2s;
}

.app-item:hover {
  background: rgba(255, 255, 255, 0.05);
}

.app-avatar {
  width: 36px;
  height: 36px;
  background: #374151;
  color: #d1d5db;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 0.9rem;
}

.app-info {
  flex: 1;
}

.app-info h4 {
  font-size: 0.9rem;
  color: #f3f4f6;
  margin: 0 0 0.2rem 0;
}

.app-info p {
  font-size: 0.75rem;
  color: #9ca3af;
  margin: 0;
}

.app-status {
  padding: 0.3rem 0.6rem;
  border-radius: 20px;
  font-size: 0.7rem;
  font-weight: 600;
  background: rgba(255, 255, 255, 0.1);
}

.status-blue {
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
  border: 1px solid rgba(59, 130, 246, 0.2);
}

.status-orange {
  background: rgba(245, 158, 11, 0.15);
  color: #fbbf24;
  border: 1px solid rgba(245, 158, 11, 0.2);
}

.status-red {
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  border: 1px solid rgba(239, 68, 68, 0.2);
}

/* Notice Board */
.notice-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.notice-item {
  padding-bottom: 1rem;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.05);
}

.notice-item:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.notice-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.tag {
  font-size: 0.65rem;
  padding: 0.15rem 0.5rem;
  border-radius: 4px;
  background: rgba(239, 68, 68, 0.15);
  color: #f87171;
  font-weight: 600;
  text-transform: uppercase;
}

.tag-blue {
  background: rgba(59, 130, 246, 0.15);
  color: #60a5fa;
}

.date {
  font-size: 0.7rem;
  color: #6b7280;
}

.notice-item h4 {
  font-size: 0.85rem;
  color: #e5e7eb;
  margin: 0 0 0.3rem 0;
}

.notice-item p {
  font-size: 0.75rem;
  color: #9ca3af;
  line-height: 1.4;
  margin: 0;
}
</style>
