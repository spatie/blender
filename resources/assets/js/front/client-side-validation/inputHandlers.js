import ErrorBag from './ErrorBag';
import { parseMessage } from './messages';
import { validate } from './validate';

export const validateInput = $input => {

    const errors = new ErrorBag();

    if ($input.is('[minlength]') && !validate.min($input.val(), parseInt($input.attr('minlength')))) {
        errors.add(['minlength', {amount: parseInt($input.attr('minlength'))}]);
    }

    if ($input.is('[maxlength]') && !validate.max($input.val(), parseInt($input.attr('maxlength')))) {
        errors.add(['maxlength', {amount: parseInt($input.attr('maxlength'))}]);
    }

    if ($input.is('[type=email]') && !validate.email($input.val())) {
        errors.add(['email']);
    }

    if ($input.is('[required]') && !validate.required($input.val(), 'required')) {
        errors.add(['required']);
    }

    return errors;
};

export const clearInputError = $input => {
    $input.next('[data-validation-error]').text('');
};

export const setInputError = ($input, error) => {
    $input.next('[data-validation-error]')
        .text(parseMessage(error[0], error[1]));
};
