<div>
    @section('title')
   All Requested-Blood
    @endsection
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-md-8">
                <h5 class="m-0 text-dark">
                    Showing Requested Blood <strong>{{ $requestedBloods->firstItem() }}</strong> to <strong>{{ $requestedBloods->lastItem() }}</strong> of <strong>{{ $requestedBloods->total() }}</strong> Requested Bloods
                </h5>
            </div><!-- /.col -->
            <div class="col-md-4">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item ">Requested Blood</li>
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
                                <input type="text"  wire:model="search" class="form-control form-control-sm" placeholder="Search User">
                            </div>

                            <!-- /.input-group -->
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm table-striped">
                                <thead class="">
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Need Blood</th>
                                        <th scope="col">Request By</th>
                                        <th scope="col">Need Bag</th>
                                        <th scope="col">Need Date</th>
                                        <th scope="col">Donar Count</th>
                                        <th scope="col">Request On</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($requestedBloods as $requestedBlood)
                                        <tr wire:loading.remove wire:target="nextPage,previousPage,gotoPage,per_page,search">
                                            <th scope="row">{{ $requestedBlood->id }}</th>
                                            <td>{{ $requestedBlood->bloodGroup->short_name }}</td>
                                            <td>{{ $requestedBlood->fromUser->name }}</td>
                                            <td>{{ $requestedBlood->blood_need_bag }}</td>
                                            <td>{{ $requestedBlood->blood_need_date }}</td>
                                            <td>{{ $requestedBlood->blood_request_agreement_count }}</td>
                                            <td>{{ $requestedBlood->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm"><i class="fa fa-pen text-info"></i></button>
                                                    <button class="btn btn-sm"><i class="fa fa-trash text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                           <tr>
                                               <td colspan="8" class="bg-danger text-white justify-content-center"><p class="text-center mb-0 mt-2">Country Not Found<p></td>
                                           </tr>
                                        @endforelse

                                        <tr wire:loading wire:target="nextPage,previousPage,gotoPage,per_page,search" class="mx-auto">
                                            <td colspan="8" class="">
                                                <div class="text-center">
                                                    <div class="btn btn-sm btn-primary text-center" type="button" disabled>
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                        Loading...
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                <tfoot>
                                    <tr style="border-top: 2px solid #dee2e6;">
                                        <th scope="col">#</th>
                                        <th scope="col">Need Blood</th>
                                        <th scope="col">Request By</th>
                                        <th scope="col">Need Bag</th>
                                        <th scope="col">Need Date</th>
                                        <th scope="col">Donar Count</th>
                                        <th scope="col">Request On</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer table-responsive">
                        {{ $requestedBloods->links() }}
                    </div>
                  </div>
              </div>
          </div>
</div>
