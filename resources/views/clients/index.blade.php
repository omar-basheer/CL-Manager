<!-- resources/views/clients/index.blade.php -->

@extends('layouts.app')

@section('content')
<!-- Bootstrap Modal for creating a new client -->
<div class="modal fade" id="createClientModal" tabindex="-1" role="dialog" aria-labelledby="createClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createClientModalLabel">Create New Client</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createClientForm">
                    @csrf
                    <!-- Your form fields for creating a new client go here -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                        <div class="error-message" id="error-first_name"></div>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                        <div class="error-message" id="error-middle_name"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                        <div class="error-message" id="error-last_name"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="error-message" id="error-email"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <div class="error-message" id="error-phone"></div>
                    </div>
                    <div class="form-group">
                        <label for="company">Organization</label>
                        <input type="text" class="form-control" id="company" name="company">
                        <div class="error-message" id="error-company"></div>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website">
                        <div class="error-message" id="error-website"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (must be at least 6 characters)</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="error-message" id="error-password"></div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <div class="error-message" id="error-password_confirmation"></div>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="error-message" id="error-city"></div>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                        <div class="error-message" id="error-country"></div>
                    </div>
                    <!-- Add more form fields as needed -->
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="saveClientButton" type="button" class="btn btn-primary">Save Client</button>
            </div>
        </div>
    </div>
</div>

<!-- edit client modal -->
<div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editClientForm">
                    @csrf
                    <!-- Your form fields for creating a new client go here -->
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                        <div class="error-message" id="editError-first_name"></div>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name">
                        <div class="error-message" id="editError-middle_name"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                        <div class="error-message" id="editError-last_name"></div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                        <div class="error-message" id="editError-email"></div>
                    </div> -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <div class="error-message" id="editError-phone"></div>
                    </div>
                    <div class="form-group">
                        <label for="company">Organization</label>
                        <input type="text" class="form-control" id="company" name="company">
                        <div class="error-message" id="editError-company"></div>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website">
                        <div class="error-message" id="editError-website"></div>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="error-message" id="editError-city"></div>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                        <div class="error-message" id="editError-country"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateClientButton">Update Client</button>
            </div>
        </div>
    </div>
</div>


<div class="app">
    <!-- <h2>CL Software</h2> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand mynav-brand" href="#">Client Soft</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mynav-nav">
                <a class="nav-item nav-link  mynav-nav" href="#">Home </a>
                <a class="nav-item nav-link mynav-nav" href="#">People</a>
            </div>
        </div>
    </nav>
    <div>
        <button id="createClientButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="createClientForm">
            New Client
        </button>

        <div class="side-menu-container">
            <!-- Place your side menu content here -->
        </div>

        @foreach ($clients as $client)
        <div class="clcard">
            <div class="clcard-header">
                <img class="avatar" src="{{ $client->avatar }}" alt="Avatar" width="100" height="100">
            </div>
            <p> {{ $client->first_name }} {{ $client->last_name }}</p>
            <p> {{ $client->email }}</p>
            <p>{{ $client->phone }}</p>
            <div class="clcard-buttons">
                <button class="editClientButton" data-email="{{$client->email}}">Edit</button>
                <button class="deleteClientButton" data-email="{{$client->email}}">Delete</button>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection