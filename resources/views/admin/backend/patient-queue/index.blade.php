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
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Delete</button>
                        </form>
                        <button onclick="callQueue('Nomor antrean {{ $queue->queue_number }}, atas nama {{ $queue->patient->name }}, silahkan menuju ke dokter {{ $queue->doctor->name }}, terima kasih...')" class="btn btn-primary">Call Queue</button>

                        <script>
                            function callQueue(fullText) {
                                let audio = new Audio("https://www.myinstants.com/media/sounds/ding-sound-effect_2.mp3"); // Suara ding dong
                                audio.play(); // Mainkan suara

                                audio.onended = function() {
                                    setTimeout(() => { // Tambah delay biar voice-nya ke-load dulu
                                        let msg = new SpeechSynthesisUtterance(fullText);

                                        let voices = speechSynthesis.getVoices();
                                        let indonesianVoice = voices.find(voice => voice.lang === "id-ID") || voices.find(voice => voice.name.includes("Google")) || voices[0];

                                        msg.voice = indonesianVoice;
                                        msg.rate = 0.8;
                                        msg.pitch = 1.1;
                                        msg.volume = 1;
                                        msg.lang = 'id-ID'; // Bahasa Indonesia

                                        window.speechSynthesis.speak(msg);
                                    }, 500); // Delay 500ms buat nunggu voice ke-load
                                };

                                // Fix bug: Tunggu sampai voice list ter-load sebelum ngomong
                                if (speechSynthesis.getVoices().length === 0) {
                                    speechSynthesis.onvoiceschanged = function() {
                                        audio.onended();
                                    };
                                }
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