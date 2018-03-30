<template>
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title>Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field prepend-icon="person" name="login" label="Login" type="text"></v-text-field>
                    <v-text-field prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="primary" @click="back()"> <v-icon dark left>arrow_back</v-icon>Back</v-btn>
                  <v-btn color="primary" @click="login()"> Login<v-icon dark right>arrow_forward</v-icon></v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
</template>

<script>
export default {
    data: () => ({
        drawer: null
    }),
    props: {
        source: String
    },
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
