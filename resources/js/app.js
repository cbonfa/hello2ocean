import './bootstrap';

// Livewire 4 já inclui o Alpine; usamos a instância dele para registrar plugins.
// Os layouts usam @livewireScriptConfig no lugar de @livewireScripts.
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import mask from '@alpinejs/mask';
import TomSelect from 'tom-select';

window.TomSelect = TomSelect;

Alpine.plugin(mask);
Livewire.start();
