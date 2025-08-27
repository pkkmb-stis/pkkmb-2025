import "./bootstrap";
import "../css/app.css";
import "../scss/app.scss";

import Alpine from "alpinejs";
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

Alpine.start();
