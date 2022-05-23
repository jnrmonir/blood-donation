<div>
    @section('title')
    All Posts
    @endsection
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark">
                        Showing Post <strong>{{ $posts->firstItem() }}</strong> to <strong>{{ $posts->lastItem() }}</strong> of <strong>{{ $posts->total() }}</strong> Posts
                    </h5>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <button class="btn btn-outline-info float-sm-right" data-toggle="modal" data-target="#categoryModal">
                        Add New
                    </button>
                </div>
                <!-- /.row -->
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
                            <table class="table table-hover table-bordered table-sm table-striped">
                                <thead class="">
                                    <tr class="">
                                        <th scope="col">#</th>
                                        <th scope="col">Post By</th>
                                        <th scope="col">title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Comments</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                        <tr wire:loading.remove wire:target="nextPage,gotoPage,previousPage,per_page,search">
                                            <th scope="row">{{ $post->id }}</th>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>{{ $post->status }}</td>
                                            <td>{{ $post->comments_count }}</td>
                                            <td><img style="height: 50px" src="{{ Storage::url('public/images/thumbnail/'.$post->thumbnail)}}"></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm"><i class="fa fa-eye text-primary"></i></button>
                                                    <button data-toggle="modal" data-target="#postEditModal" wire:click="edit('{{ $post->id }}')" class="btn btn-sm"><i class="fa fa-pen text-info"></i></button>
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
                                        <th scope="col">Post By</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Comments</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer table-responsive">
                        {{ $posts->links() }}
                    </div>
                  </div>
              </div>
          </div>



            {{-- Post add form modal --}}
            <div wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalCenterTitle">Add Posts</h5>
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="title" class="">Title</label>

                                        <div class="input-group mb-3">
                                            <input type="text" wire:model.lazy="title" class="form-control @error('title') is-invalid @enderror" autofocus placeholder="Full name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fab fa-elementor"></span>
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

                                        <div class="form-group">
                                            <label for="content" class="">Content</label>

                                            <div class="input-group mb-3">
                                                <div class="mb-3">
                                                    <textarea wire:model.lazy="content" class="textarea @error('content') is-invalid @enderror"  placeholder="Place some text here"
                                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                  </div>
                                                @error('content')
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

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="category_name" class="">Category Name</label>

                                            <div class="input-group mb-3">
                                                <select wire:model.lazy="categoryName" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName">
                                                    <option value="">Choose Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('categoryName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="thumbnail" class="">Thumbnail</label>

                                            <div class="input-group mb-3">
                                                <input type="file" wire:model.lazy="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" autofocus placeholder="Full name">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-images"></span>
                                                    </div>
                                                </div>
                                                @error('thumbnail')
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
            </div>

            {{-- Post Edit, Update, Delete Form --}}
            @if($status)
            <div wire:ignore.self class="modal fade" id="postEditModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalCenterTitle">Add Posts</h5>
                        @if (session()->has('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                    <form>
                                        <input type="hidden" value="post_id">
                                        <div class="form-group">
                                            <label for="editTitle" class="">Title</label>

                                        <div class="input-group mb-3">
                                            <input type="text" wire:model.lazy="editTitle" class="form-control @error('editTitle') is-invalid @enderror" autofocus placeholder="Full name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fab fa-elementor"></span>
                                                </div>
                                            </div>
                                            @error('editTitle')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="editSlug" class="">Slug</label>

                                        <div class="input-group mb-3">
                                            <input type="text" wire:model.lazy="editSlug" name="slug" class="form-control @error('editSlug') is-invalid @enderror" autofocus placeholder="enter slug">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fa fa-book-reader"></span>
                                                </div>
                                            </div>
                                            @error('editSlug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="editContent" class="">Content</label>

                                            <div class="input-group mb-3">
                                                <div class="mb-3">
                                                    <textarea wire:model.lazy="editContent" class="textarea @error('editContent') is-invalid @enderror"  placeholder="Place some text here"
                                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                  </div>
                                                @error('editContent')
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

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <input type="hidden" value="post_id">
                                            <div class="form-group">
                                                <label for="category_name" class="">Category Name</label>

                                            <div class="input-group mb-3">
                                                <select wire:model.lazy="editCategoryName" class="form-control @error('editCategoryName') is-invalid @enderror" id="editCategoryName">
                                                    <option value="">Choose Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('editCategoryName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="editThumbnail" class="">Thumbnail</label>
                                                <img style="height: 50px" src="{{ Storage::url('public/images/thumbnail/'.$post->thumbnail)}}">
                                            <div class="input-group mb-3">
                                                <input type="file" wire:model.lazy="editThumbnail" class="form-control @error('editThumbnail') is-invalid @enderror" autofocus placeholder="Full name">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-images"></span>
                                                    </div>
                                                </div>
                                                @error('editThumbnail')
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
            </div>
            @endif
</div>
