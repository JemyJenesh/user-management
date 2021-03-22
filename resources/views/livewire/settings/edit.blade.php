<form>
  <div class="custom-control custom-switch">
    <input id="multiple-user-roles" type="checkbox" class="custom-control-input" wire:model="value" @if ($value === 1) checked @else @endif>
    <label for="multiple-user-roles" class="custom-control-label">Allow multiple user roles</label>
  </div>
</form>
