
/* 
   Generic Functions
*/
function log(texttolog) {
    var d = new Date();
    var time = padLeft(d.getHours(), 2) + ":" + padLeft(d.getMinutes(), 2) + ":" + padLeft(d.getSeconds(), 2) + ":" + padLeft(d.getMilliseconds(), 3);
    $('#logging_box').prepend(time + ": " + texttolog + "<br>");
}
function padLeft(nr, n, str) {
    return Array(n - String(nr).length + 1).join(str || '0') + nr;
}

/* 
   How to send an Instant Message using the Skype Web SDK 
*/
$(function () {
    'use strict';

    console.log("App Loaded");
    $('#chatfunctions').hide();

    var Application
    var client;
    var conversation;

    Skype.initialize({
        apiKey: 'SWX-BUILD-SDK',
    }, function (api) {
        Application = api.application;
        client = new Application();
    }, function (err) {
        console.log('some error occurred: ' + err);
    });

    console.log("Client Created");

    // when the user clicks the "Sign In" button
    $('#signin').click(function () {
        $('#signin').hide();
        console.log('Signing in...');
        // and invoke its asynchronous "signIn" method
        client.signInManager.signIn({
            username: $('#address').text(),
            password: $('#password').text()
        }).then(function () {
            console.log('Logged In Succesfully');
            $('#loginbox').hide();
            $('#chatfunctions').show();

            //create a new conversation
            console.log("Creating a new Conversation");
            conversation = client.conversationsManager.createConversation();


        }).then(null, function (error) {
            // if either of the operations above fails, tell the user about the problem
            console.log(error || 'Oops, Something went wrong.');
            $('#signin').show()
        });
    });

    $('#add_participant').click(function () {
        var the_participant = $('#the_participant').text();
        console.log("Adding the participant " + the_participant);
        conversation.addParticipant("sip:" + the_participant).then(function () {
            console.log(the_participant + " added!");
        }).then(null, function (error) {
            console.log("Error:" + error);
        });
    });
         
    $('#send_message').click(function () {
        var the_message = $('#the_message').text();
        if (the_message != "") {
            console.log('Sending message: ' + the_message);
            conversation.chatService.sendMessage(the_message).then(function () {
                console.log('Message sent.');
            }).then(null, function (error) {
                console.log('Error:' + error);
            });
        } else {
           console.log('<b><font color=red>Please enter a message to send!</font></b>');
        }
    });

    $('#startChat').click(function () {
        console.log('Starting chatService...');
        conversation.chatService.start().then(function () {
            console.log('chatService started!');
            $('#startChat').hide();
        }).then(null, function (error) {
            console.log('Error:' + error);
        });
    });

    $('#stopChat').click(function () {
        console.log('Stopping chatService...');
        conversation.chatService.stop().then(function () {
            console.log('chatService stopped.');
            $('#startChat').show();
        }).then(null, function (error) {
            console.log('Error:' + error);
        });
    });

    // when the user clicks on the "Sign Out" button
    $('#signout').click(function () {
        // start signing out
        console.log("Signing Out");
        client.signInManager.signOut().then(
                //onSuccess callback
                function () {
                    // and report the success
                    console.log('Signed out');
                    $('#loginbox').show();
                    $('#signin').show();
                    $('#chatfunctions').hide();
                },
            //onFailure callback
            function (error) {
                // or a failure
                console.log(error || 'Cannot Sign Out');
            });
    });

});