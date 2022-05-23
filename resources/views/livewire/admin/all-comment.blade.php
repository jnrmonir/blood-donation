<div>
    @section('title')
    All Comment
    @endsection
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">
                    Showing Comment <strong>{{ $comments->firstItem() }}</strong> to <strong>{{ $comments->lastItem() }}</strong> of <strong>{{ $comments->total() }}</strong> Comments
                </h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item ">All Comments</li>
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
                                        <th scope="col">Comment</th>
                                        <th scope="col">Comment By</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($comments as $comment)
                                        <tr wire:loading.remove wire:target="nextPage,gotoPage,previousPage,per_page,search">
                                            <th scope="row">{{ $comment->id }}</th>
                                            <td>{{ $comment->comment }}</td>
                                            <td>{{ $comment->user->name }}</td>
                                            <td>{{ $comment->post->title }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button wire:click="edit('{{ $comment->id }}')" data-toggle="modal" data-target="#commentModal" class="btn btn-sm"><i class="fa fa-pen text-info"></i></button>
                                                    <button wire:click="delete('{{ $comment->id }}')" class="btn btn-sm"><i class="fa fa-trash text-danger"></i></button>
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
                                        <th scope="col">Comment</th>
                                        <th scope="col">Comment By</th>
                                        <th scope="col">Post</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                      </div>
                      <div class="card-footer table-responsive">
                          {{ $comments->links() }}
                      </div>
                  </div>
              </div>
          </div>

          {{-- Comment Edit,Update,Delete Modal --}}
          @if($status)
          <div wire:ignore.self class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalCenterTitle">Update Comment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="card">
                      <div class="card-body">
                          <form>
                            <input type="hidden" wire:model="comment_id">
                            <div class="form-group">
                                <label for="name" class="">Name</label>

                            <div class="input-group mb-3">
                                <input type="text" wire:model.lazy="name" class="form-control @error('name') is-invalid @enderror" autofocus placeholder="Full name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-user-alt"></span>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="">Title</label>

                            <div class="input-group mb-3">
                                <input type="text" wire:model.lazy="title" name="title" class="form-control @error('title') is-invalid @enderror" autofocus placeholder="enter title">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-book-reader"></span>
                                    </div>
                                </div>
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>

                            <div class="form-group">
                                <label for="Comments" class="">Comments</label>

                            <div class="input-group mb-3">
                                <input type="text" wire:model.lazy="Comments" class="form-control @error('Comments') is-invalid @enderror" autofocus placeholder="enter Comments">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fa fa-pen"></span>
                                    </div>
                                </div>
                                @error('Comments')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </div>
                          </form>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" wire:click="update" class="btn btn-primary">
                        <span wire:loading class="text-left">
                            <span class="spinner-border spinner-border-sm text-success" role="status">
                                <span class="sr-only">Loading..</span>
                            </span>
                        </span>
                        Save changes
                    </button>
                </div>
              </div>
            </div>
          </div>
          @endif
</div>
