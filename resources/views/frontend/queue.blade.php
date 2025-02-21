<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Queue Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            padding: 5rem 0;
        }

        .card {
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .queue-number {
            font-size: 6.5rem;
            font-weight: bold;
        }

        .info-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6c757d;
        }

        .info-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        #clock {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <h1>Queue Number</h1>
                    <h3 class="queue-number">{{ $currentPatient ? $currentPatient->queue_number : '-' }}</h3>
                    <div id="clock"></div>
                </div>
            </div>
            <div class="col-md-6">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/t0YahM-5ngw" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <p class="info-title">Patient Name</p>
                    <p class="info-value">{{ $currentPatient ? $currentPatient->patient->name : '-' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <p class="info-title">To Doctor</p>
                    <p class="info-value">dr. {{ $currentPatient ? $currentPatient->doctor->name : '-' }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <p class="info-title">Status</p>
                    <p class="info-value">{{ $currentPatient ? $currentPatient->status : '-' }}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <h3 class="p-5">Next Queue</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Queue Number</th>
                            <th>Patient Name</th>
                            <th>To Doctor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nextPatients as $patient)
                        <tr>
                            <td>{{ $patient->queue_number }}</td>
                            <td>{{ $patient->patient->name }}</td>
                            <td>dr. {{ $patient->doctor->name }}</td>
                            <td>
                                @if ($patient->status == 'Waiting')
                                <span class="badge bg-warning text-dark">Waiting</span>
                                @elseif ($patient->status == 'In Progress')
                                <span class="badge bg-primary">In Progress</span>
                                @elseif ($patient->status == 'Completed')
                                <span class="badge bg-success">Completed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            let hours = now.getHours().toString().padStart(2, "0");
            let minutes = now.getMinutes().toString().padStart(2, "0");
            let seconds = now.getSeconds().toString().padStart(2, "0");
            document.getElementById("clock").innerHTML = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <script>
        setInterval(function() {
            location.reload(); // Auto refresh setiap 10 detik
        }, 10000);
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>