import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path:"/",
      name:"home",
      component: () => import("../views/HomeView.vue")
    },
    {
      path:"/dashboard",
      name:"dashboard",
      component: () => import("../views/DashboardView.vue")
    },
    {
      path:"/transactions",
      name:"transactions",
      component: () => import("../views/TransactionView.vue")
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterView.vue")
    },
    {
      path: "/contact",
      name: "contact",
      component: () => import("../views/ContactsView.vue"),
    },
    {
      path: "/project",
      name: "project",
      component: () => import("../views/ProjectView.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
    },
    {
      path: "/cracking",
      name: "cracking",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/CrackingView.vue"),
    },
    {
      path: "/edit",
      name: "edit",
      component: () => import("../views/EditProfilView.vue"),
    },
    {
      path: "/admin",
      name: "admin",
      component: () => import("../views/AdminView.vue"),
    },
    {
      path: "/reset",
      name: "reset",
      component: () => import("../views/PasswordResetView.vue"),
    },
    {
      path: "/confirm/:token",
      name: "confirm",
      component: () => import("../views/ConfirmPasswordView.vue"),
    },
    {
      path: "/agreed/",
      name: "agreed",
      component: () => import("../views/AgreedContactView.vue"),
      path: "/cancelstripe",
      name: "cancelstripe",
      component: () => import("../views/CancelstripeView.vue"),
    },

    // router.beforeEach((to, from, next) => {
    //   const user = useUserStore();
    //   if(to.meta.requiresGuest && user.loggedIn){
    //     next({name: 'home'})
    //   } else{
    //     next()
    //   }
    // })
    // {
    //   path: "/profil",
    //   name: "profil",
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import("../views/ProfilView.vue"),
    // },
    // {
    //   path: "/login",
    //   name: "login",
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import("../views/LoginView.vue"),
    // },
    // {
    //   path: "/edit",
    //   name: "edit",
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import("../views/EditView.vue"),
    // },
    // {
    //   path: "/about",
    //   name: "about",
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import("../views/AboutView.vue"),
    // },
  ],
});

export default router;
