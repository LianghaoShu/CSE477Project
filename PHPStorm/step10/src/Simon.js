import * as $ from 'jquery';

export const Simon = function(sel) {
    const that = this;
    this.state = "initial";
    this.sequence = [Math.floor(Math.random() * 4)];
    this.current = 0;

    this.initialize = function() {
        console.log('Simon started');

        const div = $(sel);
        div.html(
            '<form>' +
            '<p>' +
            '<input type="button" value="Red">' +
            '<input type="button" value="Green">' +
            '<input type="button" value="Blue">' +
            '<input type="button" value="Yellow">' +
            '</p>' +
            '<p>' +
            '<input id="start" type="button" value="Start">' +
            '</p>' +
            '</form>' +
            '<audio id="red" src="audio/red.mp3" preload="auto"></audio>' +
            '<audio id="green" src="audio/green.mp3" preload="auto"></audio>' +
            '<audio id="blue" src="audio/blue.mp3" preload="auto"></audio>' +
            '<audio id="yellow" src="audio/yellow.mp3" preload="auto"></audio>' +
            '<audio id="buzzer" src="audio/buzzer.mp3" preload="auto"></audio>'
        );


        this.form = div.find('form');
        const start = this.form.find('#start');
        start.click(function(event) {
            that.onStart();
        });
    }

    this.onStart = function() {
        console.log('Start button pressed');

        const start = this.form.find('#start');
        start.remove();

        this.configureButton(0, "red");
        this.configureButton(1, "green");
        this.configureButton(2, "blue");
        this.configureButton(3, "yellow");

        this.play();
    }

    this.configureButton = function(ndx, color) {
        var button = $(this.form.find("input").get(ndx));
        var that = this;

        button.click(function(event) {

            document.getElementById(color).currentTime = 0;
            that.buttonPress(ndx,color);
            console.log('state: ' + that.state);
            if(that.state !== 'fail') {
                document.getElementById(color).play();
            }

            else{
                window.setTimeout(function() {
                    that.play();
                }, 1000);
            }


        });

        button.mousedown(function(event) {
            button.css("background-color", color);
        });

        button.mouseup(function(event) {
            button.css("background-color", "lightgrey");
        });
    }

    this.play = function() {
        if(this.state === 'fail'){
            this.sequence = [Math.floor(Math.random() * 4)];
        }
        this.state = "play";    // State is now playing
        this.current = 0;       // Starting with the first one
        this.playCurrent();
    }

    this.playCurrent = function() {
        var that = this;
        if(this.current < this.sequence.length) {
            // We have one to play
            var colors = ['red', 'green', 'blue', 'yellow'];
            document.getElementById(colors[this.sequence[this.current]]).play();
            that.buttonOn(this.sequence[this.current]);
            window.setTimeout(function() {
                that.buttonOn(-1);
            }, 1000);
            this.current++;

            window.setTimeout(function() {
                that.playCurrent();
            }, 1000);
        } else {
            this.state = "enter";
            this.current = 0;
        }
    }

    this.buttonOn = function(button) {
        var colors = ['red', 'green', 'blue', 'yellow'];
        console.log(button);
        if(button !== -1){
            var butto = $(this.form.find("input").get(button));
            butto.css("background-color", colors[button]);
        }
        else{
            $(this.form.find("input").get(0)).css("background-color", "lightgrey");
            $(this.form.find("input").get(1)).css("background-color", "lightgrey");
            $(this.form.find("input").get(2)).css("background-color", "lightgrey");
            $(this.form.find("input").get(3)).css("background-color", "lightgrey");
        }
    }

    this.buttonPress = function(button, color) {
        var that = this
        console.log("Button press: " + button);
        console.log("current" + this.current);
        if(button !== this.sequence[this.current]){
            this.state = 'fail';
            document.getElementById('buzzer').play();
        }

        else{
            this.current++;
            if(this.current>this.sequence.length - 1){
                console.log("all correct");
                this.sequence.push(Math.floor(Math.random() * 4));

                window.setTimeout(function() {
                    that.play();
                }, 1000);
            }
        }

    }




    // Ensure this is the last line of the function!
    this.initialize();
}