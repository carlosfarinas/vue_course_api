<template>
    <section>
        <base-card>
            <h2>Submitted Experiences</h2>
            <div>
                <base-button @click="loadExperiences">Load Submitted Experiences</base-button>
            </div>
            <p v-if="isLoading">Loading...</p>
            <p v-else-if="!isLoading && err">{{ err }}</p>
            <p v-else-if="!isLoading && (!results || results.length === 0)">
                No records found, please start adding some Surveys.
            </p>
            <ul v-if="!isLoading && results && results.length > 0 && !err">
                <survey-result
                        v-for="result in results"
                        :key="result.id"
                        :name="result.name"
                        :rating="result.rating"
                ></survey-result>
            </ul>
        </base-card>
    </section>
</template>

<script>
import SurveyResult from './SurveyResult.vue';
import axios from "axios";

export default {
    components: {
        SurveyResult,
    },
    data() {
        return {
            results: [],
            isLoading: false,
            err: null
        }
    },
    methods: {
        async loadExperiences () {
            this.invalidInput = false;
            this.isLoading = true;
            this.err = null;
            await axios({
                method: 'get',
                url: 'http://127.0.0.1/api/surveys/all',
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                this.isLoading = false;
                const data = response.data.data.surveys;
                const results = [];
                for (const id in data) {
                    results.push({
                        id: id,
                        name: data[id].enteredName,
                        rating: data[id].chosenRating
                    })
                }
                //this.results = response.data.data.surveys;
                this.results = results;
                console.log(this.results);
            }).catch(e => {
                this.isLoading = false;
                this.err = "Failed to fetch the data, Reason: " + e.message;
                console.log(this.err);
            });
        }

    },
    mounted() {
        this.loadExperiences();
    }
};
</script>

<style scoped>
ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
</style>
