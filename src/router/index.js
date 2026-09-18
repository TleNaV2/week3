import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/about',
    name: 'about',
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/customer',
    name: 'customers',
    component: () => import('../views/Customer.vue')
  },
  {
    path: '/employee',
    name: 'employee',
    component: () => import('../views/Employee.vue')
  },
  {
    path: '/add-customer',
    name: 'add-customer',
    component: () => import('../views/Add_customer.vue')
  },
  {
    path: '/add-employee',
    name: 'add-employee',
    component: () => import('../views/Add_employee.vue')
  },
  {
    path: '/contact',
    name: 'contact',
    component: () => import('../views/contacts.vue')
  },
  {
    path: '/add-contact',
    name: 'add-contact',
    component: () => import('../views/Add_contact.vue')
  }
]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
