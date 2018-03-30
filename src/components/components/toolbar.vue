<template>
    <v-toolbar style="margin: 0px; padding: 0px" :color="style.bgColor" :class="style.textColor" app fixed clipped-left>
        <v-toolbar-side-icon :class="style.textColor" @click="$emit('clickMenu')"></v-toolbar-side-icon>
        <v-toolbar-title>VuEditor</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn :class="style.textColor" color="orange" flat  @click="finalize()">
                <v-icon style="padding-right: 5px">share</v-icon>
                Share
            </v-btn>
            <v-btn :color="style.loginColor" class="" flat @click="login()"><v-icon style="padding-right: 5px">account_box</v-icon>Login</v-btn>
        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
export default {
    name: 'toolbar',
    data () {
        return {
            style: style
        }
    },
    methods: {
        login: function() {
            location.href = location.href + 'login'
        },
        finalize: function() {
            this.$emit('finalize')
        }
    }
}

var style = {
    textColor: "white--text",
    bgColor: 'deep-purple darken-3',
    loginColor: 'orange'
}

</script>
