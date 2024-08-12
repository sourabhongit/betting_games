<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head Tail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/HeadAndTail.css') }}">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- google icons -->
</head>

<body class="text-center">
    <section class="home">
        <audio id="Kachingsound1" src="{{ asset('assets/audio/frontend/ka-ching-full.mp3') }}"></audio>
        <audio id="toss" src="{{ asset('assets/audio/frontend/toss.mp3') }}"></audio>
        <!-- 5-4-3-2-1 -->
        <div id="last-seconds" class="text-center hidden">
            <div class=" counter-modal">
                <h1 class="countermodaltext"><b id="last-countdown">5</b></h1>
                <audio id="tick" src="{{ asset('assets/audio/frontend/tick-sound.mp3') }}"></audio>
            </div>
        </div>
        <!-- stop betting modal -->
        <div id="stop-betting" class="text-center">
            <div class="stop-betting-modal">
                <img src="{{ asset('assets/images/frontend/images/stop-bet.png') }}" class="bet-img" alt="">
            </div>
        </div>
        <!-- winning popup -->
        <div id="winning-popup" class="text-center">
            <div class=" winning-popup-modal">
                <div>
                    <div class="d-flex justify-content-center">
                        <img src="" class="w-50 " id="win-img" alt="">
                    </div>
                    <h5 class="text-center text-light" id="WinMessage"></h5>
                </div>
            </div>
        </div>
        <!-- game -->
        <div class="container" style="max-width: 500px; overflow-x: hidden;">
            <div class="container top-head mt-4 mb-2">
                <div class="row align-items-center">
                    <div class="col d-flex justify-content-between align-items-center">
                        <div class="text-center game-log">
                            {{ $GameLog->session_id }}
                        </div>
                        <div class="text-center">
                        </div>
                        <div>
                            <a href={{ route('home') }}>
                                <button class="btn btn-danger">
                                    <p class="mb-0 mt-1 text-small">Exit</p>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h3 class="mb-0"><b id="countdown"> </b></h3>
            </div>
            <div class="row">
                <div class="col-12 my-1">
                    <div class="scrolling-div">
                        <img src="{{ asset('assets/images/frontend/images/arrow.png') }}" class="scrollingimg"
                            alt="">
                        @foreach ($GameLogHistory as $GameHistory)
                            @if ($GameHistory->result == 'head')
                                <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="scrollingimg"
                                    alt="">
                            @else
                                <img src="{{ asset('assets/images/frontend/images/tail.png') }}" class="scrollingimg"
                                    alt="">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-2 profile-column1">
                    <div class="my-1 profile-div MovinCoinprofile1">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/gold.png') }}" class="crownimg1"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[0]['player'] }} </p>
                    </div>
                    <div class="my-1 profile-div MovinCoinprofile2">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/silver.png') }}" class="crownimg2"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[1]['player'] }}</p>
                    </div>
                    <div class="my-1 profile-div MovinCoinprofile3">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/bronze.png') }}" class="crownimg3"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[2]['player'] }}</p>
                    </div>
                </div>
                <div class="col-8 d-flex justify-content-center coin-bg">
                    <div class="coin-container">
                        <div id="coin" class="coin">
                            <div class="coin-face head"></div>
                            <div class="coin-face tail"></div>
                        </div>
                    </div>
                </div>
                <div class="col-2 profile-column2">
                    <div class="my-1 profile-div MovinCoinprofile4">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/gold.png') }}" class="crownimg1"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[3]['player'] }}</p>
                        {{-- <p class="text-center text-small mb-0 mt--1"><b>₹<span id="amount4">0</span></b></p> --}}
                    </div>
                    <div class="my-1 profile-div MovinCoinprofile5">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/silver.png') }}" class="crownimg2"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[4]['player'] }}</p>
                        {{-- <p class="text-center text-small mb-0 mt--1"><b>₹<span id="amount5">0</span></b></p> --}}
                    </div>
                    <div class="my-1 profile-div MovinCoinprofile6">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/bronze.png') }}" class="crownimg3"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[5]['player'] }}</p>
                        {{-- <p class="text-center text-small mb-0 mt--1"><b>₹<span id="amount6">0</span></b></p> --}}
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6">
                    <div class="card" id="yellow-bg">
                        <div class="card-body rounded" id="HeadBtn">
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-warning align-items-center">
                                <img src="{{ asset('assets/images/frontend/images/head.png') }}"
                                    style="width: 20px;height: 20px;" alt="">
                                <p class="mb-0 ms-2"><b class="RandomAmount1">Total Bet</b></p>
                            </div>
                            <div class="py-2">
                                <img src="{{ asset('assets/images/frontend/images/coins-img.png') }}"
                                    class="multiplecoinimg" alt="">
                                <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="w-75"
                                    style="opacity: 0.5; " alt="">
                            </div>
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-warning align-items-center">
                                <p class="mb-0 ms-2"><b><span id="HeadBetAmount" class="amountvalueshown">Place Bet
                                            Here
                                        </span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" id="blue-bg">
                        <div class="card-body rounded" id="TailBtn">
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-info align-items-center">
                                <img src="{{ asset('assets/images/frontend/images/tail.png') }}"
                                    style="width: 20px;height: 20px;" alt="">
                                <p class="mb-0 ms-2"><b class="RandomAmount2">Total Bet</b></p>
                            </div>
                            <div class="py-2">
                                <img src="{{ asset('assets/images/frontend/images/coins-img.png') }}"
                                    class="multiplecoinimg" alt="">
                                <img src="{{ asset('assets/images/frontend/images/tail.png') }}" class="w-75"
                                    style="opacity: 0.5; " alt="">
                            </div>
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-info align-items-center">
                                <p class="mb-0 "><b> <span id="TailBetAmount" class="amountvalueshown">Place Bet
                                            Here</span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center my-3">
                <div></div>
                <div class=" profile-div MovinCoinprofile7">
                    <p class="mb-0" id="BettingUsers">0</p>
                    <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                        alt="">
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center my-3"
                style="margin-bottom: 100px !important">
            </div>
            <br><br><br>
            <div class="bottom">
                <div class="row" style="max-width: 500px;">
                    <div class="col-12">
                        <div class="d-flex justify-content-center price-coin-div align-items-end">
                            <img src="{{ asset('assets/images/frontend/images/yellow10.png') }}" class="price-img"
                                id="10" alt="">
                            <img src="{{ asset('assets/images/frontend/images/green50.png') }}" class="price-img"
                                id="50" alt="">
                            <img src="{{ asset('assets/images/frontend/images/blue100.png') }}" class="price-img"
                                id="100" alt="">
                            <img src="{{ asset('assets/images/frontend/images/orange500.png') }}" class="price-img"
                                id="500" alt="">
                            <img src="{{ asset('assets/images/frontend/images/black1k.png') }}" class="price-img"
                                id="1000" alt="">
                            <img src="{{ asset('assets/images/frontend/images/purple5k.png') }}" class="price-img"
                                id="5000" alt="">
                            <img src="{{ asset('assets/images/frontend/images/10k.png') }}" class="price-img"
                                id="10000" alt="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/images/frontend/images/goldenpanel.png') }}"
                                class="bottompanel" alt="">
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="d-flex amount align-items-center justify-content-center">
                                <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="amount-coin"
                                    alt="">
                                <span class="px-2"
                                    id="user-wallet-balance">{{ auth()->user()->wallet ? auth()->user()->wallet->balance : 0 }}</span>
                                <a href="" class="nav"><img src="assets/add.png')}}" class="amount-add"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $UserData = auth()->user();
        if ($GameLog) {
            $GameCreateTime = Carbon\Carbon::parse($GameLog->created_at);
            $Now = Carbon\Carbon::now();

            $DiffInSeconds = $GameCreateTime->diffInSeconds($Now);
            $RoundedDiffInSeconds = 64 - round($DiffInSeconds);
        }
    @endphp

    <script>
        const UserData = {!! json_encode($UserData) !!};
        const globalTimeLeft = {!! json_encode($RoundedDiffInSeconds) !!};
        const GameLog = {!! json_encode($GameLog) !!};
        const UserBets = {!! json_encode($UserBets) !!};
    </script>
    <script>
        const AvatarImages = [
            '{{ asset('assets/images/frontend/images/Avatar0.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar1.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar2.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar3.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar4.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar5.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar6.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar7.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar8.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar9.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar10.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar11.png') }}',
        ];

        function GetRandomAvatar() {
            return AvatarImages[Math.floor(Math.random() * AvatarImages.length)];
        }

        function ReplaceProfileImages() {
            const ProfileImages = document.querySelectorAll('.ProfileImg');

            ProfileImages.forEach(img => {
                img.src = GetRandomAvatar();
            });
        }

        document.addEventListener('DOMContentLoaded', ReplaceProfileImages);
    </script>
    <script>
        const KachingSound = document.getElementById('Kachingsound1');
        const TossSound = document.getElementById('toss');

        // Set the audio element to loop
        KachingSound.loop = true;

        function AttemptPlayAudio() {
            // Try to play the audio
            var Promise = KachingSound.play();
            if (Promise !== undefined) {
                Promise.then(function() {}).catch(function(error) {
                    console.log('Autoplay was prevented:', error);
                    // Retry after a delay
                    setTimeout(AttemptPlayAudio, 1000); // retry every 1 second
                });
            }
        }

        // Attempt to play the audio initially
        AttemptPlayAudio();
        // Global variables to store the total amount and the chosen amount
        let TotalAmount = 0;
        let ChosenAmount = 0;
        let ChosenFace = '';
        let TotalBetOnHead = 0;
        let TotalBetOnTail = 0;
        let AllowCoinCreation = true;
        let FinalResult = '';
        let BetCount = 0;
        let IntervalAmount = '';
        let UserInterval = '';
        let AmountOne;
        let AmountTwo;
        let User = 0;

        // Check if the player has previous bets and update on the frontend
        if (UserBets.length !== 0) {
            UserBets.forEach(Bet => {
                if (Bet.bet_on === 'head') {
                    TotalBetOnHead = Bet.bet_amount;
                    document.getElementById('HeadBetAmount').innerText = TotalBetOnHead;
                } else if (Bet.bet_on === 'tail') {
                    TotalBetOnTail = Bet.bet_amount;
                    document.getElementById('TailBetAmount').innerText = TotalBetOnTail;
                };
            });
            // Update the user's wallet balance in the UI
            let UserBalanceElement = document.getElementById('user-wallet-balance');
            let UserBalance = parseInt(UserBalanceElement.textContent) - (parseInt(TotalBetOnHead) + parseInt(
                TotalBetOnTail));
            UserBalanceElement.textContent = UserBalance;
        };

        // Timer variable
        let TimeLeft = {{ $RoundedDiffInSeconds }};

        // Function to handle image click
        function HandleImageClick(event) {
            document.querySelectorAll('.price-img').forEach(image => {
                image.classList.remove('price-img-active');
            });

            event.target.classList.add('price-img-active');
            // Set what amount is choosen by the player
            ChosenAmount = parseInt(event.target.id, 10);
        }

        // Function to handle button click
        function HandleButtonClick(Face) {
            if (Face == 'head') {
                ChosenFace = 'head';
                CheckAmount(Face, TotalBetOnHead);
            }
            if (Face == 'tail') {
                ChosenFace = 'tail';
                CheckAmount(Face, TotalBetOnTail);
            }
            UpdateDisplayedAmounts();
        }

        // Function to update displayed amounts
        function UpdateDisplayedAmounts() {
            if (ChosenFace === 'head' && TotalBetOnHead) {
                document.getElementById('HeadBetAmount').innerText = TotalBetOnHead;
            } else if (ChosenFace === 'tail' && TotalBetOnTail) {
                document.getElementById('TailBetAmount').innerText = TotalBetOnTail;
            }
        }

        // Update random amount in head and tail
        function UpdateRandomAmount() {
            // Retrieve amounts from sessionStorage or initialize to 0 if not available
            AmountOne = sessionStorage.getItem('OneMinAmountOne');
            AmountTwo = sessionStorage.getItem('OneMinAmountTwo');

            // Initialize amounts to 0 if they do not exist in sessionStorage
            if (AmountOne === null) {
                AmountOne = 0;
                sessionStorage.setItem('OneMinAmountOne', AmountOne);
            } else {
                AmountOne = parseInt(AmountOne);
            }

            if (AmountTwo === null) {
                AmountTwo = 0;
                sessionStorage.setItem('OneMinAmountTwo', AmountOne);
            } else {
                AmountTwo = parseInt(AmountTwo);
            }

            // Function to generate a random multiple of 10 within a range
            function GetRandomStep(min, max) {
                return Math.round((Math.random() * (max - min) + min) / 10) * 10;
            }

            let StepOne = GetRandomStep(1000, 3000); // Adjust min and max as needed
            let StepTwo = GetRandomStep(1000, 3000); // Adjust min and max as needed

            // Get elements by class name
            let RandomAmount1 = document.getElementsByClassName('RandomAmount1');
            let RandomAmount2 = document.getElementsByClassName('RandomAmount2');

            // Initialize the interval
            IntervalAmount = setInterval(() => {
                // Increment the amounts
                AmountOne += StepOne;
                AmountTwo += StepTwo;

                // Update each element with the new amount
                for (let element of RandomAmount1) {
                    element.innerText = AmountOne;
                }

                for (let element of RandomAmount2) {
                    element.innerText = AmountTwo;
                }

                // Save the updated amounts in sessionStorage
                sessionStorage.setItem('OneMinAmountOne', AmountOne);
                sessionStorage.setItem('OneMinAmountTwo', AmountTwo);

            }, 1000); // Update every second
        }
        // Example call to the function
        UpdateRandomAmount();

        function GenerateBettingUserCount() {
            let html = document.getElementById('BettingUsers');
            User = sessionStorage.getItem('OneMinUserCount');
            User = User ? parseInt(User, 10) : 0;
            sessionStorage.setItem('OneMinUserCount', User);
            // Set interval to update user count
            UserInterval = setInterval(() => {
                let RandomIncrement = Math.floor(Math.random() * 90) + 8;
                User += RandomIncrement;
                html.innerHTML = User; // Use number directly
                sessionStorage.setItem('OneMinUserCount', User);
            }, 1000); // Update every second
        }

        // Call the function to start updating
        GenerateBettingUserCount();
        // Function to start the countdown timer
        function StartCountdownTimer() {
            const CountdownElement = document.getElementById('countdown');
            const LastSecondsElement = document.getElementById('last-seconds');
            const LastCountdownElement = document.getElementById('last-countdown');

            const CountdownTimer = setInterval(function() {
                if (TimeLeft < 0) {
                    clearInterval(CountdownTimer);
                    CountdownElement.textContent = '0';
                    LastSecondsElement.classList.add('hidden');
                    let WinMessage = document.getElementById('WinMessage');
                    let WinImg = document.getElementById('win-img');
                    let Message = '';

                    if (FinalResult == 'head') {
                        Message = 'You won! ' + TotalBetOnHead + '\n' + 'you lost! ' + TotalBetOnTail;
                    } else if (FinalResult == 'tail') {
                        Message = 'You won! ' + TotalBetOnTail + '\n' + 'you lost! ' + TotalBetOnHead;
                    } else if (ChosenFace === '') {
                        Message = 'No Bet';
                    } else {
                        Message = 'You lost!';
                    }
                    if (TotalBetOnHead !== 0 || TotalBetOnTail !== 0) {
                        UpdateWallet(UserData.id);
                    }
                    setTimeout(function() {
                        WinMessage.innerText = Message;
                        if (FinalResult === 'head') {
                            WinImg.src = '/assets/images/frontend/images/head.png';
                        } else {
                            WinImg.src = '/assets/images/frontend/images/tail.png';
                        }
                        ShowwInModal();
                    }, 500);
                    setTimeout(function() {
                        sessionStorage.clear();
                        location.reload();
                    }, 1500);
                } else {
                    CountdownElement.textContent = TimeLeft;
                }

                // Inside the countdown timer function
                const TickSound = document.getElementById('tick');
                if (TimeLeft <= 5 && TimeLeft > 0) {
                    function AttemptPlayTickAudio() {
                        // Try to play the audio
                        var Promise = TickSound.play();
                        if (Promise !== undefined) {
                            Promise.then(function() {}).catch(function(error) {
                                console.log('Autoplay was prevented:', error);
                                // Retry after a delay
                                setTimeout(AttemptPlayTickAudio, 1000); // retry every 1 second
                            });
                        }
                    }
                    AttemptPlayTickAudio();

                    LastSecondsElement.classList.remove('hidden');
                    LastCountdownElement.textContent = TimeLeft;
                } else {
                    LastCountdownElement.textContent = '';
                }
                if (TimeLeft === 58) {
                    sessionStorage.clear();
                    IntervalAmount = '';
                    UserInterval = '';
                    AmountOne = 0;
                    AmountTwo = 0;
                    User = 0;
                };
                if (TimeLeft === 5) {
                    KachingSound.pause();
                    FlipCoin();
                    TossSound.loop = false;

                    function AttemptPlayTossAudio() {
                        // Try to play the audio
                        var Promise = TossSound.play();
                        if (Promise !== undefined) {
                            Promise.then(function() {}).catch(function(error) {
                                console.log('Autoplay was prevented:', error);
                                // Retry after a delay
                                setTimeout(AttemptPlayAudio, 1000); // retry every 1 second
                            });
                        }
                    }
                    // Attempt to play the audio initially
                    AttemptPlayTossAudio();
                }

                if (TimeLeft === 6) {
                    // Stop the interval
                    clearInterval(IntervalAmount);
                    clearInterval(UserInterval);
                    let LogData = {
                        GameLogId: GameLog.id,
                    };

                    $.ajax({
                        url: "{{ route('game.log.result') }}",
                        type: "POST",
                        data: LogData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            FinalResult = response.data.result;
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                    ShowModal();
                    //stop betting
                    AllowCoinCreation = false;
                }

                TimeLeft -= 1;
            }, 1000);
        }

        StartCountdownTimer();

        // Function to handle coin flip
        function FlipCoin() {
            const coin = document.getElementById('coin');
            // Increase size and flip
            coin.style.transition = 'transform 2s, width 2s, height 2s';
            coin.style.transform = 'rotateX(720deg)';
            coin.style.width = '100px';
            coin.style.height = '100px';

            // Determine result of the flip
            Result = FinalResult;
            const FinalAngle = Result === 'head' ? 0 : 180;

            // Decrease size and flip again after the initial animation
            setTimeout(function() {
                // Rotate multiple times and decrease size
                coin.style.transition = 'transform 2s, width 2s, height 2s';
                coin.style.transform = `rotateX(${1440 + FinalAngle}deg)`;
                coin.style.width = '60px';
                coin.style.height = '60px';
            }, 2000); // Adjust this timeout to match the initial flip duration

            return Result;
        }

        // Example coin flip usage
        // document.getElementById('coin').addEventListener('click', FlipCoin);


        // Function to show modal
        function ShowModal() {
            var BetModal = document.getElementById('stop-betting');
            var BetModalContent = document.querySelector('.stop-betting-modal');
            BetModalContent.classList.add('show-modal');

            setTimeout(function() {
                BetModalContent.classList.remove('show-modal');
                BetModalContent.classList.add('hide-modal');

                setTimeout(function() {
                    BetModal.classList.add('hidden');
                    BetModalContent.classList.remove('hide-modal');
                }, 200);
            }, 800);
        }

        // Function to show win modal
        function ShowwInModal() {
            var BetModal = document.getElementById('winning-popup');
            var BetModalContent = document.querySelector('.winning-popup-modal');
            BetModalContent.classList.add('show-modal');

            setTimeout(function() {
                BetModalContent.classList.remove('show-modal');
                BetModalContent.classList.add('hide-modal');

                setTimeout(function() {
                    BetModal.classList.add('hidden');
                    BetModalContent.classList.remove('hide-modal');
                }, 200);
            }, 800);
        }

        // Event listeners for DOM content loaded
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.price-img');
            images.forEach(image => {
                image.addEventListener('click', HandleImageClick);
            });

            const HeadBtn = document.getElementById('HeadBtn');
            const TailBtn = document.getElementById('TailBtn');

            HeadBtn.addEventListener('click', function() {
                HandleButtonClick('head');
            });

            TailBtn.addEventListener('click', function() {
                HandleButtonClick('tail');
            });

            function GetRandomElement(arr) {
                const RandomIndex = Math.floor(Math.random() * arr.length);
                return arr[RandomIndex];
            }

            // Define the function to select elements by class name
            function getElementByClassName(className) {
                return document.getElementsByClassName(className)[0];
            }

            // Determine the class for each profile at page load
            const ProfileClasses = {};
            for (let i = 1; i <= 6; i++) {
                ProfileClasses[`MovinCoinprofile${i}`] = GetRandomElement([`moving-coin${i}yellow`,
                    `moving-coin${i}blue`
                ]);
            }

            function CreateMovingCoin(i = 1) {
                if (!AllowCoinCreation) return;
                if (i > 6) return; // Stop after the sixth profile

                const MovinCoinprofile = getElementByClassName(`MovinCoinprofile${i}`);

                if (MovinCoinprofile) {
                    const CoinImg = document.createElement('img');
                    CoinImg.src = GetRandomElement([
                        "/assets/images/frontend/images/yellow10.png",
                        "/assets/images/frontend/images/green50.png",
                        "/assets/images/frontend/images/blue100.png",
                        "/assets/images/frontend/images/yellow10.png",
                        "/assets/images/frontend/images/green50.png",
                        "/assets/images/frontend/images/blue100.png",
                        "/assets/images/frontend/images/orange500.png",
                        "/assets/images/frontend/images/black1k.png",
                        "/assets/images/frontend/images/purple5k.png",
                    ]);

                    CoinImg.classList.add('moving-coin');

                    // Get the predetermined class for this profile
                    const AdditionalClass = ProfileClasses[`MovinCoinprofile${i}`];
                    CoinImg.classList.add(AdditionalClass);

                    // Append the coin image to the profile div
                    MovinCoinprofile.appendChild(CoinImg);

                    setTimeout(() => {
                        // Set random top and left positions based on the profile
                        if (MovinCoinprofile.classList.contains('MovinCoinprofile1') ||
                            MovinCoinprofile.classList.contains('MovinCoinprofile2') ||
                            MovinCoinprofile.classList.contains('MovinCoinprofile3')) {
                            if (AdditionalClass.includes('yellow')) {
                                CoinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                CoinImg.style.left =
                                    `${Math.floor(Math.random() * 121) + 70}%`; // Left range: 70-120
                            } else if (AdditionalClass.includes('blue')) {
                                CoinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                CoinImg.style.left =
                                    `${Math.floor(Math.random() * 115) + 361}%`; // Left range: 361-475
                            }
                        } else if (MovinCoinprofile.classList.contains('MovinCoinprofile4') ||
                            MovinCoinprofile.classList.contains('MovinCoinprofile5') ||
                            MovinCoinprofile.classList.contains('MovinCoinprofile6')) {
                            if (AdditionalClass.includes('yellow')) {
                                CoinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                CoinImg.style.left =
                                    `${-Math.floor(Math.random() * 137) - 308}%`; // Left range: -308% to -444%
                            } else if (AdditionalClass.includes('blue')) {
                                CoinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                CoinImg.style.left =
                                    `${-Math.floor(Math.random() * 119) - 20}%`; // Left range: -20% to -138%
                            }

                        }

                        // Call the function again for the next profile after 500ms
                        setTimeout(() => CreateMovingCoin(i + 1), 900);
                    }, 1000);

                } else {
                    // Skip to the next profile after 500ms
                    setTimeout(() => CreateMovingCoin(i + 1), 800);
                }
            }

            setInterval(() => CreateMovingCoin(), 3500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            function GetRandomElement(arr) {
                const RandomIndex = Math.floor(Math.random() * arr.length);
                return arr[RandomIndex];
            }

            function GetRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            function CreateMovingCoinProfile7() {
                if (!AllowCoinCreation) return;
                const MovinCoinprofile7 = document.querySelector('.MovinCoinprofile7');

                if (MovinCoinprofile7) {
                    const CoinImg = document.createElement('img');
                    CoinImg.src = GetRandomElement([
                        '/assets/images/frontend/images/yellow10.png',
                        '/assets/images/frontend/images/green50.png',
                        '/assets/images/frontend/images/blue100.png',
                        '/assets/images/frontend/images/yellow10.png',
                        '/assets/images/frontend/images/green50.png',
                        '/assets/images/frontend/images/blue100.png',
                        '/assets/images/frontend/images/orange500.png',
                        '/assets/images/frontend/images/black1k.png',
                        "/assets/images/frontend/images/purple5k.png",
                    ]);

                    CoinImg.classList.add('moving-coin-bottom');

                    // Determine the class to add based on the profile index
                    const AdditionalClass = GetRandomElement(['moving-coin7yellow',
                        'moving-coin7blue'
                    ]);
                    CoinImg.classList.add(AdditionalClass);

                    // Append the coin image to the profile div
                    MovinCoinprofile7.appendChild(CoinImg);

                    setTimeout(() => {
                        if (AdditionalClass.includes('yellow')) {
                            CoinImg.style.top =
                                `${-Math.floor(Math.random() * 76) - 150}%`; // Top range: -150% to -225%
                            CoinImg.style.right =
                                `${Math.floor(Math.random() * 21) + 60}%`; // Right range: 60% to 80%
                        } else if (AdditionalClass.includes('blue')) {
                            CoinImg.style.top =
                                `${-Math.floor(Math.random() * 76) - 150}%`; // Top range: -150% to -225%
                            CoinImg.style.right =
                                `${Math.floor(Math.random() * 22) + 10}%`; // Right range: 10% to 31%
                        }
                    }, 1000);
                } else {
                    console.log('No MovinCoinprofile7 found.');
                }

                // Schedule the next coin creation with a random interval between 100 and 500 ms
                const NextInterval = GetRandomNumber(100, 500);
                setTimeout(CreateMovingCoinProfile7, NextInterval);
            }

            // Initial call to start the cycle
            CreateMovingCoinProfile7();
        });

        function PlaceBet(Face, Amount) {
            // Prepare data for AJAX request
            let data = {
                user_id: UserData.id,
                log_id: GameLog.id,
                bet_amount: Amount,
                bet_on: Face,
            };
            if (Amount !== 0) {
                // Send AJAX request
                $.ajax({
                    url: "{{ route('head.tail.place.bet') }}",
                    type: "POST",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Enable button after successful request
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Enable button if request fails
                    }
                });
            }
        };

        function UpdateWallet(UserId) {
            let data = {
                'user_id': UserId,
                'log_id': GameLog.id,
                'result': FinalResult,
            };
            $.ajax({
                url: "{{ route('head.tail.wallet.update') }}",
                type: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function CheckAmount(Face, amt) {

            // Calculate the new total amount after placing the bet
            let PotentialTotalAmount = TotalBetOnHead + TotalBetOnTail + ChosenAmount;

            // Check if the total bet count exceeds the limit
            if (BetCount >= 5) {
                alert('You can only place a maximum of 5 bets total.');
                return;
            }

            // Check if the user has sufficient balance
            if (PotentialTotalAmount > UserData.wallet.balance) {
                alert('Insufficient balance to place bet.');
                return;
            }

            // Update bet amounts and place the bet
            if (Face === 'head') {
                TotalBetOnHead += ChosenAmount;
                PlaceBet(Face, TotalBetOnHead);
            } else if (Face === 'tail') {
                TotalBetOnTail += ChosenAmount;
                PlaceBet(Face, TotalBetOnTail);
            }

            // Update the total amount and bet count
            TotalAmount = TotalBetOnHead + TotalBetOnTail;
            BetCount += 1;

            // Update the user's wallet balance in the UI
            let UserBalanceElement = document.getElementById('user-wallet-balance');
            let UserBalance = parseInt(UserBalanceElement.textContent) - ChosenAmount;
            UserBalanceElement.textContent = UserBalance;
        }
    </script>
</body>

</html>
