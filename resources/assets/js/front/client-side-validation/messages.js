const LANG = ($('html').attr('lang') || 'nl').toLowerCase();

const messages = {
    nl: {
        min: 'Dit veld moet minstens :amount tekens bevatten.',
        max: 'Dit veld mag maximaal :amount tekens bevatten.',
        email: 'Dit veld moet een geldig e-mailadres bevatten.',
        required: 'Dit is een verplicht veld.',
    },
    en: {
        min: 'This field must contain at least :amount characters.',
        max: 'This field may contain at most :amount characters.',
        email: 'This field must contain a valid email address.',
        required: 'This field is required.',
    },
    fr: {
        min: 'Ce champ doit contenir au moins :amount caractères.',
        max: 'Ce champ peut contenir au plus :amount caractères.',
        email: 'Ce champ doit contenir une adresse e-mail valable.',
        required: 'Ce champ est obligatoire.',
    },
};

export const parseMessage = (message, parameters = {}) => {
    return messages[LANG][message].replace(/:[\w]+/g, (key => parameters[key.slice(1)] || key));
}
