<template>
    <v-navigation-drawer right fixed :clipped="true" v-model="right" app>

        <v-toolbar flat>
            <v-list>
                <v-list-tile>
                    <v-list-tile-title class="title">
                    Options
                    </v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-toolbar>
        <v-divider></v-divider>


        <v-container fluid>
            <v-subheader class="subheading">FORM PROPERTIES</v-subheader>

            <v-layout style="margin-bottom: 20px" row>
                <v-icon>{{checkbox == true ? 'timer' : 'timer_off'}}</v-icon>
                <v-switch
                    @click="test"
                    style="width: 200px; margin-left: 10px; "
                    hide-details
                    :label="checkbox == true ? 'Timer enabled' : 'Timer disabled'"
                    v-model="checkbox">
                </v-switch>
            </v-layout>

            <v-layout style="margin-bottom: 20px"  row>
                <v-icon  :light="switch1">lightbulb_outline</v-icon>
                <v-switch style="width: 200px; margin-left: 10px" :label="'UI Theme'" hide-details v-model="switch1"></v-switch>
            </v-layout>

            <v-layout style="margin-bottom: 20px"  row>
                <v-icon>insert_drive_file</v-icon>
                <v-switch style="width: 200px; margin-left: 10px" label="Page Number" hide-details v-model="switch2"></v-switch>
            </v-layout>

        </v-container>



        <v-container fluid>
            <v-divider></v-divider>
            <v-subheader class="subheading">STYLING</v-subheader>
            <v-menu offset-x :close-on-content-click="false" v-model="menu" bottom left>
                <v-btn dark flat slot="activator"><v-icon medium>format_color_fill</v-icon></v-btn>
                <v-card light>
                    <sketch-picker v-model="colors" @input="$emit('colorChange', colors.hex)"/>
                </v-card>
            </v-menu>
            <v-btn color="" flat @click="deleteDialog = true"><v-icon large>delete_forever</v-icon></v-btn>
        </v-container>


        <v-container fluid>
            <v-divider></v-divider>
            <v-subheader class="subheading">PAGES</v-subheader>
            <v-spacer></v-spacer>

            <v-btn :class="textColor" color="orange" flat @click="$emit('addPage')">
                <v-icon style="padding-right: 5px">add</v-icon>
                New Page
            </v-btn>
            <v-btn :class="textColor" color="orange" flat @click="$emit('orderPage')">
                <v-icon style="padding-right: 15px" class="fas fa-sort"></v-icon>
                Re-arrange pages
            </v-btn>
            <v-divider style="margin-top: 20px"></v-divider>
        </v-container>






            <!-- DELETE DIALOG -->
            <v-dialog v-model="deleteDialog" max-width="500px">
                <v-card>
                    <!-- TEXT -->
                    <v-card-title>
                        <v-card-title primary-title>
                            <div>
                            <h3 class="headline mb-0">Delete</h3>
                            <div><br>This will delete the entire form permanently</div>
                            </div>
                         </v-card-title>
                     </v-card-title>

                     <!-- BUTTONS -->
                     <v-card-actions>
                         <v-spacer/>
                         <v-btn color="error" flat @click.stop="deleteForm()">Confirm</v-btn>
                         <v-btn color="default" flat @click.stop="deleteDialog = false">Close</v-btn>
                     </v-card-actions>
               </v-card>
             </v-dialog>

      </v-navigation-drawer>
</template>

<script>

import { Photoshop, Material, Compact, Swatches, Slider, Sketch, Chrome } from 'vue-color'

export default {
    props: ['value'],
    components: {
        'material-picker': Material,
        'compact-picker': Compact,
        'swatches-picker': Swatches,
        'slider-picker': Slider,
        'sketch-picker': Sketch,
        'chrome-picker': Chrome,
        'photoshop-picker': Photoshop
    },
    data() {
        return {
            icon: '',
            icon2: '',
            deleteDialog: false,
            menu: false,
            right: null,
            textColor: "white--text",
            switch1: false,
            switch2: false,
            checkbox: false,
            colors: '#ffffff',
        }
    },
    watch: {
        switch1: function() {
            this.$emit('lightChange')
        },
        switch2: function() {
            this.$emit('pageChange')
            console.log('dsad');
        },
        // checkbox: function() {
        //
        //     this.$emit('timerSet', this.checkbox)
        //     console.log(this.checkbox)
        // }
    },


    computed: {
        // checked: function() {
        //     return
        // }
    },
    methods: {
        test: function() {
            this.checkbox = !this.checkbox
            this.$emit('timerSet', this.checkbox)
            console.log(this.checkbox)
        },
        finalize: function() {
            this.$emit('finalize')
        },
        deleteForm: function() {
            this.deleteDialog = false
            // this.colors.hex = "#ffffff"
            this.$emit('delete')
        }
    }
}

</script>
