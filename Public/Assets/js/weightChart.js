var ctx = document.getElementById('myChart').getContext('2d');

var dates = [];
var weights = [];
var duration = 14;

for (var i=0; i<weightTracking.length; i++) {
	weights[i] = weightTracking[i]['wt_weight'];
	dates[i] = weightTracking[i]['wt_date'];
}

Chart.scaleService.updateScaleDefaults('linear', {
    ticks: {
        min: 40
    }
});

var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',
    data: {
        labels: dates,
        datasets: [{
            label: 'Weight (kg)',
            backgroundColor: 'rgba(72, 199, 116, 0.7)',
            borderColor: 'rgba(0, 0, 0, 0.85)',
            borderWidth: 5,
            barThickness: 1,
            data: weights
        }]
    },
    options: {
    	scales: {
    		// Y axis
    		yAxes: [{
	    		gridLines: {
	    			display: false
	    		},
	    		scaleLabel: {
	    			display: true
	    		}
	    	}],
	    	// X axis
	    	xAxes: [{
	    		gridLines: {
	    			display: false
	    		},
	    		scaleLabel: {
	    			display: true
	    		}
	    	}]
    	}
    }
});

