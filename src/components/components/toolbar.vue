<template>
    <v-toolbar style="margin: 0px; padding: 0px" :color="dynamicStyle.bgColor" :class="dynamicStyle.textColor" app fixed clipped-left>
        <v-toolbar-side-icon :class="dynamicStyle.textColor" @click="$emit('clickMenu')"></v-toolbar-side-icon>
        <v-toolbar-title id="title" @click="goHome">VuEditor</v-toolbar-title>
        <v-btn v-if="!display_logout" color="orange" class="" flat @click="goto_login()"><v-icon style="padding-right: 5px">account_box</v-icon>Login</v-btn>
        <v-btn v-if="display_logout" :color="dynamicStyle.loginColor" class="" flat @click="logout()"><v-icon style="padding-right: 5px">account_box</v-icon>Logout</v-btn>
        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-sm-and-down">
            <!-- SHARE -->
            <v-tooltip bottom>
                <v-btn slot="activator"  v-if="display" :class="dynamicStyle.textColor" flat  @click="$emit('finalize')">
                    <v-icon style="padding-right: 5px">share</v-icon>
                </v-btn>
                <span>Share form</span>
            </v-tooltip>



            <!-- REGISTER -->
            <v-tooltip debounce="2000" open-on-hover="true"  close-delay="200" bottom>
            <v-btn slot="activator" v-if="display"  class="" flat @click="goto_register()">
                <v-icon style="padding-right: 5px">account_box</v-icon>
            </v-btn>
            <span>Signup</span>
        </v-tooltip>
            <!-- ANSWERS -->
            <v-tooltip bottom>
            <v-btn slot="activator" v-if="display"  class="" flat @click="goto_stats()">
                <v-icon style="padding-right: 5px" class="fas fa-chart-bar"></i>" style="padding-right: 5px"></v-icon>
            </v-btn>
            <span>See answers</span>
        </v-tooltip>

        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
export default {
    name: 'toolbar',
    props: ['display', 'display_logout'],
    data () {
        return {
            dynamicStyle: dynamicStyle
        }
    },
    methods: {
        logout: function() {
            this.$emit('logout')
        },
        goto_login: function() {
            this.$router.push({ path: '/login' })
        },
        goHome: function() {
            this.$router.push({ path: '/' })
        },
        goto_stats: function() {
            this.$router.push({ path: '/answers' })
        },
        goto_register: function() {
            this.$router.push({ path: '/signup' })
        }
    }
}

var dynamicStyle = {
    textColor: "white--text",
    bgColor: 'deep-purple darken-3',
    loginColor: 'orange'
}
</script>


<style scoped>
    #title:hover {
        cursor: pointer;
    }
</style>
