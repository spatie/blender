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

export const init = () => {

    $('[data-validate] input').on('blur keyup', e => {
        const $input = $(e.target);
        const errors = [];

        if ($input.is('[min]') && ! validate.min($input.val(), parseInt($input.attr('min')))) {
            errors.push(['min', { amount: parseInt($input.attr('min')) }]);
        }

        if ($input.is('[max]') && ! validate.max($input.val(), parseInt($input.attr('max')))) {
            errors.push(['max', { amount: parseInt($input.attr('max')) }]);
        }

        if ($input.is('[type=email]') && ! validate.email($input.val())) {
            errors.push(['email']);
        }

        if ($input.is('[required]') && ! validate.required($input.val(), 'required')) {
            errors.push(['required']);
        }

        if (errors.length === 0) {
            $input.next('[data-validation-error]').text('');
            return;
        }

        if (e.type === 'blur') {
            const [ message, variables ] = errors[errors.length - 1];
            $input.next('[data-validation-error]').text(parseMessage(message, variables));
        }
    });

};

export default init;
