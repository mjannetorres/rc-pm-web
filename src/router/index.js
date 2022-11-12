import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProjectsView from '../views/ProjectsView.vue'
import ReportsView from '../views/ReportsView.vue'
import ProjectDetailView from '../views/ProjectDetailView.vue'
import LayoutView from "../views/LayoutView.vue";
import LoginView from "../views/LoginView.vue";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/projects',
    name: 'projects',
    component: ProjectsView
  },
  {
    path: '/reports',
    name: 'reports',
    component: ReportsView
  },
  {
    path: '/project/:id',
    name: 'projectdetail',
    component: ProjectDetailView,
    props: true
  },
  {
    path: '/layout/:id',
    name: 'layout',
    component: LayoutView,
    props: true
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  }  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
