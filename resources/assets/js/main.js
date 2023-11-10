import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";

import BaseCard from './components/UI/BaseCard.vue';
import BaseButton from './components/UI/BaseButton.vue';

import TeamsList from './components/teams/TeamsList.vue';
import UsersList from './components/users/UsersList.vue';
import TeamMembers from "./components/teams/TeamMembers.vue";

import App from './App.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TeamsList },
        { path: '/teams', component: TeamsList },
        { path: '/users', component: UsersList },
        { path: '/teams/:teamId', component: TeamMembers, props: true }
    ],
    linkActiveClass: 'active'
});

const app = createApp(App);
app.use(router);

app.component('base-card', BaseCard);
app.component('base-button', BaseButton);

app.mount('#app');
