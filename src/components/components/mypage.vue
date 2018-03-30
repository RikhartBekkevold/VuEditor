<template>
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card width="100px" class="elevation-12">
                <v-card-title>{{msg}}</v-card-title>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
</template>

<script>
export default {
    props: ['msg'],
    data: () => ({
        drawer: null
    }),
    methods: {
        back: function() {
            location.hash = '/' //history api to go back instead? simulating user action
        },
        login: function() {
            location.hash = '/form'
        }
    }
}
</script>

<style scoped>

</style>
