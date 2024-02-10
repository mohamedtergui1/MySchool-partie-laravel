import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './layouts/App.vue';
import FirstView from './views/FirstView.vue';
import AnotherView from './views/AnotherView.vue';

const routes = [
  {
    path: '/',
    name: 'home'
    
  },
  {
    path: '/login',
    name: 'login',
    component: FirstView
  },
  {
    path: '/signup',
    name: 'signup',
    component: AnotherView
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

const app = createApp(App);

app.use(router);

app.mount('#app');
