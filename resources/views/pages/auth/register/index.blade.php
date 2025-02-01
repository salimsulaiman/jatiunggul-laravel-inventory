  <x-layout>
      <x-slot:title>{{ $title }}</x-slot:title>
      <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
          data-sidebar-position="fixed" data-header-position="fixed">
          <div
              class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
              <div class="d-flex align-items-center justify-content-center w-100">
                  <div class="row justify-content-center w-100">
                      <div class="col-md-8 col-lg-6 col-xxl-3">
                          <div class="card mb-0">
                              <div class="card-body">
                                  <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                      <img src="./images/logos/dark-logo.svg" width="180" alt="">
                                  </a>
                                  <p class="text-center">Your Social Campaigns</p>
                                  @if (session()->has('successRegist'))
                                      <div class="alert alert-success" role="alert">
                                          {{ session('successRegist') }}
                                      </div>
                                  @endif
                                  @if (session()->has('failedRegist'))
                                      <div class="alert alert-danger" role="alert">
                                          {{ session('failedRegist') }}
                                      </div>
                                  @endif
                                  <form action="{{ route('register.post') }}" method="POST">
                                      @csrf
                                      <div class="mb-3">
                                          <label for="exampleInputtext1" class="form-label">Name</label>
                                          <input type="text" class="form-control" id="exampleInputtext1"
                                              name="name" aria-describedby="textHelp" required
                                              value="{{ old('name') }}">
                                          @error('name')
                                              <h6 class="text-danger mt-2 ms-1">{{ $message }}</h6>
                                          @enderror
                                      </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                          <input type="email" class="form-control" id="exampleInputEmail1"
                                              name="email" aria-describedby="emailHelp" required
                                              value="{{ old('email') }}">
                                          @error('email')
                                              <h6 class="text-danger mt-2 ms-1">{{ $message }}</h6>
                                          @enderror
                                      </div>
                                      <div class="mb-4">
                                          <label for="exampleInputPassword1" class="form-label">Password</label>
                                          <input type="password" class="form-control" id="exampleInputPassword1"
                                              name="password" required value="{{ old('password') }}">
                                          @error('password')
                                              <h6 class="text-danger mt-2 ms-1">{{ $message }}</h6>
                                          @enderror
                                      </div>
                                      <div class="mb-4">
                                          <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                          <input type="password" class="form-control" id="exampleInputPassword1"
                                              name="confirmPassword" required>
                                          @error('confirmPassword')
                                              <h6 class="text-danger mt-2 ms-1">{{ $message }}</h6>
                                          @enderror
                                      </div>
                                      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                          Up</button>
                                      <div class="d-flex align-items-center justify-content-center">
                                          <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                          <a class="text-primary fw-bold ms-2" href="/login">Sign
                                              In</a>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-layout>
