import "./bootstrap";
//require("flatpickr");
//require("../../node_modules/sweetalert2/src/SweetAlert");

import Alpine from "alpinejs";
import flatpickr from "flatpickr";
import SlimSelect from "slim-select";
import Chart from "chart.js/auto";
import jspdf from "jspdf";
import "chartjs-adapter-luxon";

window.Chart = Chart;
window.SlimSelect = SlimSelect;
window.Alpine = Alpine;
window.jspdf = jspdf;
window.flatpickr = flatpickr;

Alpine.start();
