<template>
    <div>
        <toolbar>
        </toolbar>
        <v-content>
          <v-container fluid>

            <v-layout align-center justify-center>
              <v-flex xs12 sm8 md5>


                <!-- <div style="color: white; text-align: center" class="loading" v-if="loading">
                    Loading...
                </div> -->
                <h2 style="color: white" v-if="chartData.length === 0">{{msg}}</h2>
                <h2 style="color: white; text-align: center" v-if="loading">Loading...</h2>
                <!-- {{answers}} -->
                <div style="margin-bottom: 100px;" v-for="(answer, index) in chartData">
                    <v-divider></v-divider>
                    <h2 style="margin-top: 10px; margin-bottom: 40px">Question {{index + 1}}: {{answer.qTitle}}</h2>
                    <bar-chart v-if="answer.type === 'check'" legend="right" :data="answer.answers"></bar-chart>
                    <pie-chart v-if="answer.type === 'radio'" legend="right" :data="answer.answers"></pie-chart>
                    <line-chart v-if="answer.type === 'time'" legend="right" :data="answer.answers"></line-chart>
                </div>




              </v-flex>
            </v-layout>
          </v-container>
        </v-content>

    </div>
</template>

<script>
import toolbar from './components/toolbar'
import axios   from 'axios'

//. means a specificed path. this path is in a file read at launch. webpack config file.

export default {
    name: 'StatsView',
    components: {
        toolbar
    },
    data: () => ({
        drawer: null,
        loading: false,
        myChart: null,
        msg: 'No answers yet',
        answers: {},
        chartData: [
        // {   type: 'check',
        //     qTitle: 'What is?',
        //     answers: {'Blueberry': 44, 'Strawberry': 23, 'Strawbedrry': 2}
        // },
        //
        // {type: 'radio', qTitle: 'Which one do you prefer?', answers: {'dasd': 14, 'yyyew': 23, 'Strawbedrry': 2}},
        // {type: 'time', qTitle: 'Occurence', answers: {'jan': 14, 'feb': 23, 'march': 20}},
        // {qTitle: 'What is?', answers: {'dasd': 14, 'yyyew': 23, 'Strawbedrry': 2}},
        // {qTitle: 'What is?', answers: {'dasd': 14, 'yyyew': 23, 'Strawbedrry': 2}},
        ]

    }),
    created() {
        // this.answers = JSON.parse(this.$route.params.ids)
        // console.log(this.answers)
        this.fetchData()
    },
    methods: {
        // not one answer. all answers from all people
        // fetch from db
        fetchData: function() {
            this.loading = true
            var self = this;


            axios('/server/fetchAnswers.php', {
                method: 'get',
            }).then(function(response) {
                self.chartData = response.data
                self.loading = false
            })
            .catch(function(error) {
                console.log('ERROR::', error)
            });
        }
    }
}


</script>
