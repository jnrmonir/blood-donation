<div>
    <form>
        <div class="form-group row">
            <label for="inputPassword1" class="col-sm-4 col-form-label">Old Password</label>
            <div class="col-sm-8">
                <input type="password" wire:model.lazy="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="inputPassword1" placeholder="old Password">
                @if($error != '')
                <span class="error text-danger">{{ $error }}</span>
                @endif
            </div>
        </div>


        <div class="form-group row" >
            <label for="inputPassword32" class="col-sm-4 col-form-label">New Password</label>
            <div class="col-sm-8">
                <input type="password"  wire:model.lazy="password" @if ($status==false) disabled @endif   class="form-control @error('password') is-invalid @enderror" id="inputPassword2" placeholder="new Password">
                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>



        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" name="password_confirmation" wire:model.lazy="password_confirmation" @if ($status==false) disabled @endif class="form-control @error('password') is-invalid @enderror" id="inputPassword3" placeholder="confirmation Password">
                @error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="save" class="col-sm-4 col-form-label"></label>
            <div class="col-sm-8">
                <button type="button" wire:click="submit" @if ($status==false) disabled @endif class="btn btn-secondary border border-dark border-2">Save
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
