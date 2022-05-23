<div>
    @section('title')
    All-Category
    @endsection
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <button class="btn btn-outline-info float-sm-right" data-toggle="modal" data-target="#categoryModal">
                    Add New
                </button>

                {{-- Category form modal --}}
                <div wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalCenterTitle">Add Category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="card">
                              <div class="card-body">
                                  <form>
                                    <div class="form-group">
                                        <label for="category_name" class="">Category Name</label>

                                    <div class="input-group mb-3">
                                        <input type="text" wire:model.lazy="categoryName" class="form-control @error('categoryName') is-invalid @enderror" autofocus placeholder="Full name">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-user-alt"></span>
                                            </div>
                                        </div>
                                        @error('categoryName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug" class="">Slug</label>

                                    <div class="input-group mb-3">
                                        <input type="text" wire:model.lazy="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" autofocus placeholder="enter slug">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fa fa-book-reader"></span>
                                            </div>
                                        </div>
                                        @error('slug')
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
                          <button type="submit" wire:click="submit" class="btn btn-primary">
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
                        <table class="table table-hover table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Post Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody >
                                    @forelse ($categories as $category)
                                    <tr wire:loading.remove wire:target="nextPage,gotoPage,previousPage,per_page,search">
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->posts->count() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="modal" data-target="#exampleModalCenter" wire:click="edit('{{ $category->id }}')" class="btn btn-sm"><i class="fa fa-pen text-info"></i></button>
                                                <button wire:click="delete('{{ $category->id }}')"  class="btn btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash text-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                       <tr>
                                           <td colspan="5" class="">Category Not Found</td>
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
                                    <th scope="col">Slug</th>
                                    <th scope="col">Post Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $categories->links() }}
                    </div>
                  </div>
              </div>


          {{-- Category Edit Modal --}}
          @if($status)
  <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <form>
                        <input type="hidden" wire:model="category_id">
                      <div class="form-group">
                          <label for="category_name" class="">Category Name</label>
                        <div class="input-group mb-3">
                            <input type="text" wire:model="editCategoryName" class="form-control @error('categoryName') is-invalid @enderror" autofocus placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-user-alt"></span>
                                </div>
                            </div>
                            @error('categoryName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="slug" class="">Slug</label>
                        <div class="input-group mb-3">
                            <input type="text" wire:model.lazy="editSlug" name="slug" class="form-control @error('slug') is-invalid @enderror" autofocus placeholder="enter slug">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-book-reader"></span>
                                </div>
                            </div>
                            @error('slug')
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
</div>




