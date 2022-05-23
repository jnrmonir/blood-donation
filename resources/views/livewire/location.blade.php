<div>
    <div class="form-group row">
        <label  class="col-md-4 col-form-label text-left">Blood Group</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <select  name="newbloodgroup" class="form-control @error('newbloodgroup') is-invalid  @enderror" wire:model="newbloodgroup" style="width: 100%;">
                    <option>Choose blood group</option>
                    @foreach($bloodGroups as $bloodGroup)
                        <option value="{{ $bloodGroup->id }}">{{ $bloodGroup->full_name }}</option>
                    @endforeach
                </select>

                @error('newbloodgroup')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>


    <div class="form-group row">
        <label  class="col-md-4 col-form-label text-left">Country</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <select  class="form-control @error('newcountry') is-invalid @enderror" name="newcountry" wire:model="newcountry" style="width: 100%;">
                    <option>Choose Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @auth @if($country->id == Auth::user()->profile->present_country_id) selected @endif @endauth>{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('newcountry')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>




    @if($newcountry)
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-left">State</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <select   class="form-control @error('newstate') is-invalid @enderror" name="newstate"  wire:model="newstate" style="width: 100%;">
                    <option>Choose State</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('newstate')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    @endif

    @if($newstate)
    <div class="form-group row">
        <label  class="col-md-4 col-form-label text-left">City</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <select   class="form-control @error('newcity') @enderror" name="newcity"  wire:model="newcity" style="width: 100%;">
                    <option>Choose City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('newcity')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    @endif

    @if($newcity)
    <div class="form-group row">
        <label  class="col-md-4 col-form-label text-left">Address</label>
        <div class="col-sm-8">
            <div class="input-group mb-3">
                <input   type="text" wire:model.lazy="address" name="address" class="form-control @error('address') @enderror" placeholder="Full name">
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
</div>
