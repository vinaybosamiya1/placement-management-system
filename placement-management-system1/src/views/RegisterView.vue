<template>
  <div class="min-h-screen flex flex-col relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <!-- <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div> -->
      <div v-for="p in particles" :key="p.id" class="particle" :style="p.style"></div>
    </div>

    <div class="relative z-10 flex-1 flex items-center justify-center px-4 py-6">
      <Transition name="card" appear>
        <div class="glass-card w-full max-w-md rounded-3xl p-8 shadow-2xl">
          <!-- Branding -->
          <div class="flex flex-col items-center mb-5">
            <div class="icon-ring mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <h1 class="text-lg font-bold text-blue-700 tracking-wide text-center">Placement Management System</h1>
          </div>

          <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">Create Account</h2>
          <p class="text-center text-gray-500 text-sm mb-6">Fill in your details to get started</p>

          <!-- Step indicator -->
          <!-- <div class="flex items-center justify-center gap-2 mb-6">
            <div v-for="s in 3" :key="s" class="step-dot" :class="{ active: currentStep >= s, done: currentStep > s }">
              <Transition name="fade-quick" mode="out-in">
                <svg v-if="currentStep > s" key="check" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span v-else key="num" class="text-xs font-bold">{{ s }}</span>
              </Transition>
            </div>
            <div class="step-line" :class="{ active: currentStep >= 2 }"></div>
            <div class="step-line" :class="{ active: currentStep >= 3 }"></div>
          </div> -->

          <form @submit.prevent="handleRegister" class="space-y-4">
            <!-- Name row -->
            <!-- <div class="grid grid-cols-2 gap-3">
              <div class="form-group" :class="{ focused: focus.firstName, filled: form.firstName }">
                <label class="float-label">First Name</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </span>
                  <input v-model="form.firstName" type="text" required class="float-input text-sm"
                    @focus="focus.firstName = true" @blur="focus.firstName = false; updateStep()" />
                </div>
              </div>
              <div class="form-group" :class="{ focused: focus.lastName, filled: form.lastName }">
                <label class="float-label">Last Name</label>
                <div class="input-wrap">
                  <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </span>
                  <input v-model="form.lastName" type="text" required class="float-input text-sm"
                    @focus="focus.lastName = true" @blur="focus.lastName = false; updateStep()" />
                </div>
              </div>
            </div> -->

            <div class="form-group" :class="{ focused: focus.fullName, filled: form.fullName }">
              <label class="float-label">Full Name</label>
              <div class="input-wrap">
                <span class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  </span>
                <input v-model="form.fullName" type="text" required class="float-input"
                  @focus="focus.fullName = true" @blur="focus.fullName = false; updateStep()" />
              </div>
            </div>

            <!-- Email -->
            <div class="form-group" :class="{ focused: focus.email, filled: form.email }">
              <label class="float-label">Email Address</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </span>
                <input v-model="form.email" type="email" required class="float-input"
                  @focus="focus.email = true" @blur="focus.email = false; updateStep()" />
              </div>
            </div>

            <!-- Password -->
            <div class="form-group" :class="{ focused: focus.password, filled: form.password }">
              <label class="float-label">Password</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </span>
                <input v-model="form.password" :type="showPassword ? 'text' : 'password'" required
                  class="float-input pr-10" @focus="focus.password = true" @blur="focus.password = false; updateStep()" />
                <button type="button" @click="showPassword = !showPassword" class="eye-btn" tabindex="-1">
                  <Transition name="fade-quick" mode="out-in">
                    <svg v-if="!showPassword" key="e1" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg v-else key="e2" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                  </Transition>
                </button>
              </div>
              <!-- Password strength -->
              <Transition name="slide-down">
                <div v-if="form.password" class="mt-2">
                  <div class="flex gap-1 mb-1">
                    <!-- <div v-for="i in 4" :key="i" class="h-1 flex-1 rounded-full transition-all duration-300"
                      :class="i <= passwordStrength.score ? passwordStrength.color : 'bg-gray-200'"></div> -->
                  </div>
                  <!-- <p class="text-xs font-medium" :class="passwordStrength.textColor">{{ passwordStrength.label }}</p> -->
                </div>
              </Transition>
            </div>

            <!-- Confirm Password -->
            <div class="form-group" :class="{ focused: focus.confirm, filled: form.confirmPassword, error: passwordMismatch }">
            
              <label class="float-label">Confirm Password</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                  </svg>
                </span>
                <!-- <input v-model="form.confirmPassword" :type="showConfirm ? 'text' : 'password'" required
                  class="float-input pr-10"
                  :class="{ 'border-red-400': passwordMismatch, 'border-green-400': passwordMatch }"
                  @focus="focus.confirm = true" @blur="focus.confirm = false; updateStep()" /> -->
                <input v-model="form.confirmPassword" :type="showConfirm ? 'text' : 'password'" required
                  class="float-input pr-10"
                  @focus="focus.confirm = true" @blur="focus.confirm = false; updateStep()" />
                <button type="button" @click="showConfirm = !showConfirm" class="eye-btn" tabindex="-1">
                  <Transition name="fade-quick" mode="out-in">
                    <svg v-if="!showConfirm" key="e3" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg v-else key="e4" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                  </Transition>
                </button>
                <Transition name="fade-quick">
                  <span v-if="passwordMatch" class="match-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                  </span>
                </Transition>
              </div>
              <!-- <Transition name="slide-down">
                <p v-if="passwordMismatch" class="mt-1 text-xs text-red-500 font-medium">Passwords do not match.</p>
              </Transition> -->
            </div>

            <Transition name="shake">
              <div v-if="error" class="error-banner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                {{ error }}
              </div>
            </Transition>

            <Transition name="slide-down">
              <div v-if="success" class="success-banner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                  <p class="font-semibold">Account created!</p>
                  <p class="text-xs opacity-80">Redirecting to login…</p>
                </div>
              </div>
            </Transition>

            <!-- <button type="submit" :disabled="loading || passwordMismatch || success" class="btn-primary" @mousedown="createRipple"> -->
            <button type="submit" @click="handleRegister" class="btn-primary">
              <!-- <Transition name="fade-quick" mode="out-in"> -->
                <span v-if="loading" key="l" class="flex items-center justify-center gap-2">
                  <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                  </svg>
                  Creating account...
                </span>
                <span v-else-if="success" key="s" class="flex items-center justify-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                  </svg>
                  Account Created!
                </span>
                <span v-else key="n" class="flex items-center justify-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                  </svg>
                  Register
                </span>
              <!-- </Transition> -->
            </button>
          </form>

          <div class="flex items-center my-5">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-3 text-xs text-gray-400 font-medium">OR</span>
            <div class="flex-1 border-t border-gray-200"></div>
          </div>

          <p class="text-center text-sm text-gray-600">
            Already have an account?
            <RouterLink to="/login" class="text-blue-600 font-bold hover:underline ml-1 hover:text-blue-800 transition-colors">Login Here →</RouterLink>
          </p>
        </div>
      </Transition>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { RouterLink, useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const form = reactive({ firstName: "", lastName: "", fullName:"", email: "", password: "", confirmPassword: "" });
const focus = reactive({ firstName: false, lastName: false, fullName:"", email: false, password: false, confirm: false });
const showPassword = ref(false);
const showConfirm = ref(false);
const loading = ref(false);
const error = ref("");
const success = ref(false);
const currentStep = ref(1);
const particles = ref([]);

onMounted(() => {
  particles.value = Array.from({ length: 200 }, (_, i) => ({
    id: i,
    style: `left:${Math.random() * 100}%;top:${Math.random() *200}%;width:${4 + Math.random() * 10}px;height:${6 + Math.random() * 10}px;animation-delay:${Math.random() * 2}s;animation-duration:${6 + Math.random() * 8}s;opacity:${0.15 + Math.random() * 0.25};`,
  }));
});

const passwordMismatch = computed(() => form.confirmPassword.length > 0 && form.password !== form.confirmPassword);
const passwordMatch = computed(() => form.confirmPassword.length > 0 && form.password === form.confirmPassword);

const passwordStrength = computed(() => {
  const p = form.password;
  // let score = 0;
  // if (p.length >= 8) score++;
  // if (/[A-Z]/.test(p)) score++;
  // if (/[0-9]/.test(p)) score++;
  // if (/[^A-Za-z0-9]/.test(p)) score++;
  // const labels = ["Very Weak", "Weak", "Fair", "Good", "Strong"];
  // const colors = ["bg-red-400", "bg-red-400", "bg-yellow-400", "bg-blue-400", "bg-green-500"];
  // const textColors = ["text-red-500", "text-red-500", "text-yellow-600", "text-blue-600", "text-green-600"];
  // return { score, label: labels[score], color: colors[score], textColor: textColors[score] };
  // return { score, label: labels[score], color: colors[score], textColor: textColors[score] };
});

function updateStep() {
  // if (form.firstName && form.lastName) currentStep.value = Math.max(currentStep.value, 2);
  if (form.fullName) currentStep.value = Math.max(currentStep.value, 2);
  if (form.email && form.password) currentStep.value = Math.max(currentStep.value, 3);
}

// function createRipple(e) {
//   const btn = e.currentTarget;
//   const circle = document.createElement("span");
//   const rect = btn.getBoundingClientRect();
//   const size = Math.max(rect.width, rect.height) * 2;
//   circle.style.cssText = `position:absolute;width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;background:rgba(255,255,255,0.3);border-radius:50%;transform:scale(0);animation:ripple-anim 0.6s linear;pointer-events:none;`;
//   btn.appendChild(circle);
//   setTimeout(() => circle.remove(), 700);
// }

async function handleRegister() {
  if (passwordMismatch.value) {
    error.value = "Passwords do not match";
    return;
  }
  error.value = "";
  loading.value = true;
  try{
    const response = await axios.post("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/register.php",
      {
        full_name: form.fullName,
        email:form.email,
        password: form.password,
      }
    );
    console.log(response.data);
    if(response.data.status){
      success.value = true;
      setTimeout(() => router.push("/login"), 2000);
    }else{
      error.value = response.data.message;
    }
  }catch(err){
    error.value =  "Server Error";
    console.log(err);
  }
  await new Promise((r) => setTimeout(r, 1200));
  loading.value = false;
  
  // currentStep.value = 3;

}



</script>

<style scoped>

.particle {
  position: absolute;
  background: rgba(255, 255, 255, 0.6);
  border-radius: 50%;
  /* animation: particle-rise linear infinite; *//* below used instead of this */
  animation-name: particle-rise;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
}

@keyframes particle-rise {
  0% {
    /* transform: translateY(0) scale(1); */ 
    /* use below  instead of above */
    transform: translateY(0);
    opacity: 0
  }

  10% {
    opacity: 1
  }

  90% {
    opacity: 1
  }

  100% {
    transform: translateY(-150vh) scale(0.5);
    opacity: 0
  }
}

  .glass-card {
    background: rgba(255, 255, 255, 0.92);  
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
  }

.icon-ring {
  width: 84px;
  height: 84px;
  border-radius: 50%;
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 32px rgba(37, 99, 235, 0.4);
  animation: icon-pulse 3s ease-in-out infinite;
  position: relative;
}

.icon-ring::before {
  content: '';
  position: absolute;
  top: -10px;
  bottom: -7px;
  right: -7px;
  left: -7px;
  border-radius: 50%;
  border: 2px solid rgba(37, 99, 235, 0.3);
  animation: ring-spin 4s linear infinite;
}

.icon-inner {
  display: flex;
  align-items: center;
  justify-content: center;
}

@keyframes icon-pulse {

  0%,
  100% {
    box-shadow: 0 8px 32px rgba(37, 99, 235, 0.4);
    transform: scale(1)
  }

  50% {
    box-shadow: 0 12px 48px rgba(37, 99, 235, 0.6);
    transform: scale(1.04)
  }
}

@keyframes ring-spin {
  from {
    transform: rotate(0deg)
  }

  to {
    transform: rotate(360deg)
  }
}

.form-group {
  position: relative;
}

.float-label {
  position: absolute;
  left: 40px;
  top: 13px;
  font-size: 0.875rem;
  color: #9ca3af;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  pointer-events: none;
  z-index: 1;
}

.form-group.focused .float-label,
.form-group.filled .float-label {
  top: -8px;
  left: 36px;
  font-size: 0.72rem;
  color: #2563eb;
  background: white;
  padding: 0 4px;
  font-weight: 600;
}

.input-wrap {
  position: relative;
}

.input-icon {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
  transition: color 0.2s;
  display: flex;
}

.form-group.focused .input-icon {
  color: #2563eb;
}

.float-input {
  width: 100%;
  padding: 12px 12px 12px 40px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 0.9rem;
  outline: none;
  background: #f9fafb;
  transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
}

.float-input:focus {
  border-color: #2563eb;
  background: white;
  box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
}

.input-line {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 0;
  background: #2563eb;
  border-radius: 2px;
  transition: width 0.3s;
}

.form-group.focused .input-line {
  width: 100%;
}

.eye-btn {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
  background: none;
  border: none;
  cursor: pointer;
  padding: 2px;
  transition: color 0.2s, transform 0.2s;
}

.eye-btn:hover {
  color: #2563eb;
  transform: translateY(-50%) scale(1.15);
}

.error-banner {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #dc2626;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 0.85rem;
  font-weight: 500;
}

.btn-primary {
  position: relative;
  overflow: hidden;
  width: 100%;
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  color: white;
  font-weight: 700;
  font-size: 0.95rem;
  padding: 13px;
  border-radius: 12px;
  border: none;
  cursor: pointer;
  transition: transform 0.15s, box-shadow 0.15s, opacity 0.2s ;
  box-shadow: 0 4px 20px rgba(37, 99, 235, 0.35);
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 28px rgba(37, 99, 235, 0.45);
}

.btn-primary:active:not(:disabled) {
  transform: translateY(0);
}

.btn-primary:disabled {
  opacity: 0.65;
  cursor: not-allowed;
}

/* below code is not required or compalsary */
/* .blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  opacity: 0.4;
  animation: blob-float 12s ease-in-out infinite alternate;
}

.blob-1 {
  width: 500px;
  height: 500px;
  background: #1e40af;
  top: -150px;
  left: -150px;
  animation-delay: 0s;
}

.blob-2 {
  width: 400px;
  height: 400px;
  background: #3b82f6;
  bottom: -100px;
  right: -100px;
  animation-delay: 3s;
}

.blob-3 {
  width: 300px;
  height: 300px;
  background: #60a5fa;
  top: 50%;
  left: 50%;
  animation: blob-float3 10s ease-in-out infinite alternate;
}

@keyframes blob-float {
  0% {
    transform: scale(1) translate(0, 0)
  }

  100% {
    transform: scale(1.15) translate(30px, 30px)
  }
}

@keyframes blob-float3 {
  0% {
    transform: translate(-50%, -50%) scale(1)
  }

  100% {
    transform: translate(-40%, -60%) scale(1.2)
  }
} */


  .card-enter-active {
  animation: card-appear 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes card-appear {
  from {
    transform: translateY(40px) scale(0.95);
    opacity: 0
  }

  to {
    transform: translateY(0) scale(1);
    opacity: 1
  }
}  

  .fade-quick-enter-active,
.fade-quick-leave-active {
  transition: opacity 0.15s, transform 0.15s;
}

.fade-quick-enter-from {
  opacity: 0;
  transform: scale(0.8);
}

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
    transform: translateX(0)
  }

  20% {
    transform: translateX(-8px)
  }

  40% {
    transform: translateX(8px)
  }

  60% {
    transform: translateX(-5px)
  }

  80% {
    transform: translateX(5px)
  }
}  

  @keyframes ripple-anim {
  to {
    transform: scale(1);
    opacity: 0
  }
}  
</style>