<!-- Dashboard entry point — redirects to AdminDashboard view -->
<script setup>
// Dashboard.vue acts as the router entry; the full UI lives in AdminDashboard.vue
import AdminDashboard from '../views/AdminDashboard.vue';
</script>

<template>
  <AdminDashboard />
</template>
