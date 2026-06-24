<template>
    <div class="h-screen flex items-center justify-center w-[10vw] bg-white">
        <ul class="space-y-2 ">
            <li v-for="(item, index) in leftsideItems" :key="index"
            :ref="el => menuItems[index] = el"
                class="menu-item w-40 gap-3 p-3 rounded-xl cursor-pointer flex items-center" @mouseenter="hoverIn(index)"
                @mouseleave="hoverout(index)">
                <img :src="item.logo" :alt="item.title" class="h-7 w-7" />
                <p>{{ item.title }}</p>
            </li>
        </ul>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { gsap } from "gsap";
import dashboardImg from "../svg/dashboard-fill.svg";
import JobListing from "../svg/briefcase-2-line.svg";

const menuItems = ref([]);

const leftsideItems = [
    { logo: dashboardImg, title: "Dashboard" },
      { logo: JobListing, title: "Job Listing" },
    //   { logo: applicationIcon, title: "My Application" },
    //   { logo: profileIcon, title: "Profile" },
    //   { logo: logoutIcon, title: "Logout" },
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
            scale:1,
            duration:0.3,
            ease:"power2.out",
        })
    };
</script>