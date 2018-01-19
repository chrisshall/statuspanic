// we want to dispose all the previous conversations added event listeners because
// in this demo site, we don't want to samples interfere with each other.
var registeredListeners = registeredListeners || [];
registeredListeners.forEach(function (listener) {
    listener.dispose();
});
registeredListeners = [];
$(function () {
    'use strict';
    window['sign-out_load'] = function () {
        var client = window.skypeWebApp;
        $('.wrappingdiv .signed-out').hide();
        // when the user clicks on the "Sign Out" button
        $('#btn-sign-out').click(function () {
            // start signing out
            client.signInManager.signOut()
                .then(function () {
                // and report the success
                console.log('Signed out');
                $('.wrappingdiv .signed-out').show();
                $('.wrappingdiv .sign-out').hide();
            }, function (error) {
                // or a failure
                console.log(error || 'Cannot sign out');
            });
        });
    };
});
