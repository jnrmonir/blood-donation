{{--<x-jet-form-section submit="updatePassword">--}}
{{--    <x-slot name="title">--}}
{{--        {{ __('Update Password') }}--}}
{{--    </x-slot>--}}

{{--    <x-slot name="description">--}}
{{--        {{ __('Ensure your account is using a long, random password to stay secure.') }}--}}
{{--    </x-slot>--}}

{{--    <x-slot name="form">--}}
{{--        <div class="col-span-6 sm:col-span-4">--}}
{{--            <x-jet-label for="current_password" value="{{ __('Current Password') }}" />--}}
{{--            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />--}}
{{--            <x-jet-input-error for="current_password" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="col-span-6 sm:col-span-4">--}}
{{--            <x-jet-label for="password" value="{{ __('New Password') }}" />--}}
{{--            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />--}}
{{--            <x-jet-input-error for="password" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="col-span-6 sm:col-span-4">--}}
{{--            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
{{--            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />--}}
{{--            <x-jet-input-error for="password_confirmation" class="mt-2" />--}}
{{--        </div>--}}
{{--    </x-slot>--}}

{{--    <x-slot name="actions">--}}
{{--        <x-jet-action-message class="mr-3" on="saved">--}}
{{--            {{ __('Saved.') }}--}}
{{--        </x-jet-action-message>--}}

{{--        <x-jet-button>--}}
{{--            {{ __('Save') }}--}}
{{--        </x-jet-button>--}}
{{--    </x-slot>--}}
{{--</x-jet-form-section>--}}

<div>
    <div class="card rounded-0 mt-2">
        <div class="card-header">
            <strong>{{ __('Update Password') }}</strong><br>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </div>
        <div class="card-body">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model="photo"
                           x-ref="photo"
                           x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                    </div>

                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    @if ($this->user->profile_photo_path)
                        <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-jet-secondary-button>
                    @endif

                    <x-jet-input-error for="photo" class="mt-2" />
                </div>
            @endif


            @livewire('update-password')
        </div>
    </div>
</div>
