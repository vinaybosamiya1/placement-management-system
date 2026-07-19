<!-- created at 24/6/26 -->
<template>
    <div class="h-[calc(100vh-80px)] w-full sm:max-w-xs md:max-w-sm lg:max-w-xs
           bg-black/15 flex items-center justify-center
           py-6 sm:py-8 lg:py-10">
        <ul class="w-full max-w-xs px-3 sm:px-4 md:px-6 space-y-2">

            <li v-for="(item, index) in leftsideItems" :key="index" @click="handleLogout(item.title)" class="group
               w-full
               min-h-11
               flex items-center
               gap-3
               rounded-lg
               bg-white
               px-3 sm:px-4
               py-2 sm:py-3
               cursor-pointer
               text-sm sm:text-base
               font-medium
               text-black
               transition-all
               duration-300
               ease-out
               hover:bg-blue-600
               hover:text-white
               hover:scale-105
               hover:shadow-lg
               hover:font-bold">
                <component :is="item.logo" class="h-5 w-5 sm:h-6 sm:w-6
                 transition-transform
                 duration-300
                 group-hover:scale-110" />

                <span>{{ item.title }}</span>
            </li>

        </ul>
    </div>
</template>
<script setup>
// import { gsap } from "gsap";
// import { ref } from "vue";
import DashboardIcon from "../assets/svg/leftPanel-icon/dashboard-fill.svg";
import JobListing from "../assets/svg/leftPanel-icon/briefcase-2-line.svg";
import applicationIcon from "../assets/svg/leftPanel-icon/file-list-fill.svg";
import profileIcon from "../assets/svg/leftPanel-icon/user-fill.svg";
import logoutIcon from "../assets/svg/leftPanel-icon/logout-box-r-line.svg";
import axios from "axios";
import { useRouter } from "vue-router";


const router = useRouter();

// const menuItems = ref([]);

const leftsideItems = [
    { logo: DashboardIcon, title: "Dashboard" },
    { logo: JobListing, title: "Job Listing" },
    { logo: applicationIcon, title: "My Application" },
    { logo: profileIcon, title: "Profile" },
    { logo: logoutIcon, title: "Logout" },
];

// const hoverIn = (index) => {
//     gsap.to(menuItems.value[index], {
//         backgroundColor: "#2563EB",
//         color: "#ffffff",
//         scale: 1.05,
//         duration: 0.3,
//         ease: "power2.out"
//     });
// };
// const hoverout = (index) => {
//     gsap.to(menuItems.value[index], {
//         backgroundColor: "#ffffff",
//         color: "#000000",
//         scale: 1,
//         duration: 0.3,
//         ease: "power2.out",
//     })

// };

const Logout = async () => {
    await axios.post("http://localhost/placementManagement/placement-management-system/placement-management-system1/backend/API/logout.php", { withCredentials: true });

    localStorage.removeItem('isLoggedIn');
    // Add your axios call to logout.php and router.push('/login') here
    router.push('/login');
};
const handleLogout = (title) => {
    if (title === "Logout") {
        Logout();

    }
}
</script>