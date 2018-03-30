<template>
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>

                <!-- display answers as graphs and a table = 1 row, on participant -->

            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
</template>

<script>
export default {
    name: 'StatsView',
    data: () => ({
        drawer: null
    }),
    props: {
        source: String
        //recieve answers
    },
    methods: {
        back: function() {
            location.hash = '/' //history api to go back instead? simulating user action
        },
        login: function() {
            location.hash = '/'
        }
    }
}
</script>

<style scoped>

</style>
