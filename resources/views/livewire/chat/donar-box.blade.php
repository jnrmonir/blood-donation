<div>
    <div class="input-group">
        <input type="text" wire:model.lazy="body" wire:keydown.enter="send"  required placeholder="Type Message ..." class="form-control @error('body') @enderror">
        <span class="input-group-append">
          <button type="button" wire:click="send" class="btn btn-primary">Send</button>
        </span>
      </div>
</div>
