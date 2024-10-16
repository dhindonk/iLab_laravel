@extends('baru.layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">Members</h2>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="card-text">You can manage all Members, such as editing, deleting and more.</p>
                        <a href="{{ route('create') }}" class="btn btn-primary">Add New</a>
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
                                                <th>Foto Profile</th>
                                                <th>Fullname</th>
                                                <th>Email</th>
                                                <th>University Name</th>
                                                <th>Verified</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>368</td>
                                                <td>Imani Lara</td>
                                                <td>(478) 446-9234</td>
                                                <td>Asset Management</td>
                                                <td> <span class="badge badge-success">✓ Verified</span>
                                                </td>
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
                                                <td>323</td>
                                                <td>Walter Sawyer</td>
                                                <td>(671) 969-1704</td>
                                                <td>Tech Support</td>
                                                <td> <span class="badge badge-danger">✗ Not Verified</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-check"></i>
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
                                                <td>371</td>
                                                <td>Noelle Ray</td>
                                                <td>(803) 792-2559</td>
                                                <td>Human Resources</td>
                                                <td>Sibelius</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-check"></i>
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
                                                <td>302</td>
                                                <td>Portia Nolan</td>
                                                <td>(216) 946-1119</td>
                                                <td>Payroll</td>
                                                <td>Microsoft</td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-edit"></i>
                                                        </a>
                                                        <a href='' class="btn btn-sm btn-dark btn-icon mr-1">
                                                            <i class="fe fe-check"></i>
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
    </main>
@endsection
