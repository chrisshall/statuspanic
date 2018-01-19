// we want to dispose all the previous conversations added event listeners because
// in this demo site, we don't want to samples interfere with each other.
var registeredListeners = registeredListeners || [];
registeredListeners.forEach(function (listener) {
    listener.dispose();
});
registeredListeners = [];
/**
 * This web app demonstrates group and person management functionalities, such as:
 * - creating a new user-defined group in the group list
 * - deleting a user-defined group from the group list
 * - renaming a user defined group
 * - adding a DG to the group list
 * - removing a DG from the group list
 * - adding a person to the person list
 * - removing a person from the person list
 */
$(function () {
    'use strict';
    window['person-group-manager_load'] = function () {
        var personsFound, groupsFound, personsInGroup, groupsInClient, oldName; // group name before renaming
        // create an instance of the Application object
        var client = window.skypeWebApp;
        // disable some buttons by default
        $('#addPerson').prop('disabled', true);
        $('#addDG').prop('disabled', true);
        $('#removeGroup').prop('disabled', true);
        $('#removePerson').prop('disabled', true);
        $('#addRemovePerson').prop('disabled', true);
        $('#removeFromAll').prop('disabled', true);
        // toggle README content
        $('#show_readme').click(function () {
            $('#readme').toggle();
        });
        // when a group is selected
        $('#groupList').change(function () {
            $('#removeGroup').prop('disabled', !$('#groupList').val());
            updatePersonList();
        });
        // when a person is selected
        $('#personList').change(function () {
            var v = $('#personList').val();
            $('#removePerson').prop('disabled', !v);
            $('#removeFromAll').prop('disabled', !v);
        });
        // when a group from search is selected
        $('#groupsFoundList').change(function () {
            var v = $('#groupsFoundList').val();
            $('#addDG').prop('disabled', !v);
        });
        // when a person from search is selected
        $('#personsFoundList').change(function () {
            var v = $('#personsFoundList').val();
            $('#addPerson').prop('disabled', !v);
        });
        // -----------------------------------------------------
        $('#searchKey').prop('disabled', false);
        // subscribe to the groups update events
        client.personsAndGroupsManager.all.groups.subscribe();
        client.personsAndGroupsManager.all.groups.added(function (g) {
            console.log('group added', g);
            // skip privacy relationship groups since person and group
            // management APIs are not supported for them
            if (g.type() == 'Custom' || g.type() == 'Distribution' ||
                g.type() == 'Others' || g.type() == 'Favorites')
                addToGroupList(g);
        });
        client.personsAndGroupsManager.all.groups.removed(function (g) {
            console.log('group removed', g);
            removeFromGroupList(g);
        });
        // reset cached group list and person list
        groupsInClient = {};
        personsInGroup = {};
        function addToGroupList(group) {
            group.name.get().then(function (name) {
                groupsInClient[name] = group;
                if ($('#groupList option[value="' + name + '"]').length == 0) {
                    $('#groupList').append($('<option>', { value: name }).text(name));
                    $('#groupList').val(name);
                    $('#removeGroup').prop('disabled', !$('#groupList').val());
                }
            });
            group.name.changed(function (newName) {
                if ($('#groupList option[value="' + oldName + '"]').length == 1) {
                    $('#groupList option[value="' + oldName + '"]').text(newName);
                    $('#groupList option[value="' + oldName + '"]').val(newName);
                    $('#removeGroup').prop('disabled', !$('#groupList').val());
                    if (newName != oldName) {
                        groupsInClient[newName] = groupsInClient[oldName];
                        delete groupsInClient[oldName];
                        updatePersonList();
                    }
                }
            });
            $('#removeGroup').prop('disabled', !$('#groupList').val());
            updatePersonList(group);
        }
        function removeFromGroupList(group) {
            group.name.get().then(function (name) {
                delete groupsInClient[name];
                $('#groupList option[value="' + name + '"]').remove();
                updatePersonList();
            });
        }
        function updatePersonList(g) {
            $('#removePerson').prop('disabled', true);
            $('#removeFromAll').prop('disabled', true);
            $('#groupTag').empty();
            $('#personList').empty();
            g = g || groupsInClient[$('#groupList').val()];
            if (g) {
                g.name.get().then(function (name) {
                    var cs, id;
                    $('#groupTag').text(name + ':');
                    personsInGroup = {};
                    g.persons.get().then(function () {
                        // add the persons to the list in order
                        $('#personList').empty();
                        cs = g.persons().sort(function (a, b) {
                            return a.id().localeCompare(b.id());
                        });
                        $.each(cs, function (key, value) {
                            id = value.id();
                            personsInGroup[id] = value;
                            if ($('#personList option[value="' + id + '"]').length == 0)
                                $('#personList').append($('<option>', { value: id }).text(id));
                        });
                    });
                });
            }
        }
        // -----------------------------------------------------
        function createGroupSuccess() {
            console.log('create group success');
        }
        function createGroupFail(e) {
            console.log('create group fail');
            console.log(e);
        }
        function doCreate(groupName) {
            var g = client.personsAndGroupsManager.createGroup();
            g.name(groupName);
            client.personsAndGroupsManager.all.groups.add(g).then(createGroupSuccess, createGroupFail);
        }
        // when the user clicks on the 'Create Group by Name' button
        $('#createGroupByName').click(function () {
            var name = $('#groupName').text();
            if (name) {
                doCreate(name);
            }
        });
        // -----------------------------------------------------
        function addDGSuccess() {
            console.log('addDG success');
        }
        function addDGFail(e) {
            console.log('addDG fail');
            console.log(e);
        }
        function doAddDG(group) {
            client.personsAndGroupsManager.all.groups.add(group).then(addDGSuccess, addDGFail);
        }
        // when the user clicks on the 'Add DG' button
        $('#addDG').click(function () {
            doAddDG(groupsFound[$('#groupsFoundList').val()]);
        });
        // -----------------------------------------------------
        function removeGroupSuccess() {
            console.log('removeGroup success');
        }
        function removeGroupFail(e) {
            console.log('removeGroup fail');
            console.log(e);
        }
        function doRemoveGroup(group) {
            client.personsAndGroupsManager.all.groups.remove(group).then(removeGroupSuccess, removeGroupFail);
        }
        // when the user clicks on the 'Remove Group' button
        $('#removeGroup').click(function () {
            doRemoveGroup(groupsInClient[$('#groupList').val()]);
        });
        // -----------------------------------------------------
        function renameGroupSuccess() {
            console.log('renameGroup success');
        }
        function renameGroupFail(e) {
            console.log('renameGroup fail');
            console.log(e);
        }
        // when the user clicks on the 'Rename Group' button
        $('#renameGroup').click(function () {
            var group = groupsInClient[$('#groupList').val()], name = $('#newGroupName').text();
            oldName = group.name();
            group.name.set(name).then(function () {
                // note group is the old group and n is the old name
                // 1. for non-UCS account, the old group will be removed - triggered
                // by the 'group deleted' event; a new group is create with the new
                // name, triggered by the 'group added' event.
                // 2. for UCS account, the existing group will be updated, triggered
                // by the 'group updated' event.
                renameGroupSuccess();
            }, renameGroupFail);
        });
        // -----------------------------------------------------
        function addPersonSuccess() {
            console.log('addPerson success');
        }
        function addPersonFail(e) {
            console.log('addPerson fail');
            console.log(e);
        }
        function addToPersonList(person) {
            var id = person.id();
            personsInGroup[id] = person;
            if ($('#personList option[value="' + id + '"]').length == 0)
                $('#personList').append($('<option>', { value: id }).text(id));
        }
        // when the user clicks on the 'Add Person' button
        $('#addPerson').click(function () {
            var group = groupsInClient[$('#groupList').val()];
            group.persons.added(function (c) {
                console.log('person added', c);
                addToPersonList(c);
            });
            group.persons.add(personsFound[$('#personsFoundList').val()]).then(addPersonSuccess, addPersonFail);
        });
        // -----------------------------------------------------
        function removePersonSuccess() {
            console.log('removePerson success');
        }
        function removePersonFail(e) {
            console.log('removePerson fail');
            console.log(e);
        }
        function removeFromPersonList(person) {
            $('#personList option[value="' + person.id() + '"]').remove();
        }
        function doRemovePerson(groupName, person) {
            var g = groupsInClient[$('#groupList').val()];
            if (g) {
                g.persons.subscribe();
                g.persons.removed(function (c) {
                    console.log('person removed', c);
                    removeFromPersonList(c);
                });
                // remove from the specified group
                g.persons.remove(person).then(removePersonSuccess, removePersonFail);
            }
        }
        // when the user clicks on the 'Remove Person' button
        $('#removePerson').click(function () {
            var groupName = $('#groupList').val(), person = personsInGroup[$('#personList').val()];
            doRemovePerson(groupName, person);
        });
        // when the user clicks on the 'Remove from all Groups' button
        $('#removeFromAll').click(function () {
            var i, g, person = personsInGroup[$('#personList').val()], gs = client.personsAndGroupsManager.all.groups();
            for (i = 0; i < gs.length; ++i) {
                g = gs[i];
                g.persons.subscribe();
                g.persons.removed(removeFromPersonList);
            }
            client.personsAndGroupsManager.all.persons.remove(person).then(removePersonSuccess, removePersonFail);
        });
        // -----------------------------------------------------
        // when the user clicks on the 'Search' button
        $('#doSearch').click(function () {
            var pSearch, gSearch, v = $('#searchKey').text();
            if (v) {
                pSearch = client.personsAndGroupsManager.createPersonSearchQuery();
                pSearch.text.set(v);
                pSearch.limit.set(10);
                $('#personsFoundList').empty();
                pSearch.getMore().then(function (results) {
                    // populate persons found
                    var i, person;
                    personsFound = {};
                    $('#addPerson').prop('disabled', true);
                    for (i = 0; i < results.length; ++i) {
                        person = results[i].result;
                        personsFound[person.id()] = person;
                        $('#personsFoundList').append($('<option></option>').text(person.id()));
                    }
                });
                gSearch = client.personsAndGroupsManager.createGroupSearchQuery();
                gSearch.text.set(v);
                gSearch.limit.set(10);
                $('#groupsFoundList').empty();
                gSearch.getMore().then(function (results) {
                    // populate distribution groups found
                    var i, group;
                    groupsFound = {};
                    $('#addDG').prop('disabled', true);
                    for (i = 0; i < results.length; ++i) {
                        group = results[i].result;
                        groupsFound[group.id()] = group;
                        $('#groupsFoundList').append($('<option></option>').text(group.id()));
                    }
                });
            }
        });
    };
});
