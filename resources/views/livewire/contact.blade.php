<div>
    {{-- <p><p> --}}
    <div class="input-group mb-3">
        <input type="text" wire:model.lazy="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror" autocomplete="true" autofocus="true" required placeholder="Full name">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-user-alt"></span>
            </div>
        </div>
        @error('full_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror


    </div>

    <div class="input-group mb-3">
        <input type="email" wire:model.lazy="email" name="email" class="form-control @error('email') is-invalid @enderror" autofocus autocomplete="true" aria-autocomplete="both" required placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="tel" wire:model.lazy="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" autocomplete="true" autofocus required aria-autocomplete="both"  placeholder="Phone">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-phone-alt"></span>
            </div>
        </div>
        @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input type="tel" wire:model.lazy="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="subject">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fa fa-book"></span>
            </div>
        </div>
        @error('subject')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <textarea wire:model.lazy="message" name="message" class="form-control @error('message') is-invalid @enderror" placeholder="write You message" rows="5"></textarea>

        @error('message')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


        <button wire:click="send" type="button"  class="btn btn-danger">
            <span wire:loading class="text-left">
                <span class="spinner-border spinner-border-sm text-success" role="status">
                    <span class="sr-only">Loading..</span>
                </span>
             Loading..
            </span>

            <span wire:loading.remove><i class="fas fa-paper-plane"></i> Send</span>

        </button>



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
