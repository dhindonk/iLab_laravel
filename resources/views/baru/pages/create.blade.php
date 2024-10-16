@extends('baru.layouts.main')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
          <div class="row align-items-center my-4">
            <div class="col">
              <h2 class="h3 mb-0 page-title">Create New Member</h2>
            </div>
          </div>
          <form>
            <hr class="my-4">
            <h5 class="mb-2 mt-4">Member Information</h5>
            <p class="mb-4">Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus</p>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="text" id="email" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="lastname">Password</label>
                <input type="text" id="lastname" class="form-control">
              </div>
            </div>
            <hr class="my-4">
            <h5 class="mb-2 mt-4">Personal Data</h5>
            <p class="mb-4">Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus</p>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="firstname">Full Name</label>
                <input type="text" id="firstname" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label for="lastname">Profile Picture</label>
                <input type="file" id="lastname" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Gender</label>
                <input type="email" class="form-control" id="inputEmail4">
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Phone</label>
                <input type="email" class="form-control" id="inputEmail4">
              </div>
              <div class="form-group col-md-4">
                <label for="inputPhone">Status</label>
                <input type="text" class="form-control" id="inputPhone">
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Residential Address</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
              </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Student Identity Number (Optional)</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPhone">Country of Origin</label>
                  <input type="text" class="form-control" id="inputPhone">
                </div>
              </div>
            <hr class="my-4">
            <h5 class="mb-2 mt-4">Company</h5>
            <p class="mb-4">Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus</p>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstname">University Name</label>
                <input type="text" id="firstname" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="lastname">Affiliate/Department</label>
                <input type="text" id="lastname" class="form-control">
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="firstname">University Address</label>
                  <input type="text" id="firstname" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="lastname">Country of Origin</label>
                  <input type="text" id="lastname" class="form-control">
                </div>
              </div>
            <hr class="my-4">
            <div class="form-row">
              <div class="col-md-6">
                  <label for="">Create account and email generated password</label>
              </div>
              <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary">Save Change</button>
              </div>
            </div>
          </form>
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
  </main>
  @endsection
