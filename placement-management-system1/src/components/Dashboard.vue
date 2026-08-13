<script setup>
import { ref, onMounted } from 'vue';
import StudentDashboard from './StudentDashboard.vue';
import AdminDashboard from '../views/AdminDashboard.vue';

const userRole = ref(localStorage.getItem('userRole') || 'student');

onMounted(() => {
  const role = localStorage.getItem('userRole');
  if (role) {
    userRole.value = role;
  }
});
</script>

<template>
  <AdminDashboard v-if="userRole === 'Admin'" />
  <StudentDashboard v-else />
</template>
