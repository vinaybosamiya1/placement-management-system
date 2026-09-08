<script setup>
import { shallowRef } from 'vue';

// Import all sub-components
import Dashboard from './Dashboard.vue';
import CompanyProfile from './CompanyProfile.vue';
import JobManagement from './JobManagement.vue';
import Applicants from './Applicants.vue';
import InterviewManagement from './InterviewManagement.vue';
import Notifications from './Notifications.vue';
import ChangePassword from './ChangePassword.vue';

const currentComponent = shallowRef(Dashboard);
const activeTab = shallowRef('dashboard');

const navigation = [
  { id: 'dashboard', name: 'Dashboard', icon: 'ri-dashboard-fill', component: Dashboard },
  { id: 'profile', name: 'Company Profile', icon: 'ri-building-4-fill', component: CompanyProfile },
  { id: 'jobs', name: 'Job Management', icon: 'ri-briefcase-4-fill', component: JobManagement },
  { id: 'applicants', name: 'Applicants', icon: 'ri-file-user-fill', component: Applicants },
  { id: 'interviews', name: 'Interview Management', icon: 'ri-calendar-event-fill', component: InterviewManagement },
  { id: 'notifications', name: 'Notifications', icon: 'ri-notification-3-fill', component: Notifications },
  { id: 'password', name: 'Change Password', icon: 'ri-lock-password-fill', component: ChangePassword },
];

const switchTab = (tab) => {
  activeTab.value = tab.id;
  currentComponent.value = tab.component;
};

const handleLogout = () => {
  // Mock logout
  console.log('Logging out...');
};
</script>

<template>
  <div class="company-panel-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <div class="logo-box">
          <i class="ri-building-line"></i>
        </div>
        <div class="header-text">
          <h2>Placement Portal</h2>
          <p>COMPANY MANAGEMENT SUITE</p>
        </div>
      </div>

      <div class="nav-section">
        <span class="nav-label">NAVIGATION MENU</span>
        <nav class="nav-links">
          <button 
            v-for="item in navigation" 
            :key="item.id"
            class="nav-item"
            :class="{ active: activeTab === item.id }"
            @click="switchTab(item)"
          >
            <i :class="item.icon"></i>
            {{ item.name }}
          </button>
        </nav>
      </div>

      <div class="sidebar-footer">
        <button class="nav-item logout-btn" @click="handleLogout">
          <i class="ri-logout-box-r-line"></i>
          Logout
        </button>
        <div class="support-box">
          <i class="ri-customer-service-2-line"></i>
          <div>
            <h4>TPO Support Desk</h4>
            <p>Need help with hiring?</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-content">
      <!-- Top Navigation -->
      <header class="topbar">
        <div class="topbar-left">
           <!-- Potential breadcrumbs or search could go here -->
        </div>
        <div class="topbar-right">
          <button class="icon-btn">
            <i class="ri-notification-3-line"></i>
            <span class="badge"></span>
          </button>
          <div class="user-profile">
            <div class="avatar">TC</div>
            <div class="user-info">
              <h4>TechCorp Solutions</h4>
              <p>Premium Recruiter</p>
            </div>
          </div>
        </div>
      </header>

      <!-- Dynamic Content Wrapper -->
      <main class="content-wrapper">
        <transition name="fade" mode="out-in">
          <component :is="currentComponent" />
        </transition>
      </main>
    </div>
  </div>
</template>

<style scoped>
/* Base Variables inspired by the images */
.company-panel-layout {
  --bg-primary: #0a0f1c; /* Deep space dark blue */
  --bg-secondary: #111827; /* Slightly lighter for cards */
  --bg-glass: rgba(17, 24, 39, 0.6);
  --border-color: rgba(255, 255, 255, 0.08);
  --text-main: #f3f4f6;
  --text-muted: #9ca3af;
  --accent-blue: #3b82f6;
  --accent-blue-hover: #2563eb;
  --gradient-active: linear-gradient(90deg, #4f46e5 0%, #3b82f6 100%);
  
  display: flex;
  height: 100vh;
  width: 100vw;
  background-color: var(--bg-primary);
  color: var(--text-main);
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  overflow: hidden;
  position: relative;
}

/* Optional subtle background glow effect */
.company-panel-layout::before {
  content: '';
  position: absolute;
  top: -20%;
  left: -10%;
  width: 50%;
  height: 50%;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.05) 0%, transparent 70%);
  z-index: 0;
  pointer-events: none;
}

/* Sidebar */
.sidebar {
  width: 280px;
  background-color: rgba(10, 15, 28, 0.8);
  backdrop-filter: blur(20px);
  border-right: 1px solid var(--border-color);
  display: flex;
  flex-direction: column;
  z-index: 10;
  padding: 1.5rem;
}

.sidebar-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2.5rem;
}

.logo-box {
  width: 40px;
  height: 40px;
  background: var(--gradient-active);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.header-text h2 {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0;
  letter-spacing: 0.5px;
}

.header-text p {
  font-size: 0.65rem;
  color: var(--text-muted);
  margin: 0;
  letter-spacing: 1px;
}

.nav-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.nav-label {
  font-size: 0.7rem;
  color: var(--text-muted);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 0.5rem;
  padding-left: 0.5rem;
}

.nav-links {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.85rem 1rem;
  border-radius: 12px;
  color: var(--text-muted);
  background: transparent;
  border: none;
  font-size: 0.95rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  text-align: left;
  outline: none;
}

.nav-item:hover {
  color: var(--text-main);
  background: rgba(255, 255, 255, 0.03);
}

.nav-item i {
  font-size: 1.2rem;
}

.nav-item.active {
  background: var(--gradient-active);
  color: #fff;
  box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
}

.sidebar-footer {
  margin-top: auto;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.logout-btn {
  color: #ef4444;
}
.logout-btn:hover {
  background: rgba(239, 68, 68, 0.1);
  color: #ef4444;
}

.support-box {
  background: var(--bg-glass);
  border: 1px solid var(--border-color);
  padding: 1rem;
  border-radius: 12px;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-top: 0.5rem;
}

.support-box i {
  color: var(--accent-blue);
  font-size: 1.5rem;
  background: rgba(59, 130, 246, 0.1);
  padding: 0.5rem;
  border-radius: 8px;
}

.support-box h4 {
  font-size: 0.85rem;
  margin: 0 0 0.25rem 0;
  color: var(--text-main);
}

.support-box p {
  font-size: 0.7rem;
  margin: 0;
  color: var(--text-muted);
}

/* Main Content */
.main-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  z-index: 10;
  overflow: hidden;
}

/* Topbar */
.topbar {
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 2.5rem;
  background: transparent;
}

.topbar-right {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.icon-btn {
  background: var(--bg-glass);
  border: 1px solid var(--border-color);
  width: 40px;
  height: 40px;
  border-radius: 50%;
  color: var(--text-main);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  position: relative;
  transition: all 0.2s ease;
  outline: none;
}

.icon-btn:hover {
  background: rgba(255, 255, 255, 0.1);
}

.badge {
  position: absolute;
  top: 8px;
  right: 10px;
  width: 8px;
  height: 8px;
  background: var(--accent-blue);
  border-radius: 50%;
  box-shadow: 0 0 8px var(--accent-blue);
}

.user-profile {
  display: flex;
  align-items: center;
  gap: 1rem;
  background: var(--bg-glass);
  border: 1px solid var(--border-color);
  padding: 0.4rem 1.25rem 0.4rem 0.4rem;
  border-radius: 30px;
  cursor: pointer;
  transition: border-color 0.2s;
}

.user-profile:hover {
  border-color: rgba(255, 255, 255, 0.2);
}

.avatar {
  width: 36px;
  height: 36px;
  background: var(--accent-blue);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 0.9rem;
  color: #fff;
}

.user-info h4 {
  font-size: 0.85rem;
  margin: 0;
}
.user-info p {
  font-size: 0.7rem;
  color: var(--accent-blue);
  margin: 0;
}

/* Content Wrapper */
.content-wrapper {
  flex: 1;
  padding: 0 2.5rem 2.5rem 2.5rem;
  overflow-y: auto;
  scroll-behavior: smooth;
}

/* Scrollbar styles */
.content-wrapper::-webkit-scrollbar {
  width: 6px;
}
.content-wrapper::-webkit-scrollbar-track {
  background: transparent;
}
.content-wrapper::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
}

/* Vue Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease, transform 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
