@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 d-flex justify-content">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Import Data
        </button>
      </div>
        <div class="col-md-10 border shadow-sm p-5">

            <form action="{{route('certificate.add')}}" method="post">
                @csrf
            <div class="row">
                <div class="col-4">
                  <input type="text" class="form-control" name="name" placeholder="Full name" aria-label="Full name">
                </div>
                <div class="col-4">
                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email">
                  </div>
                <div class="col-2">
                    <select class="form-select" name="category" aria-label="Default select example">
                        <option selected>Category</option>
                        <option value="Attendance">Attendance</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div>
                <div class="col-2 d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
            </form>
            <hr/>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Category</th>
                    <th scope="col">Certificate No.</th>
                    <th scope="col">Sent</th>
                    <th scope="col">Opened</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $c =1; ?>
                    @forelse ($certificates as $certificate)
                    <tr>
                        <th scope="row">{{ $c++ }}</th>
                        <td>{{$certificate->name}}</td>
                        <td>{{$certificate->email}}</td>
                        <td>{{$certificate->type}}</td>
                        <td>{{$certificate->unique_code}}</td>
                        <td>{{$certificate->isEmailSent}}</td>
                        <td>{{$certificate->link_click_count}}</td>
                        <td><a href="{{ route('certificate.send.email', $certificate->id) }}" type="button" class="btn btn-success" >Send Email</a>
                        </td>
                      </tr>
                    @empty
                        No data found!
                    @endforelse

                </tbody>
              </table>
        </div>
    </div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('certificate.import') }}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12 mb-3">
          <select class="form-select" name="category" aria-label="Default select example" required>
              <option selected value="">Select Category</option>
              <option value="Attendance">Attendance</option>
              {{-- <option value="2">Two</option>
              <option value="3">Three</option> --}}
            </select>
      </div>
        <div class="col-12">
          <input type="file" name="file" class="form-control" placeholder="Upload" aria-label="Email" required>
        </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">upload</button>
  </div>

      </form>
</div>
@endsection
