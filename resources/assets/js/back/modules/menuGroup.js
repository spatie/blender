function init() {
    $('[data-menu-group]').each(function () {
       initializeMenuGroup($(this));
    });
}

function initializeMenuGroup($group) {
    let secondaryItems = $('.-secondary', $group);

    if (secondaryItems.size()) {
        addToggle($group);
    }
}

function addToggle($group) {
    let css = $group.hasClass('-active') ? 'fa-caret-left' : 'fa-ellipsis-v';
    let moreLink = $('<li class="menu_group_item -icon"><a href="#"><i data-group-toggle class="fa ' + css + '"></i></a></li>');
    $('ul', $group).append(moreLink);

    moreLink.on('click', e => {
        e.preventDefault();
        toggleGroup($group);
        closeOtherGroups($group);
    });
}


function closeOtherGroups($group) {
    $('[data-menu-group]').not($group).filter('.-active').each(function () {
        toggleGroup($(this));
    })
}

function toggleGroup($group) {
    $group.toggleClass('-active');
    $('[data-group-toggle]', $group).toggleClass('fa-ellipsis-v fa-caret-left');
}

export default init;
