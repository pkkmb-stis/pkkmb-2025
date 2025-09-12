import "./bootstrap";
import "../css/app.css";
import "../scss/app.scss";

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import flatpickr from "flatpickr";
import SlimSelect from "slim-select";
import Chart from "chart.js/auto";
import jspdf from "jspdf";
import "chartjs-adapter-luxon";
import { Notyf } from "notyf";
import '@fortawesome/fontawesome-free/css/all.css';

window.Chart = Chart;
window.SlimSelect = SlimSelect;
window.Alpine = Alpine;
window.jspdf = jspdf;
window.flatpickr = flatpickr;
window.Notyf = Notyf;

Livewire.start();
