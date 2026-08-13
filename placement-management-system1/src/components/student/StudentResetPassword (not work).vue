<template>
  <div class="space-y-6 max-w-3xl mx-auto">
    <!-- Header Banner -->
    <div
      class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 p-6 rounded-3xl shadow-xl flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-black text-white tracking-tight">Reset / Set Password</h1>
        <p class="text-xs text-slate-400">Update your account password for secure login</p>
      </div>
      <div
        class="w-10 h-10 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center font-bold">
        🔑
      </div>
    </div>

    <!-- Password Reset Card -->
    <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">

      <!-- Registered Email Badge -->
      <div class="flex items-center gap-3 bg-slate-950/80 border border-slate-800 rounded-2xl p-4">
        <div
          class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold flex-shrink-0 shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
        <div>
          <p class="text-[10px] text-slate-400 uppercase tracking-widest font-extrabold">Student Account Email</p>
          <p class="text-sm font-bold text-white truncate">{{ userEmail || 'Loading account info...' }}</p>
        </div>
        <span
          class="ml-auto text-xs font-bold px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-300 border border-emerald-500/30">
          Verified
        </span>
      </div>

      <!-- Password Reset Form -->
      <form @submit.prevent="handleSetPassword" class="space-y-5">

        <!-- New Password Field -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">New Password</label>
          <div class="relative">
            <input v-model="form.password" :type="showPassword ? 'text' : 'password'" required minlength="6"
              placeholder="Enter at least 6 characters"
              class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 shadow-inner pr-10" />
            <button type="button" @click="showPassword = !showPassword"
              class="absolute right-3.5 top-3.5 text-slate-400 hover:text-white transition-colors">
              <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
              <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
              </svg>
            </button>
          </div>

          <!-- Password Strength Meter -->
          <div v-if="form.password" class="space-y-1 pt-1">
            <div class="flex gap-1.5">
              <div v-for="i in 4" :key="i" class="h-1.5 flex-1 rounded-full transition-all duration-300"
                :class="i <= passwordStrength ? strengthColor : 'bg-slate-800'"></div>
            </div>
            <p class="text-[11px] font-bold" :class="strengthTextColor">{{ strengthLabel }}</p>
          </div>
        </div>

        <!-- Confirm Password Field -->
        <div class="space-y-1.5">
          <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Confirm Password</label>
          <div class="relative">
            <input v-model="form.confirmPassword" :type="showConfirm ? 'text' : 'password'" required
              placeholder="Re-enter new password"
              class="w-full bg-slate-950 border rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none shadow-inner pr-10"
              :class="passwordMismatch ? 'border-rose-500/80 focus:border-rose-500' : 'border-slate-800 focus:border-blue-500'" />
            <button type="button" @click="showConfirm = !showConfirm"
              class="absolute right-3.5 top-3.5 text-slate-400 hover:text-white transition-colors">
              <svg v-if="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
              <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
              </svg>
            </button>
          </div>
          <p v-if="passwordMismatch" class="text-xs text-rose-400 font-semibold mt-1">Passwords do not match.</p>
          <p v-else-if="passwordMatch" class="text-xs text-emerald-400 font-semibold mt-1">✓ Passwords match.</p>
        </div>

        <!-- Feedback Message Banner -->
        <Transition name="fade">
          <div v-if="message"
            :class="[messageType === 'success' ? 'bg-emerald-500/15 border-emerald-500/30 text-emerald-300' : 'bg-rose-500/15 border-rose-500/30 text-rose-300']"
            class="p-3.5 rounded-xl border text-xs font-semibold flex items-center gap-2">
            <span>{{ message }}</span>
          </div>
        </Transition>

        <!-- Submit Button -->
        <div class="pt-2">
          <button type="submit" :disabled="loading || passwordMismatch || !form.password"
            class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 disabled:opacity-50 text-white font-black text-xs rounded-xl shadow-lg shadow-blue-500/25 active:scale-95 transition-all cursor-pointer flex items-center justify-center gap-2">
            <svg v-if="loading" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
              </path>
            </svg>
            <span>Update Account Password</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import axios from 'axios';

const form = reactive({ password: '', confirmPassword: '' });
const showPassword = ref(false);
const showConfirm = ref(false);
const loading = ref(false);
const message = ref('');
const messageType = ref('');
const userEmail = ref('');

const passwordMismatch = computed(() => form.confirmPassword.length > 0 && form.password !== form.confirmPassword);
const passwordMatch = computed(() => form.confirmPassword.length > 0 && form.password === form.confirmPassword);

const passwordStrength = computed(() => {
  const p = form.password;
  if (!p) return 0;
  let score = 0;
  if (p.length >= 6) score++;
  if (p.length >= 10) score++;
  if (/[A-Z]/.test(p) && /[a-z]/.test(p)) score++;
  if (/[0-9]/.test(p) && /[^A-Za-z0-9]/.test(p)) score++;
  return score;
});

const strengthColor = computed(() => {
  const colors = ['bg-rose-500', 'bg-orange-400', 'bg-yellow-400', 'bg-emerald-500'];
  return colors[passwordStrength.value - 1] || 'bg-rose-500';
});

const strengthLabel = computed(() => {
  const labels = ['Weak Password', 'Fair Password', 'Good Password', 'Strong Password'];
  return labels[passwordStrength.value - 1] || 'Too short';
});

const strengthTextColor = computed(() => {
  const colors = ['text-rose-400', 'text-orange-400', 'text-yellow-400', 'text-emerald-400'];
  return colors[passwordStrength.value - 1] || 'text-rose-400';
});

async function handleSetPassword() {
  if (passwordMismatch.value) {
    message.value = 'Passwords do not match.';
    messageType.value = 'error';
    return;
  }

  loading.value = true;
  message.value = '';

  try {
    const res = await axios.post(
      'http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/setPassword.php',
      { password: form.password },
      { withCredentials: true }
    );

    if (res.data && res.data.status) {
      message.value = 'Password updated successfully!';
      messageType.value = 'success';
      form.password = '';
      form.confirmPassword = '';
    } else {
      message.value = res.data.message || 'Failed to set password. Please try again.';
      messageType.value = 'error';
    }
  } catch (err) {
    message.value = 'Unable to connect to server. Please try again.';
    messageType.value = 'error';
  } finally {
    loading.value = false;
  }
}

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php', {
      withCredentials: true
    });
    if (res.data && res.data.success && res.data.user) {
      userEmail.value = res.data.user.email;
    }
  } catch (err) {
    userEmail.value = localStorage.getItem('googleUserEmail') || 'Student Email';
  }
});
</script>
