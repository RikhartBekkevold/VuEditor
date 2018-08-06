<template>
      <v-content>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="deep-purple darken-3">
                  <v-toolbar-title>Login</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field  @focus="msg = ''" browser-autocomplete="off" v-model="username" prepend-icon="person" name="username" label="Username" type="text"></v-text-field>
                    <div style="text-align: center"></div>
                    <v-text-field  @focus="msg = ''" v-model="password" prepend-icon="lock" name="password" label="Password" id="password" type="password"></v-text-field>
                    <div id="msg" class="red--text text--lighten--5">{{msg}}</div>
                  </v-form>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn flat  @click="back()">Back</v-btn>
                  <v-btn flat  @click="login()">Login</v-btn>
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
        msg: '',
        namemsg: 'dasda'
    }),
    props: {
        source: String
    },
    methods: {
        back: function() {
            this.$router.go(-1) // -1 = one place back in history stack
        },
        login: function() {
            var self = this;


            if(this.username === '') {
                this.msg = 'Username empty!'
                return
            }
            if(this.password === '') {
                this.msg = 'Password empty!'
                return
            }


            axios('/server/login.php', {
                method: 'post',
                data: {username: this.username, password: this.password}
            }).then(function(response) {
                console.log('response::', response.data)


                if(response.data === 'logged in') {
                    self.$router.push({ path: '/', query: { loggedIn: true } })
                }
                else {
                    self.msg = response.data


                    if(response.data === 'Password incorrect') {
                        self.password = '';
                    }
                    if(response.data === "Username doesn't exists") {
                        self.username = '';
                    }

                }
                // this will only be called if user exists and got valid response form server


                // pass data to new page aswell
                //change log in to log out button
                //also need register button and page
                // add remmember me button?

            })
            .catch(function(error) {
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
