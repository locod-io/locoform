import $ from "jquery";

const loginValidator = {
    passwordField: undefined,
    loginForm: undefined,
    init: function () {
        this.passwordField = $('.required').first();
        this.shake(this.passwordField);
        this.loginForm = $('#loginForm').on('submit', function (event) {
            if (this.passwordField !== undefined) {
                let _password = this.passwordField.val();
                if (_password.trim().length === 0) {
                    this.shake(this.passwordField);
                    event.preventDefault();
                }
            } else {
                console.log('no password field defined');
                event.preventDefault();
            }
        }.bind(this));
    },
    shake: function (input) {
        let pos = input.position().left;
        let duration = 50;
        let distance = 3;
        input.animate({
            left: pos - distance
        }, duration)
            .animate({
                left: pos + distance * 2
            }, duration)
            .animate({
                left: pos - distance * 2
            }, duration)
            .animate({
                left: pos + distance * 2
            }, duration)
            .animate({
                left: pos - distance
            }, duration)
            .animate({
                left: pos
            }, duration);
    }
}

export default loginValidator;