<template>
  <div class="min-h-screen bg-slate-950 text-slate-100 font-sans flex flex-col relative overflow-x-hidden">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
      <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] rounded-full bg-blue-600/15 blur-[140px]"></div>
      <div class="absolute bottom-[-10%] right-[-10%] w-[45vw] h-[45vw] rounded-full bg-teal-500/10 blur-[130px]"></div>
      <div v-for="p in particles" :key="p.id" class="particle" :style="p.style"></div>
    </div>

    <!-- Sticky Header Navbar -->
    <Navbar class="relative z-50" />

    <!-- Main Workspace Layout -->
    <div class="flex-1 flex flex-col md:flex-row relative z-10 overflow-hidden">
      <!-- Left Sidebar Navigation (Reset Password Active) -->
      <LeftSidesection activeTab="Reset Password" />

      <!-- Main Workspace Viewport -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto max-h-[calc(100vh-80px)] flex items-center justify-center">
        <Transition name="card" appear>
          <div
            class="glass-card w-full max-w-4xl rounded-3xl shadow-2xl border border-white/10 backdrop-blur-xl flex flex-col md:flex-row overflow-hidden">

            <!-- LEFT PANEL -->
            <div
              class="relative w-full md:w-[42%] bg-gradient-to-b from-emerald-600 via-teal-700 to-indigo-950 text-white p-8 md:p-10 flex flex-col justify-between items-center text-center overflow-hidden min-h-[240px] md:min-h-full rounded-b-[40px] md:rounded-b-none md:rounded-r-[110px] border-b md:border-b-0 md:border-r border-white/10 shadow-xl">

              <div class="w-full mt-8">
                <span class="text-lg font-bold uppercase tracking-widest text-emerald-50 block mb-1">Placement
                  Portal</span>
                <div class="h-[2px] w-8 bg-emerald-400 mx-auto rounded-full"></div>
              </div>

              <!-- Icon -->
              <div class="flex flex-col items-center gap-4">
                <div
                  class="w-28 h-28 rounded-full bg-white/10 border border-white/20 flex items-center justify-center shadow-2xl backdrop-blur-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-emerald-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                  </svg>
                </div>
                <div class="max-w-[200px]">
                  <h2 class="text-lg font-bold text-white mb-2">One Last Step!</h2>
                  <p class="text-[11px] text-emerald-100/70 leading-relaxed">
                    Set a password so you can also login using your email and password — not just Google.
                  </p>
                </div>
              </div>

              <div class="w-full pt-4">
                <button @click="skipAndGoToDashboard"
                  class="w-full max-w-[160px] cursor-pointer border border-emerald-300/50 hover:border-white text-emerald-100/80 hover:text-white font-bold rounded-full py-1.5 px-6 text-xs bg-white/5 hover:bg-white/10 active:scale-95 transition-all duration-300 uppercase tracking-widest">
                  Skip for now →
                </button>
              </div>
            </div>

            <!-- RIGHT PANEL: Set Password Form -->
            <div class="w-full md:w-[58%] p-8 md:p-12 flex flex-col justify-center relative z-20">

              <!-- Success State -->
              <Transition name="card" mode="out-in">
                <div v-if="success" key="success-state" class="flex flex-col items-center justify-center gap-6 py-8">
                  <div
                    class="w-20 h-20 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-emerald-400" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <div class="text-center">
                    <h3 class="text-2xl font-extrabold text-white mb-2">Password Set! 🎉</h3>
                    <p class="text-slate-400 text-sm">You can now login with your email and password. Redirecting to
                      dashboard...</p>
                  </div>
                  <div class="w-full max-w-xs bg-slate-900/60 rounded-xl p-4 border border-white/5 text-sm space-y-2">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Your Login Credentials</p>
                    <div class="flex items-center gap-2 text-slate-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      <span class="text-xs truncate">{{ userEmail }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-200">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                      </svg>
                      <span class="text-xs text-emerald-300 font-bold">Password set ✓</span>
                    </div>
                  </div>
                </div>

                <!-- Form State -->
                <div v-else key="form-state">
                  <div class="mb-7">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Set Your Password</h2>
                    <p class="text-xs text-slate-400 mt-1">Create a password so you can also sign in with email</p>
                  </div>

                  <!-- Registered Email Badge -->
                  <div class="flex items-center gap-3 bg-slate-900/60 border border-white/5 rounded-xl px-4 py-3 mb-6">
                    <div
                      class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-teal-400 flex items-center justify-center flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                    </div>
                    <div>
                      <p class="text-[10px] text-slate-500 uppercase tracking-wider font-bold">Registered via Google</p>
                      <p class="text-sm text-slate-200 font-medium truncate">{{ userEmail || 'Loading...' }}</p>
                    </div>
                    <div class="ml-auto flex-shrink-0">
                      <span
                        class="text-[10px] bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full px-2 py-0.5 font-bold">Verified
                        ✓</span>
                    </div>
                  </div>

                  <form @submit.prevent="handleSetPassword" class="space-y-5">

                    <!-- New Password -->
                    <div class="form-group" :class="{ focused: focus.password, filled: form.password }">
                      <label class="float-label">New Password</label>
                      <div class="input-wrap">
                        <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                          </svg>
                        </span>
                        <input v-model="form.password" :type="showPassword ? 'text' : 'password'" required minlength="6"
                          class="float-input pr-10" @focus="focus.password = true" @blur="focus.password = false" />
                        <button type="button" @click="showPassword = !showPassword" class="eye-btn" tabindex="-1">
                          <Transition name="fade-quick" mode="out-in">
                            <svg v-if="!showPassword" key="eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg v-else key="eye-off" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                              viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                          </Transition>
                        </button>
                        <span class="input-line"></span>
                      </div>
                      <!-- Password strength bar -->
                      <div v-if="form.password" class="mt-2 space-y-1">
                        <div class="flex gap-1">
                          <div v-for="i in 4" :key="i" class="h-1 flex-1 rounded-full transition-all duration-300"
                            :class="i <= passwordStrength ? strengthColor : 'bg-slate-800'"></div>
                        </div>
                        <p class="text-xs" :class="strengthTextColor">{{ strengthLabel }}</p>
                      </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group" :class="{ focused: focus.confirm, filled: form.confirmPassword }">
                      <label class="float-label">Confirm Password</label>
                      <div class="input-wrap">
                        <span class="input-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                          </svg>
                        </span>
                        <input v-model="form.confirmPassword" :type="showConfirm ? 'text' : 'password'" required
                          class="float-input pr-14" :class="{
                            'border-rose-500 focus:border-rose-500': passwordMismatch,
                            'border-emerald-500 focus:border-emerald-500': passwordMatch
                          }" @focus="focus.confirm = true" @blur="focus.confirm = false" />
                        <!-- Match check icon -->
                        <Transition name="fade-quick">
                          <span v-if="passwordMatch"
                            class="absolute right-10 top-1/2 -translate-y-1/2 text-emerald-400 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="3">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                          </span>
                        </Transition>
                        <button type="button" @click="showConfirm = !showConfirm" class="eye-btn" tabindex="-1">
                          <Transition name="fade-quick" mode="out-in">
                            <svg v-if="!showConfirm" key="eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                              fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg v-else key="eye-off" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                              viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                          </Transition>
                        </button>
                        <span class="input-line"></span>
                      </div>
                    </div>

                    <!-- Message Banner -->
                    <Transition name="shake">
                      <div v-if="message" :class="[
                        messageType === 'success'
                          ? 'text-emerald-400 border border-emerald-500/30 bg-emerald-950/40'
                          : 'text-rose-400 border border-rose-500/30 bg-rose-950/40'
                      ]" class="message-banner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path v-if="messageType === 'error'" stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                          <path v-else stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ message }}</span>
                      </div>
                    </Transition>

                    <!-- Submit Button -->
                    <div class="pt-2">
                      <button type="submit" :disabled="loading || passwordMismatch" class="btn-primary w-full"
                        @mousedown="createRipple">
                        <Transition name="fade-quick" mode="out-in">
                          <span v-if="loading" key="loading" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" />
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                            </svg>
                            Saving password...
                          </span>
                          <span v-else key="label" class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Set Password & Go to Dashboard
                          </span>
                        </Transition>
                      </button>
                    </div>

                  </form>
                </div>
              </Transition>
            </div>
          </div>
        </Transition>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { useRouter } from "vue-router";
import Navbar from "../components/navbar.vue";
import LeftSidesection from "../components/leftsidesection.vue";
import axios from "axios";

const router = useRouter();

const form = reactive({ password: "", confirmPassword: "" });
const focus = reactive({ password: false, confirm: false });
const showPassword = ref(false);
const showConfirm = ref(false);
const loading = ref(false);
const message = ref("");
const messageType = ref("");
const success = ref(false);
const userEmail = ref("");
const particles = ref([]);

onMounted(() => {
  particles.value = Array.from({ length: 120 }, (_, i) => ({
    id: i,
    style: `left:${Math.random() * 100}%;top:${Math.random() * 200}%;width:${4 + Math.random() * 8}px;height:${4 + Math.random() * 8}px;animation-delay:${Math.random() * 3}s;animation-duration:${7 + Math.random() * 8}s;opacity:${0.1 + Math.random() * 0.2};`,
  }));

  // Get the email from localStorage (set during Google registration)
  userEmail.value = localStorage.getItem("googleUserEmail") || "";

  // If no session info, redirect to register
  if (!localStorage.getItem("isLoggedIn")) {
    router.push("/register");
  }
});

// Password validation
const passwordMismatch = computed(() =>
  form.confirmPassword.length > 0 && form.password !== form.confirmPassword
);
const passwordMatch = computed(() =>
  form.confirmPassword.length > 0 && form.password === form.confirmPassword
);

// Password strength meter
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
  const colors = ["bg-rose-500", "bg-orange-400", "bg-yellow-400", "bg-emerald-500"];
  return colors[passwordStrength.value - 1] || "bg-rose-500";
});
const strengthLabel = computed(() => {
  const labels = ["Weak", "Fair", "Good", "Strong"];
  return labels[passwordStrength.value - 1] || "Too short";
});
const strengthTextColor = computed(() => {
  const colors = ["text-rose-400", "text-orange-400", "text-yellow-400", "text-emerald-400"];
  return colors[passwordStrength.value - 1] || "text-rose-400";
});

function createRipple(e) {
  const btn = e.currentTarget;
  const circle = document.createElement("span");
  const rect = btn.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height) * 2;
  circle.style.cssText = `position:absolute;width:${size}px;height:${size}px;left:${e.clientX - rect.left - size / 2}px;top:${e.clientY - rect.top - size / 2}px;background:rgba(255,255,255,0.25);border-radius:50%;transform:scale(0);animation:ripple-anim 0.6s linear;pointer-events:none;`;
  btn.appendChild(circle);
  setTimeout(() => circle.remove(), 700);
}

function skipAndGoToDashboard() {
  router.push("/dashboard");
}

async function handleSetPassword() {
  if (passwordMismatch.value) {
    message.value = "Passwords do not match.";
    messageType.value = "error";
    return;
  }

  loading.value = true;
  message.value = "";

  try {
    const res = await axios.post(
      "http://localhost/placementManagement/placement-management-system%20-%20Copy/placement-management-system1/backend/API/setPassword.php",
      {
        password: form.password,
        confirm_password: form.confirmPassword,
      },
      { withCredentials: true }
    );

    if (res.data.status) {
      success.value = true;
      // Clean up
      localStorage.removeItem("googleUserEmail");
      // Redirect to dashboard after showing success
      setTimeout(() => router.push("/dashboard"), 3000);
    } else {
      message.value = res.data.message || "Failed to set password.";
      messageType.value = "error";
    }

  } catch (err) {
    console.error(err);
    message.value = "Unable to connect to the server. Please try again.";
    messageType.value = "error";
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.particle {
  position: absolute;
  background: rgba(255, 255, 255, 0.6);
  border-radius: 50%;
  animation-name: particle-rise;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

@keyframes particle-rise {
  0% {
    transform: translateY(0);
    opacity: 0;
  }

  10% {
    opacity: 1;
  }

  90% {
    opacity: 1;
  }

  100% {
    transform: translateY(-150vh) scale(0.5);
    opacity: 0;
  }
}

.glass-card {
  background: rgba(15, 23, 42, 0.45);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.05);
}

.form-group {
  position: relative;
}

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
  color: #10b981;
  background: #0f172a;
  padding: 0 6px;
  font-weight: 700;
  border-radius: 4px;
}

.input-wrap {
  position: relative;
}

.input-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: #64748b;
  transition: color 0.25s;
  display: flex;
}

.form-group.focused .input-icon {
  color: #10b981;
}

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
  border-color: #10b981;
  background: rgba(15, 23, 42, 0.8);
  box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
}

.input-line {
  position: absolute;
  bottom: 0;
  left: 50%;
  height: 2px;
  width: 0;
  background: linear-gradient(90deg, #10b981, #06b6d4);
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
  color: #10b981;
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

.btn-primary {
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #059669 0%, #0d9488 50%, #0891b2 100%);
  color: white;
  font-weight: 700;
  font-size: 0.95rem;
  padding: 14px;
  border-radius: 14px;
  border: none;
  cursor: pointer;
  transition: transform 0.15s ease, box-shadow 0.15s ease, opacity 0.2s ease;
  box-shadow: 0 8px 24px rgba(5, 150, 105, 0.3);
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-1.5px);
  box-shadow: 0 12px 28px rgba(5, 150, 105, 0.4);
}

.btn-primary:active:not(:disabled) {
  transform: translateY(0.5px);
}

.btn-primary:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

@keyframes ripple-anim {
  to {
    transform: scale(1);
    opacity: 0;
  }
}

.card-enter-active {
  animation: card-appear 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes card-appear {
  from {
    transform: translateY(40px) scale(0.95);
    opacity: 0;
  }

  to {
    transform: translateY(0) scale(1);
    opacity: 1;
  }
}

.fade-quick-enter-active,
.fade-quick-leave-active {
  transition: opacity 0.15s, transform 0.15s;
}

.fade-quick-enter-from,
.fade-quick-leave-to {
  opacity: 0;
  transform: scale(0.8);
}

.shake-enter-active {
  animation: shake 0.5s ease;
}

@keyframes shake {

  0%,
  100% {
    transform: translateX(0);
  }

  20% {
    transform: translateX(-8px);
  }

  40% {
    transform: translateX(8px);
  }

  60% {
    transform: translateX(-5px);
  }

  80% {
    transform: translateX(5px);
  }
}
</style>
