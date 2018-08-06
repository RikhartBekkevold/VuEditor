<template>
    <v-layout>
        <v-flex xs12 sm6 offset-sm3>

          <v-card :style="{'background': form.bgcolor.hex}"  style="margin: auto; width: 80%; margin-bottom: 40px; margin-top: 60px" v-for="(page, index) in form.pages" v-if="index === form.currentPage"  :key="index" :light="false">


                   <v-toolbar color="deep-purple darken-3" flat class="white--text">
                       <v-toolbar-title>{{form.title}}</v-toolbar-title>
                   </v-toolbar>

                       <!-- {{form.pages}}
                       <br>
                       <br>
                       <br>
                       {{answers}} -->
                       <v-list :style="{'background': form.bgcolor.hex}" :light="lightMode"  style="min-height: 650px;" class="pt-0 ">


                            <v-container fluid style="padding: 0px; margin-bottom: 50px">
                                    <v-layout row :light="lightMode" v-for="(item, index) in page.questions" :key="item.id">
                                        <v-flex>

                                        <v-card :style="{'background': form.bgcolor.hex}" :light="lightMode" class="post" style="box-shadow: none; border-radius: 0px; padding: 20px 20px 20px 20px">


                                            <h2 style="margin-bottom: 20px">{{item.question}}</h2>

                                            <v-text-field
                                                v-if="item.title == 'Textfield'"
                                                v-model="item.value"
                                                :light="lightMode"
                                                class="black--text"
                                                name="input-1"
                                                label="">
                                            </v-text-field>

                                            <v-layout v-if="item.title == 'Checkmark'" :key="index" v-for="(n, index) in item.options" align-center>
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
                                                height="600px">
                                            </v-card-media>

                                            <v-text-field
                                                :light="lightMode"
                                                v-if="item.title == 'Textarea'"
                                                name="input-1"
                                                v-model="item.value"
                                                textarea>
                                            </v-text-field>

                                            <v-date-picker
                                                :light="lightMode"
                                                v-if="item.title == 'Date'"
                                                color="deep-purple darken-3"
                                                v-model="date">
                                            </v-date-picker>

                                            <v-time-picker
                                                v-if="item.title == 'Time'"
                                                color="deep-purple darken-3"
                                                header-color="deep-purple darken-3"
                                                v-model="time">
                                            </v-time-picker>

                                            <v-slider
                                                :light="lightMode"
                                                v-if="item.title === 'Slider'"
                                                v-model="item.value"
                                                thumb-label
                                                step="5">
                                            </v-slider>

                                            <v-select
                                                v-if="item.title === 'Select'"
                                                :items="item.options"
                                                v-model="e1"
                                                :light="lightMode"
                                                label="Select"
                                                single-line>
                                            </v-select>
                                        </v-card>


                                        <!-- <v-divider inset :light="lightMode" style="margin: 0px 10px 50px 30px" ></v-divider> -->
                                        </v-flex>
                                    </v-layout>
                            </v-container>
                            <v-card-actions :style="{'background': form.bgColor}">
                                <!-- <v-spacer/> -->
                                <v-btn class="white--text" style="position: absolute; bottom: 10px; right: 10px; margin-top: 20px" color="orange"  @click="send()">Send</v-btn>
                            </v-card-actions>
                   </v-list>

               </v-card>


           </v-flex>
       </v-layout>
</template>

<script>
import { Photoshop, Material, Compact, Swatches, Slider, Sketch, Chrome } from 'vue-color'
import axios from 'axios'
// import 'whatwg-fetch'

export default {
    name: 'FormView',
    components: {
        'material-picker': Material,
        'compact-picker': Compact,
        'swatches-picker': Swatches,
        'slider-picker': Slider,
        'sketch-picker': Sketch,
        'chrome-picker': Chrome,
        'photoshop-picker': Photoshop
    },
    props: ["formObj"],
  data () {
    return {
        e1: null,
        lightMode: true,
        time: null,
        form: {},
        startTime: 0,
        answers: []
    }
},
created() {
    this.fetchData()
},
watch: {
    '$route': 'fetchData' //not needed
},
methods: {
        fetchData () {
            this.form = JSON.parse(this.$route.params.id)
            console.log(this.form);
            //it cant read second time, because its just an object. first time you actually send param.. its the tyoe you get, not the content
        },
        nextPage: function()  {
            this.form.currentPage++
            if(this.form.timerEnabled) {
                this.form.times.push(new Date().getTime())
            }
        },
        validate: function() {
            //check if all obligatory fields are answered
            var self = this;
            this.form.pages.forEach(function(page) {
                page.questions.forEach(function(question) {
                    if(question.obligatory === true) {
                        return false
                    }
                })
            })
            return true
        },
        checkIfQuestionIsAnswered: function() {

            //watch? if questiion cahnged?
            //on user click?
            //on vmodel changed
            //set obligatory = false
        },
        pushAnswers: function() {
            var self = this;

            // {type: 'check', qTitle: 'What is?', answers: {'Blueberry': 44, 'Strawberry': 23, 'Strawbedrry': 2}},

            this.form.pages.forEach(function(page) {
                page.questions.forEach(function(question, index) {
                    self.answers.push({type: 'check', qTitle: question.title, answers: {}   })

                    question.options.forEach(function(option) {
                        // var label = option.label
                        // self.answers[index].answers.push({label: option.checked})
                    })
                })
            })
        },
        send: function() {
        // if(this.validate()) {
            this.pushAnswers()
            var self = this

            axios('/server/saveForm.php', {
                method: 'post',
                data: JSON.stringify(this.answers)
            }).then(function(response) {
                console.log('response::', response.data)
                //json pars inni her
                self.$router.push({name: 'StatsView', params: { ids: JSON.stringify(self.answers) }})
            })
            .catch(function(error) {
                  console.log('ERROR::', error.data)
            });
        }
    }
}


</script>
