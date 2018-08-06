<template>
    <div>

        <toolbar
            @clickMenu="right = !right"
            @finalize="sendForm"
            :display="true"
            :display_logout="logged_in"
            @logout="logout()">
        </toolbar>
        <questionmenu
            @clicked="addQuestion"
            :show="right">
        </questionmenu>
        <optionsmenu
            @lightChange="invertColourTheme"
            @pageChange="hidePagenr"
            @finalize="sendForm"
            @colorChange="changeColour"
            @delete="deleteEntireForm()"
            @addPage="addPage"
            @orderPage="orderPage"
            @timerSet="enableTime">
        </optionsmenu>


    <v-layout>
        <v-flex xs12 sm6 offset-sm3>

            <v-toolbar color="deep-purple darken-3" style="margin: auto; margin-top: 100px; width: 80%; padding: 10px; padding-top:0px;">
                <v-text-field
                    hide-details
                    class="white--text deep-purple darken-3"
                    name="input-1"
                    placeholder="TITLE"
                    v-model="form.title">
                </v-text-field>
            </v-toolbar>

               <v-card  style="margin: auto; width: 80%; margin-bottom: 40px;" v-for="(page, index) in form.pages" v-if="index === form.currentPage"  :key="index" :light="false">
                   <v-list :light="lightMode" :style="{'background': form.bgcolor.hex}" style="min-height: 650px;" class="pt-0 ">
                        <v-container fluid style="padding: 0px">
                            <draggable v-model="page.questions" style="min-height: 650px" :options="{group:{ name:'questions' }, animation: 150}">
                                <v-layout row :light="lightMode" v-for="(item, index) in page.questions" :key="item.id">
                                    <v-flex>
                                    <v-card :style="{'background': form.bgcolor.hex}" :light="lightMode" class="post" style="box-shadow: none; border-radius: 0px; padding: 20px 20px 20px 20px">
                                        <v-layout style="margin-bottom: 40px" row>
                                            <v-flex xs12>

                                                <!-- Question -->
                                                <v-text-field
                                                    v-model="item.question"
                                                    :light="lightMode"
                                                    class="black--text"
                                                    style="margin-bottom: 20px;"
                                                    name="input-1"
                                                    label="Question"
                                                    clearable>
                                                </v-text-field>

                                            </v-flex>
                                            <v-flex xs1>
                                                <v-tooltip bottom>
                                                    <v-btn slot="activator" style="" light icon @click="deleteQuestion(index, page)">
                                                        <v-icon color="error">clear</v-icon>
                                                    </v-btn>
                                                     <span>Delete question</span>
                                                </v-tooltip>
                                            </v-flex>
                                        </v-layout>


                                        <!-- TEXTFIELD -->
                                        <v-text-field
                                            v-if="item.title == 'Textfield'"
                                            v-model="item.value"
                                            :light="lightMode"
                                            class="black--text"
                                            name="input-1"
                                            label="">
                                        </v-text-field>


                                        <!-- CHECKMARK AND RADIOBUTTON-->
                                        <draggable   v-if="item.title == 'Checkmark' || 'Radiobutton'" v-model="item.options" style="" :options="{animation: 150}">
                                            <v-layout style="margin-bottom: 10px" :key="index" v-for="(n, index) in item.options" align-center>
                                                <v-flex style="">

                                                    <!-- CHECKMARK -->
                                                    <v-checkbox
                                                        v-if="item.title == 'Checkmark'"
                                                        hide-details
                                                        :light="lightMode"
                                                        class="shrink mr-2"
                                                        v-model="selected"
                                                        :key="index"
                                                        :value="n.label + ' ' + index">
                                                    </v-checkbox>

                                                    <!-- RADIOBUTTON -->
                                                    <v-radio-group v-if="item.title == 'Radiobutton'" style="padding-top: 0px" class="shrink mr-2" v-model="index">
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


                                                </v-flex>
                                                <v-flex style="padding: 0px; margin: 0px" xs11>
                                                    <v-text-field
                                                        @keyup.enter="addOption(item)"
                                                        single-line name="input-1-3" v-model="n.label" :light="lightMode" label="">
                                                    </v-text-field>
                                                </v-flex>
                                                <v-flex style="padding: 0px; margin: 0px" xs1>
                                                    <v-tooltip bottom>
                                                        <v-btn slot="activator" style="font-size: 0.6em" light icon @click="deleteOption(item, index)">
                                                            <v-icon style="font-size: 2em" color="error">clear</v-icon>
                                                        </v-btn>
                                                        <span>Delete option</span>
                                                   </v-tooltip>
                                                </v-flex>
                                            </v-layout>
                                        </draggable>


                                        <!-- IMAGE -->
                                        <v-text-field
                                            :light="lightMode"
                                            v-if="item.title == 'Image' && item.showUrl == true"
                                            name="input-1"
                                            label="Enter image url"
                                            v-model="item.src">
                                        </v-text-field>
                                        <v-card-media
                                            v-if="item.title == 'Image'"
                                            :src="item.src"
                                            height="200px">
                                        </v-card-media>
                                        <!-- TEXTAREA -->
                                        <v-textarea
                                            :light="lightMode"
                                            v-if="item.title == 'Textarea'"
                                            name="input-1"
                                            v-model="item.value"
                                            outline>
                                        </v-textarea>
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
                                        <!-- SELECT -->
                                        <v-select
                                            v-if="item.title === 'Select'"
                                            :items="item.options"
                                            v-model="e1"
                                            light
                                            label="Select"
                                            single-line>
                                        </v-select>

                                    </v-card>


                                    <v-layout row>
                                        <v-flex xs11>
                                        <v-tooltip bottom>
                                            <v-btn
                                                slot="activator"
                                                style="margin: 20px; margin-right: 0px; margin-bottom: 0px"
                                                @click="addOption(item)"
                                                icon
                                                :light="lightMode">
                                                <v-icon
                                                    color="blue"
                                                    style="font-size: 2em">
                                                    add_circle_outline
                                                </v-icon>
                                            </v-btn>
                                             <span>Add new option</span>
                                        </v-tooltip>

                                        <v-tooltip bottom>
                                            <v-btn  slot="activator" style="margin: 20px; margin-right: 0px; margin-bottom: 0px" light icon @click="copyQuestion(page, item, index)">
                                                <v-icon>content_copy</v-icon>
                                            </v-btn>
                                             <span>Copy question</span>
                                        </v-tooltip>


                                        <v-tooltip bottom>
                                            <v-btn slot="activator" style="margin: 20px; margin-right: 0px; margin-bottom: 0px" light icon @click="makeObligatory(item)">
                                                <v-icon :style="{'color': item.transparent}" class="fas fa-asterisk" style="font-size: 1em"  ></v-icon>
                                            </v-btn>
                                             <span> {{item.obligatory == true ? 'Remove mandatory': 'Make mandatory'}} </span>
                                        </v-tooltip>
                                        </v-flex>

                                        <v-flex xs1>

                                        </v-flex>
                                    </v-layout>

                                    <v-divider inset :light="lightMode" style="margin: 0px 10px 50px 30px"></v-divider>

                                    </v-flex>
                                </v-layout>
                            </draggable>
                        </v-container>

                        <div style="width: 239px" class="mx-auto">
                            <v-btn style="" @click="prevPage()" flat :light="lightMode">
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

import draggable    from 'vuedraggable'
import questionmenu from './components/questionmenu'
import optionsmenu  from './components/optionsmenu'
// import mypage       from './components/mypage'
import toolbar      from './components/toolbar'
import Question     from '../js/classes'
import Page         from '../js/page'
import axios        from 'axios'


export default {
    name: 'MainView',
    components: {
        draggable,
        questionmenu,
        optionsmenu,
        toolbar,
        // mypage,
    },
    props: ['loggedIn'],
    data () {
        return {
            e1: null,
            deleteDialog: false,
            date: null,
            time: null,
            switch1: true,
            right: true,
            switch2: false,
            // colors: { hex: '#ffffff' },
            selected: [],
            textColor: "white--text",
            //computed. return pages.length
            // totalQuestions: 0,

            logged_in: false,

            lightMode: true,
            // isMandatory
            // isAnswered?

            form: {
                id: null,
                title: '',
                timerEnabled: false,
                totalTime: 0,
                timeUponSendin: 0,
                currentPage: 0,
                bgcolor: { hex: '#ffffff' },
                fgcolor: { hex: '#000' },
                opacity: {},

                times: [],

                style:
                {
                    tbColor: 'deep-purple darken-3',
                    bgColor: 'red',
                    fgColor: '#000',
                },
                pages: [new Page(1)]
            }
        }
    },
    // check url and display content apprpriately
    created() {

        console.log(this.$route.query.loggedIn)
        this.logged_in = this.$route.query.loggedIn // read url.. either set from php or js router
        // this.$route.params.name

        // load from LS
    },
    methods: {
        logout: function() {
            this.logged_in = false
            console.log(this.$router.history.current.query.loggedIn);
            // this.$router.history.current.query = '/'
            // this.$router.history.current.query.loggedIn = false
            this.$router.push({ path: '/' })

            //look at the router object to learn more

        },
        enableTime: function(value) {
             this.form.timerEnabled = value
        },
        deleteOption: function(question, index) {
            question.options.splice(index, 1)
        },
        makeObligatory: function(item) {
            item.obligatory = !item.obligatory
            if(item.obligatory == false) {
                item.transparent = '#616161'
            }
            else {
                item.transparent = '#FF5252'
            }
        },
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
            // question.options[length-1].focus()
            console.log(this.$children[this.$children.length-1]);
        },
        deleteEntireForm: function() {
            //reset the colour
            this.form.bgcolor.hex = "#fff"
            // replace entire form with a new blank page
            this.form.pages = [new Page(1)]
            // reset display of page to first page
            this.form.currentPage = 0
        },
        changeColour: function(t) {
            this.form.bgcolor.hex = t;
        },
        sendForm: function() {
            this.$router.push({ name: 'FormView', params: { id: JSON.stringify(this.form) } });

//when to generate an id? need to query db to create unique right?

            // /search?q=vue
        },
        invertColourTheme: function() {
            this.lightMode = !this.lightMode
        },
        hidePagenr: function() {
            // this.form.pag
        },
        orderPage: function() {
            this.$router.push({ path: '/pages', query: {form: this.form} })
        }
    }
}
</script>

<style scoped>
/* the one you drag around.... nbo... the backgriund infact */
.ghostDrag {
    border: 1px solid blue;
    background: blue;
    opacity: 0;
}
.dragDrag {
    border: 1px solid green;
    background: green;
    opacity: 0;
}
.chosenDrag {
    border: 1px solid red;
    background: red;
    opacity: 1;
}
</style>
