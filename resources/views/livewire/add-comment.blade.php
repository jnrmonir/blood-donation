<div>
    <div class="row">
           <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                       <label>
                       Comment :
                       </label>
                       <textarea wire:model.lazy="comment" class="form-control @error('comment') is-invalid @enderror" rows="5"></textarea>
                       @error('comment')
                         <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                         </div>
                       @enderror
                     </div>
                     <div class="form-group">
                       {{-- @auth  --}}
                        <button wire:click="submit" class="btn btn-danger">
                            <span wire:loading.remove wire:target="submit">Submit</span>
                            <span wire:loading wire:target="submit">Processing..</span>
                        </button>
                       {{-- @endauth

                       @guest 
                        <a href="{{ route('login') }}">Please Login Then Comment Here</a>
                       @endguest --}}
                       

                     </div>
                  </div>
              </div>
           </div>
        </div>


                    @if (session()->has('status'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('status') }}'
            });
        });

    </script>
@endif

@if (session()->has('wrong'))
    <script>
        $(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: 'error',
                title: '{{ session('wrong') }}'
            });
        });

    </script>
@endif
</div>
