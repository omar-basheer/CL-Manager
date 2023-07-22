$(document).ready(function () {
    var createClientModalButton = $('#createClientModalButton');
    var modal = $('#createClientModal');
    var saveClientButton = $('#saveClientButton');

    // Function to clear form inputs
    function clearFormInputs() {
        $('#createClientForm')[0].reset(); // This will reset the form fields to their initial values
        clearErrorMessages(); // Clear error messages as well
    }

    // Open the modal when clicking the "New Client" button
    createClientModalButton.click(function () {
        modal.modal('show');
    });

    // Clear inputs when modal is closed
    modal.on('hidden.bs.modal', function () {
        clearFormInputs(); // Clear form inputs when the modal is closed
    });

    function clearErrorMessages(){
        $('.error-message').empty();
    }

    saveClientButton.click(function () {
        clearErrorMessages();
        var formData = new FormData($('#createClientForm')[0]);
        console.log('formData: ', formData);

        // Make an AJAX POST request to the store route
        $.ajax({
            type: 'POST',
            url: '/api/clients/store',
            data: formData,
            contentType: false, // Set to false to prevent jQuery from automatically setting the Content-Type header
            processData: false, // Set to false to prevent jQuery from automatically processing the data
            success: function (response) {
                console.log('post success');
                // If there are no errors, close the modal and display a success message
                modal.modal('hide');
                alert('Client created successfully!');
                window.location.reload();
            },
            error: function (error) {
                console.error(error);
                if (error.status === 422){
                    var errors = error.responseJSON.errors;
                    var errorMessage = '* ';

                    for (var field in errors){
                        errorMessage += errors[field][0] + '\n'
                        $('#error-' + field).text(errorMessage);
                        errorMessage = '* '
                    }
                }
                else{
                    alert('Failed to create client. Please check the form and try again.');
                }
                
            }
        });
    });
});
