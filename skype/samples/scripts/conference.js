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
    window['conference_load'] = function () {
        if (window['noMeResource']) {
            $('.container .content .noMe').show();
        }
        var client = window.skypeWebApp;
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
                    monitor('Accepting chat request from ' + name, dfdChatAccept);
                }
                else {
                    console.log('declining the incoming chat request');
                    chatService.reject();
                }
            }
            // participant audio and video state changes
            conversation.participants.added(function (p) {
                p.video.state.changed(function (newState, reason, oldState) {
                    // a convenient place to set the video stream container 
                    if (newState == 'Connected')
                        p.video.channels(0).stream.source.sink.container(document.getElementById("renderWindow"));
                });
                p.audio.state.changed(function (newState, reason, oldState) {
                    //onChanged('_participant.audio.state', newState, reason, oldState);
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
                        monitor('Accepting video request from ' + name, dfdVideoAccept);
                    }
                    else if (confirm('Accept a video call from ' + name + ' with audio only?\n' +
                        '(You will still see the incoming video)')) {
                        console.log('accepting a video call with audio');
                        dfdAudioAccept = audioService.accept();
                        monitor('Accepting audio request from ' + name, dfdAudioAccept);
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
                        monitor('Accepting audio call from ' + name, dfdAudioAccept);
                    }
                    else {
                        console.log('declining the incoming audio request');
                        audioService.reject();
                    }
                }
                timerId = null;
            }
            selfParticipant.audio.state.changed(function (newState, reason, oldState) {
                if (newState == 'Notified' && !timerId)
                    timerId = setTimeout(onAudioVideoNotified, 0);
            });
            selfParticipant.video.state.changed(function (newState, reason, oldState) {
                var selfChannel;
                if (newState == 'Notified' && !timerId) {
                    timerId = setTimeout(onAudioVideoNotified, 0);
                }
                else if (newState == 'Connected') {
                    selfChannel = conversation.selfParticipant.video.channels(0);
                    selfChannel.stream.source.sink.container.set(document.getElementById("previewWindow"));
                }
            });
            conversation.state.changed(function onDisconnect(state) {
                if (state == 'Disconnected') {
                    conversation.state.changed.off(onDisconnect);
                    client.conversationsManager.conversations.remove(conversation);
                }
            });
        });
        registeredListeners.push(addedListener);
        function addParticipant(conv, uri) {
            var person, participant, searchQuery;
            searchQuery = client.personsAndGroupsManager.createPersonSearchQuery();
            searchQuery.text(uri);
            return searchQuery.getMore().then(function (results) {
                person = results[0].result;
                participant = conv.createParticipant(person);
                conv.participants.add(participant);
                conv.chatService.sendMessage('Hi, meeting now!');
            });
        }
        $(".contactAdd").click(function () {
            $(".add-p-container").toggleClass("hide");
        });
        $("#btn-add-participant").click(function () {
            var conv = client.conversationsManager.conversations(0), uri = $('#txt-contact').val(), dfd;
            if (conv) {
                dfd = addParticipant(conv, uri);
            }
            $(".av-controls").show();
            $(".add-p-container").hide();
        });
        // join an online meeting and start chat
        $('#startChatMeeting').click(function () {
            var uri = $('#meetingUri').text(), conv, dfd;
            conv = client.conversationsManager.getConversationByUri(uri);
            dfd = conv.chatService.start().then(function () {
                conv.chatService.sendMessage('Hi');
            });
        });
        // join an online meeting and start audio
        $('#startAudioMeeting').click(function () {
            var uri = $('#meetingUri').text(), conv, dfd;
            conv = client.conversationsManager.getConversationByUri(uri);
            dfd = conv.audioService.start();
        });
        // join an online meeting and start video
        $('#startVideoMeeting').click(function () {
            var uri = $('#meetingUri').text(), conv, dfd;
            conv = client.conversationsManager.getConversationByUri(uri);
            dfd = conv.videoService.start();
        });
        // start an online meeting and start chat
        $('#startNewChatMeeting').click(function () {
            var conv, dfd, meetingUri;
            conv = client.conversationsManager.createConversation();
            $('#newMeetingUri').val("");
            dfd = conv.chatService.start().then(function () {
                meetingUri = conv.uri();
                $('#newMeetingUri').val(meetingUri);
                $(".c-add-p-container").removeClass('hide');
            });
        });
        // start an online meeting and start audio
        $('#startNewAudioMeeting').click(function () {
            var conv, dfd, meetingUri;
            conv = client.conversationsManager.createConversation();
            $('#newMeetingUri').val("");
            dfd = conv.audioService.start().then(function () {
                meetingUri = conv.uri();
                $('#newMeetingUri').val(meetingUri);
                $(".c-add-p-container").removeClass('hide');
            });
        });
        // start an online meeting and start video
        $('#startNewVideoMeeting').click(function () {
            var conv, dfd, meetingUri;
            conv = client.conversationsManager.createConversation();
            $('#newMeetingUri').val("");
            dfd = conv.videoService.start().then(function () {
                meetingUri = conv.uri();
                $('#newMeetingUri').val(meetingUri);
                $(".c-add-p-container").removeClass('hide');
            });
        });
        // start video
        $('#showRemoteVideoInMeeting').click(function () {
            var conv, channel, dfd;
            if (client.conversationsManager.conversations.size() == 1) {
                conv = client.conversationsManager.conversations(0);
                channel = conv.participants(0).video.channels(0);
                channel.stream.source.sink.container(document.getElementById('renderWindow'));
                dfd = channel.isStarted.set(true);
            }
        });
        // start video
        $('#removeRemoteVideoInMeeting').click(function () {
            var conv, channel, dfd;
            if (client.conversationsManager.conversations.size() == 1) {
                conv = client.conversationsManager.conversations(0);
                channel = conv.participants(0).video.channels(0);
                dfd = channel.isStarted.set(false);
            }
        });
    };
});
