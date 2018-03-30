<template>
    <v-navigation-drawer  :clipped="true" v-model="show" app>
        <!-- 1 -->
        <v-toolbar>
            <v-list>
                <v-list-tile>
                    <v-list-tile-title class="title">
                        Input
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-toolbar>
        <v-divider></v-divider>

        <!-- 1.1 -->
        <v-list class="pt-0" :style="{color: style.hex}">
            <draggable :clone="clone" v-model="input" :options="{group:{ name:'questions',  pull:'clone', put: false }, sort: false}">
                <v-list-tile
                v-for="item in input"
                :key="item.title"
                @click="$emit('clicked', item.title)">
                    <v-list-tile-action>
                        <v-icon large :color="style.name">

                            {{ item.icon }}

                        </v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>

                            {{ item.title }}

                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </draggable>
        </v-list>


        <!-- 2 -->
        <v-toolbar color="">
            <v-list>
                <v-list-tile>
                    <v-list-tile-title class="title">
                        Media
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-toolbar>
        <v-divider></v-divider>

        <!-- 2.1 -->
        <v-list class="pt-0" :style="{color: style.hex}" >
            <draggable
                v-model="media"
                :options="{group:{ name:'questions',  pull:'clone', put: false }, sort: false}">

                <v-list-tile
                    v-for="rareitem in media"
                    :key="rareitem.title"
                    @click="$emit('clicked', rareitem.title)">

                    <v-list-tile-action>
                        <v-icon large :color="style.name">

                            {{ rareitem.icon }}

                        </v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>

                            {{ rareitem.title }}

                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </draggable>
        </v-list>


        <!-- 3 -->
        <v-toolbar>
            <v-list>
                <v-list-tile>
                    <v-list-tile-title class="title">
                        Time
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-toolbar>
        <v-divider></v-divider>

        <!-- 3.1 -->
        <v-list class="pt-0" :style="{color: style.hex}" >
            <draggable
                v-model="time"
                :options="{group:{ name:'questions',  pull:'clone', put: false }, sort: false}">

                <v-list-tile
                    v-for="rareitem in time"
                    :key="rareitem.title"
                    @click="$emit('clicked', rareitem.title)">

                    <v-list-tile-action>
                        <v-icon large :color="style.name">

                            {{ rareitem.icon }}

                        </v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>

                            {{ rareitem.title }}

                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </draggable>
        </v-list>



    </v-navigation-drawer>
</template>

<script>
import draggable from 'vuedraggable'
import Question from '../../js/classes' // or './module'


export default {
    components: {
        draggable,
    },
    props: {
        show: null
    },
    data () {
        return {
            style: style,
            input: [
                new Question('Radiobutton'),
                new Question('Checkmark'),
                new Question('Textfield'),
                new Question('Textarea'),
                new Question('Select'),
                new Question('Slider')
            ],
            media:[
                new Question('Image'),
                new Question('Video')
            ],
            time: [
                new Question('Date'),
                new Question('Time')
            ]
        }
    },
    methods: {
        // returns the values to copy when cloning el into another list
        clone: function(el) {
            return (new Question(el.title))
        }
    }
}

var style = {
    hex: '#BDBDBD',
    name: 'grey lighten-1'
}

</script>
