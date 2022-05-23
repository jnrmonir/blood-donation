<div>
    @section('title')
    {{ $post->title }}
    @endsection

    @section('description')
    {{ $post->title }}
    @endsection

    @section('keywords')
    {{ $post->title }}
    @endsection

<!-- Content Header (Page header) -->
<div class="content-header bg-white shadow-sm">
    <div class="container clearfix">
        <h1 class="text-gray text-capitalize float-left" style="font-size: 20px">{{ $post->title }}</h1>
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog') }}"><i class="fa fa-dashboard"></i> Blog Posts</a></li>
            <li class="breadcrumb-item active">{{ $post->title }}</li>
          </ol>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


    {{-- main content --}}
    <div class="content mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card rounded-0 hoverable-card">
                        <img src="{{ Storage::url('images/posts/'.$post->thumbnail)  }}" class="{{ $post->title }}" />
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $post->title }}</h5>

                        <p class="card-text">
                        {{ $post->content}}
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated {{ $post->updated_at->diffForHumans() }}</small></p>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="box-title bg-white py-2 px-2 h4">Recently Added Posts</h3>
                    @foreach ($recent_posts as $recent_post)
                    <div class="attachment-block clearfix">
                        <img class="attachment-img" src="{{ Storage::url('images/posts/'.$recent_post->thumbnail)  }}" alt="{{ $recent_post->title }}">

                        <div class="attachment-pushed">
                          <h4 class="attachment-heading h5 mb-0"><a href="{{ route('single_blog',$recent_post->slug) }}">{{ $recent_post->title }}</a></h4>
                          <span class="card-text p-0 m-0"><small class="text-muted m-0 p-0">{{ $recent_post->updated_at->diffForHumans() }} </small></span>
                          <div class="attachment-text d-flex">
                              <small class="mr-2"><i class="fa fa-thumbs-up"></i> 0</small>
                              <small class="mr-2"><i class="fa fa-eye"></i> {{ $recent_post->view_count }}</small>
                              <small><i class="fa fa-comments"></i> {{ $recent_post->comments_count }}</small>
                          </div>
                          <!-- /.attachment-text -->
                        </div>
                        <!-- /.attachment-pushed -->
                    </div>
                    @endforeach
                </div>
            </div>


            @livewire('post-comment', ['post_id' => $post->id], key($post->id))
        </div>
    </div>
</div>
