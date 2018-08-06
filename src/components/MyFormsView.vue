<template>
  <div>
    <div>{{error_msg}}</div>

    <!-- check if user is logged in. if not deny access
    load all forms from db where username matches

    make logged in status global -->
    {{userForms}}
    <v-container fluid style="border: 1px solid red">
        <v-layout style="border: 1px solid blue">
            <v-flex  style="display: flex; justify-content: center; flex-wrap: wrap; border: 1px solid green"  xs12 sm6 offset-sm3>
                <v-card style="border: 1px solid black; width: 200px; margin: 20px 20px 20px 20px;" v-for="(form, index) in userForms" :key="index">

                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">{{form.title}}</h3>
                            <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
                        </div>
                    </v-card-title>

                    <v-card-actions>
                        <v-btn flat @click="edit()" color="orange">Edit</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>

  </div>

<!-- save as string directly in db, dont decode it when recieveing. that way can just send it righjt back as string and decode on js side -->




</template>

<script>
import axios from 'axios'

export default {
    name: 'MyFormsView',
    data () {
        return {
            error_msg: '',
            userForms:
                    [
                        // {title: 'Users and their behaviour'},
                        // {title: 'Users and theviour'},
                        // {title: 'Users and th'},
                        // {title: 'Userviour'},

                    ],
            logged_in: true
        }
    },
    created() {
        this.fetchForms();
    },
    methods: {
        fetchForms() {
            // get all forms where user id matches... foreign key...
            if(this.logged_in) {
                var self = this;

                axios('/server/getAllForms.php', {
                    method: 'post',
                    data: { id: 4 }
                }).then(function(response) {
                    console.log('response::', response.data)
                    self.userForms = response.data
                })
                .catch(function(error) {
                      console.log('ERROR::', error.data)
                });


                // if logged in reset message
                this.error_msg = ''
            }
            else {
                this.error_msg = 'Access denied. Log in first.'
            }

        },
        edit() {
            // open mainview with  this form  represented in form
        }



    }
}
</script>

<style scoped>

</style>
