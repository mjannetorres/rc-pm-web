import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProjectsView from '../views/ProjectsView.vue'
import ReportsView from '../views/ReportsView.vue'
import ProjectDetailView from '../views/ProjectDetailView.vue'
import LayoutView from "../views/LayoutView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";

Vue.use(VueRouter)

const requiredAuth =  (to, from, next) => {
  let user =  localStorage.getItem('auth')
  console.log(user)
  if(!user){
    next({ name : 'login'})
  } else {
    next()
  }
}

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    beforeEnter: requiredAuth
  },
  {
    path: '/projects',
    name: 'projects',
    component: ProjectsView,   
    beforeEnter: requiredAuth
  },
  {
    path: '/reports',
    name: 'reports',
    component: ReportsView,    
    beforeEnter: requiredAuth
  },
  {
    path: '/project/:id',
    name: 'projectdetail',
    component: ProjectDetailView,        
    props: true,
    beforeEnter: requiredAuth
  },
  {
    path: '/layout/:id',
    name: 'layout',
    component: LayoutView,   
    props: true,
    beforeEnter: requiredAuth
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView,
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView,
  }  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router

