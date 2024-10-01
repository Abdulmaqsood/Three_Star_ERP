"use strict";

// Class definition
var KTUsersUpdatePassword = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_update_password');
    const form = element.querySelector('#kt_modal_update_password_form');
    const modal = new bootstrap.Modal(element);

    // Init update password modal
    var initUpdatePassword = () => {
        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        if (closeButton) {
            closeButton.addEventListener('click', e => {
                e.preventDefault();
                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.isConfirmed) {
                        modal.hide(); // Hide modal
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });
        } else {
            console.error("Close button not found!");
        }

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        if (cancelButton) {
            cancelButton.addEventListener('click', e => {
                e.preventDefault();
                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    console.log(result);
                    if (result.isConfirmed) {
                        modal.hide(); // Hide modal
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });
        } else {
            console.error("Cancel button not found!");
        }
    }

    return {
        // Public functions
        init: function () {
            initUpdatePassword();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersUpdatePassword.init();
});
