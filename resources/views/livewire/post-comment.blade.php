<div>
        @livewire('add-comment', ['post_id' => $post_id], key($post_id))
        <div class="row">
           <div class="col-md-12">

                <div class="card">
                   <div class="card-body">
                       <h2 class="mb-0">Total Comments <b>({{ $comments->total() }})</b></h2>
                       <hr>
                     <div class="card-widget widget-user-2 mb-2" wire:loading.remove wire:target="nextPage,previousPage,gotoPage">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        @forelse ($comments as $comment)
                        <div class="widget-user-header hoverable-card">
                            <div class="widget-user-image">
                            @if($comment->user->profile_photo_path != null)
                            <img class="img-circle elevation-2" src="{{ Storage::url('images/avatars/'.$comment->user->profile_photo_path) }}" alt="{{ $comment->user->name }}">
                            @else
                           <img class="img-circle elevation-2" src="{{ asset('images/avator.png') }}" alt="{{ $comment->user->name }}">

                            @endif
                            </div>
                            <!-- /.widget-user-image -->
                           <div class="">
                            <h3 class="widget-user-username d-inline ml-2 text-capitalize mr-2">{{ $comment->user->name }}</h3>
                            <span class="text-right">{{  $comment->updated_at->diffForHumans() }}</span>
                           </div>
                            <p class="widget-user-desc">
                              {{ $comment->comment }}
                            </p>
                        </div>
                        <hr class="my-0 py-0">
                        @empty
                            <h3 class="widget-user-username">Comment Has Empty</h3>
                        @endforelse
                       </div>
                       <div class="col-12 text-center" wire:loading wire:target="nextPage,previousPage,gotoPage">
                                <div class="spinner-grow text-danger" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-warning" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                                </div>

                        </div>
                       {{ $comments->links() }}
                   </div>
                </div>
           </div>
        </div>


</div>
