<form>
  <div class="custom-control custom-switch">
    <input wire:click="changeValue" id="multiple-user-roles" type="checkbox" class="custom-control-input" @if ($value == 1) checked @endif>
    <label for="multiple-user-roles" class="custom-control-label">Allow multiple user roles</label>
  </div>
</form>
