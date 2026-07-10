import { createRouter, createWebHashHistory } from "vue-router";
  import LoginView from "../views/LoginView.vue";
  import LoginViewcopy from "../views/LoginView copy.vue";
  import RegisterView from "../views/RegisterView.vue";

const router = createRouter({
  history: createWebHashHistory(),
  routes: [
    { path: "/", redirect: "/login" },
    { path: "/login", component: LoginView },
    { path: "/logincopy", component: LoginViewcopy },
    { path: "/register", component: RegisterView },
  ],
});

export default router;
