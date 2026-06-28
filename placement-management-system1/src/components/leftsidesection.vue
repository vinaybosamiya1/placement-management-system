<!-- created at 24/6/26 -->
<template>
    <!-- <div class="relative -left-87.5"> -->

        <div class="h-screen w-full max-w-xs py-10 flex items-center justify-center bg-black/5 ">
            <ul class="space-y-4 ">
                <li v-for="(item, index) in leftsideItems" :key="index" :ref="el => menuItems[index] = el"
                    class="menu-item w-full min-h-14 py-4 bg-white px-6  gap-3 rounded-xl cursor-pointer flex items-center font-medium  hover:font-bold "
                    @mouseenter="hoverIn(index)" @mouseleave="hoverout(index)">
                    <component :is="item.logo" class="h-7 w-7" />
                    <span>{{ item.title }}</span>
                </li>
               <router-link to="/login">Login</router-link>
            </ul>
        </div>
    <!-- </div> -->
</template>
<script setup>
import { ref } from "vue";
import { gsap } from "gsap";
import DashboardIcon from "../assets/svg/leftPanel-icon/dashboard-fill.svg";
import JobListing from "../assets/svg/leftPanel-icon/briefcase-2-line.svg";
import applicationIcon from "../assets/svg/leftPanel-icon/file-list-fill.svg";
import profileIcon from "../assets/svg/leftPanel-icon/user-fill.svg";
import logoutIcon from "../assets/svg/leftPanel-icon/logout-box-r-line.svg";

const menuItems = ref([]);

const leftsideItems = [
    { logo: DashboardIcon, title: "Dashboard" },
      { logo: JobListing, title: "Job Listing" },
      { logo: applicationIcon, title: "My Application" },
      { logo: profileIcon, title: "Profile" },
      { logo: logoutIcon, title: "Logout" },
];

const hoverIn = (index) => {
    gsap.to(menuItems.value[index], {
        backgroundColor: "#2563EB",
        color: "#ffffff",
        scale: 1.05,
        duration: 0.3,
        ease: "power2.out"
    });
};
const hoverout = (index) => {
    gsap.to(menuItems.value[index], {
        backgroundColor: "#ffffff",
        color: "#000000",
        scale: 1,
        duration: 0.3,
        ease: "power2.out",
    })
};
</script>