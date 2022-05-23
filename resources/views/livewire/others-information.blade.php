<div>
    <form>
        <div class="form-group row">
          <label for="alt_contact_number" class="col-sm-4 col-form-label">Emergency Phone</label>
          <div class="col-sm-8">
              <input type="tel" class="form-control" id="alt_contact_number" wire:model.lazy="alt_contact_number" wire:model.lazy="alt_contact_number">
              @error('alt_contact_number') <span class="error text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

         <div class="form-group row">
          <label for="date" class="col-sm-4 col-form-label">Birth Day</label>
          <div class="col-sm-8">
              <input type="date"  class="form-control" id="date" wire:model.lazy="date" placeholder="MM/DD/YYY" value="">
          </div>
      	</div>

      	<div class="form-group row">
      		<label for="gender"  class="col-sm-4 col-form-label">Gender</label>
      		<div class="col-sm-8">
      			<div class="form-check">
      			   <input class="form-check-input" type="radio" wire:model.lazy="gender" name="male" id="male" value="1" checked>
      			   <label class="form-check-label" for="male">
      			     Male
      			   </label>
      			</div>

      			<div class="form-check">
      			   <input class="form-check-input" wire:model.lazy="gender" type="radio" name="female" id="female" value="0">
      			   <label class="form-check-label" for="female">
      			     Female
      			   </label>
      			</div>

      			<div class="form-check">
      			   <input class="form-check-input" type="radio" wire:model.lazy="gender" name="others" id="others" value="2">
      			   <label class="form-check-label" for="others">
      			     Others
      			   </label>
      			</div>
        	</div>
      	</div>

        <div class="form-group row">
            <label class="col-md-4">Area Representative</label>
            <div class="col-md-8">
                <input type="checkbox" wire:model="area_representive"/>  Apply for Area representative
            </div>
        </div>

        <div class="form-group row">
           <label for="save" class="col-sm-4 col-form-label"></label>
           <div class="col-sm-8">
               <button type="button" wire:click="submit" class="btn btn-secondary border border-dark border-2">Save
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
