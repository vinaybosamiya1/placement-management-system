<template>
  <div class="min-h-screen flex flex-col relative overflow-hidden bg-slate-950 font-sans antialiased text-slate-100">
    <!-- Animated Glowing Background Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-blue-600/20 blur-[120px] animate-[pulse_8s_ease-in-out_infinite]"></div>
      <div class="absolute bottom-[-10%] right-[-10%] w-[45vw] h-[45vw] rounded-full bg-teal-500/15 blur-[120px] animate-[pulse_10s_ease-in-out_infinite_2s]"></div>
      <div class="absolute top-[30%] right-[15%] w-[35vw] h-[35vw] rounded-full bg-orange-500/10 blur-[100px] animate-[pulse_12s_ease-in-out_infinite_4s]"></div>
      
      <!-- Floating Background Particles -->
      <div v-for="p in particles" :key="p.id" class="particle" :style="p.style"></div>
    </div>

    <!-- Main Content Area -->
    <div class="relative z-10 flex-1 flex items-center justify-center px-4 py-12">
      <Transition name="card" appear>
        <!-- Split Layout Card -->
        <div class="glass-card w-full max-w-5xl rounded-3xl shadow-2xl border border-white/10 backdrop-blur-xl flex flex-col md:flex-row overflow-hidden">
          
          <!-- LEFT PANEL: Branding -->
          <div class="relative w-full md:w-[42%] bg-gradient-to-b from-blue-600 via-blue-700 to-indigo-950 text-white p-8 md:p-10 flex flex-col justify-between items-center text-center overflow-hidden min-h-[260px] md:min-h-full rounded-b-[40px] md:rounded-b-none md:rounded-r-[110px] border-b md:border-b-0 md:border-r border-white/10 shadow-xl">
            
            <div class="w-full mt-10">
              <span class="text-lg font-bold uppercase tracking-widest text-blue-50 block mb-1">Placement Portal</span>
              <div class="h-[2px] w-8 bg-blue-400 mx-auto rounded-full"></div>
            </div>

            <!-- SVG Logo Section -->
            <div class="logo-wrapper group">
              <img src="../assets/img/placement management system.png" alt="Logo" class="w-80 h-80 drop-shadow-[0_8px_16px_rgba(37,99,235,0.3)] transition-transform duration-500 group-hover:scale-105">
            </div>

            <div class="max-w-[220px]">
              <h2 class="text-lg md:text-xl font-bold tracking-wide text-white mb-2">Start Your Journey!</h2>
              <p class="text-[11px] text-blue-100/70 leading-relaxed">
                Join our platform today to connect with top recruiters and manage your career options seamlessly.
              </p>
            </div>

            <!-- Link to Login -->
            <div class="w-full pt-4">
              <RouterLink 
                to="/login"
                class="inline-block w-full max-w-[150px] border border-blue-300 hover:border-white text-blue-100 hover:text-white font-bold rounded-full py-1.5 px-6 text-xs bg-white/5 hover:bg-white/10 active:scale-95 transition-all duration-300 uppercase tracking-widest"
              >
                Login →
              </RouterLink>
            </div>
          </div>

          <!-- RIGHT PANEL: Registration Form -->
          <div class="w-full md:w-[58%] p-8 md:p-12 flex flex-col justify-center relative z-20">
            
            <div class="mb-6">
              <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Create your account</h2>
              <p class="text-xs text-slate-400 mt-1">Register to apply and track job openings</p>
            </div>

            <!-- Multi-Role Tab Switcher -->
            <div class="flex p-1 bg-slate-900/60 rounded-xl border border-white/5 mb-6 max-w-sm">
              <button 
                type="button" 
                v-for="role in ['student', 'recruiter', 'coordinator']" 
                :key="role"
                @click="selectedRole = role"
                :class="[
                  selectedRole === role 
                    ? 'bg-blue-600 text-white shadow-md' 
                    : 'text-slate-400 hover:text-slate-200'
                ]"
                class="flex-1 py-1.5 text-xs font-bold rounded-lg uppercase tracking-wider transition-all duration-300 capitalize"
              >
                {{ role }}
              </button>
            </div>

            <form @submit.prevent="handleRegister" class="space-y-4">
              
              <!-- Full Name Input -->
              <div class="form-group" :class="{ focused: focus.fullName, filled: form.fullName }">
                <label class="float-label">Full Name</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </span>
                  <input 
                    v-model="form.fullName" 
                    type="text" 
                    required 
                    class="float-input" 
                    @focus="focus.fullName = true"
                    @blur="focus.fullName = false" 
                  />
                  <span class="input-line"></span>
                </div>
              </div>

              <!-- Email Input -->
              <div class="form-group" :class="{ focused: focus.email, filled: form.email }">
                <label class="float-label">Email Address</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </span>
                  <input 
                    v-model="form.email" 
                    type="email" 
                    required 
                    class="float-input" 
                    @focus="focus.email = true"
                    @blur="focus.email = false" 
                  />
                  <span class="input-line"></span>
                </div>
              </div>

              <!-- Password Input -->
              <div class="form-group" :class="{ focused: focus.password, filled: form.password }">
                <label class="float-label">Password</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </span>
                  <input 
                    v-model="form.password" 
                    :type="showPassword ? 'text' : 'password'" 
                    required
                    class="float-input pr-10" 
                    @focus="focus.password = true" 
                    @blur="focus.password = false" 
                  />
                  <button type="button" @click="showPassword = !showPassword" class="eye-btn" tabindex="-1">
                    <Transition name="fade-quick" mode="out-in">
                      <svg v-if="!showPassword" key="eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      <svg v-else key="eye-off" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                      </svg>
                    </Transition>
                  </button>
                  <span class="input-line"></span>
                </div>
              </div>

              <!-- Confirm Password Input -->
              <div class="form-group" :class="{ focused: focus.confirm, filled: form.confirmPassword }">
                <label class="float-label">Confirm Password</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                  </span>
                  
                  <input 
                    v-model="form.confirmPassword" 
                    :type="showConfirm ? 'text' : 'password'" 
                    required
                    class="float-input pr-14 transition-colors" 
                    :class="{ 'border-rose-500 focus:border-rose-500 bg-rose-950/20': passwordMismatch, 'border-emerald-500 focus:border-emerald-500 bg-emerald-950/10': passwordMatch }"
                    @focus="focus.confirm = true" 
                    @blur="focus.confirm = false" 
                  />
                  
                  <!-- Match Icon (Green Check) -->
                  <Transition name="fade-quick">
                    <span v-if="passwordMatch" class="absolute right-10 top-1/2 -translate-y-1/2 text-emerald-400 pointer-events-none">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                      </svg>
                    </span>
                  </Transition>

                  <button type="button" @click="showConfirm = !showConfirm" class="eye-btn" tabindex="-1">
                    <Transition name="fade-quick" mode="out-in">
                      <svg v-if="!showConfirm" key="eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                      <svg v-else key="eye-off" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                      </svg>
                    </Transition>
                  </button>
                  <span class="input-line"></span>
                </div>
              </div>

              <!-- Options Area -->
              <div class="flex items-center text-xs py-1">
                <label class="flex items-center gap-2 text-slate-400 cursor-pointer select-none">
                  <input type="checkbox" required class="rounded bg-slate-950 border-slate-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900" />
                  <span>By Signing Up, I agree with Terms & Conditions</span>
                </label>
              </div>

              <!-- Message Banner -->
              <Transition name="shake">
                <div v-if="message" :class="[
                  messageType === 'success' ? 'text-emerald-400 border border-emerald-500/30 bg-emerald-950/40' : 'text-rose-400 border border-rose-500/30 bg-rose-950/40',
                ]" class="message-banner">
                  <!-- Error Icon -->
                  <svg v-if="messageType === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                  <!-- Success Icon -->
                  <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ message }}</span>
                </div>
              </Transition>

              <!-- Submit Button -->
              <div class="pt-2">
                <button type="submit" :disabled="loading || success" class="btn-primary w-full md:w-[100%]" @mousedown="createRipple">
                  <Transition name="fade-quick" mode="out-in">
                    
                    <span v-if="loading" key="loading" class="flex items-center justify-center gap-2">
                      <svg class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                      </svg>
                      Creating account...
                    </span>

                    <span v-else-if="success" key="success" class="flex items-center justify-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                      </svg>
                      Account Created!
                    </span>

                    <span v-else key="label" class="flex items-center justify-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                      </svg>
                      Register
                    </span>
                  </Transition>
                </button>
              </div>
            </form>

            <div class="flex items-center my-6">
              <div class="flex-1 border-t border-slate-800"></div>
              <span class="px-3 text-xs text-slate-500 font-bold tracking-wider">OR</span>
              <div class="flex-1 border-t border-slate-800"></div>
            </div>

            <p class="text-center text-sm text-slate-400">
              Already have an account?
              <RouterLink to="/login" class="text-blue-400 font-bold hover:underline ml-1 transition-colors hover:text-blue-300">
                Login Here →
              </RouterLink>
            </p>

          </div>
        </div>
      </Transition>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { useRouter, RouterLink } from "vue-router";
import axios from "axios";

const router = useRouter();

const selectedRole = ref("student");
const form = reactive({ fullName: "",firstName:"",lastName:"", email: "", password: "", confirmPassword: "" });
const focus = reactive({ fullName: false,firstName:false,lastName:false, email: false, password: false, confirm: false });

const showPassword = ref(false);
const showConfirm = ref(false);
const loading = ref(false);
const message = ref("");
const messageType = ref("");
const success = ref(false);
const particles = ref([]);


onMounted(() => {
  // Density and style from Code 1, applied to the dark background seamlessly
  particles.value = Array.from({ length: 200 }, (_, i) => ({
    id: i,
    style: `left:${Math.random() * 100}%;top:${Math.random() * 200}%;width:${4 + Math.random() * 10}px;height:${6 + Math.random() * 10}px;animation-delay:${Math.random() * 2}s;animation-duration:${6 + Math.random() * 8}s;opacity:${0.15 + Math.random() * 0.25};`,
  }));
});

// Computed properties for Password Validation UI
const passwordMismatch = computed(() => form.confirmPassword.length > 0 && form.password !== form.confirmPassword);
const passwordMatch = computed(() => form.confirmPassword.length > 0 && form.password === form.confirmPassword);

function createRipple(e) {
  const btn = e.currentTarget;
  const circle = document.createElement("span");
  const rect = btn.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height) * 2;
  
  circle.style.width = circle.style.height = `${size}px`;
  circle.style.left = `${e.clientX - rect.left - size / 2}px`;
  circle.style.top = `${e.clientY - rect.top - size / 2}px`;
  circle.classList.add("ripple");
  
  btn.appendChild(circle);
  setTimeout(() => circle.remove(), 600);
}

async function handleRegister() {
  if (passwordMismatch.value) {
    message.value = "Passwords do not match.";
    messageType.value = "error";
    return;
  }

  loading.value = true;
  message.value = "";
  success.value = false;

  try {
    const response = await axios.post("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/register.php",
      {
        full_name: form.fullName,
        email: form.email,
        password: form.password,
        role: selectedRole.value
      }
    );

    if (response.data.status) {
      success.value = true;
      message.value = response.data.message || "Registration Successful! Redirecting to login...";
      messageType.value = "success";
      
      setTimeout(() => router.push("/login"), 2000);
    } else {
      message.value = response.data.message || "Registration failed. Please try again.";
      messageType.value = "error";
    }
  } catch (err) {
    message.value = "Connection failure. Verify target backend host endpoints.";
    messageType.value = "error";
  }
  
  // Fake brief delay for UI smooth feeling if network was extremely fast
  await new Promise((r) => setTimeout(r, 800));
  loading.value = false;
}
</script>

<style scoped>
/* Animated Background Dust Particles */
.particle {
  position: absolute;
  background: white;
  border-radius: 50%;
  animation-name: particle-rise;
  animation-timing-function: ease-in-out;
  animation-iteration-count: infinite;
}

@keyframes particle-rise {
  0% { transform: translateY(10vh) scale(0.8); opacity: 0; }
  20% { opacity: 0.5; }
  80% { opacity: 0.5; }
  100% { transform: translateY(-80vh) scale(1.2); opacity: 0; }
}

/* Glassmorphism Card Styling */
.glass-card {
  background: rgba(15, 23, 42, 0.45);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.05);
}

.logo-wrapper {
  position: relative;
  border-radius: 50%;
  padding: 4px;
}

/* Form floating interactive labels */
.form-group { position: relative; }

.float-label {
  position: absolute;
  left: 42px;
  top: 14px;
  font-size: 0.875rem;
  color: #94a3b8;
  transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1);
  pointer-events: none;
  z-index: 10;
}

.form-group.focused .float-label,
.form-group.filled .float-label {
  top: -8px;
  left: 36px;
  font-size: 0.75rem;
  color: #3b82f6;
  background: #0f172a;
  padding: 0 6px;
  font-weight: 700;
  border-radius: 4px;
}

.input-wrap { position: relative; }

.input-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748b;
  transition: color 0.25s;
  display: flex;
}

.form-group.focused .input-icon { color: #3b82f6; }

.float-input {
  width: 100%;
  padding: 13px 14px 13px 42px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 14px;
  font-size: 0.95rem;
  outline: none;
  background: rgba(15, 23, 42, 0.6);
  color: #f8fafc;
  transition: border-color 0.25s, background-color 0.25s, box-shadow 0.25s;
}

.float-input:focus {
  border-color: #3b82f6;
  background: rgba(15, 23, 42, 0.8);
  box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
}

.input-line {
  position: absolute;
  bottom: 0;
  left: 50%;
  height: 2px;
  width: 0;
  background: linear-gradient(90deg, #3b82f6, #06b6d4);
  border-radius: 2px;
  transition: width 0.3s ease, left 0.3s ease;
}

.form-group.focused .input-line {
  width: 100%;
  left: 0;
}

.eye-btn {
  position: absolute;
  right: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748b;
  background: none;
  border: none;
  cursor: pointer;
  padding: 2px;
  transition: color 0.2s, transform 0.2s;
}

.eye-btn:hover {
  color: #3b82f6;
  transform: translateY(-50%) scale(1.1);
}

.message-banner {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 14px;
  border-radius: 12px;
  font-size: 0.85rem;
  font-weight: 600;
}

/* Primary Button Styling */
.btn-primary {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #0284c7 100%);
  color: white;
  font-weight: 700;
  font-size: 0.95rem;
  padding: 14px;
  border-radius: 14px;
  border: none;
  cursor: pointer;
  transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.2s ease;
  box-shadow: 0 8px 24px rgba(37, 99, 235, 0.25);
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-1.5px);
  box-shadow: 0 12px 28px rgba(37, 99, 235, 0.35);
}

.btn-primary:active:not(:disabled) {
  transform: translateY(0.5px);
}

.btn-primary:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* Ripple Element Styles */
:deep(.ripple) {
  position: absolute;
  background: rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  transform: scale(0);
  animation: ripple-anim 0.6s linear;
  pointer-events: none;
}

@keyframes ripple-anim {
  to { transform: scale(1); opacity: 0; }
}

/* Animations */
.card-enter-active { animation: card-appear 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
@keyframes card-appear {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.fade-quick-enter-active, .fade-quick-leave-active { transition: opacity 0.15s, transform 0.15s; }
.fade-quick-enter-from, .fade-quick-leave-to { opacity: 0; transform: scale(0.9); }

.shake-enter-active { animation: shake 0.4s ease-in-out; }
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20%, 60% { transform: translateX(-6px); }
  40%, 80% { transform: translateX(6px); }
}
</style>