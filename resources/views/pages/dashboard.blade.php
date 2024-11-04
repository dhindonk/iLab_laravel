@extends('baru.layouts.main')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="row align-items-center mb-2">
                  <div class="col">
                    <h2 class="h5 page-title">Welcome!</h2>
                  </div>
                  <div class="col-auto">
                    <form class="form-inline">
                      <div class="form-group d-none d-lg-inline">
                        <label for="reportrange" class="sr-only">Date Ranges</label>
                        <div id="reportrange" class="px-2 py-2 text-muted">
                          <span class="small"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                        <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- widgets -->
                <div class="row my-4">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow bg-primary text-white border-0">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary-light">
                                  <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                                </span>
                              </div>
                              <div class="col pr-0">
                                <p class="small text-muted mb-0">Monthly Sales</p>
                                <span class="h3 mb-0 text-white">$1250</span>
                                <span class="small text-muted">+5.5%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                  <i class="fe fe-16 fe-shopping-cart text-white mb-0"></i>
                                </span>
                              </div>
                              <div class="col pr-0">
                                <p class="small text-muted mb-0">Orders</p>
                                <span class="h3 mb-0">1,869</span>
                                <span class="small text-success">+16.5%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                  <i class="fe fe-16 fe-filter text-white mb-0"></i>
                                </span>
                              </div>
                              <div class="col">
                                <p class="small text-muted mb-0">Conversion</p>
                                <div class="row align-items-center no-gutters">
                                  <div class="col-auto">
                                    <span class="h3 mr-2 mb-0"> 86.6% </span>
                                  </div>
                                  <div class="col-md-12 col-lg">
                                    <div class="progress progress-sm mt-2" style="height:3px">
                                      <div class="progress-bar bg-success" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-0">
                          <div class="card-body">
                            <div class="row align-items-center">
                              <div class="col-3 text-center">
                                <span class="circle circle-sm bg-primary">
                                  <i class="fe fe-16 fe-activity text-white mb-0"></i>
                                </span>
                              </div>
                              <div class="col">
                                <p class="small text-muted mb-0">AVG Orders</p>
                                <span class="h3 mb-0">$80</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div> <!-- end section -->
                <!-- linechart -->
                <div class="my-4">
                  <div id="lineChart"></div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong>Goal</strong>
                      </div>
                      <div class="card-body px-4">
                        <div class="row border-bottom">
                          <div class="col-4 text-center mb-3">
                            <p class="mb-1 small text-muted">Completions</p>
                            <span class="h3">26</span><br />
                            <span class="small text-muted">+20%</span>
                            <span class="fe fe-arrow-up text-success fe-12"></span>
                          </div>
                          <div class="col-4 text-center mb-3">
                            <p class="mb-1 small text-muted">Goal Value</p>
                            <span class="h3">$260</span><br />
                            <span class="small text-muted">+6%</span>
                            <span class="fe fe-arrow-up text-success fe-12"></span>
                          </div>
                          <div class="col-4 text-center mb-3">
                            <p class="mb-1 small text-muted">Conversion</p>
                            <span class="h3">6%</span><br />
                            <span class="small text-muted">-2%</span>
                            <span class="fe fe-arrow-down text-danger fe-12"></span>
                          </div>
                        </div>
                        <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm">
                          <thead>
                            <tr>
                              <th class="w-50">Goal</th>
                              <th class="text-right">Conversion</th>
                              <th class="text-right">Completions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Checkout</td>
                              <td class="text-right">5%</td>
                              <td class="text-right">260</td>
                            </tr>
                            <tr>
                              <td>Add to Cart</td>
                              <td class="text-right">55%</td>
                              <td class="text-right">1260</td>
                            </tr>
                            <tr>
                              <td>Contact</td>
                              <td class="text-right">18%</td>
                              <td class="text-right">460</td>
                            </tr>
                          </tbody>
                        </table>
                      </div> <!-- .card-body -->
                    </div> <!-- .card -->
                  </div> <!-- .col -->
                  <div class="col-md-6">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">Top Selling</strong>
                        <a class="float-right small text-muted" href="#!">View all</a>
                      </div>
                      <div class="card-body">
                        <div class="list-group list-group-flush my-n3">
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Fusion Backpack</strong>
                                <div class="my-0 text-muted small">Gear, Bags</div>
                              </div>
                              <div class="col-auto">
                                <strong>+85%</strong>
                                <div class="progress mt-2" style="height: 4px;">
                                  <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p2.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Luma hoodies</strong>
                                <div class="my-0 text-muted small">Jackets, Men</div>
                              </div>
                              <div class="col-auto">
                                <strong>+75%</strong>
                                <div class="progress mt-2" style="height: 4px;">
                                  <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p3.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Luma shorts</strong>
                                <div class="my-0 text-muted small">Shorts, Men</div>
                              </div>
                              <div class="col-auto">
                                <strong>+62%</strong>
                                <div class="progress mt-2" style="height: 4px;">
                                  <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p4.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Brown Trousers</strong>
                                <div class="my-0 text-muted small">Trousers, Women</div>
                              </div>
                              <div class="col-auto">
                                <strong>+24%</strong>
                                <div class="progress mt-2" style="height: 4px;">
                                  <div class="progress-bar" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> <!-- / .list-group -->
                      </div> <!-- / .card-body -->
                    </div> <!-- .card -->
                  </div> <!-- .col -->
                </div> <!-- .row -->
                <div class="row">
                  <div class="col-md-4">
                    <div class="card shadow eq-card  mb-4">
                      <div class="card-header">
                        <strong>Region</strong>
                      </div>
                      <div class="card-body">
                        <div class="map-box my-5" style="position:relative; max-width: 320px; max-height: 200px; margin:0 auto;">
                          <div id="dataMapUSA"></div>
                        </div>
                        <div class="row align-items-bottom my-2">
                          <div class="col">
                            <p class="mb-0">France</p>
                            <span class="my-0 text-muted small">+10%</span>
                          </div>
                          <div class="col-auto text-right">
                            <p class="mb-0">118</p>
                            <div class="progress mt-2" style="height: 4px;">
                              <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row align-items-center my-2">
                          <div class="col">
                            <p class="mb-0">Netherlands</p>
                            <span class="my-0 text-muted small">+0.6%</span>
                          </div>
                          <div class="col-auto text-right">
                            <p class="mb-0">1008</p>
                            <div class="progress mt-2" style="height: 4px;">
                              <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row align-items-center my-2">
                          <div class="col">
                            <p class="mb-0">Italy</p>
                            <span class="my-0 text-muted small">+1.6%</span>
                          </div>
                          <div class="col-auto text-right">
                            <p class="mb-0">67</p>
                            <div class="progress mt-2" style="height: 4px;">
                              <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row align-items-center my-2">
                          <div class="col">
                            <p class="mb-0">Spain</p>
                            <span class="my-0 text-muted small">+118%</span>
                          </div>
                          <div class="col-auto text-right">
                            <p class="mb-0">186</p>
                            <div class="progress mt-2" style="height: 4px;">
                              <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- .col -->
                  <div class="col-md-4">
                    <div class="card shadow eq-card mb-4">
                      <div class="card-header">
                        <strong class="card-title">Traffic</strong>
                        <a class="float-right small text-muted" href="#!">View all</a>
                      </div>
                      <div class="card-body">
                        <div class="chart-box mb-3" style="min-height:180px;">
                          <div id="customAngle"></div>
                        </div> <!-- .col -->
                        <div class="mx-auto">
                          <div class="row align-items-center mb-2">
                            <div class="col">
                              <p class="mb-0">Direct</p>
                              <span class="my-0 text-muted small">+10%</span>
                            </div>
                            <div class="col-auto text-right">
                              <p class="mb-0">218</p>
                              <span class="dot dot-md bg-success"></span>
                            </div>
                          </div>
                          <div class="row align-items-center mb-2">
                            <div class="col">
                              <p class="mb-0">Organic Search</p>
                              <span class="my-0 text-muted small">+0.6%</span>
                            </div>
                            <div class="col-auto text-right">
                              <p class="mb-0">1002</p>
                              <span class="dot dot-md bg-warning"></span>
                            </div>
                          </div>
                          <div class="row align-items-center mb-2">
                            <div class="col">
                              <p class="mb-0">Referral</p>
                              <span class="my-0 text-muted small">+1.6%</span>
                            </div>
                            <div class="col-auto text-right">
                              <p class="mb-0">67</p>
                              <span class="dot dot-md bg-primary"></span>
                            </div>
                          </div>
                          <div class="row align-items-center">
                            <div class="col">
                              <p class="mb-0">Social</p>
                              <span class="my-0 text-muted small">+118%</span>
                            </div>
                            <div class="col-auto text-right">
                              <p class="mb-0">386</p>
                              <span class="dot dot-md bg-secondary"></span>
                            </div>
                          </div>
                        </div>
                      </div> <!-- .card-body -->
                    </div> <!-- .card -->
                  </div> <!-- .col-md -->
                  <div class="col-md-4">
                    <div class="card shadow eq-card mb-4">
                      <div class="card-header">
                        <strong>Browsers</strong>
                      </div>
                      <div class="card-body">
                        <div class="chart-box mt-3 mb-5">
                          <div id="radarChartWidget"></div>
                        </div> <!-- .col -->
                        <div class="mx-auto">
                          <div class="row align-items-center my-2">
                            <div class="col-6 col-xl-3 my-3">
                              <span class="mb-0">Safari</span>
                              <div class="progress my-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-6 col-xl-3 my-3 text-right">
                              <span>118</span><br />
                              <span class="my-0 text-muted small">+10%</span>
                            </div>
                            <div class="col-6 col-xl-3 my-3">
                              <span class="mb-0">Chrome</span>
                              <div class="progress my-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 36%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-6 col-xl-3 my-3 text-right">
                              <span>1008</span><br />
                              <span class="my-0 text-muted small">+36%</span>
                            </div>
                            <div class="col-6 col-xl-3 my-3">
                              <span class="mb-0">Opera</span>
                              <div class="progress my-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-6 col-xl-3 my-3 text-right">
                              <span>67</span><br />
                              <span class="my-0 text-muted small">+1.6%</span>
                            </div>
                            <div class="col-6 col-xl-3 my-3">
                              <span class="mb-0">Edge</span>
                              <div class="progress my-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-6 col-xl-3 my-3 text-right">
                              <span>186</span><br />
                              <span class="my-0 text-muted small">+118%</span>
                            </div>
                          </div>
                        </div>
                      </div> <!-- .card-body -->
                    </div> <!-- .card -->
                  </div> <!-- .col -->
                </div>
              </div> <!-- /.col -->
            </div> <!-- .row -->
          </div>
    </main> <!-- main -->
@endsection
