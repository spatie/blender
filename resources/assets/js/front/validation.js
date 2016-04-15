import ErrorBag from './ErrorBag';
import validate from './validators';

const messages = {
    min: 'Dit veld moet minstens :amount tekens bevatten',
    max: 'Dit veld mag maximaal :amount tekens bevatten',
    email: 'Dit veld moet een geldig e-mailadres bevatten',
    required: 'Dit veld is vereist',
};

const parseMessage = (message, parameters = {}) => {
    return messages[message].replace(/:[\w]+/g, (key => parameters[key.slice(1)] || key));
}

const validateInput = $input => {

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

const clearInputError = $input => {
    $input.next('[data-validation-error]').text('');
};

const setInputError = ($input, error) => {
    $input.next('[data-validation-error]')
        .text(parseMessage(error[0], error[1]));
};

export const init = () => {

    $('[data-validate] input').on('blur keyup', function(e) {

        const $input = $(e.target);
        const errors = validateInput($input);

        if (errors.isEmpty()) {
            clearInputError($input);
            return;
        }

        if (e.type === 'blur') {
            setInputError($input, errors.last());
        }
    });

    $('[data-validate]').on('submit', e => {

        const formErrors = new ErrorBag();

        $.each($(e.target).find('input'), function (i, el) {

            const $input = $(el);
            const errors = validateInput($input);

            formErrors.merge(errors);

            if (formErrors.isEmpty()) {
                clearInputError($input);
                return;
            }

            setInputError($input, errors.last());
        });

        if (formErrors.hasErrors()) {
            e.preventDefault();
        }
    });
};

export default init;
