<script setup>
import { ref } from 'vue';

const companyData = ref({
  name: 'TechCorp Solutions',
  industry: 'Information Technology',
  website: 'https://techcorpsolutions.example.com',
  location: 'Bangalore, India',
  description: 'We are a leading software development company specializing in cloud-native applications and AI-driven solutions. We empower businesses to digitalize and scale.',
  hrName: 'Anjali Desai',
  hrEmail: 'hr@techcorpsolutions.example.com',
  hrPhone: '+91 98765 43210'
});

const isEditing = ref(false);

const toggleEdit = () => {
  isEditing.value = !isEditing.value;
};

const saveProfile = () => {
  isEditing.value = false;
  // Mock save
  console.log('Profile saved', companyData.value);
};
</script>

<template>
  <div class="profile-container">
    <div class="page-header">
      <div>
        <h2>Company Profile</h2>
        <p>Manage your company details and recruiter contact information.</p>
      </div>
      <button v-if="!isEditing" @click="toggleEdit" class="btn-primary">
        <i class="ri-edit-line"></i> Edit Profile
      </button>
      <div v-else class="action-buttons">
        <button @click="toggleEdit" class="btn-secondary">Cancel</button>
        <button @click="saveProfile" class="btn-primary">Save Changes</button>
      </div>
    </div>

    <div class="profile-grid">
      <!-- Left Column: Logo & Basic Info -->
      <div class="profile-card">
        <div class="logo-section">
          <div class="company-logo">TC</div>
          <button v-if="isEditing" class="btn-outline btn-small mt-3">Upload New Logo</button>
        </div>
        
        <div class="form-group mt-4">
          <label>Company Name</label>
          <input v-if="isEditing" v-model="companyData.name" type="text" class="form-input">
          <div v-else class="value-text">{{ companyData.name }}</div>
        </div>

        <div class="form-group">
          <label>Industry</label>
          <input v-if="isEditing" v-model="companyData.industry" type="text" class="form-input">
          <div v-else class="value-text">{{ companyData.industry }}</div>
        </div>

        <div class="form-group">
          <label>Website</label>
          <input v-if="isEditing" v-model="companyData.website" type="text" class="form-input">
          <div v-else class="value-text"><a :href="companyData.website" target="_blank">{{ companyData.website }}</a></div>
        </div>
      </div>

      <!-- Right Column: Details & HR Info -->
      <div class="details-column">
        <div class="profile-card mb-4">
          <h3 class="card-title">About Company</h3>
          <div class="form-group">
            <label>Description</label>
            <textarea v-if="isEditing" v-model="companyData.description" rows="4" class="form-input"></textarea>
            <div v-else class="value-text">{{ companyData.description }}</div>
          </div>
          <div class="form-group">
            <label>Headquarters Location</label>
            <input v-if="isEditing" v-model="companyData.location" type="text" class="form-input">
            <div v-else class="value-text">{{ companyData.location }}</div>
          </div>
        </div>

        <div class="profile-card">
          <h3 class="card-title">Primary HR Contact</h3>
          <div class="grid-2-col">
            <div class="form-group">
              <label>HR Manager Name</label>
              <input v-if="isEditing" v-model="companyData.hrName" type="text" class="form-input">
              <div v-else class="value-text">{{ companyData.hrName }}</div>
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input v-if="isEditing" v-model="companyData.hrPhone" type="text" class="form-input">
              <div v-else class="value-text">{{ companyData.hrPhone }}</div>
            </div>
            <div class="form-group col-span-2">
              <label>Email Address</label>
              <input v-if="isEditing" v-model="companyData.hrEmail" type="email" class="form-input">
              <div v-else class="value-text">{{ companyData.hrEmail }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.profile-container {
  animation: fadeIn 0.4s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
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

.action-buttons {
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
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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

.btn-outline {
  background: transparent;
  color: #60a5fa;
  border: 1px solid rgba(59, 130, 246, 0.5);
  padding: 0.4rem 1rem;
  border-radius: 6px;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-outline:hover {
  background: rgba(59, 130, 246, 0.1);
}

.mt-3 { margin-top: 0.75rem; }
.mt-4 { margin-top: 1rem; }
.mb-4 { margin-bottom: 1.5rem; }

.profile-grid {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 1.5rem;
}

.profile-card {
  background: rgba(17, 24, 39, 0.6);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 1.5rem;
}

.card-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #e5e7eb;
  margin: 0 0 1.25rem 0;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.logo-section {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.company-logo {
  width: 100px;
  height: 100px;
  background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2.5rem;
  font-weight: 700;
  color: #fff;
  box-shadow: 0 8px 25px rgba(59, 130, 246, 0.2);
}

.form-group {
  margin-bottom: 1.25rem;
}

.form-group:last-child {
  margin-bottom: 0;
}

.form-group label {
  display: block;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #9ca3af;
  margin-bottom: 0.5rem;
}

.value-text {
  font-size: 0.95rem;
  color: #f3f4f6;
  line-height: 1.5;
}

.value-text a {
  color: #60a5fa;
  text-decoration: none;
}

.value-text a:hover {
  text-decoration: underline;
}

.form-input {
  width: 100%;
  background: rgba(10, 15, 28, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px;
  padding: 0.75rem 1rem;
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

textarea.form-input {
  resize: vertical;
  min-height: 100px;
}

.grid-2-col {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.25rem;
}

.col-span-2 {
  grid-column: span 2;
}
</style>
