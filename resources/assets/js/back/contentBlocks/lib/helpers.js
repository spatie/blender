export function getTranslation(translations, locale, fallback = '') {
    return translations[locale] || fallback;
}