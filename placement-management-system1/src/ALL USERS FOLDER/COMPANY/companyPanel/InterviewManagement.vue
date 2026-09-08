<script setup>
import { ref } from 'vue';

const upcomingInterviews = ref([
  { id: 1, candidate: 'Priya Patel', role: 'Frontend Developer', date: '10 Aug 2026', time: '10:00 AM', round: 'Technical Round 1', link: 'meet.google.com/abc-def-ghi' },
  { id: 2, candidate: 'Rahul Sharma', role: 'Associate Software Engineer', date: '11 Aug 2026', time: '02:00 PM', round: 'HR Round', link: 'meet.google.com/xyz-uvw-rst' }
]);
</script>

<template>
  <div class="interviews-container fade-in">
    <div class="page-header">
      <div>
        <h2>Interview Management</h2>
        <p>Schedule and track upcoming interviews with candidates.</p>
      </div>
      <button class="btn-primary">
        <i class="ri-calendar-check-line"></i> Schedule Interview
      </button>
    </div>

    <div class="interviews-grid">
      <div v-for="interview in upcomingInterviews" :key="interview.id" class="interview-card">
        <div class="card-header">
          <div class="date-box">
            <span class="month">{{ interview.date.split(' ')[1] }}</span>
            <span class="day">{{ interview.date.split(' ')[0] }}</span>
          </div>
          <div class="interview-info">
            <h3>{{ interview.candidate }}</h3>
            <p>{{ interview.role }} &bull; {{ interview.round }}</p>
          </div>
        </div>
        <div class="card-body">
          <div class="info-row">
            <i class="ri-time-line"></i> {{ interview.time }}
          </div>
          <div class="info-row">
            <i class="ri-links-line"></i> <a :href="'https://' + interview.link" target="_blank">{{ interview.link }}</a>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn-outline">Reschedule</button>
          <button class="btn-primary btn-small">Join Meeting</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* styles for interviews */
.interviews-container { display: flex; flex-direction: column; gap: 1.5rem; }
.fade-in { animation: fadeIn 0.3s ease-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; }
.page-header h2 { font-size: 1.5rem; font-weight: 600; color: #fff; margin: 0 0 0.25rem 0; }
.page-header p { color: #9ca3af; font-size: 0.9rem; margin: 0; }
.btn-primary { background: linear-gradient(90deg, #4f46e5 0%, #3b82f6 100%); color: white; border: none; padding: 0.6rem 1.25rem; border-radius: 8px; font-weight: 500; display: flex; align-items: center; gap: 0.5rem; cursor: pointer; transition: all 0.2s; }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }

.interviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; }
.interview-card { background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 1.5rem; transition: transform 0.2s; }
.interview-card:hover { transform: translateY(-3px); border-color: rgba(59, 130, 246, 0.3); }
.card-header { display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: center; }
.date-box { background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: 12px; min-width: 60px; height: 60px; display: flex; flex-direction: column; align-items: center; justify-content: center; }
.date-box .month { font-size: 0.7rem; text-transform: uppercase; color: #60a5fa; font-weight: 600; }
.date-box .day { font-size: 1.4rem; font-weight: 700; color: #fff; line-height: 1; }
.interview-info h3 { font-size: 1.1rem; color: #f3f4f6; margin: 0 0 0.25rem 0; }
.interview-info p { font-size: 0.8rem; color: #9ca3af; margin: 0; }
.card-body { display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1.5rem; }
.info-row { display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: #d1d5db; }
.info-row i { color: #60a5fa; }
.info-row a { color: #60a5fa; text-decoration: none; }
.info-row a:hover { text-decoration: underline; }
.card-footer { display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 1rem; }
.btn-outline { background: transparent; color: #9ca3af; border: 1px solid rgba(255, 255, 255, 0.1); padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.85rem; cursor: pointer; transition: all 0.2s; }
.btn-outline:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
.btn-small { padding: 0.5rem 1rem; font-size: 0.85rem; }
</style>
