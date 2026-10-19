import Alpine from 'alpinejs';
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';
import { cvPhotoCropper } from './photo-cropper.js';

window.Alpine = Alpine;
window.Cropper = Cropper;
window.cvPhotoCropper = cvPhotoCropper;

Alpine.data('cvPhotoCropper', cvPhotoCropper);

Alpine.start();
