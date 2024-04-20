let deleteConfirm = document.querySelectorAll('.zr-delete-confirm');

// Get all elements with the class .zr-delete-confirm
var deleteButtons = document.querySelectorAll('.zr-delete-confirm');

// Check if any delete buttons were found
if (deleteButtons !== null) {
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            // Get the confirmation message from the data-confirm attribute
            var id = button.getAttribute('data-zrid');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteForm = document.getElementById('zr-delete-form-' + id)
                    deleteForm.submit();
                }
            });


            // Ask for confirmation before proceeding
            // if (confirm(confirmationMessage)) {
            //     // If user confirms, proceed with the default action
            //     // For example, submit the form or perform the delete action
            //     // Access the form or delete action from the button's attributes or parent elements
            //     // Example: button.form.submit();
            // }
        });
    });
}


// const Toast = Swal.mixin({
//     toast: true,
//     position: "top-end",
//     showConfirmButton: false,
//     timer: 3000,
//     timerProgressBar: true,
//     didOpen: (toast) => {
//         toast.onmouseenter = Swal.stopTimer;
//         toast.onmouseleave = Swal.resumeTimer;
//     }
// });
// Toast.fire({
//     icon: "success",
//     title: "Signed in successfully"
// });