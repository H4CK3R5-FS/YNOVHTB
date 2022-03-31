"use strict";

// $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115, 50], {
//     type: 'line',
//     height: '70',
//     width: '100%',
//     lineWidth: '2',
//     lineColor: 'rgba(255, 255, 255, .5)',
//     fillColor: 'rgba(255, 255, 255, .15)'
// });


// $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115, 200], {
//     type: 'line',
//     height: '70',
//     width: '100%',
//     lineWidth: '2',
//     lineColor: 'rgba(255, 255, 255, .5)',
//     fillColor: 'rgba(255, 255, 255, .15)'
// });

// Cicle Chart
Circles.create({
	id:           'task-complete',
	radius:       50,
	value:        20, // le pourcentage du niveau
	maxValue:     100,
	width:        5,
	text:         function(value){return value + '%';},
	colors:       ['#36a3f7', '#fff'],
	duration:     400,
	wrpClass:     'circles-wrp',
	textClass:    'circles-text',
	styleWrapper: true,
	styleText:    true
})

//Chart

var ctx = document.getElementById('statisticsChart').getContext('2d');

var statisticsChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [ {
			label: "Active Users",
			borderColor: '#177dff',
			pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
			pointRadius: 0,
			backgroundColor: 'rgba(23, 125, 255, 0.4)',
			legendColor: '#177dff',
			fill: true,
			borderWidth: 2,
			data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 200]
		}]
	},
	options : {
		responsive: true, 
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		tooltips: {
			bodySpacing: 4,
			mode:"nearest",
			intersect: 0,
			position:"nearest",
			xPadding:10,
			yPadding:10,
			caretPadding:10
		},
		layout:{
			padding:{left:5,right:5,top:15,bottom:15}
		},
		scales: {
			yAxes: [{
				ticks: {
					fontStyle: "500",
					beginAtZero: false,
					maxTicksLimit: 5,
					padding: 10
				},
				gridLines: {
					drawTicks: false,
					display: false
				}
			}],
			xAxes: [{
				gridLines: {
					zeroLineColor: "transparent"
				},
				ticks: {
					padding: 10,
					fontStyle: "500"
				}
			}]
		}	 
	}
});