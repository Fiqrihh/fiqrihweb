@extends('lyout.leotuang')

@section('contener')
    
<style>
    .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}



  .foto-container {
    width: 300px; /* Sesuaikan lebar kotak dengan kebutuhan Anda */
    height: 300px; /* Sesuaikan tinggi kotak dengan kebutuhan Anda */
    overflow: hidden;
    position: relative;
  }

  .foto-container img {
    width: 100%;
    height: auto;
    object-fit: cover;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }



</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="card">
  <div class="foto-container">
  <img src="{{ asset('storage/' . $user->fotoAdmin) }}" alt="">
  </div>
  <h1>{{ $user->name }}</h1>
  <p class="title">mimin</p>
  <p>Harvard University</p>
  <a href="/editaku" class="btn btn-primary"><i class="fa fa-edit" ></i></a> ||
  <p><button>Contact</button></p>
</div>

@endsection
