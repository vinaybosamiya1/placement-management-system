<script setup>
import { ref } from 'vue';

const oldPassword = ref('');
const newPassword = ref('');
const confirmPassword = ref('');

const updatePassword = () => {
  console.log('Password updating...');
  // Logic here
};
</script>

<template>
  <div class="fade-in page-container">
    <div class="page-header">
      <div>
        <h2>Change Password</h2>
        <p>Ensure your account is using a long, random password to stay secure.</p>
      </div>
    </div>
    
    <div class="card max-w">
      <div class="form-group">
        <label>Current Password</label>
        <input v-model="oldPassword" type="password" class="form-input">
      </div>
      <div class="form-group">
        <label>New Password</label>
        <input v-model="newPassword" type="password" class="form-input">
      </div>
      <div class="form-group">
        <label>Confirm New Password</label>
        <input v-model="confirmPassword" type="password" class="form-input">
      </div>
      
      <div class="form-actions mt-4">
        <button class="btn-primary" @click="updatePassword">Update Password</button>
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
.card { background: rgba(17, 24, 39, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 2rem; }
.max-w { max-width: 500px; }
.form-group { margin-bottom: 1.25rem; }
label { display: block; font-size: 0.8rem; color: #9ca3af; margin-bottom: 0.5rem; }
.form-input { width: 100%; background: rgba(10, 15, 28, 0.5); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 0.8rem 1rem; color: #fff; box-sizing: border-box; transition: all 0.2s; }
.form-input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
.btn-primary { background: linear-gradient(90deg, #4f46e5 0%, #3b82f6 100%); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.2s; }
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
.mt-4 { margin-top: 1.5rem; }
.form-actions { display: flex; justify-content: flex-end; }
</style>
