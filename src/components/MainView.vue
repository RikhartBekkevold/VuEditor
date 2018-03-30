<template>
    <div>

        <toolbar
            @clickMenu="right = !right"
            @finalize="sendForm">
        </toolbar>
        <questionmenu
            @clicked="addQuestion"
            :show="right">
        </questionmenu>
        <optionsmenu
            @finalize="sendForm"
            @colorChange="changeColour"
            @delete="deleteEntireForm()"
            @addPage="addPage"
            v-model="form.timerEnabled">
        </optionsmenu>


    <v-layout>
        <v-flex xs12 sm6 offset-sm3>

            <v-toolbar color="deep-purple darken-3" style="margin: auto; margin-top: 100px; width: 80%; padding: 10px;padding-top:0px;">
                <v-text-field
                    hide-details
                    class="white--text deep-purple darken-3"
                    name="input-1"
                    placeholder="TITLE"
                    v-model="form.title">
                </v-text-field>
            </v-toolbar>

               <v-card  style="margin: auto; width: 80%; margin-bottom: 40px;" v-for="(page, index) in form.pages" v-if="index === form.currentPage"  :key="index" :light="false">
                   <v-list :light="lightMode" :style="{'background': colors.hex}" style="min-height: 650px;" class="pt-0 ">
                        <v-container fluid style="padding: 0px">
                            <draggable v-model="page.questions" style="min-height: 650px" :options="{group:{ name:'questions' }, animation: 150}">
                                <v-layout row :light="lightMode" v-for="(item, index) in page.questions" :key="item.id">
                                    <v-flex>
                                    <v-card :style="{'background': colors.hex}" :light="lightMode" class="post" style="box-shadow: none; border-radius: 0px; padding: 20px 20px 20px 20px">

                                        <!-- Question -->
                                        <v-text-field
                                            v-model="item.question"
                                            :light="lightMode"
                                            class="black--text"
                                            style="margin-bottom: 20px"
                                            name="input-1"
                                            label="Question"
                                            clearable
                                            counter>
                                        </v-text-field>
                                        <!-- TEXTFIELD -->
                                        <v-text-field
                                            v-if="item.title == 'Textfield'"
                                            v-model="item.value"
                                            :light="lightMode"
                                            class="black--text"
                                            name="input-1"
                                            label="">
                                        </v-text-field>
                                        <!-- CHECKMARK -->
                                        <draggable v-if="item.title == 'Checkmark'" v-model="item.options" style="" :options="{animation: 150}">
                                            <v-layout :key="index" v-for="(n, index) in item.options" align-center>
                                                <v-checkbox
                                                    hide-details
                                                    :light="lightMode"
                                                    class="shrink mr-2"
                                                    v-model="selected"
                                                    :key="index"
                                                    :value="n.label + ' ' + index">
                                                </v-checkbox>
                                                <v-text-field  single-line name="input-1-3" v-model="n.label" :light="lightMode" label=""></v-text-field>
                                            </v-layout>
                                        </draggable>
                                        <!-- RADIOBUTTON -->
                                        <v-layout :key="index" v-for="(n, index) in item.options"  v-if="item.title == 'Radiobutton'">
                                             <v-radio-group style="padding-top: 0px" class="shrink mr-2" v-model="index">
                                                <v-radio
                                                    :key="index"
                                                    :light="lightMode"
                                                    hide-details
                                                    class="shrink mr-2"
                                                    :value="index"
                                                    :name="form.pages.indexOf(item)"
                                                    value disabled>
                                                </v-radio>
                                            </v-radio-group>
                                            <v-text-field  style="padding-top: 0px" single-line v-model="n.label" :light="lightMode" label=""></v-text-field>
                                        </v-layout>
                                        <!-- IMAGE -->
                                        <v-text-field
                                            :light="lightMode"
                                            v-if="item.title == 'Image' && item.showUrl == true"
                                            name="input-1"
                                            label="Enter image url"
                                            v-model="item.src"
                                            >
                                        </v-text-field>
                                        <v-card-media
                                            v-if="item.title == 'Image'"
                                            :src="item.src"
                                            height="200px">
                                        </v-card-media>
                                        <!-- TEXTAREA -->
                                        <v-text-field
                                            :light="lightMode"
                                            v-if="item.title == 'Textarea'"
                                            name="input-1"
                                            v-model="item.value"
                                            textarea>
                                        </v-text-field>
                                        <!-- DATE -->
                                        <v-date-picker
                                            :light="lightMode"
                                            v-if="item.title == 'Date'"
                                            color="deep-purple darken-3"
                                            v-model="date">
                                        </v-date-picker>
                                        <!-- TIME -->
                                        <v-time-picker
                                            v-if="item.title == 'Time'"
                                            color="deep-purple darken-3"
                                            header-color="deep-purple darken-3"
                                            v-model="time">
                                        </v-time-picker>
                                        <!-- SLIDER -->
                                        <v-slider
                                            :light="lightMode"
                                            v-if="item.title === 'Slider'"
                                            v-model="item.value"
                                            thumb-label
                                            step="5">
                                        </v-slider>

                                    </v-card>

                                    <v-btn style="margin: 20px; margin-right: 0px; margin-bottom: 0px" @click="addOption(item)" icon :light="lightMode">
                                        <v-icon color="blue" style="font-size: 2em">add_circle_outline</v-icon>
                                    </v-btn>

                                    <v-btn style="margin: 20px; margin-right: 0px; margin-bottom: 0px" light icon @click="copyQuestion(page, item, index)">
                                        <v-icon>content_copy</v-icon>
                                    </v-btn>

                                    <v-btn style="margin: 20px; margin-right: 0px; margin-bottom: 0px" light icon @click="deleteQuestion(index, page)">
                                        <v-icon color="error">clear</v-icon>
                                    </v-btn>

                                    <v-divider inset :light="lightMode" style="margin: 0px 10px 50px 30px" ></v-divider>

                                    </v-flex>
                                </v-layout>
                            </draggable>
                        </v-container>

                        <div style=" width: 239px" class="mx-auto">
                            <v-btn style="" @click="prevPage()"  flat :light="lightMode">
                                <v-icon>keyboard_arrow_left</v-icon>
                            </v-btn>
                            <span style="font-size: 1.5em; padding: 2%">{{form.currentPage + 1}}</span>
                            <v-btn style=""  @click="nextPage()" flat  :light="lightMode">
                                <v-icon>keyboard_arrow_right</v-icon>
                            </v-btn>
                        </div>
                        <!-- padding = padding form - 10% -->
                   </v-list>
               </v-card>

        </v-flex>
    </v-layout>

</div>
</template>

<script>

import draggable from 'vuedraggable'
import questionmenu from './components/questionmenu'
import optionsmenu from './components/optionsmenu'
import mypage from './components/mypage'
import toolbar from './components/toolbar'
import Question from '../js/classes'
import Page from '../js/page'
import axios from 'axios'


export default {
    name: 'MainView',
    components: {
        draggable,
        questionmenu,
        optionsmenu,
        toolbar,
        mypage,
    },
    data () {
        return {
            deleteDialog: false,
            date: null,
            time: null,
            switch1: true,
            right: true,
            switch2: false,
            colors: { hex: '#ffffff' },
            selected: [],
            textColor: "white--text",
            //computed. return pages.length
            totalQuestions: 0,

            lightMode: true,
            // isMandatory
            // isAnswered?

            form: {
                id: null,
                title: '',
                timerEnabled: true,
                totalTime: 0,
                timeUponSendin: 0,
                currentPage: 0,

                times: [],

                style:
                {
                    tbColor: 'deep-purple darken-3',
                    bgColor: 'red',
                    fgColor: '#000',
                },
                pages: [new Page(0)]
            }
        }
    },
    methods: {
        nextPage: function() {
            if(this.form.currentPage < this.form.pages.length - 1) {
                this.form.currentPage++
            }
        },
        prevPage: function() {
            if(this.form.currentPage > 0) {
                this.form.currentPage--
            }
        },
        addPage: function() {
            this.form.pages.push(new Page(this.form.pages.length + 1))
            // jump to page after creation
            this.form.currentPage = this.form.pages.length - 1
        },
        deleteQuestion: function(index, page) {
            page.questions.splice(index, 1)
        },
        copyQuestion: function(page, question, index) {
            page.questions.splice(index + 1, 0, JSON.parse(JSON.stringify(question)))
        },
        addQuestion: function(type) {
            this.form.pages[this.form.currentPage].questions.push(new Question(type))
        },
        addOption: function(question) {
            question.options.push({label: ''})
        },
        deleteEntireForm: function() {
            //reset the colour
            this.colors.hex = "#fff"
            // replace entire form with a new blank page
            this.form.pages = [new Page(0)]
            // reset display of page to first page
            this.form.currentPage = 0
        },
        changeColour: function(t) {
            this.colors.hex = t;
        },
        sendForm: function() {
            this.$router.push({ name: 'FormView', params: {formObj: this.form} });
            // /search?q=vue
        },
        invertColourTheme: function() {
            this.lightMode = !this.lightmode
        }
    }
}

//progress to completing answer. steps it takes to do form.
//when clicking, get time
//create timed questionares
//explanation page
//statisticvs
//likert scale
//control arraws
//v-model = computed var
//liker sacle, or rating underneath image
//login, send data to server
//required feields, obligatory
//PUSH PAGES TO AN ARRAY AND THEN CYCLE TRHOUGH LIKE ON A ONE PAGE APP YOU MADE
// features:
//<!-- time to complete questions, feature for my own VuEditor -->
// images then rate this image
</script>
