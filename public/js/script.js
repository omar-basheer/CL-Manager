$(document).ready(function () {
    var createClientButton = $('#createClientButton');
    var createClientModal = $('#createClientModal');
    var saveClientButton = $('#saveClientButton');
    var deleteClientButton = $('.deleteClientButton')
    var editClientButton = $('.editClientButton')
    var editClientModal = $('#editClientModal')
    var updateClientButton = $('.updateClientButton');
    var editClientEmail = '';

    // Function to clear form inputs
    function clearFormInputs() {
        $('#createClientForm')[0].reset(); // This will reset the form fields to their initial values
        clearErrorMessages(); // Clear error messages as well
    }

    // Clear inputs when modal is closed
    createClientModal.on('hidden.bs.modal', function () {
        clearFormInputs(); // Clear form inputs when the modal is closed
    });

    // clear error messages as user updates fields
    function clearErrorMessages(){
        $('.error-message').empty();
    }

    /**
     * @function createClientModalButton
     * shows modal form for receiving data on new client
     */
    createClientButton.click(function () {
        createClientModal.modal('show');
    });

    /**
     * @function saveClientButton
     *  retrieves form data and makes post request to /api/clients/store
     * handles display of form validation errors
     */

    saveClientButton.click(function () {
        clearErrorMessages();
        var formData = new FormData($('#createClientForm')[0]);

        // Make an AJAX POST request to the store route
        $.ajax({
            type: 'POST',
            url: '/api/clients/store',
            data: formData,
            contentType: false, // Set to false to prevent jQuery from automatically setting the Content-Type header
            processData: false, // Set to false to prevent jQuery from automatically processing the data
            success: function (response) {
                // If there are no errors, close the modal and display a success message
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

    deleteClientButton.click(function () {
        var email = $(this).data('email');
        if (confirm('Are you sure you want to delete this client?')) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from the meta tag
    
            $.ajax({
                type: 'DELETE',
                url: '/api/clients/delete/' + email,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                },
                success: function (response) {
                    editClientModal.modal('hide');
                    alert('Client deleted successfully!');
                    window.location.reload(); // Reload the page to update the client list
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Failed to delete client. Please try again.');
                }
            });
        }
    });
    
    

    editClientButton.click(function(){
        var email = $(this).data('email');
        editClientModal.data('client-email', email); 

        $.ajax({
            type: 'GET',
            url: `/clients/${email}`,
            success: function(data){
                console.log(data)
                $('#editClientForm #first_name').val(data.first_name);
                $('#editClientForm #middle_name').val(data.middle_name);
                $('#editClientForm #last_name').val(data.last_name);
                $('#editClientForm #phone').val(data.phone);
                $('#editClientForm #company').val(data.company);
                $('#editClientForm #website').val(data.website);
                $('#editClientForm #city').val(data.city);
                $('#editClientForm #country').val(data.country);

                editClientModal.modal('show');
            },
            error: function(error) {
                console.error(error);
                alert('Failed to fetch client data. Please try again.');
              }
        })
    });


    updateClientButton.click(function () {
        var email = editClientModal.data('client-email'); 
        console.log(email);
        var formData = new FormData(document.getElementById('editClientForm')); 

        $.ajax({
            type: 'POST',
            url: `/clients/update/${email}`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response); 
                alert('Client updated successfully!');
                editClientModal.modal('hide');
                window.location.reload();
            },
            error: function (error) {
                console.log(error.status)
                if (error.status === 400) {
                    var errors = error.responseJSON.errors;
                    var errorMessage = '* ';

                    for (var field in errors) {
                        errorMessage += errors[field][0] + '\n';
                        console.log(errorMessage)
                        $('#editError-' + field).text(errorMessage);
                        errorMessage = '* ';
                    }
                } else {
                    alert('Failed to update client. Please try again.');
                }
            }
        });
    });
});
