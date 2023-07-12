<template>
    <learning-survey></learning-survey>
    <user-experiences></user-experiences>
    <button @click="confirmInput">Go to teams</button>
    <base-card>
        <link-navigation></link-navigation>
        <router-view></router-view>
    </base-card>

</template>

<script>
import LearningSurvey from './components/survey/LearningSurvey.vue';
import UserExperiences from './components/survey/UserExperiences.vue';
import LinkNavigation from "./components/LinkNavigation.vue";

export default {
    components: {
        LearningSurvey,
        UserExperiences,
        LinkNavigation
    },
    methods: {
        confirmInput() {
            this.$router.push('/teams');
        }
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