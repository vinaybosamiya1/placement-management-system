import { createRouter, createWebHistory } from "vue-router";
// import LoginView from "../views/LoginView.vue";
// import RegisterView from "../views/RegisterView.vue";
// import Dashboard from "../components/Dashboard.vue";

const routes = [
    { path: "/", redirect: "/login" },
    {
        path: "/login", name: 'Login', component: () => import('../views/LoginView.vue')
    },
    {
        path: "/register", name: 'register', component: () => import('../views/RegisterView.vue')
    },
    {
        path: "/dashboard", name: 'dashboard', component: () => import('../components/Dashboard.vue'), 
        meta: {
            requiresAuth:true,
        }
    },
    {
        path:"/profile", name:'profile',component: ()=>import("../components/userProfile.vue"),meta:{requiresAuth:true}
    },
    {
        path:"/editprofile", name:'editprofile',component: ()=>import("../components/EditUserProfile.vue"),meta:{requiresAuth:true}
    },
]

const router = createRouter({ history: createWebHistory(import.meta.env.BASH_URL), routes })

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true';
    // chatgpt = https://chatgpt.com/c/6a579f52-e640-83ee-bb53-71b12a860182
    if (to.meta.requiresAuth && !isAuthenticated){
        next('/login');
    }
    // else if((to.path === "/login" || to.path === "/register") && isAuthenticated){
    //     next('/dashboard')
    // }
    else {
    next();
  }
})
export default router;