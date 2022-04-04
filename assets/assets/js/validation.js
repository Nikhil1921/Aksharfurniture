$(document).ready(function(){
    var url = window.location.href;

    $('#loginForm').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: 'fa fa-check log_valid',
            invalid: 'fa fa-close log_invalid',
            validating: 'fa fa-spinner',
        },
        fields: {
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'The Mobile is required'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The Mobile must be 10 characters long'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The Mobile can only consist of number'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The Password is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The Password can only consist of alphabetical, number and underscore'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            data.element
                .data('bv.messages')
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                .filter('[data-bv-validator="' + data.validator + '"]').show();
        });

    $('#employeeForm').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: 'fa fa-check valid',
            invalid: 'fa fa-close invalid',
            validating: 'fa fa-spinner',
        },
        fields: {
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'The Mobile is required'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The Mobile must be 10 characters long'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The Mobile can only consist of number'
                    }
                }
            },
            email: {
                validators: {
                    emailAddress: {
                        message: 'The Email Address is not valid'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_@0-9.]+$/,
                        message: 'The Email Address is not valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The Password is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The Password can only consist of alphabetical, number and underscore'
                    }
                }
            },
            c_password: {
                validators: {
                    notEmpty: {
                        message: 'The Confirm Password is required'
                    },
                    identical: {
                        field: 'password',
                        message: 'The Password and confirm password must be same'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_ ]+$/,
                        message: 'The Name is not valid'
                    }
                }
            },
            address: {
                validators: {
                    notEmpty: {
                        message: 'The Address is required'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            data.element
                .data('bv.messages')
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                .filter('[data-bv-validator="' + data.validator + '"]').show();
        });

    if (url.indexOf('/profile') != -1) {
        var form = $("#userForm").attr("action");
        var str2 = "/profile/update/";
        if(form.indexOf(str2) != -1){
            $('#userForm').bootstrapValidator('enableFieldValidators','image', false, 'notEmpty');
        }
    }

    $('#productForm').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: 'fa fa-check valid',
            invalid: 'fa fa-close invalid',
            validating: 'fa fa-spinner',
        },
        fields: {
            c_name: {
                validators: {
                    notEmpty: {
                        message: 'The Category Name is required'
                    }
                }
            },
            p_name: {
                validators: {
                    notEmpty: {
                        message: 'The Product Name is required'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'The Price is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The Product Proce can only consist of number'
                    }
                }
            },
            description: {
                validators: {
                    notEmpty: {
                        message: 'The Product description is required'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            data.element
                .data('bv.messages')
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                .filter('[data-bv-validator="' + data.validator + '"]').show();
        });

    $('#myForm').bootstrapValidator({
        excluded: [':disabled', ':hidden', ':not(:visible)'],
        feedbackIcons: {
            valid: 'fa fa-check valid',
            invalid: 'fa fa-close invalid',
            validating: 'fa fa-spinner',
        },
        fields: {
            order_id: {
                validators: {
                    notEmpty: {
                        message: 'The order id is required'
                    }
                }
            },
            pay_type: {
                validators: {
                    notEmpty: {
                        message: 'The payment type is required'
                    }
                }
            },
            pay_bill: {
                validators: {
                    notEmpty: {
                        message: 'The payment amount is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The payment amount can only consist of number'
                    }
                }
            },
            payment_id: {
                validators: {
                    notEmpty: {
                        message: 'The payment id is required'
                    }
                }
            }
        }
    }).on('error.validator.bv', function(e, data) {
            data.element
                .data('bv.messages')
                .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                .filter('[data-bv-validator="' + data.validator + '"]').show();
        });
});