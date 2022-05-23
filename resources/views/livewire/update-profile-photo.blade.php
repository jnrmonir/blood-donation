<div>


        <form>
          <div class="form-group row">
              <label for="photo" class="col-sm-4 col-form-label">Photo</label>
              <div class="col-sm-8">
                    @if(Auth::user()->profile_photo_path != null)
                        <img src="{{ Storage::url('images/avatars/'.Auth::user()->profile_photo_path) }}" class="img-fluid">
                    @endif

                    @if ($photo)
                        @unless($status)
                        <img src="{{ $photo->temporaryUrl() }}" class="img-fluid">
                        @endunless
                    @endif

                    <div wire:loading wire:target="photo">
                    <span class="spinner-border spinner-border-sm text-success" role="status">
                        <span class="sr-only">Loading..</span>
                    </span>
                    Processing...
                    </div>

                  <input type="file" class="form-control mt-2" wire:model.lazy="photo" name="photo" id="photo">
                  @error('photo') <span class="error text-danger">{{ $message }}</span> @enderror



              </div>
          </div>

          <div class="form-group row">
              <label for="save" class="col-sm-4 col-form-label"></label>
              <div class="col-sm-8">
                  <button type="button" wire:click="submit"  class="btn btn-secondary border border-dark border-2">
                    <div wire:loading wire:target="submit">
                        <span class="spinner-border spinner-border-sm text-success" role="status">
                            <span class="sr-only">Loading..</span>
                        </span>
                        Saving..
                    </div>
                    <span wire:loading.remove>Save</span>
                  </button>
              </div>
          </div>
          </form>
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
