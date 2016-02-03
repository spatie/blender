import store from 'store';

function init() {
    $('[data-menu-group]').each(function () {
        initializeMenuGroup($(this));
    });

    getState();
    showMenu();
}

function initializeMenuGroup($group) {
    let secondaryItems = $('.-secondary', $group);

    if (secondaryItems.size()) {
        addToggle($group);
    }
}


function addToggle($group) {
    let moreLink = $('<li class="menu_group_item -icon"><a href="#"><i data-group-toggle class="fa fa-ellipsis-v"></i></a></li>');
    $('ul', $group).append(moreLink);

    moreLink.on('click', e => {
        e.preventDefault();
        toggleGroup($group);
        storeState();
    });
}

function toggleGroup($group) {
    $group.toggleClass('-show-secondary');
    $('[data-group-toggle]', $group).toggleClass('fa-ellipsis-v fa-caret-left');
}

function storeState() {

    let activeGroups = [];

    $('[data-menu-group]').each(function () {
        if ($(this).hasClass('-show-secondary')) {
            activeGroups.push($(this).data('menu-group'));
        }
    });

    store.set('activeMenuGroups', activeGroups);
}


function getState() {

    let activeGroups = store.get('activeMenuGroups', []);
    activeGroups.map(group => {
        toggleGroup($('[data-menu-group="' + group + '"]'));
    });
}

function showMenu() {
    $('html').addClass('$menu-ready');
}

export default init;
export { initializeMenuGroup };
