<template>
    <v-layout>
        <v-flex xs12 sm6 offset-sm3>

          <v-card style="margin: auto; width: 80%; margin-bottom: 40px; margin-top: 60px" v-for="(page, index) in form.pages" v-if="index === form.currentPage"  :key="index" :light="false">
                   <v-toolbar color="deep-purple darken-3" flat class="white--text">
                       <v-toolbar-title>{{form.title}}</v-toolbar-title>
                   </v-toolbar>



                       <v-list :light="lightMode"  style="min-height: 650px;" class="pt-0 ">


                            <v-container fluid style="padding: 0px">
                                    <v-layout row :light="lightMode" v-for="(item, index) in page.questions" :key="item.id">
                                        <v-flex>

                                        <v-card :light="lightMode" class="post" style="box-shadow: none; border-radius: 0px; padding: 20px 20px 20px 20px">


                                            <h2 style="margin-bottom: 20px">{{item.question}}</h2>

                                            <v-text-field
                                                v-if="item.title == 'Textfield'"
                                                v-model="item.value"
                                                :light="lightMode"
                                                class="black--text"
                                                name="input-1"
                                                label="">
                                            </v-text-field>

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
                                                v-model="item.src"
                                                >
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

                                        </v-card>


                                        <!-- <v-divider inset :light="lightMode" style="margin: 0px 10px 50px 30px" ></v-divider> -->
                                        </v-flex>
                                    </v-layout>
                            </v-container>
                            <v-card-actions :style="{'background': form.bgColor}">
                                <v-spacer/>
                                <v-btn class="white--text" color="orange"  @click="send()">Send</v-btn>
                            </v-card-actions>
                   </v-list>

               </v-card>


           </v-flex>
       </v-layout>
</template>

<script>
import { Photoshop, Material, Compact, Swatches, Slider, Sketch, Chrome } from 'vue-color'
import axios from 'axios'

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
        lightMode: true,
        time: null,
        form: {},
        startTime: 0
    }
},
watch: {
    '$route'(to, from) {
        this.form = this.formObj //must have it accessible in url
    }
},
created() {
    // this.form = this.formObj
    this.form = $route.params.formObj
    this.startTime = new Date().getTime()
},
methods: {
    nextPage: function()  {
        var time = new Date().getTime()

        //go to next page
        this.form.currentPage++

        // each click. push current time in - assumes forced sequence, with no going back
        // check currentPage when clicked. to make sure only one per page? and reset if go back
        //arrow only forward in this mode

        //PUSH THIS REPO

        //record time if option enabled
        if(this.form.timerEnabled) {
            this.form.times.push(new Date().getTime())
        }
    },
    send: function() {

        if (this.form.timerEnabled === true) {
            var currentTime = new Date().getTime()
            //format: Sun Mar 25 2018 21:28:26 GMT+0200 (Vest-Europa (sommertid))
            this.form.timeUponSendin = new Date()
            this.form.totalTime = currentTime - this.startTime
        }

        //extract answers and package them to store in db. then can use this to fetch and display on another
        //page



        // time in milliseconds
        console.log(this.form.totalTime);
        // time in seconds without decimals
        console.log(Math.round(this.form.totalTime / 1000))
        // time in seconds
        console.log(Math.round(this.form.totalTime / 1000))
    }

 }
}

//make a custom button which has api call in it when clicked, you just provide the url in a prop. then its reusable
//automatic download with import of other library included in src. but what about updating then?
//try and pusblish and you will understand how these things work

//the dragging element becomes transparent so can see behind it when dragging
//padding on the inside better


</script>
