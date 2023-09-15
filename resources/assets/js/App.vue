<template>
    <base-card>
        <the-navigation @set-page="setActivePage"></the-navigation>
    </base-card>
    <main>
        <component :is="activePage"></component>
    </main>
    <hr>
    <learning-survey></learning-survey>
    <user-experiences></user-experiences>
    <button @click="confirmInput">Go to teams</button>


</template>

<script>
import LearningSurvey from './components/survey/LearningSurvey.vue';
import UserExperiences from './components/survey/UserExperiences.vue';
import TeamsList from "./components/teams/TeamsList.vue";
import UsersList from "./components/users/UsersList.vue";
import TheNavigation from "./components/nav/TheNavigation.vue";

export default {
    components: {
        LearningSurvey,
        UserExperiences,
        TheNavigation,
        TeamsList,
        UsersList
    },
    data() {
        return {
            activePage: 'teams-list',
            teams: [
                { id: 't1', name: 'Frontend Engineers', members: ['u1', 'u2'] },
                { id: 't2', name: 'Backend Engineers', members: ['u1', 'u2', 'u3'] },
                { id: 't3', name: 'Client Consulting', members: ['u4', 'u5'] },
            ],
            users: [
                { id: 'u1', fullName: 'Max Schwarz', role: 'Engineer' },
                { id: 'u2', fullName: 'Praveen Kumar', role: 'Engineer' },
                { id: 'u3', fullName: 'Julie Jones', role: 'Engineer' },
                { id: 'u4', fullName: 'Alex Blackfield', role: 'Consultant' },
                { id: 'u5', fullName: 'Marie Smith', role: 'Consultant' },
            ],
        };
    },
    provide() {
        return {
            teams: this.teams,
            users: this.users,
        };
    },
    methods: {
        confirmInput() {
            this.$router.push('/teams/t1');
        },
        setActivePage(page) {
            this.activePage = page;
        },
    }
    // data() {
    //   return {
    //     savedSurveyResults: [],
    //   };
    // },
    // methods: {
    //   storeSurvey(surveyData) {
    //     const surveyResult = {
    //       name: surveyData.userName,
    //       rating: surveyData.rating,
    //       id: new Date().toISOString(),
    //     };
    //     this.savedSurveyResults.push(surveyResult);
    //     console.log(surveyResult);
    //   },
    // },
};
</script>

<style>
* {
    box-sizing: border-box;
}

html {
    font-family: sans-serif;
}

body {
    margin: 0;
}
</style>
