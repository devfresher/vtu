"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {

        $('#kt_login_signin_submit').on('click', function (e) {
            // e.preventDefault();
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

		var url = window.location.href;
		var split = url.split('#');
		var formId = split[1];


		if (formId != undefined && formId != '') {
			var split = formId.split("_");
			var form = split[2];
			_showForm(form);
		}
		

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        $('#kt_login_signup_submit').on('click', function (e) {
            // e.preventDefault();

            // validation.validate().then(function(status) {
		    //     if (status == 'Valid') {
            //         swal.fire({
		    //             text: "All is cool! Now you submit this form",
		    //             icon: "success",
		    //             buttonsStyling: false,
		    //             confirmButtonText: "Ok, got it!",
            //             customClass: {
    		// 				confirmButton: "btn font-weight-bold btn-light-primary"
    		// 			}
		    //         }).then(function() {
			// 			KTUtil.scrollTop();
			// 		});
			// 	} else {
			// 		swal.fire({
		    //             text: "Sorry, looks like there are some errors detected, please try again.",
		    //             icon: "error",
		    //             buttonsStyling: false,
		    //             confirmButtonText: "Ok, got it!",
            //             customClass: {
    		// 				confirmButton: "btn font-weight-bold btn-light-primary"
    		// 			}
		    //         }).then(function() {
			// 			KTUtil.scrollTop();
			// 		});
			// 	}
		    // });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            // e.preventDefault();
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
