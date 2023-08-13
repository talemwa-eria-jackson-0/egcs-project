












document.addEventListener('DOMContentLoaded', function () {
    // Your existing JavaScript code for the pie chart
    var acceptedRequests = <?php echo $acceptedRequests ?>;
    var rejectedRequests = <?php echo $rejectedRequests ?>;
    var pendingRequests = <?php echo $pendingRequests ?>;

    var ctx = document.getElementById('requestsPieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Accepted', 'Rejected', 'Pending'],
            datasets: [{
                data: [acceptedRequests, rejectedRequests, pendingRequests],
                backgroundColor: ['#28a745', '#dc3545', '#ffc107'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            }
        }
    });

