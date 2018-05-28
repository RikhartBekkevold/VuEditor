<template>
    <v-toolbar style="margin: 0px; padding: 0px" :color="dynamicStyle.bgColor" :class="dynamicStyle.textColor" app fixed clipped-left>
        <v-toolbar-side-icon :class="dynamicStyle.textColor" @click="$emit('clickMenu')"></v-toolbar-side-icon>
        <v-toolbar-title id="title" @click="goHome">VuEditor</v-toolbar-title>
        <!-- <v-toolbar-title id="">Rearrange the order the pages will appear</v-toolbar-title> -->
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn v-if="display" :class="dynamicStyle.textColor" color="orange" flat  @click="$emit('finalize')">
                <v-icon style="padding-right: 5px">share</v-icon>
                Share
            </v-btn>
            <v-btn v-if="display" :color="dynamicStyle.loginColor" class="" flat @click="goto_login()"><v-icon style="padding-right: 5px">account_box</v-icon>Login</v-btn>
            <v-btn v-if="display" :color="dynamicStyle.loginColor" class="" flat @click="goto_stats()"><v-icon style="padding-right: 5px" class="fas fa-chart-bar"></i>" style="padding-right: 5px"></v-icon>Answers</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
export default {
    name: 'toolbar',
    props: ['display'],
    data () {
        return {
            dynamicStyle: dynamicStyle
        }
    },
    methods: {
        goto_login: function() {
            this.$router.push({ path: '/login' })
        },
        goHome: function() {
            this.$router.push({ path: '/' })
        },
        goto_stats: function() {
            this.$router.push({ path: '/answers' })
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
