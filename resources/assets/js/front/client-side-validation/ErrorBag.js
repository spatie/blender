class ErrorBag {

    constructor() {
        this.errors = [];
    }

    errors() {
        return this.errors;
    }

    add(error, args = []) {
        this.errors.push([error, args]);
    }

    hasErrors() {
        return this.errors.length !== 0;
    }

    isEmpty() {
        return !this.hasErrors();
    }

    last() {
        return this.errors[this.errors.length - 1];
    }

    merge(errorBag) {
        this.errors = this.errors.concat(errorBag.errors);
    }
}

export default ErrorBag;
