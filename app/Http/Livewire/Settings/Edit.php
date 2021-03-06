<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class Edit extends Component {
  public $setting;
  public $value;
  public function mount($setting) {
    $this->setting = $setting;
    $this->value = $this->setting->value;
  }
  public function changeValue() {
    $this->value = $this->value == '1' ? '0' : '1';
    Setting::where('id', $this->setting->id)->update([
      'value' => $this->value,
    ]);
  }
  public function render() {
    return view('livewire.settings.edit');
  }
}
