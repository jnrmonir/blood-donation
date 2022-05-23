<div>

    @section('title')
    Blogs
    @endsection

    @section('description')
    blog post in blood bank 24
    @endsection

    @section('keywords')
    blog post in blood bank 24
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header bg-white shadow-sm">
        <div class="container clearfix">
            <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">Blog Posts</h1>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Blog Posts</li>
            </ol>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    {{-- main content --}}
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6 col-xl-6 mb-1">
                    <div class="search-form">
                    <div class="input-group">
                        <input type="search" name="search" wire:model.debounce.1000ms="search" class="form-control bg-dark" autofocus
                        placeholder="Real time Search here">

                        <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-default bg-dark"><i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                    <!-- /.input-group -->
                    </div>
                </div><!-- /.col -->



                <div class="col-12 col-sm-6 col-lg-6 col-xl-6 mb-1">
                    <select wire:model="filter" class="form-control bg-dark" style="width: 100%;">
                    <option selected="selected" value="latest">Latest Post</option>
                    <option value="viewer">Top Viewer Post</option>
                    <option value="popular">Popular Post</option>
                    </select>
                </div>

            </div>


            <div class="row mt-3">
                @forelse ($posts as $post)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                    <div class="card rounded-0 hoverable-card h-100">
                        <a href="{{ route('single_blog',$post->slug) }}"><div class="hover-zoom text-center" style="background-image: url({{ Storage::url('images/posts/'.$post->thumbnail)  }})">
                        </div></a>
                      <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('single_blog',$post->slug) }}" class="text-capitalize">{{ $post->title }}</a></h5>
                        <p class="card-text">
                           {{ Str::limit($post->content, 80, '...') }}
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
                      </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="card">
                        <h2 class="text-center text-danger text-capitalize mb-0">Post Does Not Found</h2>
                    </div>
                </div>
                @endforelse

                <div class="col-12 text-center" wire:loading>
                    <div class="spinner-grow text-danger" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-warning" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-success" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                 </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    {{ $posts->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>


</div>
