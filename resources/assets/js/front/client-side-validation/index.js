import ErrorBag from './ErrorBag';
import { validateInput, clearInputError, setInputError } from './inputHandlers';

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
