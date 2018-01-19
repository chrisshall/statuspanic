// we want to dispose all the previous conversations added event listeners because
// in this demo site, we don't want to samples interfere with each other.
var registeredListeners = registeredListeners || [];
registeredListeners.forEach(function (listener) {
    listener.dispose();
});
registeredListeners = [];
/**
 * This script demonstrates how to use audio/video along with messaging in an existing conversation
 */
$(function () {
    'use strict';
    if (window['noMeResource']) {
        $('.container .content .noMe').show();
    }
    window['audio-video-manager_load'] = function () {
        var client = window.skypeWebApp;
        var soundHandler;
        var sound = new Audio('sounds/outgoing.mp3');
        $('#av-to').keypress(function (evt) {
            if (evt.keyCode == 13) {
                evt.preventDefault();
                $("#btn-search").click();
            }
        });
        // when the user clicks on the "Get Contact" button
        $('#btn-search').click(function () {
            // start the contact search
            var pSearch = client.personsAndGroupsManager.createPersonSearchQuery();
            if (!$('#av-to').text().trim()) {
                return;
            }
            pSearch.text($('#av-to').text());
            pSearch.limit(1);
            pSearch.getMore().then(function () {
                var sr = pSearch.results();
                // and throw an exception if no contacts found:
                // the exception will be passed to the next "fail"
                // handler: this is how Promises/A+ work.
                if (sr.length == 0)
                    throw new Error('The contact not found');
                // then take any found contact
                // and pass the found contact down the chain
                return sr[0].result;
            }).then(function (contact) {
                var name = contact.displayName();
                $(".c-name").text(name);
                contact.location.changed(function (location) {
                    $(".location").text(location);
                });
                contact.status.changed(function (newStatus, reason, oldStatus) {
                    $(".presence-status").removeClass('presence-' + oldStatus)
                        .addClass('presence-' + newStatus);
                });
                contact.location.subscribe();
                contact.status.subscribe();
                uiStateFoundUser();
            }).then(null, function (error) {
                // if either of the steps above threw an exception,
                // catch it here and display to the user
                $('#status').text(error || 'Something went wrong');
            });
        });
        var addedListener = client.conversationsManager.conversations.added(function (conversation) {
            var chatService, dfdChatAccept, audioService, dfdAudioAccept, videoService, dfdVideoAccept, selfParticipant, name, timerId;
            selfParticipant = conversation.selfParticipant;
            chatService = conversation.chatService;
            audioService = conversation.audioService;
            videoService = conversation.videoService;
            if (chatService.accept.enabled()) {
                name = conversation.participants(0).person.displayName();
                if (confirm('Accept incoming chat request from ' + name + '?')) {
                    console.log('accepting the incoming chat request');
                    dfdChatAccept = chatService.accept();
                }
                else {
                    console.log('declining the incoming chat request');
                    chatService.reject();
                }
            }
            // participant audio and video state changes
            conversation.participants.added(function (p) {
                if (conversation.participants.size() == 1) {
                    $("#av-to").text(p.person.id());
                    $(".c-name").text(p.person.displayName());
                    p.person.location.changed(function (location) {
                        $(".location").text(location);
                    });
                    p.person.location.subscribe();
                }
                p.video.state.changed(function (newState, reason, oldState) {
                    // a convenient place to set the video stream container 
                    if (newState == 'Connected') {
                        if (conversation.participants.size() == 1) {
                            p.video.channels(0).stream.source.sink.container(document.getElementById("render-p-window"));
                        }
                        else {
                            var partcipant = conversation.participants(0);
                            partcipant.video.channels(0).stream.source.sink.container(document.getElementById("render-p-window"));
                            partcipant.video.channels(0).isStarted.set(true);
                            p.video.channels(0).stream.source.sink.container($(".add-video-container")[0]);
                            p.video.channels(0).isStarted.set(true);
                        }
                    }
                });
            });
            function onAudioVideoNotified() {
                // AV invitation may come from a 1:1 conversation only, so the caller is
                // the single participant in the participants collection
                var name = conversation.participants(0).person.displayName();
                if (selfParticipant.video.state() == 'Notified') {
                    if (confirm('Accept a video call from ' + name + '?')) {
                        console.log('accepting a video call');
                        // selfParticipant video stream container can be set before we 
                        // accept the incominng video call or after it is accepted or even 
                        // later, when the selfParticipant video state becomes "Connected"
                        dfdVideoAccept = videoService.accept();
                    }
                    else if (confirm('Accept a video call from ' + name + ' with audio only?\n' +
                        '(You will still see the incoming video)')) {
                        console.log('accepting a video call with audio');
                        dfdAudioAccept = audioService.accept();
                    }
                    else {
                        console.log('declining the incoming video request');
                        videoService.reject();
                    }
                }
                else if (selfParticipant.audio.state() == 'Notified') {
                    if (confirm('Accept an audio call from ' + name + '?')) {
                        console.log('accepting the audio call');
                        dfdAudioAccept = audioService.accept();
                    }
                    else {
                        console.log('declining the incoming audio request');
                        audioService.reject();
                    }
                }
                timerId = null;
            }
            ;
            selfParticipant.audio.state.changed(function (newState, reason, oldState) {
                if (newState == 'Notified' && !timerId) {
                    timerId = setTimeout(onAudioVideoNotified, 0);
                }
                else if (newState == 'Connected') {
                    clearInterval(soundHandler);
                }
                else if (newState == "Disconnected") {
                    clearInterval(soundHandler);
                }
            });
            selfParticipant.video.state.changed(function (newState, reason, oldState) {
                var selfChannel;
                if (newState == 'Notified' && !timerId) {
                    timerId = setTimeout(onAudioVideoNotified, 0);
                }
                else if (newState == 'Connected') {
                    selfChannel = conversation.selfParticipant.video.channels(0);
                    selfChannel.stream.source.sink.container.set(document.getElementById("render-self-window"));
                }
            });
        });
        registeredListeners.push(addedListener);
        function findPerson(uri) {
            var searchQuery = client.personsAndGroupsManager.createPersonSearchQuery();
            searchQuery.text(uri);
            return searchQuery.getMore().then(function (results) {
                return results[0].result;
            });
        }
        function addParticipant(conv, uri) {
            return findPerson(uri).then(function (person) {
                conv.participants.add(conv.createParticipant(person));
            });
        }
        $("#btn-audio").click(function () {
            var uri = $('#av-to').text(), conv, dfd;
            findPerson(uri).then(function (person) {
                conv = client.conversationsManager.getConversation(person);
                dfd = conv.audioService.start();
            });
            sound.play();
            soundHandler = setInterval(function () {
                sound.play();
            }, 2000);
        });
        $("#btn-video").click(function () {
            var uri = $('#av-to').text(), conv;
            findPerson(uri).then(function (person) {
                conv = client.conversationsManager.getConversation(person);
                // video stream containers can be set either before calling start() or after
                // that async call is resolved or when participant video state becomes "Connected".
                conv.videoService.start().then(function () {
                    $("#btn-show-video").hide();
                    $("#btn-hide-video").show();
                });
            });
            if (conv.audioService.state() !== 'Connected') {
                sound.play();
                soundHandler = setInterval(function () {
                    sound.play();
                }, 2000);
            }
        });
        $('#btn-mute, #btn-unmute').click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), audio;
                if (conv) {
                    audio = conv.selfParticipant.audio;
                    if (audio.isMuted()) {
                        $("#btn-unmute").hide();
                        $("#btn-mute").show();
                    }
                    else {
                        $("#btn-unmute").show();
                        $("#btn-mute").hide();
                    }
                    audio.isMuted.set(!audio.isMuted());
                }
            });
        });
        $('#btn-show-video, #btn-hide-video').click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), val, vcSelf, dfd, audio;
                if (conv) {
                    audio = conv.selfParticipant.audio;
                    vcSelf = conv.selfParticipant.video.channels(0);
                    val = vcSelf.isStarted();
                    vcSelf.isStarted.set(!val);
                    if (val) {
                        $("#btn-show-video").show();
                        $("#btn-hide-video").hide();
                    }
                    else {
                        $("#btn-show-video").hide();
                        $("#btn-hide-video").show();
                    }
                }
            });
        });
        $("#hang-up").click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), dfd;
                if (conv) {
                    dfd = conv.audioService.stop();
                }
            });
        });
        var hasIM = false;
        $("#chatinput").on('keypress', function (evt) {
            if (evt.keyCode == 13) {
                evt.preventDefault();
                var messageText = $("#chatinput").text();
                if (!hasIM) {
                    var uri = $('#av-to').text(), conv, dfd;
                    if (client.conversationsManager.conversations.size() == 0) {
                        findPerson(uri).then(function (person) {
                            conv = client.conversationsManager.getConversation(person);
                            dfd = conv.chatService.start().then(function () {
                                conv.chatService.sendMessage(messageText);
                            });
                        });
                    }
                    else {
                        conv = client.conversationsManager.conversations(0);
                        if (conv) {
                            dfd = conv.chatService.start().then(function () {
                                conv.chatService.sendMessage(messageText);
                            });
                        }
                    }
                    conv.historyService.activityItems.added(function (message) {
                        $(".message-list").append(XMessage(message));
                        $(".message-list").animate({ scrollTop: $(".message-list")[0].scrollHeight }, "fast");
                    });
                    hasIM = true;
                }
                else {
                    var conversation = client.conversationsManager.conversations(0);
                    conversation.chatService.sendMessage(messageText);
                }
            }
        });
        // returns a DOM element attached to the Message model
        function XMessage(message) {
            var xTitle = $('<div>').addClass('sender');
            var xStatus = $('<div>').addClass('status');
            var xText = $('<div>').addClass('text').text(message.text());
            var xMessage = $('<div>').addClass('message');
            xMessage.append(xTitle, xStatus, xText);
            if (message.sender) {
                message.sender.displayName.get().then(function (displayName) {
                    xTitle.text(displayName);
                });
            }
            message.status.changed(function (status) {
                //xStatus.text(status);
            });
            return xMessage;
        }
        $("#btn-add-participant").click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), uri = $('#av-add-p').text(), dfd;
                if (conv) {
                    dfd = addParticipant(conv, uri);
                    $('#av-add-p').empty();
                }
            });
        });
        $('#btn-hold').click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), dfd;
                if (conv) {
                    dfd = conv.selfParticipant.audio.isOnHold.set(true);
                }
            });
        });
        $('#btn-resume').click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), dfd;
                if (conv) {
                    dfd = conv.selfParticipant.audio.isOnHold.set(false);
                }
            });
        });
        // end conversation
        $('#btn-end').click(function () {
            findPerson($('#av-to').text()).then(function (person) {
                var conv = client.conversationsManager.getConversation(person), dfd;
                if (conv) {
                    dfd = conv.leave();
                    monitor('Ending conversaton', dfd);
                    dfd.then(function () {
                        client.conversationsManager.conversations.remove(conv);
                    });
                }
            });
        });
        function uiStateFoundUser() {
            $("#search-user").hide();
            $("#found-user").show();
        }
        function uiStateDisconnected() {
            $("#search-user").show();
            $("#found-user").hide();
        }
    };
});
