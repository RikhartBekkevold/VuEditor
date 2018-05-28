<template>
    <div>
        <toolbar
            :display="false">
        </toolbar>
        <v-content>
          <v-container fluid>

            <v-layout style=" " align-center justify-center>
              <v-flex style=" " xs12 sm8 md5>



                  <div style="text-align: center;  width: 770px; margin: auto" id="wrapper">
                  <draggable v-model="workingForm.pages" style="min-height: 650px" :options="{group:{ name:'questions' }, animation: 200}">

                      <v-card v-for="(page, index) in workingForm.pages" style=" display: inline-block; margin: auto; width: 30%; margin:  0 10px 40px 0;" :key="index" light>
                          <v-list light style=" min-height: 250px;" class="pt-0">
                               <v-container fill-height fluid style="padding: 0px">

                                   <v-layout style="text-align: center; " align-center justify-center>
                                       <v-flex style="" md12 justify-center>
                                           <!-- dynamically create a row for each page that is in array, untill a set nr?  -->
                                           <span style="font-size: 2em; ">Page {{page.nr}}</span>
                                           <v-divider light></v-divider>
                                           <div style="margin-top: 10px; font-size: 1.1em;"v-for="question in page.questions">
                                               Question: {{question.question}}
                                               <div style="font-size: 0.8em">
                                                   Type: {{question.title}}
                                               </div>
                                            </div>



                                       </v-flex>
                                   </v-layout>

                               </v-container>


                          </v-list>
                      </v-card>
                  </draggable>
              </div>



              </v-flex>
            </v-layout>
          </v-container>
        </v-content>

    </div>
</template>

<script>
import toolbar from './components/toolbar'
import draggable from 'vuedraggable'


//percent width cahnge  3 == 33% - 1

//send as prop form, emit it after changed it, emit('change', form)
//mothercompo(f)
// this.form = f

export default {
    name: 'PageView',
    props: ['form'],
    components: {
        toolbar,
        draggable
    },
    data: () => ({
        workingForm: null
    }),
    created() {
        this.workingForm = this.$route.query.form;
    }

}


</script>
























<!--
However, I learned that I could trust others, standalone
this helped me be less critical. I had confidence in their abilites, and leanred I could but more on
other shoulders in the team, making the team better - making me less of a cat

Personal learning/development:
Although
I learned some, and developed during this course, but I feel this is owned to the good group dynamic and the encouragment of
of the group, not so much the course itself.

Before the project start I knew some things about myself. Some of my flaws. For example that I am a
very critical person at time. I see the problems with ideas, but not ideas. However, I learned
a few things about myself.


come off as strong, which can be offputting
that excericei benefited me

helped always, made
individual need and greed

revieced help and helped


Since the group was accepting of and listend, this open up honesty...

This group work was characterized with a lack of conflicts.


In team work I am the critical person, the ones that always find holes in ideas.

not course, but group dynamic that did this
lack of conflicts made it,, but open an accpting, understanding

in contrast to earlier
the groups competence, made me reflect more on myself, and not overestimate my own skill and value in the group

Future:
I would like to
This group did not have many conflicts, but future groups might have. I then need to know
how to deal with this.
 that they dont say it to be mean, to see their perspective
work together, look at myself first


the others competence and understanding helped me to not blame others.


competent. so could trust them. let go.
ecnocurage them, and ppl believing in me. trust. respect.
sab help and help me


beeing aware of myself




help eachother
development

my flaws. The groups positive attitude, and
 made it
During this course I tried to work on some

Why I do things

examples

to critical
dont push myself
how did i work in the team


And the different perspectives provided food for thought, new ways of seeing potential solutions.

This require good communication and honesty, and a will to improve, not blame.

Learned some things from excercises
see their perpective

honesty, so communicate, so others can imporove and we can change. understnad not blame.

How imp i am for the team, the individual
The importance of individuals, myself inc, in a group


helped explain my behaviour that i had observed in myself
knew, but never the terms and persp
I learned
Need for affiliation and achievment.

mostly knew it
divide tasks
difference in opinions

However, I feel I didn’t learn too much I didn’t already know because we avoided .

avoided conflict by respecting their authority.

disagreement. lack of understanding.
ellinor knows she doesnt know. this avoid conflicts.
someone ppl think they know programming when they clearly dont.



However, the competence of the other groups members were undeniable to me. -->
