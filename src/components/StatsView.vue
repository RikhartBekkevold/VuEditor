<template>
    <div>
        <toolbar>
        </toolbar>
        <v-content>
          <v-container fluid>
            <v-layout align-center justify-center>
              <v-flex xs12 sm8 md5>

                <!-- <h2 style="color: white" v-if="chartData.length === 0">{{msg}}</h2>
                <h2 style="color: white; text-align: center" v-if="loading">Loading...</h2> -->


                <div style="margin-bottom: 100px;" v-for="(answer, index) in chartData">
                    <v-divider></v-divider>
                    <h2 style="margin-top: 10px; margin-bottom: 40px">Question {{index + 1}}: {{answer.qTitle}}</h2>
                    <bar-chart v-if="answer.type === 'check'" legend="right" :data="answer.answers"></bar-chart>
                    <pie-chart v-if="answer.type === 'radio'" legend="right" :data="answer.answers"></pie-chart>
                    <line-chart v-if="answer.type === 'time'" legend="right" :data="answer.answers"></line-chart>
                </div>
                {{chartData}}
                <br>
                <br>
                {{chartData.length}}

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
        msg: 'No answers yet', // error message
        answers: {},
        chartData: [
        {   type: 'check',
            qTitle: 'What is?',
            answers: {'Blueberry': 44, 'Strawberry': 23, 'Strawbedrry': 2}
        },
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
        // get the answers for this form from the DB
        this.fetchData()
        //transform the data to a format the chart components understand
        this.transformAnswerToChartData()
    },
    methods: {
        // not one answer. all answers from all people
        // fetch from db
        fetchData: function() {
            this.loading = true
            var self = this;

            // let loadTime = setTimeout(function() {
            //     self.msg = 'took to long' // rather based this on reponse from request?
            // }, 10000)

            axios('/server/fetchAnswers.php', {
                method: 'get',
            }).then(function(response) {
                // console.log(response.data)
                // (response.data)

                // console.log(Array.isArray(response.data));

                // response.data = JSON.stringify(response.data);
                // preserve newlines, etc - use valid JSON
                // response.data = response.data.replace(/\\/g, "");
                // remove non-printable and other non-valid JSON chars
                // response.data = response.data.replace(/[\u0000-\u0019]+/g,"");
                // console.log(response.data);
                // response.data = JSON.stringify(response.data);

                // self.chartData = response.data;
                // console.log(response.data);
                self.chartData = response.data// JSON.parse()
                // console.log(Array.isArray(self.chartData));

                self.loading = false
                // clearTimeout(loadTime)
            })
            .catch(function(error) {
                console.log('ERROR:', error)
                // display error in msg, or transform it first
            });
        },
        transformAnswerToChartData() {

            // {   type: 'check',
            //     qTitle: 'What is?',
            //     answers: {'Blueberry': 44, 'Strawberry': 23, 'Strawbedrry': 2}
            // }

            // "[{"qTitle":"Radiobutton","label":["dasd","dasd"],"answers":[false,false]}]"

            this.chartData.forEach(function(item) {

            })
        }
    }
}


</script>
