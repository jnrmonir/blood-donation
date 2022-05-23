
<div>
    <div class="card rounded-0 mt-2">
        <div class="card-header">
            <strong>{{ __('Present Address') }}</strong><br>
            Update your account\'s location information present
        </div>
        <div class="card-body">


            @livewire('update-current-location')

        </div>
    </div>

    <div class="card rounded-0 mt-2">
        <div class="card-header">
            <strong>{{ __('Permanent Address') }}</strong><br>
            Update your account\'s location information permanent
        </div>
        <div class="card-body">

            @livewire('update-permanent-location')

        </div>
    </div>

    <div class="card rounded-0 mt-2">
        <div class="card-header">
            <strong>{{ __('Others Information') }}</strong><br>
            Update your account\'s location information permanent
        </div>
        <div class="card-body">

            @livewire('others-information')

        </div>
    </div>
</div>

