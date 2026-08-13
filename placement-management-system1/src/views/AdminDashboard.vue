<template>
  <div class="admin-layout">
    <!-- ═══════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════ -->
    <aside :class="['sidebar', { 'sidebar--collapsed': sidebarCollapsed }]">
      <!-- Brand -->
      <div class="sidebar__brand">
        <div class="sidebar__logo">
          <span class="sidebar__logo-icon">🎓</span>
        </div>
        <transition name="fade-slide">
          <div v-if="!sidebarCollapsed" class="sidebar__brand-text">
            <span class="sidebar__title">PlacePortal</span>
            <span class="sidebar__subtitle">Admin Panel</span>
          </div>
        </transition>
      </div>

      <!-- Toggle Button -->
      <button class="sidebar__toggle" @click="sidebarCollapsed = !sidebarCollapsed">
        <i :class="sidebarCollapsed ? 'ri-menu-unfold-line' : 'ri-menu-fold-line'"></i>
      </button>

      <!-- Navigation -->
      <nav class="sidebar__nav">
        <div class="sidebar__nav-group">
          <span v-if="!sidebarCollapsed" class="sidebar__nav-label">Main</span>
          <a
            v-for="item in navItems"
            :key="item.name"
            href="#"
            class="sidebar__nav-item"
            :class="{ 'sidebar__nav-item--active': currentPage === item.name }"
            @click.prevent="currentPage = item.name"
          >
            <i :class="item.icon" class="sidebar__nav-icon"></i>
            <transition name="fade-slide">
              <span v-if="!sidebarCollapsed" class="sidebar__nav-text">{{ item.label }}</span>
            </transition>
            <span v-if="item.badge && !sidebarCollapsed" class="sidebar__nav-badge">{{ item.badge }}</span>
          </a>
        </div>

        <div class="sidebar__nav-group">
          <span v-if="!sidebarCollapsed" class="sidebar__nav-label">Management</span>
          <a
            v-for="item in mgmtItems"
            :key="item.name"
            href="#"
            class="sidebar__nav-item"
            :class="{ 'sidebar__nav-item--active': currentPage === item.name }"
            @click.prevent="currentPage = item.name"
          >
            <i :class="item.icon" class="sidebar__nav-icon"></i>
            <transition name="fade-slide">
              <span v-if="!sidebarCollapsed" class="sidebar__nav-text">{{ item.label }}</span>
            </transition>
          </a>
        </div>
      </nav>

      <!-- User Profile at bottom -->
      <div class="sidebar__user" @click="$router.push('/profile')">
        <div class="sidebar__user-avatar">
          <span>{{ adminInitials }}</span>
        </div>
        <transition name="fade-slide">
          <div v-if="!sidebarCollapsed" class="sidebar__user-info">
            <span class="sidebar__user-name">{{ adminName }}</span>
            <span class="sidebar__user-role">Administrator</span>
          </div>
        </transition>
        <button v-if="!sidebarCollapsed" class="sidebar__logout-btn" @click.stop="handleLogout" title="Logout">
          <i class="ri-logout-box-r-line"></i>
        </button>
      </div>
    </aside>

    <!-- ═══════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════ -->
    <div class="main-content">
      <!-- Top Header -->
      <header class="topbar">
        <div class="topbar__left">
          <h1 class="topbar__title">{{ currentPageLabel }}</h1>
          <p class="topbar__subtitle">Welcome back, {{ adminName }} 👋</p>
        </div>
        <div class="topbar__right">
          <!-- Search -->
          <div class="search-box">
            <i class="ri-search-line search-box__icon"></i>
            <input type="text" class="search-box__input" placeholder="Search students, jobs..." v-model="searchQuery" />
          </div>
          <!-- Notification Bell -->
          <div class="notif-btn" @click="notifOpen = !notifOpen">
            <i class="ri-notification-3-line"></i>
            <span class="notif-btn__badge">5</span>
            <!-- Dropdown -->
            <div v-if="notifOpen" class="notif-dropdown">
              <div class="notif-dropdown__header">
                <span>Notifications</span>
                <span class="notif-dropdown__clear">Mark all read</span>
              </div>
              <div v-for="n in notifications" :key="n.id" class="notif-item">
                <div :class="['notif-item__icon', `notif-item__icon--${n.type}`]">
                  <i :class="n.icon"></i>
                </div>
                <div class="notif-item__content">
                  <p class="notif-item__text">{{ n.text }}</p>
                  <span class="notif-item__time">{{ n.time }}</span>
                </div>
              </div>
            </div>
          </div>
          <!-- Admin Avatar -->
          <div class="admin-avatar" @click="$router.push('/profile')">
            <span>{{ adminInitials }}</span>
          </div>
        </div>
      </header>

      <!-- ─── Dashboard Content ─── -->
      <div class="dashboard-content">

        <!-- ══════════════════════════════════════════════════
             SETTINGS PAGE
        ══════════════════════════════════════════════════ -->
        <template v-if="currentPage === 'Settings'">
          <div class="settings-hero">
            <div class="settings-hero__icon"><i class="ri-settings-3-line"></i></div>
            <div>
              <h2 class="settings-hero__title">Settings</h2>
              <p class="settings-hero__sub">Manage your account, system preferences and security</p>
            </div>
          </div>

          <!-- Settings Tabs -->
          <div class="settings-tabs">
            <button
              v-for="tab in settingsTabs"
              :key="tab.key"
              :class="['settings-tab', { 'settings-tab--active': activeSettingsTab === tab.key }]"
              @click="activeSettingsTab = tab.key"
            >
              <i :class="tab.icon"></i>
              {{ tab.label }}
            </button>
          </div>

          <!-- ── Profile Tab ── -->
          <div v-if="activeSettingsTab === 'profile'" class="settings-panel">
            <div class="settings-section">
              <h3 class="settings-section__title">Profile Information</h3>
              <div class="settings-avatar-row">
                <div class="settings-avatar">
                  <span>{{ adminInitials }}</span>
                  <div class="settings-avatar__overlay"><i class="ri-camera-line"></i></div>
                </div>
                <div>
                  <p class="settings-avatar__name">{{ adminName }}</p>
                  <p class="settings-avatar__role">Administrator</p>
                  <button class="btn-outline">Change Photo</button>
                </div>
              </div>
              <div class="settings-form-grid">
                <div class="settings-field">
                  <label>Full Name</label>
                  <input type="text" :value="adminName" class="settings-input" placeholder="Full name" />
                </div>
                <div class="settings-field">
                  <label>Email Address</label>
                  <input type="email" class="settings-input" placeholder="admin@college.edu" />
                </div>
                <div class="settings-field">
                  <label>Phone Number</label>
                  <input type="tel" class="settings-input" placeholder="+91 00000 00000" />
                </div>
                <div class="settings-field">
                  <label>Department</label>
                  <input type="text" class="settings-input" placeholder="Placement Cell" />
                </div>
                <div class="settings-field settings-field--full">
                  <label>Bio</label>
                  <textarea class="settings-input settings-textarea" rows="3" placeholder="Brief description about you..."></textarea>
                </div>
              </div>
              <div class="settings-actions">
                <button class="btn-primary"><i class="ri-save-line"></i> Save Changes</button>
                <button class="btn-outline">Cancel</button>
              </div>
            </div>
          </div>

          <!-- ── System Tab ── -->
          <div v-if="activeSettingsTab === 'system'" class="settings-panel">
            <div class="settings-section">
              <h3 class="settings-section__title">System Preferences</h3>
              <div class="settings-toggle-list">
                <div v-for="pref in systemPrefs" :key="pref.key" class="settings-toggle-item">
                  <div class="settings-toggle-item__info">
                    <span class="settings-toggle-item__label">{{ pref.label }}</span>
                    <span class="settings-toggle-item__desc">{{ pref.desc }}</span>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="pref.value" />
                    <span class="toggle-switch__track"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="settings-section">
              <h3 class="settings-section__title">Application Settings</h3>
              <div class="settings-form-grid">
                <div class="settings-field">
                  <label>Institution Name</label>
                  <input type="text" class="settings-input" value="ABC Engineering College" />
                </div>
                <div class="settings-field">
                  <label>Academic Year</label>
                  <select class="settings-input">
                    <option>2025–26</option>
                    <option>2026–27</option>
                  </select>
                </div>
                <div class="settings-field">
                  <label>Timezone</label>
                  <select class="settings-input">
                    <option>Asia/Kolkata (IST)</option>
                    <option>UTC</option>
                  </select>
                </div>
                <div class="settings-field">
                  <label>Language</label>
                  <select class="settings-input">
                    <option>English</option>
                    <option>Hindi</option>
                  </select>
                </div>
              </div>
              <div class="settings-actions">
                <button class="btn-primary"><i class="ri-save-line"></i> Save Settings</button>
              </div>
            </div>
          </div>

          <!-- ── Notifications Tab ── -->
          <div v-if="activeSettingsTab === 'notifications'" class="settings-panel">
            <div class="settings-section">
              <h3 class="settings-section__title">Notification Preferences</h3>
              <div class="settings-toggle-list">
                <div v-for="notif in notifPrefs" :key="notif.key" class="settings-toggle-item">
                  <div class="settings-toggle-item__info">
                    <span class="settings-toggle-item__label">{{ notif.label }}</span>
                    <span class="settings-toggle-item__desc">{{ notif.desc }}</span>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="notif.value" />
                    <span class="toggle-switch__track"></span>
                  </label>
                </div>
              </div>
              <div class="settings-actions">
                <button class="btn-primary"><i class="ri-save-line"></i> Save Preferences</button>
              </div>
            </div>
          </div>

          <!-- ── Security Tab ── -->
          <div v-if="activeSettingsTab === 'security'" class="settings-panel">
            <div class="settings-section">
              <h3 class="settings-section__title">Change Password</h3>
              <div class="settings-form-grid">
                <div class="settings-field settings-field--full">
                  <label>Current Password</label>
                  <input type="password" class="settings-input" placeholder="••••••••" />
                </div>
                <div class="settings-field">
                  <label>New Password</label>
                  <input type="password" class="settings-input" placeholder="••••••••" />
                </div>
                <div class="settings-field">
                  <label>Confirm New Password</label>
                  <input type="password" class="settings-input" placeholder="••••••••" />
                </div>
              </div>
              <div class="settings-actions">
                <button class="btn-primary"><i class="ri-lock-line"></i> Update Password</button>
              </div>
            </div>
            <div class="settings-section">
              <h3 class="settings-section__title">Active Sessions</h3>
              <div class="session-list">
                <div v-for="sess in activeSessions" :key="sess.id" class="session-item">
                  <div class="session-item__icon"><i :class="sess.icon"></i></div>
                  <div class="session-item__info">
                    <span class="session-item__device">{{ sess.device }}</span>
                    <span class="session-item__meta">{{ sess.location }} · {{ sess.time }}</span>
                  </div>
                  <span v-if="sess.current" class="session-item__current">Current</span>
                  <button v-else class="btn-outline" style="font-size:12px;padding:4px 10px">Revoke</button>
                </div>
              </div>
            </div>
          </div>

          <!-- ── Appearance Tab ── -->
          <div v-if="activeSettingsTab === 'appearance'" class="settings-panel">
            <div class="settings-section">
              <h3 class="settings-section__title">Theme</h3>
              <div class="theme-options">
                <div
                  v-for="theme in themeOptions"
                  :key="theme.key"
                  :class="['theme-option', { 'theme-option--active': selectedTheme === theme.key }]"
                  @click="selectedTheme = theme.key"
                >
                  <div class="theme-option__preview" :style="{ background: theme.bg }">
                    <div class="theme-option__sidebar" :style="{ background: theme.sidebar }"></div>
                    <div class="theme-option__content">
                      <div class="theme-option__bar" :style="{ background: theme.accent }"></div>
                      <div class="theme-option__bar theme-option__bar--sm"></div>
                      <div class="theme-option__bar theme-option__bar--sm"></div>
                    </div>
                  </div>
                  <span class="theme-option__label">{{ theme.label }}</span>
                  <i v-if="selectedTheme === theme.key" class="ri-check-line theme-option__check"></i>
                </div>
              </div>
            </div>
            <div class="settings-section">
              <h3 class="settings-section__title">Accent Color</h3>
              <div class="accent-palette">
                <div
                  v-for="color in accentColors"
                  :key="color"
                  class="accent-swatch"
                  :class="{ 'accent-swatch--active': selectedAccent === color }"
                  :style="{ background: color }"
                  @click="selectedAccent = color"
                ></div>
              </div>
            </div>
            <div class="settings-section">
              <h3 class="settings-section__title">Sidebar</h3>
              <div class="settings-toggle-list">
                <div class="settings-toggle-item">
                  <div class="settings-toggle-item__info">
                    <span class="settings-toggle-item__label">Compact Sidebar</span>
                    <span class="settings-toggle-item__desc">Always keep sidebar in collapsed mode</span>
                  </div>
                  <label class="toggle-switch">
                    <input type="checkbox" v-model="sidebarCollapsed" />
                    <span class="toggle-switch__track"></span>
                  </label>
                </div>
              </div>
              <div class="settings-actions">
                <button class="btn-primary"><i class="ri-save-line"></i> Apply Appearance</button>
              </div>
            </div>
          </div>
        </template>

        <!-- ══════════════════════════════════════════════════
             DEFAULT DASHBOARD OVERVIEW (all other pages)
        ══════════════════════════════════════════════════ -->
        <template v-else>

        <!-- ── STAT CARDS ── -->
        <section class="stats-grid">
          <div
            v-for="(stat, index) in statCards"
            :key="stat.label"
            class="stat-card"
            :style="{ '--card-color': stat.color, '--card-color-light': stat.colorLight }"
            ref="statCardRefs"
          >
            <div class="stat-card__body">
              <div class="stat-card__info">
                <span class="stat-card__label">{{ stat.label }}</span>
                <span class="stat-card__value" :ref="el => statValueRefs[index] = el">{{ stat.value }}</span>
                <div class="stat-card__change" :class="stat.trend === 'up' ? 'stat-card__change--up' : 'stat-card__change--down'">
                  <i :class="stat.trend === 'up' ? 'ri-arrow-up-s-line' : 'ri-arrow-down-s-line'"></i>
                  <span>{{ stat.change }}</span>
                </div>
              </div>
              <div class="stat-card__icon-wrap">
                <i :class="stat.icon" class="stat-card__icon"></i>
              </div>
            </div>
            <div class="stat-card__sparkline">
              <svg viewBox="0 0 100 30" preserveAspectRatio="none" class="sparkline">
                <polyline
                  :points="stat.sparkline"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </div>
          </div>
        </section>

        <!-- ── MIDDLE ROW: Chart + Quick Stats ── -->
        <section class="middle-row">
          <!-- Placement Progress Chart -->
          <div class="chart-card">
            <div class="card-header">
              <div>
                <h2 class="card-header__title">Placement Overview</h2>
                <p class="card-header__sub">Monthly placement trends — 2025–26</p>
              </div>
              <div class="chart-legend">
                <span class="chart-legend__dot" style="background:#6366f1"></span><span>Placed</span>
                <span class="chart-legend__dot" style="background:#22d3ee; margin-left:12px"></span><span>Applied</span>
              </div>
            </div>
            <!-- Bar Chart (pure CSS/SVG) -->
            <div class="bar-chart-wrap">
              <svg class="bar-chart-svg" viewBox="0 0 660 200" preserveAspectRatio="none">
                <!-- Grid lines -->
                <line v-for="y in [40,80,120,160]" :key="y" x1="0" :y1="y" x2="660" :y2="y" stroke="#334155" stroke-width="1" stroke-dasharray="4 4"/>
                <!-- Bars -->
                <g v-for="(m, i) in chartData" :key="m.month">
                  <!-- Applied bar -->
                  <rect
                    :x="i * 55 + 10"
                    :y="200 - m.applied"
                    width="20"
                    :height="m.applied"
                    rx="4"
                    fill="#22d3ee"
                    opacity="0.7"
                    class="bar-animate"
                  />
                  <!-- Placed bar -->
                  <rect
                    :x="i * 55 + 33"
                    :y="200 - m.placed"
                    width="20"
                    :height="m.placed"
                    rx="4"
                    fill="#6366f1"
                    class="bar-animate"
                  />
                  <!-- Label -->
                  <text :x="i * 55 + 32" y="218" text-anchor="middle" class="bar-label">{{ m.month }}</text>
                </g>
              </svg>
            </div>
          </div>

          <!-- Quick Stats Panel -->
          <div class="quick-stats">
            <!-- Donut: Placement Rate -->
            <div class="donut-card">
              <h3 class="donut-card__title">Placement Rate</h3>
              <div class="donut-wrap">
                <svg viewBox="0 0 120 120" class="donut-svg">
                  <circle cx="60" cy="60" r="48" fill="none" stroke="#1e293b" stroke-width="12"/>
                  <circle
                    cx="60" cy="60" r="48"
                    fill="none"
                    stroke="url(#grad1)"
                    stroke-width="12"
                    stroke-linecap="round"
                    :stroke-dasharray="`${placementRate * 3.016} 301.6`"
                    stroke-dashoffset="75.4"
                    transform="rotate(-90 60 60)"
                    class="donut-circle"
                  />
                  <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                      <stop offset="0%" stop-color="#6366f1"/>
                      <stop offset="100%" stop-color="#a855f7"/>
                    </linearGradient>
                  </defs>
                  <text x="60" y="64" text-anchor="middle" class="donut-text">{{ placementRate }}%</text>
                </svg>
              </div>
              <p class="donut-card__sub">{{ placedCount }} of {{ totalStudents }} students placed</p>
            </div>

            <!-- Top Recruiters mini-list -->
            <div class="recruiters-card">
              <h3 class="recruiters-card__title">Top Recruiters</h3>
              <ul class="recruiter-list">
                <li v-for="r in topRecruiters" :key="r.name" class="recruiter-item">
                  <div class="recruiter-item__logo" :style="{ background: r.color }">{{ r.abbr }}</div>
                  <div class="recruiter-item__info">
                    <span class="recruiter-item__name">{{ r.name }}</span>
                    <div class="recruiter-item__bar-wrap">
                      <div class="recruiter-item__bar" :style="{ width: r.pct + '%', background: r.color }"></div>
                    </div>
                  </div>
                  <span class="recruiter-item__count">{{ r.count }}</span>
                </li>
              </ul>
            </div>
          </div>
        </section>

        <!-- ── BOTTOM ROW: Recent Applications + Job Listings ── -->
        <section class="bottom-row">
          <!-- Recent Applications Table -->
          <div class="table-card">
            <div class="card-header">
              <div>
                <h2 class="card-header__title">Recent Applications</h2>
                <p class="card-header__sub">Latest student job applications</p>
              </div>
              <button class="btn-outline">View All <i class="ri-arrow-right-line"></i></button>
            </div>
            <div class="table-wrap">
              <table class="data-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Company</th>
                    <th>Role</th>
                    <th>Applied On</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(app, i) in recentApplications" :key="app.id" class="table-row">
                    <td class="text-muted">{{ i + 1 }}</td>
                    <td>
                      <div class="student-cell">
                        <div class="student-avatar" :style="{ background: app.avatarColor }">{{ app.initials }}</div>
                        <div>
                          <div class="student-name">{{ app.name }}</div>
                          <div class="student-branch">{{ app.branch }}</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="company-cell">
                        <span class="company-badge" :style="{ background: app.companyColor + '20', color: app.companyColor }">{{ app.company }}</span>
                      </div>
                    </td>
                    <td class="role-cell">{{ app.role }}</td>
                    <td class="text-muted">{{ app.date }}</td>
                    <td>
                      <span :class="['status-badge', `status-badge--${app.status.toLowerCase()}`]">
                        <span class="status-badge__dot"></span>
                        {{ app.status }}
                      </span>
                    </td>
                    <td>
                      <div class="action-btns">
                        <button class="action-btn action-btn--view" title="View"><i class="ri-eye-line"></i></button>
                        <button class="action-btn action-btn--approve" title="Approve"><i class="ri-check-line"></i></button>
                        <button class="action-btn action-btn--reject" title="Reject"><i class="ri-close-line"></i></button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Right Panel: Active Jobs + Activity Feed -->
          <div class="right-panel">
            <!-- Active Job Listings -->
            <div class="jobs-card">
              <div class="card-header">
                <div>
                  <h2 class="card-header__title">Active Jobs</h2>
                  <p class="card-header__sub">Currently open positions</p>
                </div>
                <button class="btn-primary" @click="$router.push('/jobs')">
                  <i class="ri-add-line"></i> Post Job
                </button>
              </div>
              <div class="job-list">
                <div v-for="job in activeJobs" :key="job.id" class="job-item">
                  <div class="job-item__logo" :style="{ background: job.color }">{{ job.abbr }}</div>
                  <div class="job-item__info">
                    <span class="job-item__title">{{ job.title }}</span>
                    <div class="job-item__meta">
                      <span><i class="ri-building-line"></i> {{ job.company }}</span>
                      <span><i class="ri-map-pin-line"></i> {{ job.location }}</span>
                      <span><i class="ri-money-rupee-circle-line"></i> {{ job.salary }}</span>
                    </div>
                  </div>
                  <div class="job-item__right">
                    <span class="job-item__applications">{{ job.applications }} Apps</span>
                    <span :class="['job-item__status', job.active ? 'job-item__status--open' : 'job-item__status--closed']">
                      {{ job.active ? 'Open' : 'Closed' }}
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Activity Feed -->
            <div class="activity-card">
              <div class="card-header">
                <h2 class="card-header__title">Activity Feed</h2>
              </div>
              <ul class="activity-list">
                <li v-for="act in activityFeed" :key="act.id" class="activity-item">
                  <div :class="['activity-item__dot', `activity-item__dot--${act.type}`]">
                    <i :class="act.icon"></i>
                  </div>
                  <div class="activity-item__content">
                    <p class="activity-item__text" v-html="act.text"></p>
                    <span class="activity-item__time">{{ act.time }}</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </section>

        </template>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

// ─── State ───────────────────────────────────
const sidebarCollapsed = ref(false);
const searchQuery = ref('');
const notifOpen = ref(false);
const currentPage = ref('Dashboard');
const adminName = ref('Admin');
const statValueRefs = ref([]);
const statCardRefs = ref([]);

// ─── Admin Info ──────────────────────────────
const adminInitials = computed(() => {
  const parts = adminName.value.trim().split(' ');
  return parts.length >= 2 ? parts[0][0] + parts[1][0] : parts[0].slice(0, 2);
});

onMounted(async () => {
  try {
    const res = await axios.get(
      'http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php',
      { withCredentials: true }
    );
    if (res.data.success) adminName.value = res.data.user.full_name || 'Admin';
  } catch { /* silent */ }

  // Animate stat numbers on mount
  animateStatValues();

  // Close notif on outside click
  document.addEventListener('click', closeNotifOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', closeNotifOutside);
});

const closeNotifOutside = (e) => {
  if (!e.target.closest('.notif-btn')) notifOpen.value = false;
};

// ─── Animate stat counters ───────────────────
const animateStatValues = () => {
  statCards.value.forEach((card, i) => {
    const el = statValueRefs.value[i];
    if (!el) return;
    const target = card.rawValue;
    const duration = 1200;
    const start = performance.now();
    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.round(eased * target);
      el.textContent = card.prefix + current.toLocaleString() + card.suffix;
      if (progress < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  });
};

// ─── Navigation Items ────────────────────────
const navItems = [
  { name: 'Dashboard',     label: 'Dashboard',     icon: 'ri-dashboard-3-line',    badge: null },
  { name: 'Students',      label: 'Students',       icon: 'ri-graduation-cap-line', badge: '248' },
  { name: 'Jobs',          label: 'Job Listings',   icon: 'ri-briefcase-4-line',    badge: null },
  { name: 'Applications',  label: 'Applications',   icon: 'ri-file-list-3-line',    badge: '12' },
  { name: 'Analytics',     label: 'Analytics',      icon: 'ri-bar-chart-2-line',    badge: null },
];
const mgmtItems = [
  { name: 'Companies', label: 'Companies', icon: 'ri-building-2-line' },
  { name: 'Reports',   label: 'Reports',   icon: 'ri-file-chart-line' },
  { name: 'Settings',  label: 'Settings',  icon: 'ri-settings-3-line' },
];

// ─── Current page label ──────────────────────
const currentPageLabel = computed(() => {
  const all = [...navItems, ...mgmtItems];
  return all.find(i => i.name === currentPage.value)?.label || currentPage.value;
});

// ─── Settings state ──────────────────────────
const activeSettingsTab = ref('profile');
const selectedTheme = ref('dark');
const selectedAccent = ref('#6366f1');

const settingsTabs = [
  { key: 'profile',       label: 'Profile',       icon: 'ri-user-line' },
  { key: 'system',        label: 'System',         icon: 'ri-settings-4-line' },
  { key: 'notifications', label: 'Notifications',  icon: 'ri-notification-3-line' },
  { key: 'security',      label: 'Security',       icon: 'ri-shield-keyhole-line' },
  { key: 'appearance',    label: 'Appearance',     icon: 'ri-palette-line' },
];

const systemPrefs = ref([
  { key: 'autoApprove',  label: 'Auto-approve Applications', desc: 'Automatically approve student job applications', value: false },
  { key: 'emailAlerts',  label: 'Email Alerts',              desc: 'Send email for new applications and placements', value: true },
  { key: 'twoFactor',    label: 'Two-Factor Auth',           desc: 'Require 2FA for admin login',                   value: false },
  { key: 'maintenance',  label: 'Maintenance Mode',          desc: 'Put the portal in read-only mode for students',  value: false },
]);

const notifPrefs = ref([
  { key: 'newApp',       label: 'New Application',     desc: 'Notify when a student applies for a job',          value: true },
  { key: 'placement',   label: 'Placement Confirmed',  desc: 'Notify when a student is placed successfully',      value: true },
  { key: 'jobPosted',   label: 'New Job Posted',       desc: 'Notify when a recruiter posts a new job',           value: true },
  { key: 'weekly',      label: 'Weekly Summary',       desc: 'Receive a weekly placement summary report',         value: false },
  { key: 'systemAlerts',label: 'System Alerts',        desc: 'Critical system and security notifications',        value: true },
]);

const activeSessions = ref([
  { id: 1, icon: 'ri-computer-line',  device: 'Windows PC — Chrome',  location: 'Surat, India',    time: 'Active now', current: true },
  { id: 2, icon: 'ri-smartphone-line',device: 'Android — Firefox',    location: 'Mumbai, India',   time: '2 days ago',  current: false },
  { id: 3, icon: 'ri-macbook-line',   device: 'MacBook — Safari',     location: 'Bangalore, India',time: '5 days ago',  current: false },
]);

const themeOptions = [
  { key: 'dark',  label: 'Dark',  bg: '#0f172a', sidebar: '#1e293b', accent: '#6366f1' },
  { key: 'light', label: 'Light', bg: '#f1f5f9', sidebar: '#ffffff', accent: '#6366f1' },
  { key: 'navy',  label: 'Navy',  bg: '#0a1628', sidebar: '#0f2044', accent: '#3b82f6' },
];

const accentColors = ['#6366f1','#a855f7','#ec4899','#10b981','#22d3ee','#f59e0b','#ef4444','#3b82f6'];

// ─── Stat Cards ──────────────────────────────
const statCards = ref([
  {
    label: 'Total Students',
    value: '0',
    rawValue: 1248,
    prefix: '', suffix: '',
    change: '+12% this month',
    trend: 'up',
    icon: 'ri-graduation-cap-line',
    color: '#6366f1',
    colorLight: 'rgba(99,102,241,0.15)',
    sparkline: '0,25 15,18 30,22 45,10 60,15 75,8 100,12',
  },
  {
    label: 'Job Openings',
    value: '0',
    rawValue: 87,
    prefix: '', suffix: '',
    change: '+5 this week',
    trend: 'up',
    icon: 'ri-briefcase-4-line',
    color: '#22d3ee',
    colorLight: 'rgba(34,211,238,0.15)',
    sparkline: '0,20 15,12 30,18 45,8 60,14 75,6 100,10',
  },
  {
    label: 'Applications',
    value: '0',
    rawValue: 3542,
    prefix: '', suffix: '',
    change: '+18% this month',
    trend: 'up',
    icon: 'ri-file-list-3-line',
    color: '#a855f7',
    colorLight: 'rgba(168,85,247,0.15)',
    sparkline: '0,28 15,20 30,24 45,12 60,20 75,10 100,16',
  },
  {
    label: 'Placement Rate',
    value: '0',
    rawValue: 78,
    prefix: '', suffix: '%',
    change: '+3% vs last year',
    trend: 'up',
    icon: 'ri-award-line',
    color: '#10b981',
    colorLight: 'rgba(16,185,129,0.15)',
    sparkline: '0,22 15,16 30,20 45,10 60,14 75,8 100,6',
  },
]);

// ─── Placement Rate Donut ────────────────────
const placementRate = ref(78);
const placedCount = ref(973);
const totalStudents = ref(1248);

// ─── Chart Data ──────────────────────────────
const chartData = ref([
  { month: 'Aug',  applied: 80,  placed: 50  },
  { month: 'Sep',  applied: 110, placed: 70  },
  { month: 'Oct',  applied: 140, placed: 90  },
  { month: 'Nov',  applied: 100, placed: 65  },
  { month: 'Dec',  applied: 60,  placed: 40  },
  { month: 'Jan',  applied: 130, placed: 85  },
  { month: 'Feb',  applied: 160, placed: 110 },
  { month: 'Mar',  applied: 190, placed: 140 },
  { month: 'Apr',  applied: 170, placed: 130 },
  { month: 'May',  applied: 200, placed: 160 },
  { month: 'Jun',  applied: 150, placed: 120 },
]);

// ─── Top Recruiters ──────────────────────────
const topRecruiters = ref([
  { name: 'TCS', abbr: 'TCS', count: 120, pct: 90, color: '#6366f1' },
  { name: 'Infosys', abbr: 'IN', count: 95, pct: 72, color: '#22d3ee' },
  { name: 'Wipro', abbr: 'WI', count: 80, pct: 60, color: '#a855f7' },
  { name: 'Cognizant', abbr: 'CG', count: 65, pct: 49, color: '#10b981' },
  { name: 'Accenture', abbr: 'AC', count: 55, pct: 41, color: '#f59e0b' },
]);

// ─── Recent Applications ─────────────────────
const recentApplications = ref([
  { id: 1, name: 'Rahul Sharma',   branch: 'B.Tech CSE', company: 'TCS',       companyColor: '#6366f1', role: 'Software Engineer',  date: 'Jul 28, 2026', status: 'Pending',   initials: 'RS', avatarColor: '#6366f1' },
  { id: 2, name: 'Priya Patel',    branch: 'BCA',        company: 'Infosys',   companyColor: '#22d3ee', role: 'System Analyst',     date: 'Jul 27, 2026', status: 'Approved',  initials: 'PP', avatarColor: '#10b981' },
  { id: 3, name: 'Arun Kumar',     branch: 'B.Tech IT',  company: 'Wipro',     companyColor: '#a855f7', role: 'QA Engineer',        date: 'Jul 26, 2026', status: 'Rejected',  initials: 'AK', avatarColor: '#ef4444' },
  { id: 4, name: 'Sneha Joshi',    branch: 'MCA',        company: 'Accenture', companyColor: '#f59e0b', role: 'Business Analyst',   date: 'Jul 25, 2026', status: 'Interview', initials: 'SJ', avatarColor: '#f59e0b' },
  { id: 5, name: 'Vikram Singh',   branch: 'B.Tech ECE', company: 'Cognizant', companyColor: '#10b981', role: 'Network Engineer',   date: 'Jul 24, 2026', status: 'Pending',   initials: 'VS', avatarColor: '#8b5cf6' },
  { id: 6, name: 'Meera Nair',     branch: 'BCA',        company: 'TCS',       companyColor: '#6366f1', role: 'Data Analyst',       date: 'Jul 23, 2026', status: 'Approved',  initials: 'MN', avatarColor: '#22d3ee' },
]);

// ─── Active Job Listings ─────────────────────
const activeJobs = ref([
  { id: 1, title: 'Software Engineer', company: 'TCS',       location: 'Pune',      salary: '5–8 LPA',  applications: 42, active: true,  abbr: 'TCS', color: '#6366f1' },
  { id: 2, title: 'Data Analyst',      company: 'Infosys',   location: 'Bangalore', salary: '4–7 LPA',  applications: 35, active: true,  abbr: 'IN',  color: '#22d3ee' },
  { id: 3, title: 'DevOps Engineer',   company: 'Wipro',     location: 'Chennai',   salary: '6–9 LPA',  applications: 28, active: true,  abbr: 'WI',  color: '#a855f7' },
  { id: 4, title: 'Business Analyst',  company: 'Accenture', location: 'Mumbai',    salary: '5–10 LPA', applications: 19, active: false, abbr: 'AC',  color: '#f59e0b' },
]);

// ─── Activity Feed ───────────────────────────
const activityFeed = ref([
  { id: 1, type: 'success', icon: 'ri-check-double-line', text: '<strong>Priya Patel</strong> was placed at Infosys', time: '2 min ago' },
  { id: 2, type: 'info',    icon: 'ri-file-add-line',     text: 'New job posted by <strong>TCS</strong> — Software Engineer', time: '15 min ago' },
  { id: 3, type: 'warning', icon: 'ri-user-add-line',     text: '<strong>Rahul Sharma</strong> submitted application', time: '32 min ago' },
  { id: 4, type: 'error',   icon: 'ri-close-circle-line', text: 'Application of <strong>Arun Kumar</strong> rejected', time: '1 hr ago' },
  { id: 5, type: 'info',    icon: 'ri-building-line',     text: '<strong>Cognizant</strong> registered as new recruiter', time: '2 hr ago' },
  { id: 6, type: 'success', icon: 'ri-award-line',        text: '<strong>Sneha Joshi</strong> cleared technical round', time: '3 hr ago' },
]);

// ─── Notifications ───────────────────────────
const notifications = ref([
  { id: 1, type: 'success', icon: 'ri-check-line', text: 'Priya Patel placed at Infosys', time: '2 min ago' },
  { id: 2, type: 'info',    icon: 'ri-briefcase-line', text: 'TCS posted a new job opening', time: '15 min ago' },
  { id: 3, type: 'warning', icon: 'ri-time-line', text: '12 applications pending review', time: '1 hr ago' },
  { id: 4, type: 'error',   icon: 'ri-close-circle-line', text: "Arun Kumar's application rejected", time: '2 hr ago' },
  { id: 5, type: 'info',    icon: 'ri-user-add-line', text: 'New student registration: Meera N.', time: '3 hr ago' },
]);

// ─── Logout ──────────────────────────────────
const handleLogout = async () => {
  try {
    await axios.post(
      'http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/logout.php',
      {}, { withCredentials: true }
    );
  } catch { /* silent */ }
  localStorage.removeItem('isLoggedIn');
  router.push('/login');
};
</script>

<style scoped>
/* ╔══════════════════════════════════════════════════════════════
   ║  FONT IMPORT
   ╚══════════════════════════════════════════════════════════════ */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

/* ╔══════════════════════════════════════════════════════════════
   ║  ROOT TOKENS
   ╚══════════════════════════════════════════════════════════════ */
.admin-layout {
  --bg-base:        #0f172a;
  --bg-surface:     #1e293b;
  --bg-elevated:    #273449;
  --bg-hover:       #334155;
  --border:         #334155;
  --border-subtle:  #1e293b;
  --text-primary:   #f1f5f9;
  --text-secondary: #94a3b8;
  --text-muted:     #64748b;
  --accent:         #6366f1;
  --accent-hover:   #818cf8;
  --success:        #10b981;
  --warning:        #f59e0b;
  --error:          #ef4444;
  --info:           #22d3ee;
  --sidebar-w:      260px;
  --sidebar-w-col:  72px;
  --topbar-h:       72px;
  --radius:         12px;
  --radius-sm:      8px;
  --shadow:         0 4px 24px rgba(0,0,0,0.3);
  --shadow-sm:      0 2px 8px rgba(0,0,0,0.2);
  --transition:     all 0.25s cubic-bezier(0.4,0,0.2,1);
}

/* ╔══════════════════════════════════════════════════════════════
   ║  LAYOUT
   ╚══════════════════════════════════════════════════════════════ */
.admin-layout {
  display: flex;
  min-height: 100vh;
  background: var(--bg-base);
  font-family: 'Inter', sans-serif;
  color: var(--text-primary);
}

.main-content {
  flex: 1;
  margin-left: 260px;
  transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  overflow-x: hidden;
  min-width: 0;
}

/* ╔══════════════════════════════════════════════════════════════
   ║  SIDEBAR
   ╚══════════════════════════════════════════════════════════════ */
.sidebar {
  position: fixed;
  left: 0; top: 0; bottom: 0;
  width: 260px;
  background: var(--bg-surface);
  border-right: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  z-index: 100;
  transition: width 0.3s cubic-bezier(0.4,0,0.2,1);
  overflow: hidden;
}
.sidebar--collapsed {
  width: 72px;
}
.sidebar--collapsed ~ .main-content {
  margin-left: 72px;
}

/* Brand */
.sidebar__brand {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 20px 16px;
  border-bottom: 1px solid var(--border);
  min-height: 72px;
}
.sidebar__logo {
  width: 40px; height: 40px;
  background: linear-gradient(135deg, #6366f1, #a855f7);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
  box-shadow: 0 4px 14px rgba(99,102,241,0.4);
}
.sidebar__brand-text {
  display: flex; flex-direction: column;
  overflow: hidden;
}
.sidebar__title {
  font-size: 15px; font-weight: 700;
  color: var(--text-primary);
  white-space: nowrap;
}
.sidebar__subtitle {
  font-size: 11px; font-weight: 500;
  color: var(--text-muted);
  text-transform: uppercase; letter-spacing: 0.5px;
}

/* Toggle */
.sidebar__toggle {
  position: absolute;
  top: 22px; right: -14px;
  width: 28px; height: 28px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: 50%;
  color: var(--text-secondary);
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 14px;
  transition: var(--transition);
  z-index: 200;
}
.sidebar__toggle:hover {
  background: var(--accent);
  color: white;
  border-color: var(--accent);
}

/* Nav */
.sidebar__nav {
  flex: 1;
  padding: 16px 12px;
  overflow-y: auto;
  scrollbar-width: none;
}
.sidebar__nav::-webkit-scrollbar { display: none; }
.sidebar__nav-group { margin-bottom: 24px; }
.sidebar__nav-label {
  font-size: 10px; font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase; letter-spacing: 1px;
  padding: 0 8px;
  display: block; margin-bottom: 8px;
  white-space: nowrap;
}
.sidebar__nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: var(--radius-sm);
  color: var(--text-secondary);
  text-decoration: none;
  font-size: 14px; font-weight: 500;
  transition: var(--transition);
  position: relative;
  white-space: nowrap;
  margin-bottom: 2px;
}
.sidebar__nav-item:hover {
  background: var(--bg-elevated);
  color: var(--text-primary);
}
.sidebar__nav-item--active {
  background: rgba(99,102,241,0.15) !important;
  color: var(--accent) !important;
}
.sidebar__nav-item--active::before {
  content: '';
  position: absolute;
  left: 0; top: 20%; bottom: 20%;
  width: 3px;
  background: var(--accent);
  border-radius: 2px;
}
.sidebar__nav-icon {
  font-size: 18px;
  flex-shrink: 0;
  width: 20px;
  text-align: center;
}
.sidebar__nav-text { flex: 1; }
.sidebar__nav-badge {
  background: var(--accent);
  color: white;
  font-size: 10px; font-weight: 700;
  padding: 1px 7px;
  border-radius: 20px;
}

/* User */
.sidebar__user {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 16px;
  border-top: 1px solid var(--border);
  cursor: pointer;
  transition: var(--transition);
  min-height: 68px;
}
.sidebar__user:hover { background: var(--bg-elevated); }
.sidebar__user-avatar {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, #6366f1, #a855f7);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700; color: white;
  flex-shrink: 0;
}
.sidebar__user-info {
  flex: 1;
  display: flex; flex-direction: column;
  overflow: hidden;
}
.sidebar__user-name {
  font-size: 13px; font-weight: 600;
  color: var(--text-primary);
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.sidebar__user-role {
  font-size: 11px;
  color: var(--text-muted);
}
.sidebar__logout-btn {
  background: none; border: none;
  color: var(--text-muted);
  cursor: pointer; font-size: 16px;
  padding: 4px; border-radius: 6px;
  transition: var(--transition);
}
.sidebar__logout-btn:hover { color: var(--error); background: rgba(239,68,68,0.1); }

/* ╔══════════════════════════════════════════════════════════════
   ║  TOPBAR
   ╚══════════════════════════════════════════════════════════════ */
.topbar {
  height: var(--topbar-h);
  background: var(--bg-surface);
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 28px;
  gap: 16px;
  position: sticky; top: 0; z-index: 50;
}
.topbar__title {
  font-size: 20px; font-weight: 700;
  color: var(--text-primary); margin: 0;
}
.topbar__subtitle {
  font-size: 12px; color: var(--text-muted); margin: 0;
}
.topbar__right {
  display: flex; align-items: center; gap: 14px;
}

/* Search */
.search-box {
  display: flex; align-items: center; gap: 8px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 8px 14px;
  transition: var(--transition);
}
.search-box:focus-within {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.search-box__icon { color: var(--text-muted); font-size: 16px; }
.search-box__input {
  background: none; border: none; outline: none;
  color: var(--text-primary); font-size: 14px;
  width: 200px;
}
.search-box__input::placeholder { color: var(--text-muted); }

/* Notification */
.notif-btn {
  position: relative;
  width: 40px; height: 40px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; font-size: 18px; color: var(--text-secondary);
  transition: var(--transition);
}
.notif-btn:hover { background: var(--bg-hover); color: var(--text-primary); }
.notif-btn__badge {
  position: absolute;
  top: -4px; right: -4px;
  background: var(--error);
  color: white; font-size: 10px; font-weight: 700;
  width: 18px; height: 18px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
}

/* Notification Dropdown */
.notif-dropdown {
  position: absolute;
  top: calc(100% + 12px); right: 0;
  width: 320px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  z-index: 300;
  animation: dropIn 0.2s ease;
}
.notif-dropdown__header {
  display: flex; justify-content: space-between; align-items: center;
  padding: 14px 16px;
  border-bottom: 1px solid var(--border);
  font-size: 14px; font-weight: 600; color: var(--text-primary);
}
.notif-dropdown__clear {
  font-size: 12px; color: var(--accent); cursor: pointer;
}
.notif-item {
  display: flex; gap: 12px;
  padding: 12px 16px;
  border-bottom: 1px solid var(--border-subtle);
  transition: var(--transition);
  cursor: pointer;
}
.notif-item:hover { background: var(--bg-hover); }
.notif-item__icon {
  width: 34px; height: 34px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px; flex-shrink: 0;
}
.notif-item__icon--success { background: rgba(16,185,129,0.15); color: var(--success); }
.notif-item__icon--info    { background: rgba(34,211,238,0.15);  color: var(--info); }
.notif-item__icon--warning { background: rgba(245,158,11,0.15);  color: var(--warning); }
.notif-item__icon--error   { background: rgba(239,68,68,0.15);   color: var(--error); }
.notif-item__text  { font-size: 13px; color: var(--text-primary); margin: 0 0 2px; }
.notif-item__time  { font-size: 11px; color: var(--text-muted); }

/* Admin Avatar */
.admin-avatar {
  width: 40px; height: 40px;
  background: linear-gradient(135deg, #6366f1, #a855f7);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 14px; font-weight: 700; color: white;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(99,102,241,0.3);
  transition: var(--transition);
}
.admin-avatar:hover { transform: scale(1.05); }

/* ╔══════════════════════════════════════════════════════════════
   ║  DASHBOARD CONTENT
   ╚══════════════════════════════════════════════════════════════ */
.dashboard-content {
  padding: 24px 28px;
  display: flex;
  flex-direction: column;
  gap: 24px;
  flex: 1;
}

/* ╔══════════════════════════════════════════════════════════════
   ║  STAT CARDS
   ╚══════════════════════════════════════════════════════════════ */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 18px;
}
.stat-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  transition: var(--transition);
  cursor: default;
  position: relative;
}
.stat-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: var(--card-color);
}
.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 32px rgba(0,0,0,0.3);
  border-color: var(--card-color, var(--border));
}
.stat-card__body {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 20px 20px 12px;
}
.stat-card__info { display: flex; flex-direction: column; gap: 4px; }
.stat-card__label {
  font-size: 12px; font-weight: 500;
  color: var(--text-muted);
  text-transform: uppercase; letter-spacing: 0.5px;
}
.stat-card__value {
  font-size: 28px; font-weight: 800;
  color: var(--text-primary);
  line-height: 1.1;
  font-variant-numeric: tabular-nums;
}
.stat-card__change {
  display: flex; align-items: center; gap: 2px;
  font-size: 12px; font-weight: 500;
}
.stat-card__change--up   { color: var(--success); }
.stat-card__change--down { color: var(--error); }
.stat-card__icon-wrap {
  width: 48px; height: 48px;
  border-radius: 12px;
  background: var(--card-color-light);
  display: flex; align-items: center; justify-content: center;
}
.stat-card__icon {
  font-size: 22px;
  color: var(--card-color);
}
.stat-card__sparkline {
  padding: 0 20px 14px;
  height: 40px;
}
.sparkline {
  width: 100%; height: 100%;
  color: var(--card-color);
  opacity: 0.6;
}

/* ╔══════════════════════════════════════════════════════════════
   ║  MIDDLE ROW
   ╚══════════════════════════════════════════════════════════════ */
.middle-row {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 18px;
}

/* ─── Chart Card ─── */
.chart-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 20px;
  display: flex; flex-direction: column; gap: 16px;
}
.card-header {
  display: flex; justify-content: space-between; align-items: flex-start;
}
.card-header__title {
  font-size: 16px; font-weight: 700;
  color: var(--text-primary); margin: 0 0 4px;
}
.card-header__sub {
  font-size: 12px; color: var(--text-muted); margin: 0;
}
.chart-legend {
  display: flex; align-items: center; gap: 6px;
  font-size: 12px; color: var(--text-muted);
}
.chart-legend__dot {
  width: 10px; height: 10px;
  border-radius: 50%; display: inline-block;
}
.bar-chart-wrap { overflow: hidden; }
.bar-chart-svg { width: 100%; height: 220px; }
.bar-label {
  font-size: 9px;
  fill: #64748b;
  font-family: 'Inter', sans-serif;
}
.bar-animate {
  animation: barRise 0.8s cubic-bezier(0.4,0,0.2,1) both;
  transform-origin: bottom;
}
@keyframes barRise {
  from { transform: scaleY(0); }
  to   { transform: scaleY(1); }
}

/* ─── Quick Stats ─── */
.quick-stats {
  display: flex; flex-direction: column; gap: 18px;
}

/* Donut Card */
.donut-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 20px;
  text-align: center;
}
.donut-card__title {
  font-size: 15px; font-weight: 700;
  color: var(--text-primary); margin: 0 0 16px;
  text-align: left;
}
.donut-wrap { display: flex; justify-content: center; }
.donut-svg { width: 140px; height: 140px; }
.donut-circle {
  transition: stroke-dasharray 1.2s cubic-bezier(0.4,0,0.2,1);
}
.donut-text {
  font-size: 22px; font-weight: 800;
  fill: #f1f5f9;
  font-family: 'Inter', sans-serif;
}
.donut-card__sub {
  font-size: 12px; color: var(--text-muted); margin: 10px 0 0;
}

/* Recruiters Card */
.recruiters-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 20px;
  flex: 1;
}
.recruiters-card__title {
  font-size: 15px; font-weight: 700;
  color: var(--text-primary); margin: 0 0 14px;
}
.recruiter-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.recruiter-item {
  display: flex; align-items: center; gap: 10px;
}
.recruiter-item__logo {
  width: 32px; height: 32px;
  border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 700; color: white;
  flex-shrink: 0;
}
.recruiter-item__info { flex: 1; min-width: 0; }
.recruiter-item__name {
  font-size: 13px; font-weight: 500; color: var(--text-primary);
  display: block; margin-bottom: 4px;
}
.recruiter-item__bar-wrap {
  background: var(--bg-hover); border-radius: 4px; height: 5px;
}
.recruiter-item__bar {
  height: 100%; border-radius: 4px;
  transition: width 1s cubic-bezier(0.4,0,0.2,1);
}
.recruiter-item__count {
  font-size: 12px; font-weight: 700; color: var(--text-secondary);
  min-width: 28px; text-align: right;
}

/* ╔══════════════════════════════════════════════════════════════
   ║  BOTTOM ROW
   ╚══════════════════════════════════════════════════════════════ */
.bottom-row {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 18px;
  align-items: start;
}

/* ─── Table Card ─── */
.table-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
}
.table-card .card-header {
  padding: 18px 20px;
  border-bottom: 1px solid var(--border);
}
.table-wrap { overflow-x: auto; }
.data-table {
  width: 100%; border-collapse: collapse;
  font-size: 13px;
}
.data-table th {
  background: var(--bg-elevated);
  color: var(--text-muted);
  font-size: 11px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 0.5px;
  padding: 10px 14px;
  text-align: left;
  white-space: nowrap;
}
.data-table td {
  padding: 12px 14px;
  color: var(--text-secondary);
  border-top: 1px solid var(--border-subtle);
  vertical-align: middle;
}
.table-row { transition: var(--transition); }
.table-row:hover td { background: var(--bg-elevated); }
.text-muted { color: var(--text-muted) !important; }

/* Student cell */
.student-cell { display: flex; align-items: center; gap: 10px; }
.student-avatar {
  width: 32px; height: 32px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 12px; font-weight: 700; color: white;
  flex-shrink: 0;
}
.student-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
.student-branch { font-size: 11px; color: var(--text-muted); }
.company-badge {
  font-size: 12px; font-weight: 600;
  padding: 3px 10px; border-radius: 20px;
}
.role-cell { color: var(--text-primary) !important; font-weight: 500; }

/* Status Badge */
.status-badge {
  display: inline-flex; align-items: center; gap: 5px;
  font-size: 12px; font-weight: 600;
  padding: 3px 10px; border-radius: 20px;
  white-space: nowrap;
}
.status-badge__dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: currentColor;
  animation: pulse 2s infinite;
}
.status-badge--pending   { background: rgba(245,158,11,0.15);  color: var(--warning); }
.status-badge--approved  { background: rgba(16,185,129,0.15);  color: var(--success); }
.status-badge--rejected  { background: rgba(239,68,68,0.15);   color: var(--error); }
.status-badge--interview { background: rgba(34,211,238,0.15);  color: var(--info); }

/* Action Buttons */
.action-btns { display: flex; gap: 6px; }
.action-btn {
  width: 28px; height: 28px;
  border: none; border-radius: 6px;
  cursor: pointer; font-size: 13px;
  display: flex; align-items: center; justify-content: center;
  transition: var(--transition);
}
.action-btn--view   { background: rgba(99,102,241,0.1);  color: var(--accent); }
.action-btn--approve { background: rgba(16,185,129,0.1); color: var(--success); }
.action-btn--reject  { background: rgba(239,68,68,0.1);  color: var(--error); }
.action-btn:hover { transform: scale(1.1); filter: brightness(1.2); }

/* ─── Buttons ─── */
.btn-primary {
  display: flex; align-items: center; gap: 6px;
  background: var(--accent);
  color: white; border: none;
  padding: 8px 14px; border-radius: var(--radius-sm);
  font-size: 13px; font-weight: 600;
  cursor: pointer; transition: var(--transition);
}
.btn-primary:hover { background: var(--accent-hover); transform: translateY(-1px); }
.btn-outline {
  display: flex; align-items: center; gap: 6px;
  background: none;
  color: var(--text-secondary);
  border: 1px solid var(--border);
  padding: 7px 14px; border-radius: var(--radius-sm);
  font-size: 13px; font-weight: 500;
  cursor: pointer; transition: var(--transition);
}
.btn-outline:hover { border-color: var(--accent); color: var(--accent); }

/* ─── Right Panel ─── */
.right-panel { display: flex; flex-direction: column; gap: 18px; }

/* Jobs Card */
.jobs-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
}
.jobs-card .card-header {
  padding: 16px 18px;
  border-bottom: 1px solid var(--border);
}
.job-list { display: flex; flex-direction: column; }
.job-item {
  display: flex; align-items: center; gap: 12px;
  padding: 12px 18px;
  border-bottom: 1px solid var(--border-subtle);
  transition: var(--transition);
  cursor: pointer;
}
.job-item:last-child { border-bottom: none; }
.job-item:hover { background: var(--bg-elevated); }
.job-item__logo {
  width: 38px; height: 38px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 12px; font-weight: 700; color: white;
  flex-shrink: 0;
}
.job-item__info { flex: 1; min-width: 0; }
.job-item__title {
  font-size: 13px; font-weight: 600; color: var(--text-primary);
  display: block; margin-bottom: 4px;
}
.job-item__meta {
  display: flex; gap: 10px;
  font-size: 11px; color: var(--text-muted);
}
.job-item__meta i { margin-right: 3px; }
.job-item__right {
  display: flex; flex-direction: column; align-items: flex-end; gap: 4px;
}
.job-item__applications { font-size: 11px; color: var(--text-muted); }
.job-item__status {
  font-size: 10px; font-weight: 600;
  padding: 2px 8px; border-radius: 12px;
}
.job-item__status--open   { background: rgba(16,185,129,0.15); color: var(--success); }
.job-item__status--closed { background: rgba(239,68,68,0.15);  color: var(--error); }

/* Activity Card */
.activity-card {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 18px;
}
.activity-card .card-header { margin-bottom: 14px; }
.activity-list { list-style: none; padding: 0; margin: 0; }
.activity-item {
  display: flex; gap: 12px;
  padding: 10px 0;
  border-bottom: 1px solid var(--border-subtle);
}
.activity-item:last-child { border-bottom: none; }
.activity-item__dot {
  width: 30px; height: 30px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 14px; flex-shrink: 0;
}
.activity-item__dot--success { background: rgba(16,185,129,0.15);  color: var(--success); }
.activity-item__dot--info    { background: rgba(34,211,238,0.15);  color: var(--info); }
.activity-item__dot--warning { background: rgba(245,158,11,0.15);  color: var(--warning); }
.activity-item__dot--error   { background: rgba(239,68,68,0.15);   color: var(--error); }
.activity-item__content { flex: 1; }
.activity-item__text {
  font-size: 12px; color: var(--text-secondary);
  margin: 0 0 2px; line-height: 1.5;
}
.activity-item__time { font-size: 11px; color: var(--text-muted); }

/* ╔══════════════════════════════════════════════════════════════
   ║  ANIMATIONS
   ╚══════════════════════════════════════════════════════════════ */
.fade-slide-enter-active,
.fade-slide-leave-active { transition: opacity 0.2s ease, transform 0.2s ease; }
.fade-slide-enter-from, .fade-slide-leave-to { opacity: 0; transform: translateX(-6px); }

@keyframes dropIn {
  from { opacity: 0; transform: translateY(-8px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.4; }
}

/* ╔══════════════════════════════════════════════════════════════
   ║  SETTINGS PAGE
   ╚══════════════════════════════════════════════════════════════ */
.settings-hero {
  display: flex;
  align-items: center;
  gap: 18px;
  background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(168,85,247,0.08));
  border: 1px solid rgba(99,102,241,0.2);
  border-radius: var(--radius);
  padding: 24px 28px;
}
.settings-hero__icon {
  width: 56px; height: 56px;
  background: linear-gradient(135deg, #6366f1, #a855f7);
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  font-size: 26px; color: white;
  box-shadow: 0 6px 20px rgba(99,102,241,0.35);
  flex-shrink: 0;
}
.settings-hero__title {
  font-size: 22px; font-weight: 800;
  color: var(--text-primary); margin: 0 0 4px;
}
.settings-hero__sub {
  font-size: 13px; color: var(--text-muted); margin: 0;
}

/* Tabs */
.settings-tabs {
  display: flex;
  gap: 6px;
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 8px;
  flex-wrap: wrap;
}
.settings-tab {
  display: flex; align-items: center; gap: 7px;
  padding: 9px 16px;
  border: none; background: none;
  border-radius: var(--radius-sm);
  font-size: 13px; font-weight: 500;
  color: var(--text-secondary);
  cursor: pointer;
  transition: var(--transition);
  white-space: nowrap;
}
.settings-tab i { font-size: 15px; }
.settings-tab:hover { background: var(--bg-elevated); color: var(--text-primary); }
.settings-tab--active {
  background: rgba(99,102,241,0.15) !important;
  color: var(--accent) !important;
  font-weight: 600;
}

/* Panel / Section */
.settings-panel { display: flex; flex-direction: column; gap: 20px; }
.settings-section {
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 24px;
}
.settings-section__title {
  font-size: 15px; font-weight: 700;
  color: var(--text-primary);
  margin: 0 0 20px;
  padding-bottom: 14px;
  border-bottom: 1px solid var(--border);
}

/* Avatar row */
.settings-avatar-row {
  display: flex; align-items: center; gap: 20px;
  margin-bottom: 24px;
}
.settings-avatar {
  width: 80px; height: 80px;
  background: linear-gradient(135deg, #6366f1, #a855f7);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 28px; font-weight: 800; color: white;
  position: relative; cursor: pointer;
  flex-shrink: 0;
  box-shadow: 0 6px 20px rgba(99,102,241,0.35);
}
.settings-avatar__overlay {
  position: absolute; inset: 0;
  background: rgba(0,0,0,0.5);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; font-size: 22px; color: white;
  transition: var(--transition);
}
.settings-avatar:hover .settings-avatar__overlay { opacity: 1; }
.settings-avatar__name {
  font-size: 15px; font-weight: 700; color: var(--text-primary); margin: 0 0 4px;
}
.settings-avatar__role {
  font-size: 12px; color: var(--text-muted); margin: 0 0 10px;
}

/* Form grid */
.settings-form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
.settings-field { display: flex; flex-direction: column; gap: 6px; }
.settings-field--full { grid-column: 1 / -1; }
.settings-field label {
  font-size: 12px; font-weight: 600;
  color: var(--text-muted);
  text-transform: uppercase; letter-spacing: 0.4px;
}
.settings-input {
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 10px 14px;
  font-size: 14px; color: var(--text-primary);
  font-family: 'Inter', sans-serif;
  outline: none;
  transition: var(--transition);
  width: 100%; box-sizing: border-box;
}
.settings-input:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.settings-textarea { resize: vertical; min-height: 80px; }

/* Actions */
.settings-actions {
  display: flex; gap: 10px;
  margin-top: 20px;
  padding-top: 16px;
  border-top: 1px solid var(--border);
}

/* Toggle list */
.settings-toggle-list { display: flex; flex-direction: column; gap: 0; }
.settings-toggle-item {
  display: flex; justify-content: space-between; align-items: center;
  padding: 14px 0;
  border-bottom: 1px solid var(--border-subtle);
}
.settings-toggle-item:last-child { border-bottom: none; }
.settings-toggle-item__info { display: flex; flex-direction: column; gap: 3px; }
.settings-toggle-item__label { font-size: 14px; font-weight: 500; color: var(--text-primary); }
.settings-toggle-item__desc  { font-size: 12px; color: var(--text-muted); }

/* Toggle switch */
.toggle-switch { position: relative; cursor: pointer; }
.toggle-switch input { display: none; }
.toggle-switch__track {
  display: block;
  width: 44px; height: 24px;
  background: var(--bg-hover);
  border-radius: 12px;
  border: 2px solid var(--border);
  transition: var(--transition);
  position: relative;
}
.toggle-switch__track::after {
  content: '';
  position: absolute;
  top: 2px; left: 2px;
  width: 16px; height: 16px;
  background: var(--text-muted);
  border-radius: 50%;
  transition: var(--transition);
}
.toggle-switch input:checked + .toggle-switch__track {
  background: rgba(99,102,241,0.2);
  border-color: var(--accent);
}
.toggle-switch input:checked + .toggle-switch__track::after {
  background: var(--accent);
  transform: translateX(20px);
}

/* Session list */
.session-list { display: flex; flex-direction: column; gap: 12px; }
.session-item {
  display: flex; align-items: center; gap: 14px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 14px 16px;
}
.session-item__icon {
  width: 38px; height: 38px;
  background: rgba(99,102,241,0.12);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 18px; color: var(--accent);
  flex-shrink: 0;
}
.session-item__info { flex: 1; display: flex; flex-direction: column; gap: 3px; }
.session-item__device { font-size: 14px; font-weight: 500; color: var(--text-primary); }
.session-item__meta   { font-size: 12px; color: var(--text-muted); }
.session-item__current {
  font-size: 11px; font-weight: 700;
  background: rgba(16,185,129,0.15); color: var(--success);
  padding: 3px 10px; border-radius: 20px;
}

/* Theme options */
.theme-options { display: flex; gap: 16px; flex-wrap: wrap; }
.theme-option {
  display: flex; flex-direction: column; align-items: center; gap: 10px;
  cursor: pointer; position: relative;
}
.theme-option__preview {
  width: 110px; height: 72px;
  border-radius: 10px;
  display: flex;
  overflow: hidden;
  border: 2px solid var(--border);
  transition: var(--transition);
}
.theme-option--active .theme-option__preview { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(99,102,241,0.2); }
.theme-option__sidebar { width: 28px; flex-shrink: 0; }
.theme-option__content { flex: 1; padding: 8px 6px; display: flex; flex-direction: column; gap: 5px; }
.theme-option__bar {
  height: 8px; border-radius: 4px;
  background: rgba(255,255,255,0.15);
}
.theme-option__bar--sm { height: 5px; }
.theme-option__label { font-size: 12px; font-weight: 600; color: var(--text-secondary); }
.theme-option__check {
  position: absolute; top: 6px; right: 6px;
  width: 20px; height: 20px;
  background: var(--accent); color: white;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 12px;
}

/* Accent palette */
.accent-palette { display: flex; gap: 10px; flex-wrap: wrap; }
.accent-swatch {
  width: 32px; height: 32px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid transparent;
  transition: var(--transition);
}
.accent-swatch:hover { transform: scale(1.15); }
.accent-swatch--active { border-color: white; box-shadow: 0 0 0 3px rgba(255,255,255,0.3); transform: scale(1.1); }

/* ╔══════════════════════════════════════════════════════════════
   ║  SCROLLBAR
   ╚══════════════════════════════════════════════════════════════ */
* { scrollbar-width: thin; scrollbar-color: #334155 transparent; }
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }

/* ╔══════════════════════════════════════════════════════════════
   ║  RESPONSIVE
   ╚══════════════════════════════════════════════════════════════ */
@media (max-width: 1280px) {
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .middle-row, .bottom-row { grid-template-columns: 1fr; }
  .quick-stats { flex-direction: row; }
}
@media (max-width: 768px) {
  .sidebar { width: 72px; }
  .main-content { margin-left: 72px; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
  .search-box { display: none; }
  .dashboard-content { padding: 16px; }
  .quick-stats { flex-direction: column; }
}
</style>
