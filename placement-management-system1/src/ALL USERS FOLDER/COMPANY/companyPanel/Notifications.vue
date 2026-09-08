<script setup>
</script>
<template>
  <div class="fade-in page-container">
    <div class="page-header">
      <div>
        <h2>Notifications</h2>
        <p>Stay updated with recent alerts and messages.</p>
      </div>
    </div>
    <div class="card">
      <div class="empty-state">
        <i class="ri-notification-off-line"></i>
        <p class="text-muted">No new notifications.</p>
      </div>
    </div>
  </div>
</template>
<style scoped>
.page-container { display: flex; flex-direction: column; gap: 1.5rem; }
.fade-in { animation: fadeIn 0.3s ease-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
.page-header { margin-bottom: 0.5rem; }
.page-header h2 { font-size: 1.5rem; color: #fff; margin-bottom: 0.25rem; font-weight: 600; }
.page-header p { color: #9ca3af; font-size: 0.9rem; margin: 0; }
.card { background: rgba(17, 24, 39, 0.6); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 3rem; text-align: center; }
.empty-state i { font-size: 3rem; color: #4b5563; margin-bottom: 1rem; display: block; }
.text-muted { color: #9ca3af; }
</style>
