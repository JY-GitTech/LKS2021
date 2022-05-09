import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/user/Home.vue'
import Index from '../views/index.vue'
import Register from '../views/Register.vue'
import Produk from '../views/user/Produk.vue'
import Chart from '../views/user/Chart.vue'
import Produks from '../views/admin/Produks.vue'
import News from '../views/admin/News.vue'
import CreateProduks from '../views/admin/ProduksCreate.vue'
import EditProduks from '../views/admin/ProduksEdit.vue'
import CreateNews from '../views/admin/NewsCreate.vue'
import EditNews from '../views/admin/NewsEdit.vue'
import ProdukDetail from '../views/user/ProdukDetail.vue'
import Checkout from '../views/user/Checkout.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: "Index",
    component: Index
  },
  {
    path: '/register/',
    name: 'Register',
    component: Register
  },
  //admin
  {
    path: "/produks/:token/:role",
    name: "Produks",
    component: Produks
  },
  {
    path: "/news/:token/:role",
    name: "News",
    component: News
  },
  {
    path: "/create-produks/:token/:role",
    name: "CreateProduks",
    component: CreateProduks
  },
  {
    path: "/edit-produks/:id/:token/:role",
    name: "EditProduks",
    component: EditProduks
  },
  {
    path: "/create-news/:token/:role",
    name: "CreateNews",
    component: CreateNews
  },
  {
    path: "/edit-news/:id/:token/:role",
    name: "EditNews",
    component: EditNews
  },
  //user
  {
    path: '/home/:token',
    name: 'Home',
    component: Home
  },
  {
    path: "/produk/:token",
    name: "Produk",
    component: Produk
  },
  {
    path: "/chart/:token",
    name: "Chart",
    component: Chart
  },
  {
    path: "/produk_detail/:id/:token",
    name: "ProdukDetail",
    component: ProdukDetail
  },
  {
    path: "/checkout/:token",
    name: "Checkout",
    component: Checkout
  }

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
