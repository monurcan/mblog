/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};

var score = 0;
$(function(){
    var timer = 1000;
    $("#tap").click(function(){
        $(this).fadeOut(200);
        $("#game .life div").stop().animate({width: "-=" + ($("body").css("width").replace("px", "") / 8.5) + "px"}, timer);
        setInterval(function(){
            if(parseInt($("#game .life div").css("width").replace("px", "")) <= $("body").css("width").replace("px", "") / 8.5){
                gameover();
            }else {
                $("#game .life div").stop().animate({width: "-=" + ($("body").css("width").replace("px", "") / 8.5) + "px"}, timer);
            }
        }, timer);
    });

    var colors = ["1abc9c", "2ecc71", "3498db", "9b59b6", "34495e", "f1c40f", "e67e22", "e74c3c", "95a5a6"];
    var random;
    $("#game").click(function(event){
        if($(event.target).is(".light")){
            score++;
            timer -= 3000;
            random = Math.floor(Math.random() * 9);
            if($("body").css("width").replace("px", "") - 28 > parseInt($("#game .life div").css("width").replace("px", "")) + $("body").css("width").replace("px", "") / 8.5){
                $("#game .life div").stop().animate({width: "+=" + $("body").css("width").replace("px", "") / 14.5}, $("body").css("width").replace("px", "") / 8.5);
            }
            $("#game .score").text(score);
            $("#game").css("background-color", "#" + colors[random]);
            if(Math.floor(Math.random() * 2) == 1){
                $("#game .light").css("left", "0");
            }else {
                $("#game .light").css("left", "50%");
            }
        }else {
            gameover();
        }
    });

    $("#gameover").click(function(){
        location.reload();
    })
});

function gameover(){
    $("#game").fadeOut(150);
    $("#gameover table tr td:nth-child(2)").text(score);
}