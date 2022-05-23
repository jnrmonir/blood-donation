<div>

    <form>
      <div class="form-group row">
          <label for="name" class="col-sm-4 col-form-label">Name</label>
          <div class="col-sm-8">
              <input type="text" class="form-control" wire:model.lazy="name" name="name" id="name">
              @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="phone" class="col-sm-4 col-form-label">Phone</label>
          <div class="col-sm-8">
              <input type="tel" class="form-control" id="phone" name="phone" wire:model.lazy="phone">
              @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

      <div class="form-group row">
          <label for="bloodgroup" class="col-sm-4 col-form-label">Blood Group</label>
          <div class="col-sm-8">
              <select wire:model.lazy="newbloodgroup" name="newbloodgroup" class="form-control @error('newbloodgroup') is-invalid  @enderror" wire:model="newbloodgroup" style="width: 100%;">
                  <option>Choose blood group</option>
                  @foreach(\App\Models\BloodGroup::all() as $bloodGroup)
                      <option value="{{ $bloodGroup->id }}">{{ $bloodGroup->full_name }}</option>
                  @endforeach
              </select>
              @error('newbloodgroup') <span class="error text-danger">{{ $message }}</span> @enderror
          </div>
      </div>


      <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label">Email</label>
          <div class="col-sm-8">
              <input type="text" @if ($status==false) disabled @endif class="form-control" id="email" value="{{ Auth::user()->email }}">
          </div>
      </div>

      <div class="form-group row">
          <label for="save" class="col-sm-4 col-form-label"></label>
          <div class="col-sm-8">
              <button type="button" wire:click="submit"  class="btn btn-secondary border border-dark border-2">Save
                <div wire:loading>
                    <span class="spinner-border spinner-border-sm text-success" role="status">
                        <span class="sr-only">Loading..</span>
                    </span>
                </div>
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
