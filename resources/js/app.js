import "./bootstrap"; 

import "../css/app.css";
import "../scss/app.scss";
import '../css/style.css';
import '@fortawesome/fontawesome-free/css/all.css';

import Alpine from "alpinejs";
import flatpickr from "flatpickr";
import SlimSelect from "slim-select";
import Chart from "chart.js/auto";
import jspdf from "jspdf";
import "chartjs-adapter-luxon";
import { Notyf } from "notyf";

window.Alpine = Alpine;
window.flatpickr = flatpickr;
window.SlimSelect = SlimSelect;
window.Chart = Chart;
window.jspdf = jspdf;
window.Notyf = Notyf;

Alpine.start();