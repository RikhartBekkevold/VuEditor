<template>
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="deep-purple darken-3">
                  <v-toolbar-title>Register</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field @focus="msg = ''" browser-autocomplete="off" prepend-icon="person" v-model="username" name="login" label="Username" type="text"></v-text-field>
                    <v-text-field @focus="msg = ''" prepend-icon="lock" v-model="password" name="password" label="Password" id="password" type="password"></v-text-field>
                    <!-- <v-text-field prepend-icon="lock" name="email" label="Email" id="email" type="email"></v-text-field> -->
                    <div id="msg" class="red--text text--lighten--5">{{msg}}</div>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn flat @click="back()">Back</v-btn>
                  <v-btn flat @click="register()">Sign up</v-btn>
                </v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
</template>

<script>
import axios from 'axios'


export default {
    data: () => ({
        drawer: null,
        username: '',
        password: '',
        msg: ''
    }),
    props: {
        source: String
    },
    methods: {
        back: function() {
            this.$router.go(-1);
        },
        register: function() {
            var self = this;

            // if username field is empty
            if(this.username === '') {
                this.msg = 'Username empty!'
                return
            }
            // or password field. dont ask server. just tell user to try again
            if(this.password === '') {
                this.msg = 'Password empty!'
                return
            }

            axios('/server/signup.php', {
                method: 'post',
                data: {username: this.username, password: this.password}
            }).then(function(response) {
                console.log('response::', response.data)

                if(response.data === 'success') {
                    self.msg = 'Success'
                    setTimeout(function() {
                        self.$router.push({path: '/login'})
                        // pass the info also, to auto login?
                    }, 1000);
                }
                // else display error and reset fields
                else {
                    self.msg = response.data;
                    self.password = '';
                    self.username = '';
                }
            })
            .catch(function(error) {
                // this is only for if file is not found etc, if the ajax request fails. has
                // nothing to do with php resuklts
                console.log('ERROR::', error.data)
            });

        }
    }
}
</script>

<style scoped>
    #msg {
        text-align: center;
        font-size: 1.2em;
        height: 20px;
    }
</style>
