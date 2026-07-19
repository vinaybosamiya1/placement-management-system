<!-- create at 22/6/26 and complete at 24/6/26 -->
 
<template>
  <main>
    <nav class="bg-blue-600 text-white shadow-md
             flex items-center justify-between
             h-16 sm:h-20
             px-3 sm:px-5 lg:px-8">

      <!-- Logo + Title -->
      <div class="flex items-center gap-2 sm:gap-3 min-w-0">

        <div class="h-12 w-12 sm:h-16 sm:w-16 lg:h-20 lg:w-20
                 flex items-center justify-center flex-shrink-0">
          <img src="../assets/img/placement management system.png" alt="Logo" class="w-full h-full object-contain" />
        </div>

        <h1 class="font-bold tracking-wide
                 text-sm sm:text-lg lg:text-2xl
                 truncate">
          <!-- Placement Management System -->
          Placement Portal
        </h1>

      </div>

      <!-- Right Side -->
      <div class="flex items-center gap-2 sm:gap-4 lg:gap-8">

        <!-- Notification -->
        <div class="h-9 w-9 sm:h-10 sm:w-10 lg:h-12 lg:w-12
                 rounded-full
                 bg-blue-500
                 border-2 lg:border-3 border-blue-900
                 flex items-center justify-center
                 cursor-pointer
                 transition-all duration-300
                 hover:bg-blue-800
                 hover:scale-105">
          <img src="../assets/svg/navbar-icon/notification-3-fill.svg" alt="Notification"
            class="h-5 w-5 sm:h-6 sm:w-6 lg:h-8 lg:w-8" />
        </div>

        <!-- User -->
        <button class="flex items-center
                 gap-2 sm:gap-3
                 rounded-full
                 border-2 lg:border-3 border-blue-800
                 bg-white/5
                 hover:bg-white/15
                 transition-all duration-300
                 cursor-pointer
                 p-1.5 sm:p-2
                 pr-2 sm:pr-3">

          <div class="h-8 w-8 sm:h-10 sm:w-10
                   bg-white
                   rounded-full
                   flex items-center justify-center
                   overflow-hidden
                   p-1">
            <img src="../assets/svg/navbar-icon/user-2-line.svg" alt="User" class="h-full w-full opacity-80" />
          </div>

          <!-- Hide on Mobile -->
           <router-link to="/profile">

             <div class="hidden md:block text-left">
               
               <h2 class="text-sm font-semibold">
                 {{ user.full_name }}
                </h2>
                
                <p class="text-xs text-blue-200">
                  BCA Final Year
                </p>
                
              </div>
            </router-link>

        </button>

      </div>

    </nav>
  </main>
</template>

add at 16-7-26

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const user = ref([]);

onMounted(async () => {

  const res = await axios.get("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/models/fetchUserData/getUser.php",
    {
      withCredentials: true,
    }
  );

  if (res.data.success) {
    user.value = res.data.user;
  }
  // console.log(res.data);

})

</script>
