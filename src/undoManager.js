export default function StateHandler(t) {
    this.type = t : t ? 'local';
    this.stack = [];
    this.currentState = 0;  //index

    this.add = function(state) {
        this.forwardStack.push(state);
    };
    this.remove = function(index) {
        this.stack.splice(index, 1);
    };
    this.goBack = function() {
        this.currentState--;
    };
    this.goForward = function() {
        this.currentState++;
    };
    this.save = function() {
        var data = {
            stack: this.stack;
            index: this.currentState;
        }

        switch (this.type) {
            case 'db':
                JSON.stringify(data);
                //ajax call
                break;
            case 'session':
                sessionStorage.save = data;
                break;
            default:
                localStorage.save = data;// localStorage
        }
    };
    this.clear = function() {
        this.backStack = [];
        this.forwardStack = [];
        this.currentState = 0;
    };
}


var state = new StateHandler();

state.save();


// features:
//map
//likert scale
//make dragging element transparent. så ser bak.. and give box shadow to make elevated

//bugs:
//arrow to next page moves down on double digit nr of pages





//<!-- mounted() {
    // var ctx = document.getElementById("myChart0").getContext('2d');
    //
    // this.myChart = new Chart(ctx, {
    //     type: this.type,
    //     data: {
    //         labels: labels,
    //         datasets: [{
    //             label: '# of Votes',
    //             data: values,
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.9)',
    //                 'rgba(54, 162, 235, 0.9)',
    //                 'rgba(255, 206, 86, 0.9)',
    //                 'rgba(75, 192, 192, 0.9)',
    //                 'rgba(153, 102, 255, 0.9)',
    //                 'rgba(255, 159, 64, 0.9)'
    //             ],
    //             // borderColor: [
    //             //     'rgba(255,99,132,1)',
    //             //     'rgba(54, 162, 235, 1)',
    //             //     'rgba(255, 206, 86, 1)',
    //             //     'rgba(75, 192, 192, 1)',
    //             //     'rgba(153, 102, 255, 1)',
    //             //     'rgba(255, 159, 64, 1)'
    //             // ],
    //             borderWidth: 0
    //         }]
    //     },
    //     options: {
    //         title: {
    //             display: false,
    //             text: 'Custom Chart Title',
    //             fontColor: 'white',
    //         },
    //         legend: {
    //             position: 'right',
    //             display: true,
    //             labels: {
    //                fontColor: '#fff'
    //             }
    //         },
    //         // scales: {
    //         //     yAxes: [{
    //         //         ticks: {
    //         //             beginAtZero:true,
    //         //             fontColor: "#fff"
    //         //         },
    //         //         gridLines: {
    //         //             drawOnChartArea: false,
    //         //             // zeroLineColor: '#fff'
    //         //              display : false
    //         //         }
    //         //     }],
    //         //     xAxes: [{
    //         //         ticks: {
    //         //             beginAtZero: true,
    //         //
    //         //             fontColor: "#fff"
    //         //         },
    //         //         gridLines: {
    //         //              display : false,
    //         //             drawOnChartArea: false,
    //         //             zeroLineColor: '#fff'
    //         //         }
    //         //     }]
    //         // }
    //     }
    // });



//}, -->


var counts = {};
answers.questions.forEach(function(question) {
    question.answers.forEach(function(x) {
        counts[x] = (counts[x] || 0) + 1;
    });
});


var values = [];
for (var key in counts) {
    if (counts.hasOwnProperty(key)) values.push(key);
}

var labels = [];


var self = this;
answers.questions.forEach(function(question) {
    question.labels.forEach(function(label) {
        labels.push(label)
    });
});
