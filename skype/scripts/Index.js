$(function () {
    'use strict';
    $(".menu li a").click(function () {
        var module = this.id;
        var isSignedIn = window.skypeWebApp && window.skypeWebApp.signInManager.state() == "SignedIn";
        if (isSignedIn && module == 'anonymous-join')
            return;
        if (!isSignedIn && module !== 'sign-in' && module !== 'anonymous-join')
            return;
        if ($(this).hasClass("disable"))
            return;
        // now load the page
        loadPage(module);
        $(".menu a").removeClass("selectedNav");
        $(this).addClass("selectedNav");
    });
    function loadPage(module) {
        var url = "samples/html/" + module + ".html";
        $.get(url, function (html) {
            $(".wrappingdiv .content").html(html);
            var fn = module + '_load';
            // call the _load function of the particular script
            window[fn]();
            if (module == 'conversation-control')
                $('#cc-conversations').show();
            else
                $('#cc-conversations').hide();
        });
    }
    Skype.initialize({ apiKey: config.apiKey }, function (api) {
        window.skypeWebAppCtor = api.application;
        window.skypeWebApp = new api.application();
        //Make sign in table appear
        $(".menu #sign-in").click();
        // whenever client.state changes, display its value
        window.skypeWebApp.signInManager.state.changed(function (state) {
            $('#client_state').text(state);
        });
    }, function (err) {
        console.log(err);
        alert('Cannot load the SDK.');
    });
});
function monitor(title, promise) {
    console.log(title);
    promise.then(function (res) { return console.log(title + '...done'); }, function (err) { return console.log(title + '...failed', err && err.stack || err); });
}
