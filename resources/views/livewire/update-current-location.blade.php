<div>
    <form>
        <div class="form-group row">
            <label for="present_country" class="col-sm-4 col-form-label">Present Country</label>
             <div class="col-sm-8">
                 <select name="present_country" class="form-control @error('present_country') is-invalid  @enderror" wire:model="newcountry" style="width: 100%;">
                     <option>Choose Current Country</option>
                     @foreach($countries as $country)
                         <option value="{{ $country->id }}">{{ $country->name }}</option>
                     @endforeach
                 </select>
                 @error('newcountry') <span class="error text-danger">{{ $message }}</span> @enderror
             </div>
         </div>

         @if($newcountry)
        <div class="form-group row">
            <label for="newstate" class="col-md-4 col-form-label text-left">State</label>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <select  id="newstate" class="form-control @error('newstate') is-invalid @enderror" name="newstate"  wire:model="newstate" style="width: 100%;">
                        <option>Choose State</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" >{{ $state->name }}</option>
                        @endforeach
                    </select>
                     @error('newstate') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        @endif

        @if($newstate)
        <div class="form-group row">
            <label for="newcity" class="col-md-4 col-form-label text-left">City</label>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <select  id="newcity" class="form-control @error('newcity') @enderror" name="newcity"  wire:model="newcity" style="width: 100%;">
                        <option>Choose City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                     @error('newcity') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        @endif

        @if($newcity)
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-left">Address</label>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input  id="address" type="text" wire:model.lazy="address" name="address" class="form-control @error('address') @enderror" placeholder="Full Address">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-map-marker-alt"></span>
                        </div>
                    </div>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        @endif

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
