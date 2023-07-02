import {extend} from 'vee-validate';
import {required, email} from 'vee-validate/dist/rules';

extend('required', {
    ...required,
    message: '{_field_} is required field'
})
extend('standard', {
    validate: value => {
        let regex = /^(\+98|98|0098|\+)?9\d{9}$/;
        return regex.test(value);
    },
    message: "{_field_} need standard iran phone!"
});
extend('minmax', {
    validate(value, {min, max}) {
        return value.length > min && value.length < max;
    },
    message: "{_field_} must between {min} and {max}.",
    params: ['min', 'max']
})
extend('justNumber', {
    validate: value => {
        let regex = /^\d{6,}$/;
        return regex.test(value);
    },
    message: "{_field_} most be more 5 digit"
})

extend('decimal', {
    validate: value => {
        let regex = /[0-9,.]$/;
        return regex.test(value);
    },
    message: "{_field_} just digit and decimal"
})
