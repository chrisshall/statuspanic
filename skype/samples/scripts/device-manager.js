// we want to dispose all the previous conversations added event listeners because
// in this demo site, we don't want to samples interfere with each other.
var registeredListeners = registeredListeners || [];
registeredListeners.forEach(function (listener) {
    listener.dispose();
});
registeredListeners = [];
/**
 * This script demonstrates how to do device management in skypeweb.
 */
$(function () {
    'use strict';
    window['device-manager_load'] = function () {
        var app = window.skypeWebApp;
        var lblDevices = $('<div class="status">').appendTo($('.device-manager'));
        app.devicesManager.speakers.subscribe();
        app.devicesManager.microphones.subscribe();
        app.devicesManager.cameras.subscribe();
        // observe .speakers
        app.devicesManager.speakers.added(function (ad) {
            lblDevices.append($('<div>').text('Added speaker: ' + ad.id()));
            $('#spks').append($('<option/>', {
                value: ad.id(),
                text: ad.id()
            }));
        });
        app.devicesManager.speakers.removed(function (ad) {
            lblDevices.append($('<div>').text('Removed speaker: ' + ad.id()));
            $('#spks option[value="' + ad.id() + '"]')[0].remove();
        });
        // observe .microphones
        app.devicesManager.microphones.added(function (ad) {
            lblDevices.append($('<div>').text('Added mic: ' + ad.id()));
            $('#mics').append($('<option/>', {
                value: ad.id(),
                text: ad.id()
            }));
        });
        app.devicesManager.microphones.removed(function (ad) {
            lblDevices.append($('<div>').text('Removed mic: ' + ad.id()));
            $('#mics option[value="' + ad.id() + '"]')[0].remove();
        });
        // observe .cameras
        app.devicesManager.cameras.added(function (vd) {
            lblDevices.append($('<div>').text('Added camera: ' + vd.name()));
            $('#cams').append($('<option/>', {
                value: vd.name(),
                text: vd.name()
            }));
        });
        app.devicesManager.cameras.removed(function (vd) {
            lblDevices.append($('<div>').text('Removed camera: ' + vd.name()));
            $('#cams option[value="' + vd.name() + '"]')[0].remove();
        });
        // observe .selected*
        app.devicesManager.selectedSpeaker.changed(function (ad) {
            lblDevices.append($('<div>').text('Selected speaker: ' +
                (ad ? ad.id() : 'None')));
        });
        app.devicesManager.selectedMicrophone.changed(function (ad) {
            lblDevices.append($('<div>').text('Selected microphone: ' +
                (ad ? ad.id() : 'None')));
        });
        app.devicesManager.selectedCamera.changed(function (vd) {
            lblDevices.append($('<div>').text('Selected video: ' +
                (vd ? vd.name() : 'None')));
        });
    };
});
