// we want to dispose all the previous conversations added event listeners because
// in this demo site, we don't want to samples interfere with each other.
var registeredListeners = registeredListeners || [];
registeredListeners.forEach(function (listener) {
    listener.dispose();
});
registeredListeners = [];
/**
 * This sample demonstrates how to search for contacts
 * and distributions groups and display the search results.
 */
$(function () {
    'use strict';
    window['search_load'] = function () {
        var client = window.skypeWebApp;
        var pSearch;
        $("#btn-search").click(function () {
            pSearch = client.personsAndGroupsManager.createPersonSearchQuery();
            pSearch.text($('#txt-query').val());
            pSearch.limit(50);
            pSearch.getMore().then(function (results) {
                //$('#status').text('Processing search results...');
                $('#results').empty();
                // display all found contacts
                results.forEach(function (r) {
                    var avatar, detail, detailNote, tag;
                    avatar = $("<div>").addClass("photo-c")
                        .append($("<img>").addClass("photo").attr("src", r.result.avatarUrl()));
                    detail = $("<div>").addClass("detail")
                        .append($("<div>").addClass("display-name").text(r.result.displayName()));
                    tag = $("<div>")
                        .addClass("persona").addClass("persona-small")
                        .append(avatar)
                        .append(detail);
                    $('#results').append(tag);
                });
                // and tell the user whether more results are available on the server
                // $('#status').text(pSearch.moreResultsAvailable() ?
                //     'More results are available on the server' :
                //     'No more results are available on the server');
            });
        });
        $("#txt-query").keypress(function (evt) {
            if (evt.keyCode == 13) {
                $("#btn-search").click();
            }
        });
    };
});
