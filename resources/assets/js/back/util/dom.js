export function query(scope, selector) {
    if (selector === undefined) {
        selector = scope;
        scope = document;
    }
    return scope.querySelector(selector);
}

export function queryAll(scope, selector) {
    if (selector === undefined) {
        selector = scope;
        scope = document;
    }
    return [...scope.querySelectorAll(selector)];
}

export function prop(el, name) {
    if (el.hasAttribute(`:${name}`)) {
        return JSON.parse(el.getAttribute(`:${name}`));
    }

    if (! el.hasAttribute(name)) {
        return null;
    }

    return el.getAttribute(name);
}

export function props(el) {
    const props = {};

    for (let i = 0; i < el.attributes.length; i++) {
        const name = el.attributes[i].name.replace(/^:/m, '');
        props[name] = prop(el, name);
    }

    return props;
}
