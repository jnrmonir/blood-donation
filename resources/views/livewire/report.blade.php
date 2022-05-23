<div>
    <div class="search-form">
        <div class="input-group">
            <input type="text" wire:model.lazy="report" name="report" class="form-control @error('report') is-invalid @enderror" placeholder="Write Your report here">

            <div class="input-group-append">
                <button type="button" @guest disabled @endguest name="submit" wire:click="send" class="btn btn-warning">
                    <span wire:loading.remove><i class="fas fa-paper-plane"></i></span>
                    <div class="spinner-grow spinner-grow-sm text-primary" wire:loading role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                </button>
            </div>
            @error('report')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- /.input-group -->
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
