@extends('lyout.leotuang')

@section('contener')

<style>
    /* Your existing styles */

    /* Additional styling for improved appearance */
    body {
        background-color: #f4f4f4; /* Use a light background color */
    }

    .card {
        background-color: #fff; /* Use a white background for the card */
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 400px; /* Adjust the max-width to your liking */
        margin: auto;
        text-align: center;
        padding: 20px; /* Add some padding for better spacing */
        margin-top: 50px; /* Add margin-top for better spacing */
    }

    form {
        margin-top: 20px; /* Add margin-top for better spacing */
    }

    /* Your existing styles */
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="card">
    <div class="foto-container mb-3">
        <img src="{{ asset('storage/' . $user->fotoAdmin) }}" alt="User Photo" class="img-fluid rounded-circle">
    </div>
    <h1>{{ $user->name }}</h1>
    <p class="title">pengurus kursus</p>
    <p>Bahasa arab pondok</p>
    <p>Pesantren Darul Lughah Waddirasatil Islamiyah</p>

    <!-- Edit Profile Form -->
    <form action="updateprofile" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" >
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="photo">Upload New Photo:</label>
            <input type="file" class="form-control-file" id="fotoAdmin" name="fotoAdmin" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection
