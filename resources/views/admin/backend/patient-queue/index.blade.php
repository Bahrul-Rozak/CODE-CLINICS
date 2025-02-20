@extends('admin.master')

@section('content')
<div class="container-fluid">
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Daily Patient Queue</h3>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5%;" class="text-center">No</th>
                    <th>Queue Number</th>
                    <th>Registration Time</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Service</th>
                    <th>Birth Date</th>
                    <th>Complaint</th>
                    <th>Doctor</th>
                    <th>National ID (NIK)</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queue_data as $queue)
                <tr>
                    <td class="text-center">{{ $loop->iteration  }}</td>
                    <td>{{ $queue->queue_number }}</td>
                    <td>{{ $queue->created_at }}</td>
                    <td>
                        @if ($queue->status == 'Waiting')
                        <span class="badge badge-warning">Waiting</span>
                        @elseif ($queue->status == 'In Progress')
                        <span class="badge badge-primary">In Progress</span>
                        @elseif ($queue->status == 'Completed')
                        <span class="badge badge-success">Completed</span>
                        @else
                        <span class="badge badge-secondary">{{ ucfirst($queue->status) }}</span>
                        @endif
                    </td>

                    <td>{{ $queue->patient->name }}</td>
                    <td>{{ $queue->service }}</td>
                    <td>{{ $queue->patient->birth_date }}</td>
                    <td>{{ $queue->complaint }}</td>
                    <td>dr. {{ $queue->doctor->name }}</td>
                    <td>{{ $queue->patient->national_id }}</td>
                    <td>
                        <a href="{{ route('patient-queue.edit', $queue->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('patient-queue.destroy', $queue->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                        <button onclick="callQueue('{{ $queue->queue_number }}')" class="btn btn-secondary">🔊</button>
                        <script>
                            function callQueue(queueNumber) {
                                let msg = new SpeechSynthesisUtterance(`Queue number ${queueNumber}, please proceed.`);

                                // Atur suara yang lebih manusiawi
                                msg.voice = speechSynthesis.getVoices().find(voice => voice.name.includes("Google UK English Male")) || speechSynthesis.getVoices()[0];
                                msg.rate = 0.9; // Kecepatan bicara (0.1 - 10, default 1)
                                msg.pitch = 1.2; // Nada suara (0 - 2, default 1)
                                msg.volume = 1; // Volume (0 - 1)

                                window.speechSynthesis.speak(msg);
                            }
                        </script>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection