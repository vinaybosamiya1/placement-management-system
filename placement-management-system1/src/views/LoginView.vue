<!-- start with 26/6/2026  -->
<template>
  <div
    class="min-h-screen flex flex-col relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <!-- <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div> -->
      <div v-for="p in particles" :key="p.id" class="particle" :style="p.style"></div>
    </div>

    <div class="relative z-10 flex-1 flex items-center justify-center px-4 py-8">
      <Transition name="card" appear>
        <div class="glass-card w-full max-w-md rounded-3xl p-8 shadow-2xl">
          <!-- Branding -->
          <div class="flex flex-col items-center mb-6">
            <div class="icon-ring mb-3">
              <div class="icon-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
            </div>
            <h1 class="text-lg font-bold text-blue-700 tracking-wide text-center">Placement Management System</h1>
          </div>

          <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">Welcome Back</h2>
          <p class="text-center text-gray-500 text-sm mb-7">Sign in to your account to continue</p>

          <form @submit.prevent="handleLogin" class="space-y-5">
            <!-- Email -->
            <div class="form-group" :class="{ focused: focus.email, filled: form.email }">
              <label class="float-label">Email Address</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </span>
                <input v-model="form.email" type="email" required class="float-input" @focus="focus.email = true"
                  @blur="focus.email = false" />
                <span class="input-line"></span>
              </div>
            </div>

            <!-- Password -->
            <div class="form-group" :class="{ focused: focus.password, filled: form.password }">
              <label class="float-label">Password</label>
              <div class="input-wrap">
                <span class="input-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </span>
                <input v-model="form.password" :type="showPassword ? 'text' : 'password'" required
                  class="float-input pr-10" @focus="focus.password = true" @blur="focus.password = false" />
                <button type="button" @click="showPassword = !showPassword" class="eye-btn" tabindex="-1">
                  <Transition name="fade-quick" mode="out-in">
                    <svg v-if="!showPassword" key="eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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

            <div class="flex justify-end -mt-2">
              <a href="#"
                class="text-sm text-blue-600 hover:text-blue-800 transition-colors font-medium hover:underline">Forgot
                Password?</a>
            </div>

            
            <Transition name="shake">
              <div v-if="message" :class="[
                messageType === 'success' ? 'text-green-600' : 'text-red-600',
                messageType === 'success'? 'border border-green-600':'border border-red-600',
                messageType === 'success'? 'bg-green-100':'bg-red-200',
              ]" class="message-banner" >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ message }}</span>
              </div>
            </Transition>

            <button type="submit" :disabled="loading" class="btn-primary" @mousedown="createRipple">
              <Transition name="fade-quick" mode="out-in">

                <span v-if="loading" key="loading" class="flex items-center justify-center gap-2">
                  <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                  </svg>
                  Signing in...
                </span>

                
                
                <!-- <RouterLink to="/dashboard" v-else> -->
                <span v-else key="label" class="flex items-center justify-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                  </svg>
                  Login  
                </span>

              <!-- </RouterLink> -->
                
              </Transition>
            </button>
          </form>

          <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-3 text-xs text-gray-400 font-medium">OR</span>
            <div class="flex-1 border-t border-gray-200"></div>
          </div>

          <p class="text-center text-sm text-gray-600">
            Don't have an account?
            
            <RouterLink to="/register"
            class="text-blue-600 font-bold hover:underline ml-1 transition-colors hover:text-blue-800">Register Now →
          </RouterLink>
        </p>
        <div>
   <!-- <h1 class="text-red-700">{{ users.name }}</h1>
<p>{{ users.course }}</p>
<p>{{ users.language }}</p> -->
</div>
        </div>
      </Transition>
    </div>
    
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import { useRouter, RouterLink } from "vue-router";
import axios from "axios";

const router = useRouter();

const users = ref([]);

const form = reactive({ email: "", password: "" });
const focus = reactive({ email: false, password: false });
const showPassword = ref(false);
const loading = ref(false);
const message = ref("");
const messageType = ref("");
const particles = ref([]);

onMounted(async () => {
  particles.value = Array.from({ length: 200 }, (_, i) => ({
    id: i,
    style: `left:${Math.random() * 100}%;top:${Math.random() *200}%;width:${4 + Math.random() * 10}px;height:${6 + Math.random() * 10}px;animation-delay:${Math.random() * 2}s;animation-duration:${6 + Math.random() * 8}s;opacity:${0.15 + Math.random() * 0.25};`,
  }));


  

  
});

// function createRipple(e) {
//   const btn = e.currentTarget;
//   const circle = document.createElement("span");
//   const rect = btn.getBoundingClientRect();
//   const size = Math.max(rect.width, rect.height) * 2;
//   circle.style.cssText = `position:absolute;width:${size}px;height:${size}px;left:${e.clientX - rect.left - size / 2}px;top:${e.clientY - rect.top - size / 2}px;background:rgba(255,255,255,0.3);border-radius:50%;transform:scale(0);animation:ripple-anim 0.6s linear;pointer-events:none;`;
//   btn.appendChild(circle);
//   setTimeout(() => circle.remove(), 700);
// } 

async function handleLogin() {
  // message.value = "";
  loading.value = true;
  await new Promise((r) =>  setTimeout(r, 1200));
  loading.value = false;


  const res = await axios.post("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/login.php",
  {
    email:form.email,
    password:form.password,
  });
  console.log(res)
 
  if(res.data.status){
    // message.value = "Login Successfull!";
    
    message.value = res.data.message + "!";
    messageType.value = "success";

    new Promise(() =>  setTimeout(()=>{
      router.push("/dashboard");
    }, 1200));
    
  }else{
    // message.value = "Invalid email or password. Please try again.";
    message.value =res.data.message;
    messageType.value = "error";
    
  }
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

.message-banner {
  display: flex;
  align-items: center;
  gap: 8px;
  /* background: #fef2f2;
  border: 1px solid #fecaca; */
  /* color: #dc2626; */
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
