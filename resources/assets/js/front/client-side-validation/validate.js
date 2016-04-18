import is from 'is_js';

export const validate = {
    required(value) {
        return is.existy(value) && is.not.empty(value);
    },
    min(value, length) {
        return is.string(value) && is.above(value.length, length - 1);
    },
    max(value, length) {
        return is.string(value) && is.under(value.length, length + 1);
    },
    email(value) {
        return is.email(value);
    },
};
