import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";

import BaseCard from './components/UI/BaseCard.vue';
import BaseButton from './components/UI/BaseButton.vue';

import UsersList from './components/route_components/UsersList.vue';
import TeamsList from './components/route_components/TeamsList.vue';

import App from './App.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TeamsList },
        { path: '/teams', component: TeamsList },
        { path: '/users', component: UsersList }
    ],
    linkActiveClass: 'active'
});

const app = createApp(App);
app.use(router);

app.component('base-card', BaseCard);
app.component('base-button', BaseButton);

app.mount('#app');
