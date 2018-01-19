//conversation control sample:
$(function () {
    'use strict';
    var convMap = {}; // Associates conversations with IDs to allow user to close specified conversation
    var conversationsDiv = document.getElementById('cc-conversations');
    window['conversation-control_load'] = function () {
        if (!window.skypeApi) {
            $('.wrappingdiv .cc-conversationControlsHost').hide();
            return;
        }
        $('.wrappingdiv .noconvocontrol').hide();
        if (conversationsDiv.children.length > 0)
            $('.wrappingdiv .stopConvo').show();
        function getNextConvID() {
            return Object.keys(convMap).length.toString();
        }
        function displayConversation(convId, uris) {
            var container = document.getElementById(convId), label;
            if (!container) {
                label = document.createElement('label');
                label.id = 'id_' + convId;
                label.textContent = 'Conversation ID: ' + convId;
                label.style.marginTop = '20px';
                label.style.display = 'block';
                conversationsDiv.appendChild(label);
                container = document.createElement('div');
                container.id = convId;
                conversationsDiv.appendChild(container);
            }
            var promise = window.skypeApi.renderConversation(container, {
                modalities: ['Chat'],
                participants: uris
            }).then(function (conversation) {
                convMap[convId] = conversation;
                $('.wrappingdiv .stopConvo').show();
            }).catch(function (e) {
                console.log('Render conversation failed');
                conversationsDiv.removeChild(container);
                conversationsDiv.removeChild(label);
            });
            monitor('start conversation', promise);
        }
        $('#cc-btn-startConversation').click(function () {
            var input = $('#cc-txt-sipuris').val();
            if (!input)
                return;
            var uris = input.split(',').map(function (s) { return s.trim(); });
            console.log('participants:', uris);
            var convId = getNextConvID();
            displayConversation(convId, uris);
        });
        window.skypeWebApp.conversationsManager.conversations.added(function (conversation) {
            conversation.selfParticipant.chat.state.when('Notified', function () {
                if (window.skypeApi) {
                    var convId = getNextConvID();
                    var remoteId = conversation.participants(0).person.id();
                    displayConversation(convId, [remoteId]);
                }
            });
        });
        $('#cc-txt-sipuris').keypress(function(e) {
            if (e.keyCode == 13)
                $('#cc-btn-startConversation').click();
        });
        $('#cc-btn-stopConversation').click(function () {
            var convId = $('#cc-txt-convid').val().trim();
            console.log('ID of conv to stop:', convId);
            var child = document.getElementById(convId), childLabel = document.getElementById('id_' + convId), cToEnd = convMap[convId];
            if (!cToEnd)
                console.log('Cannot find conversation with ID in map', convId);
            else {
                var promise = void 0;
                // Doing a try catch here still creates an alert if 'stop' is disabled
                // This allows stopIM to appear to succeed even if chatService state isn't 'Connected'
                if (cToEnd.chatService.stop.enabled()) {
                    promise = cToEnd.chatService.stop();
                    monitor('stop conversation', promise);
                }
                else
                    console.log('stop conversation succeeded; chat service not connected');
            }
            child && conversationsDiv.removeChild(child);
            childLabel && conversationsDiv.removeChild(childLabel);
            if (conversationsDiv.children.length == 0)
                $('.wrappingdiv .stopConvo').hide();
        });
        $('#cc-txt-convid').keypress(function(e) {
            if (e.keyCode == 13)
                $('#cc-btn-stopConversation').click();
        });
        window.skypeWebApp.conversationsManager.conversations.removed(function (conversation, key, index) {
            console.log('Conversation removed', conversation, key, index);
        });
    };
});
