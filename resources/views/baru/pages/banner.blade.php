@extends('baru.layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">Banner</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">You can manage all banners, such as editing, deleting, and more.
                        </p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#varyModal" data-whatever="@mdo">Add Ner Banner</button>
                    </div>
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <!-- table -->
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Verified</th>
                                                <th>Verified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>Borland</td>
                                                <td>Borland</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form action="" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="submit">
                                                                <i class="fe fe-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>Macromedia</td>
                                                <td>Macromedia</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form action="" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="submit">
                                                                <i class="fe fe-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>Sibelius</td>
                                                <td>Sibelius</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form action="" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="submit">
                                                                <i class="fe fe-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>Microsoft</td>
                                                <td>Microsoft</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <form action="" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-dark btn-icon" type="submit">
                                                                <i class="fe fe-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- simple table -->
                    </div> <!-- end section -->
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        <div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="varyModalLabel">New message</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Banner Name:</label>
                      <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Upload Banner Image:</label>
                      <input type="file" class="form-control" id="recipient-name">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn mb-2 btn-primary">Create Banner</button>
                </div>
              </div>
            </div>
          </div>
    </main>
@endsection
