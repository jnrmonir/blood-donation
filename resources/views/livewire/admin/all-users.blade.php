<div>
    @section('title')
      All Users
    @endsection
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">All Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item ">All Users</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      {{-- content-header end --}}


          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header clearfix">
                          <div class="float-left">
                            <select class="form-control form-control-sm" wire:model="per_page" style="width: 100%;">
                                <option selected="selected" disabled="">Per Page</option>
                                    <option value="5" class="text-uppercase">5</option>
                                    <option value="10" class="text-uppercase">10</option>
                                    <option value="20" class="text-uppercase">20</option>
                                    <option value="50" class="text-uppercase">50</option>
                                    <option value="100" class="text-uppercase">100</option>
                                    <option value="500" class="text-uppercase">500</option>
                            </select>
                          </div>
                          <div class="search-form float-right">
                            <div class="input-group">
                                <input type="text" wire:model="search" class="form-control form-control-sm" placeholder="Search User">
                            </div>

                            <!-- /.input-group -->
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Blood</th>
                                        <th scope="col">Blood Request</th>
                                        <th scope="col">Blood Donate</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($users as $user)
                                    <tr wire:loading.remove wire:target="nextPage,gotoPage,previousPage,per_page,search">
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->bloodGroup->short_name }}</td>
                                        <td>{{ $user->blood_requests_count }}</td>
                                        <td>{{ $user->blood_request_agreement_count }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm"><i class="fa fa-eye text-primary"></i></button>
                                                <button class="btn btn-sm"><i class="fa fa-pen text-info"></i></button>
                                                <button class="btn btn-sm"><i class="fa fa-trash text-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                       <tr>
                                           <td colspan="5" class="bg-danger text-white justify-content-center">Country Not Found</td>
                                       </tr>
                                    @endforelse

                                    <tr wire:loading wire:target="nextPage,gotoPage,previousPage,per_page,search" class="mx-auto">
                                        <td colspan="5" class="">
                                            <div class="btn btn-sm btn-primary" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>

                                <tfoot>
                                    <tr style="border-top: 2px solid #dee2e6;">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Blood</th>
                                        <th scope="col">Blood Request</th>
                                        <th scope="col">Blood Donate</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer table-responsive">
                        {{ $users->links() }}
                    </div>
                  </div>
              </div>
          </div>
</div>
