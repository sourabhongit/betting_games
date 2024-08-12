@extends('backend.layouts.main')
@section('content')
    <!-- content @s -->
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div>
                <h4 class="nk-block-title">Current Game</h4>
            </div>
        </div>
    </div>
    <x-alert />
    <!-- content @s -->
    <div class="card card-preview">
        <div class="card-inner">
            <table class="table table-bordered" data-auto-responsive="false" id="current-game">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Log ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Session ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Total Players</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Bet on Dragon</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Bet On Tiger</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Bet On Tie</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Time</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Result</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">{{ $GameLog->id }}</td>
                        <td class="nk-tb-col">{{ $GameLog->session_id }}</td>
                        <td class="nk-tb-col" id="TotalPlayers">{{ $TotalPlayes }}</td>
                        <td class="nk-tb-col" id="DragonBetAmount">{{ $DragonBetAmount }}</td>
                        <td class="nk-tb-col" id="TigerBetAmount">{{ $TigerBetAmount }}</td>
                        <td class="nk-tb-col" id="TieBetAmount">{{ $TieBetAmount }}</td>
                        @php
                            if ($GameLog) {
                                $GameCreateTime = Carbon\Carbon::parse($GameLog->created_at);
                                $Now = Carbon\Carbon::now();

                                $DiffInSeconds = $GameCreateTime->diffInSeconds($Now);
                                $RoundedDiffInSeconds = 64 - round($DiffInSeconds);
                            }
                        @endphp
                        <td class="nk-tb-col countdown" id="countdown">{{ $RoundedDiffInSeconds }}</td>
                        <td class="nk-tb-col"><button class="btn btn-primary"
                                onclick="UpdateResult('dragon', {{ $GameLog->id }})">Dragon</button>
                            <button class="btn ml-2 btn-secondary"
                                onclick="UpdateResult('tiger', {{ $GameLog->id }})">Tiger</button>
                            <button class="btn ml-2 btn-info"
                                onclick="UpdateResult('tie', {{ $GameLog->id }})">Tie</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- content @s
                                                    -->
    <!-- content @s -->
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <div>
                <h4 class="nk-block-title">Results</h4>
            </div>
        </div>
    </div>
    <x-alert />
    <!-- content @s -->
    <div class="card card-preview">
        <div class="card-inner">
            <!-- content @s -->
            <table class="datatable-init nowrap nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col">#</th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Player ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Log ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Session ID</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Bet Amount</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Bet On</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Win or Lost</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Result</span></th>
                    </tr>
                </thead>
                <tbody>
                    @php $sno = 0 @endphp
                    @foreach ($Results as $Result)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">{{ ++$sno }}</td>
                            <td class="nk-tb-col">{{ $Result->user_id }}</td>
                            <td class="nk-tb-col">{{ $Result->log_id }}</td>
                            <td class="nk-tb-col">{{ $Result->log->session_id }}</td>
                            <td class="nk-tb-col">{{ $Result->bet_amount }}</td>
                            <td class="nk-tb-col">{{ $Result->bet_on }}</td>
                            <td class="nk-tb-col">{{ $Result->win_lost }}</td>
                            <td class="nk-tb-col">{{ $Result->result }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- content @s
        -->
    @endsection
    @push('custom-js')
        <script>
            function UpdateResult(Result, LogID) {
                $.ajax({
                    url: '{{ route('dragon.tiger.update.result') }}',
                    type: 'POST',
                    data: {
                        Result: Result,
                        GameLogId: LogID
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        alert('Some error occurred, not able to update the result.');  
                    }
                })
            }

            // Pass the initial value from Blade to JavaScript
            let CountdownValue = {{ $RoundedDiffInSeconds }};

            // Function to update the countdown timer
            function UpdateCountdown() {
                // Calculate minutes and seconds
                let minutes = Math.floor(CountdownValue / 60);
                let seconds = CountdownValue % 60;

                // Display minutes and seconds with leading zero
                document.getElementById('countdown').innerText = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                // Disable buttons if the countdown value is less than 7 seconds
                if (CountdownValue < 7) {
                    document.querySelectorAll('.btn').forEach(button => {
                        button.disabled = true;
                    });
                }

                // Decrement the countdown value
                CountdownValue--;

                // Stop the countdown when it reaches 0
                if (CountdownValue < 0) {
                    clearInterval(timer);
                    document.getElementById('countdown').innerText = 'Time\'s up!';
                    location.reload();
                }
            }

            // Update the countdown every second
            let timer = setInterval(UpdateCountdown, 1000);

            // Initial call to display the initial value
            UpdateCountdown();

            // Function to fetch the game data and update the UI
            function FetchGameData() {
                $.ajax({
                    url: '{{ route('dragon.tiger.running.game.data', $GameLog->id) }}',
                    type: 'GET',
                    success: function(response) {
                        $('#TotalPlayers').text(response.TotalPlayes);
                        $('#DragonBetAmount').text(response.DragonBetAmount);
                        $('#TigerBetAmount').text(response.TigerBetAmount);
                        $('#TieBetAmount').text(response.TieBetAmount);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching game data:', error);
                    }
                });
            }

            // Fetch game data every second
            setInterval(FetchGameData, 1000);
        </script>
    @endpush
