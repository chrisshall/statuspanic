//sign in sample:
//if user has signed in give prompt, otherwise go to index page
$(function () {
    'use strict';
    window['sign-in_load'] = function () {
        if (window.skypeWebApp && window.skypeWebApp.signInManager.state() == "SignedIn") {
            $('.wrappingdiv .signed-in').show();
            $('.wrappingdiv .start-sign-in').hide();
            return;
        }
        function signin(options) {
            window.skypeWebApp.signInManager.signIn(options).then(function () {
                // when the sign in operation succeeds display the user name
                $(".modal").hide();
                console.log('Signed in as ' + window.skypeWebApp.personsAndGroupsManager.mePerson.displayName());
                if (!window.skypeWebApp.personsAndGroupsManager.mePerson.id()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.avatarUrl()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.email()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.displayName()
                    && !window.skypeWebApp.personsAndGroupsManager.mePerson.title()) {
                    window['noMeResource'] = true;
                }
                $("#anonymous-join").addClass("disable");
                $(".menu #sign-in").click();
                //listenForConversations();
            }, function (error) {
                // if something goes wrong in either of the steps above,
                // display the error message
                $(".modal").hide();
                alert("Can't sign in, please check the user name and password.");
                console.log(error || 'Cannot sign in');
            });
        }
        function testForConfigAndSignIn(options) {
            if (document.getElementById('chk-useConvoControl').checked) {
                Skype.initialize({
                    apiKey: config.apiKeyCC
                }, function (api) {
                    window.skypeWebApp = api.UIApplicationInstance;
                    window.skypeApi = api;
                    window.skypeWebAppCtor = api.application;
                    signin(options);
                }, function (err) {
                    console.log(err);
                });
            }
            else {
                signin(options);
            }
        }
        // when the user clicks on the "Sign In" button
        $('#btn-sign-in').click(function (evt) {
            // start signing in
            $(".modal").show();
            var options = {
                version: config.version,
                username: $('#txt-username').val(),
                password: $('#txt-password').val()
            };
            testForConfigAndSignIn(options);
        });
        $('#txt-username, #txt-password, #chk-useConvoControl').keypress(function (evt) {
            if (evt.keyCode == 13) {
                $("#btn-sign-in").click();
            }
        });
        $('#btn-token-sign-in').click(function () {
            $(".modal").show();
            var domain = $("#txt-domain").val();
            var access_token = $("#txt-token").val();
            var Bearercwt = 'Bearer cwt=';
            var Bearer = 'Bearer ';
            var cwt = 'cwt';
            if (access_token.indexOf(cwt) == -1) {
                access_token = Bearercwt + access_token;
            }
            if (access_token.indexOf(Bearer) == -1) {
                access_token = Bearer + access_token;
            }
            var options = {
                auth: function (req, send) {
                    req.headers['Authorization'] = access_token.trim();
                    return send(req);
                },
                domain: domain
            };
            testForConfigAndSignIn(options);
        });
        $('.topology-login').click(function () {
            $(".login-options").hide();
            $(".token-sign-in").hide();
            $('.useConvoControl').show();
            $(".sign-in").show();
        });
        $('.token-login').click(function () {
            $(".login-options").hide();
            $(".token-sign-in").show();
            $('.useConvoControl').show();
            $(".sign-in").hide();
        });
    };
});
