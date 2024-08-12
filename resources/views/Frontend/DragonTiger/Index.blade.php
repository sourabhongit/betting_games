<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Tiger</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/DragonTiger.css') }}">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- google icons -->
</head>

<body class="text-center">
    <section class="home">
        <audio id="kachingsound1" src="{{ asset('/assets/audio/frontend/coins.mp3') }}"></audio>
        <!-- 5-4-3-2-1 -->
        <div id="last-seconds" class="text-center hidden">
            <div class=" counter-modal">
                <h1 class="countermodaltext"><b id="last-countdown">5</b></h1>
                <audio id="tick" src="{{ asset('assets/audio/frontend/tick-sound.mp3') }}"></audio>
            </div>
        </div>
        <!-- stop betting modal -->
        <div id="stop-betting" class="text-center">
            <div class=" stop-betting-modal">
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
                    <h5 class="text-center text-light" id="winmessage"></h5>
                </div>
            </div>
        </div>
        <!-- game -->
        <div class="container" style="max-width: 500px; overflow-x: hidden;">
            <div> <img src="{{ asset('assets/images/frontend/images/dvst.png') }}" alt="" class="d_vs_t">
            </div>
            <div class="container top-head mt-2 mb-2">
                <div class="row align-items-center">
                    <div class="col d-flex justify-content-between align-items-center">
                        <div class="game-log">
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
            <div class="text-center mb-2">
                <h3><b id="countdown"> </b></h3>
            </div>
            <div class="row">
                <div class="col-12 my-1">
                    <div class="scrolling-div">
                        <img src="{{ asset('assets/images/frontend/images/arrow.png') }}" class="scrollingimg"
                            alt="">
                        @foreach ($GameLogHistory as $GameHistory)
                            @if ($GameHistory->result == 'dragon')
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
                <div class="col-2 profile-column1" style="color: white;">
                    <div class="my-1 profile-div movinCoinprofile1">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/gold.png') }}" class="crownimg1"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[0]['player'] }} </p>
                    </div>
                    <div class="my-1 profile-div movinCoinprofile2">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/silver.png') }}" class="crownimg2"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[1]['player'] }}</p>
                    </div>
                    <div class="my-1 profile-div movinCoinprofile3">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/bronze.png') }}" class="crownimg3"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[2]['player'] }}</p>
                    </div>
                </div>
                <div class="col-8 coin-bg">
                    <img src="{{ asset('assets/images/frontend/images/tie2.png') }}" class="coin-img"
                        style="border: 2px solid white;">
                    <div id="tieBtn" style="left: 136px;    top: 103px;    position: absolute;    z-index: 999;"
                        class="d-flex justify-content-center border-top border-bottom border-warning align-items-center">
                        <p class="mb-0 ms-2"><b><span id="tieBetAmount" class="amountvalueshown">My Bet
                                </span></b></p>
                    </div>
                </div>
                <div class="col-2 profile-column2" style="color: white;">
                    <div class="my-1 profile-div movinCoinprofile4">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/gold.png') }}" class="crownimg1"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[3]['player'] }}</p>
                        {{-- <p class="text-center text-small mb-0 mt--1"><b>₹<span id="amount4">0</span></b></p> --}}
                    </div>
                    <div class="my-1 profile-div movinCoinprofile5">
                        <img src="{{ asset('assets/images/frontend/images/head.png') }}" class="ProfileImg"
                            alt="">
                        <img src="{{ asset('assets/images/frontend/images/silver.png') }}" class="crownimg2"
                            alt="">
                        <p class="text-center text-small mb-0 mt-1">{{ $DummyPlayersData[4]['player'] }}</p>
                        {{-- <p class="text-center text-small mb-0 mt--1"><b>₹<span id="amount5">0</span></b></p> --}}
                    </div>
                    <div class="my-1 profile-div movinCoinprofile6">
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
                        <div class="card-body rounded" id="dragonBtn">
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-warning align-items-center">
                                <img src="{{ asset('assets/images/frontend/images/head.png') }}"
                                    style="width: 20px;height: 20px;" alt="">
                                <p class="mb-0 ms-2"><b class="randomAmount1">Total Bet</b></p>
                            </div>
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-warning align-items-center">
                                <p class="mb-0 ms-2"><b><span id="dragonBetAmount" class="amountvalueshown">My Bet
                                        </span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" id="blue-bg">
                        <div class="card-body rounded" id="tigerBtn">
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-info align-items-center">
                                <img src="{{ asset('assets/images/frontend/images/tail.png') }}"
                                    style="width: 20px;height: 20px;" alt="">
                                <p class="mb-0 ms-2"><b class="randomAmount2">Total Bet</b></p>
                            </div>
                            <div
                                class="d-flex justify-content-center border-top border-bottom border-info align-items-center">
                                <p class="mb-0 "><b> <span id="tigerBetAmount" class="amountvalueshown"> My
                                            Bet</span></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center my-3">
                <div></div>
                <div class=" profile-div movinCoinprofile7">
                    <p class="mb-0" id="bettingUsers">0</p>
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
                                <a href="https://terionclub.in/wallet/recharge" class="nav"><img
                                        src="{{ asset('assets/images/frontend/images/add.png') }}" class="amount-add"
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
            $gameCreateTime = Carbon\Carbon::parse($GameLog->created_at);
            $now = Carbon\Carbon::now();

            $diffInSeconds = $gameCreateTime->diffInSeconds($now);
            $roundedDiffInSeconds = 64 - round($diffInSeconds);
        }
    @endphp
    <script></script>

    <script>
        const userData = {!! json_encode($UserData) !!};
        const globalTimeLeft = {!! json_encode($roundedDiffInSeconds) !!};
        const gameLog = {!! json_encode($GameLog) !!};
        const userBets = {!! json_encode($UserBets) !!};
    </script>
    <script>
        const avatarImages = [
            '{{ asset('/assets/images/frontend/images/Avatar0.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar1.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar2.png') }}',
            '{{ asset('assets/images/frontend/images/Avatar3.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar4.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar5.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar6.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar7.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar8.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar9.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar10.png') }}',
            '{{ asset('/assets/images/frontend/images/Avatar11.png') }}',
        ];

        function getRandomAvatar() {
            return avatarImages[Math.floor(Math.random() * avatarImages.length)];
        }

        function replaceProfileImages() {
            const profileImages = document.querySelectorAll('.ProfileImg');

            profileImages.forEach(img => {
                img.src = getRandomAvatar();
            });
        }

        document.addEventListener('DOMContentLoaded', replaceProfileImages);
    </script>
    <script>
        const kachingSound = document.getElementById('kachingsound1');
        var multipleCoinImgs = document.querySelectorAll('.multiplecoinimg');

        // Set the audio element to loop
        kachingSound.loop = true;

        function attemptPlayAudio() {
            // Try to play the audio
            var promise = kachingSound.play();
            if (promise !== undefined) {
                promise.then(function() {
                    console.log('Audio playback started automatically.');
                }).catch(function(error) {
                    console.log('Autoplay was prevented:', error);
                    // Retry after a delay
                    setTimeout(attemptPlayAudio, 1000); // retry every 1 second
                });
            }
        }
        // Attempt to play the audio initially
        attemptPlayAudio();
        // Global variables to store the total amount and the chosen amount
        let totalAmount = 0;
        let chosenAmount = 0;
        let chosenFace = '';
        let totalBetOnDragon = 0;
        let totalBetOnTiger = 0;
        let totalBetOnTie = 0;
        let fixedResult = '';
        let faceSwitched = false; // Flag to detect face switch
        let allowCoinCreation = true;
        let finalResult = '';
        let betCount = 0;
        let intervalAmount = '';
        let userInterval = '';
        let amountOne;
        let amountTwo;
        let user = 0;

        // Check if the player has previous bets and update on the frontend
        if (userBets.length !== 0) {
            userBets.forEach(bet => {
                if (bet.bet_on === 'dragon') {
                    totalBetOnDragon = bet.bet_amount;
                    document.getElementById('dragonBetAmount').innerText = totalBetOnDragon;
                } else if (bet.bet_on === 'tiger') {
                    totalBetOnTiger = bet.bet_amount;
                    document.getElementById('tigerBetAmount').innerText = totalBetOnTiger;
                } else if (bet.bet_on === 'tie') {
                    totalBetOnTie = bet.bet_amount;
                    document.getElementById('tieBetAmount').innerText = totalBetOnTie;
                };
            });
            // Update the user's wallet balance in the UI
            let userBalanceElement = document.getElementById('user-wallet-balance');
            let userBalance = parseInt(userBalanceElement.textContent) - (parseInt(totalBetOnDragon) + parseInt(
                totalBetOnTiger) + parseInt(totalBetOnTie));
            userBalanceElement.textContent = userBalance;
        };

        // Timer variable
        let timeLeft = {{ $roundedDiffInSeconds }};

        // Function to handle image click
        function handleImageClick(event) {
            document.querySelectorAll('.price-img').forEach(image => {
                image.classList.remove('price-img-active');
            });

            event.target.classList.add('price-img-active');
            // Set what amount is choosen by the player
            chosenAmount = parseInt(event.target.id, 10);
        }

        // Function to handle button click
        function handleButtonClick(face) {
            if (face == 'dragon') {
                chosenFace = 'dragon';
                checkAmount(face, totalBetOnDragon);
            }
            if (face == 'tiger') {
                chosenFace = 'tiger';
                checkAmount(face, totalBetOnTiger);
            }
            if (face == 'tie') {
                chosenFace = 'tie';
                checkAmount(face, totalBetOnTie);
            }
            updateDisplayedAmounts();
        }

        // Function to update displayed amounts
        function updateDisplayedAmounts() {
            if (chosenFace === 'dragon' && totalBetOnDragon) {
                document.getElementById('dragonBetAmount').innerText = totalBetOnDragon;
            } else if (chosenFace === 'tiger' && totalBetOnTiger) {
                document.getElementById('tigerBetAmount').innerText = totalBetOnTiger;
            } else if (chosenFace === 'tie' && totalBetOnTie) {
                document.getElementById('tieBetAmount').innerText = totalBetOnTie;
            }
        }

        // Update random amount in dragon and tiger
        function updateRandomAmount() {
            amountOne = sessionStorage.getItem('AmountOne');
            amountTwo = sessionStorage.getItem('AmountTwo');

            function getSessionValue(key, defaultValue) {
                let value = sessionStorage.getItem(key);
                if (value === null) {
                    value = defaultValue;
                    sessionStorage.setItem(key, value);
                } else {
                    value = parseInt(value);
                }
                return value;
            }

            amountOne = getSessionValue('AmountOne', 0);
            amountTwo = getSessionValue('AmountTwo', 0);

            function getRandomStep(min, max) {
                return Math.round((Math.random() * (max - min) + min) / 10) * 10;
            }
            let stepOne = getRandomStep(1000, 3000); // Adjust min and max as needed
            let stepTwo = getRandomStep(1000, 3000); // Adjust min and max as needed
            // Get elements by class name
            let randomAmount1 = document.getElementsByClassName('randomAmount1');
            let randomAmount2 = document.getElementsByClassName('randomAmount2');

            intervalAmount = setInterval(() => {
                // Increment the amounts
                amountOne += stepOne;
                amountTwo += stepTwo;

                // Update each element with the new amount
                for (let element of randomAmount1) {
                    element.innerText = amountOne;
                }

                for (let element of randomAmount2) {
                    element.innerText = amountTwo;
                }

                // Save the updated amounts in sessionStorage
                sessionStorage.setItem('AmountOne', amountOne);
                sessionStorage.setItem('AmountTwo', amountTwo);

            }, 1000); // Update every second
        }

        // Example call to the function
        updateRandomAmount();

        function generateBettingUserCount() {
            let html = document.getElementById('bettingUsers');
            user = sessionStorage.getItem('UserCount');
            user = user ? parseInt(user, 10) : 0;
            sessionStorage.setItem('UserCount', user);
            // Set interval to update user count
            userInterval = setInterval(() => {
                let randomIncrement = Math.floor(Math.random() * 90) + 8;
                user += randomIncrement;
                html.innerHTML = user; // Use number directly
                sessionStorage.setItem('UserCount', user);
            }, 1000); // Update every second
        }

        generateBettingUserCount();

        // Function to start the countdown timer
        function startCountdownTimer() {
            const countdownElement = document.getElementById('countdown');
            const lastSecondsElement = document.getElementById('last-seconds');
            const lastCountdownElement = document.getElementById('last-countdown');

            const countdownTimer = setInterval(function() {
                if (timeLeft < 0) {
                    clearInterval(countdownTimer);
                    countdownElement.textContent = '0';
                    lastSecondsElement.classList.add('hidden');
                    let winmessage = document.getElementById('winmessage');
                    let winimg = document.getElementById('win-img');
                    let message = '';
                    if (finalResult === chosenFace) {
                        message = 'You won! ';
                    } else if (chosenFace === '') {
                        message = 'No Bet';
                    } else {
                        message = 'You lost!';
                    }
                    if (totalBetOnDragon !== 0 || totalBetOnTiger !== 0 || totalBetOnTie !== 0) {
                        updateWallet(userData.id);
                    }
                    setTimeout(function() {
                        winmessage.innerText = message;
                        console.log('awwsm');
                        if (finalResult === 'dragon') {
                            winimg.src = '{{ asset('/assets/images/frontend/images/dragon.gif') }}';
                        } else {
                            winimg.src = '{{ asset('/assets/images/frontend/images/tiger.gif') }}';
                        }
                        showwinModal();
                    }, 500);
                    setTimeout(function() {
                        sessionStorage.clear();
                        location.reload();
                    }, 1500);
                } else {
                    countdownElement.textContent = timeLeft;
                }

                // Inside the countdown timer function
                const tickSound = document.getElementById('tick');
                if (timeLeft <= 5 && timeLeft > 0) {
                    function attemptPlayTickAudio() {
                        // Try to play the audio
                        var promise = tickSound.play();
                        if (promise !== undefined) {
                            promise.then(function() {}).catch(function(error) {
                                console.log('Autoplay was prevented:', error);
                                // Retry after a delay
                                setTimeout(attemptPlayTickAudio, 1000); // retry every 1 second
                            });
                        }
                    }
                    attemptPlayTickAudio();
                    lastSecondsElement.classList.remove('hidden');
                    lastCountdownElement.textContent = timeLeft;
                } else {
                    lastCountdownElement.textContent = '';
                }

                if (timeLeft === 58) {
                    sessionStorage.clear();
                    intervalAmount = '';
                    userInterval = '';
                    amountOne = 0;
                    amountTwo = 0;
                    user = 0;
                };

                if (timeLeft === 5) {
                    kachingSound.pause();
                };

                if (timeLeft === 6) {
                    clearInterval(intervalAmount);
                    clearInterval(userInterval);
                    $.ajax({
                        url: "{{ route('dragon.tiger.log.result') }}",
                        type: "POST",
                        data: {
                            GameLogId: gameLog.id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            finalResult = response.data.result;
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                    showModal();
                    //stop betting
                    allowCoinCreation = false;
                }

                timeLeft -= 1;
            }, 1000);
        }

        startCountdownTimer();

        // Function to show modal
        function showModal() {
            var betmodal = document.getElementById('stop-betting');
            var betmodalContent = document.querySelector('.stop-betting-modal');
            betmodalContent.classList.add('show-modal');

            setTimeout(function() {
                betmodalContent.classList.remove('show-modal');
                betmodalContent.classList.add('hide-modal');

                setTimeout(function() {
                    betmodal.classList.add('hidden');
                    betmodalContent.classList.remove('hide-modal');
                }, 200);
            }, 800);
        };

        // Function to show win modal
        function showwinModal() {
            var betmodal = document.getElementById('winning-popup');
            var betmodalContent = document.querySelector('.winning-popup-modal');
            betmodalContent.classList.add('show-modal');

            setTimeout(function() {
                betmodalContent.classList.remove('show-modal');
                betmodalContent.classList.add('hide-modal');

                setTimeout(function() {
                    betmodal.classList.add('hidden');
                    betmodalContent.classList.remove('hide-modal');
                }, 200);
            }, 800);
        };

        // Event listeners for DOM content loaded
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.price-img');
            images.forEach(image => {
                image.addEventListener('click', handleImageClick);
            });

            const dragonBtn = document.getElementById('dragonBtn');
            const tigerBtn = document.getElementById('tigerBtn');
            const tieBtn = document.getElementById('tieBtn');

            dragonBtn.addEventListener('click', function() {
                handleButtonClick('dragon');
            });

            tigerBtn.addEventListener('click', function() {
                handleButtonClick('tiger');
            });

            tieBtn.addEventListener('click', function() {
                handleButtonClick('tie');
            });

            function getRandomElement(arr) {
                const randomIndex = Math.floor(Math.random() * arr.length);
                return arr[randomIndex];
            };

            // Define the function to select elements by class name
            function getElementByClassName(className) {
                return document.getElementsByClassName(className)[0];
            };

            // Determine the class for each profile at page load
            const profileClasses = {};
            for (let i = 1; i <= 6; i++) {
                profileClasses[`movinCoinprofile${i}`] = getRandomElement([`moving-coin${i}yellow`,
                    `moving-coin${i}blue`
                ]);
            };

            function createMovingCoin(i = 1) {
                if (!allowCoinCreation) return;
                if (i > 6) return; // Stop after the sixth profile

                const movinCoinprofile = getElementByClassName(`movinCoinprofile${i}`);

                if (movinCoinprofile) {
                    const coinImg = document.createElement('img');
                    coinImg.src = getRandomElement([
                        '{{ asset('/assets/images/frontend/images/yellow10.png') }}',
                        '{{ asset('/assets/images/frontend/images/green50.png') }}',
                        '{{ asset('/assets/images/frontend/images/blue100.png') }}',
                        '{{ asset('/assets/images/frontend/images/orange500.png') }}',
                        '{{ asset('/assets/images/frontend/images/black1k.png') }}',
                        '{{ asset('/assets/images/frontend/images/purple5k.png') }}'
                    ]);

                    coinImg.classList.add('moving-coin');

                    // Get the predetermined class for this profile
                    const additionalClass = profileClasses[`movinCoinprofile${i}`];
                    coinImg.classList.add(additionalClass);

                    // Append the coin image to the profile div
                    movinCoinprofile.appendChild(coinImg);

                    setTimeout(() => {
                        // Set random top and left positions based on the profile
                        if (movinCoinprofile.classList.contains('movinCoinprofile1') ||
                            movinCoinprofile.classList.contains('movinCoinprofile2') ||
                            movinCoinprofile.classList.contains('movinCoinprofile3')) {
                            if (additionalClass.includes('yellow')) {
                                coinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                coinImg.style.left =
                                    `${Math.floor(Math.random() * 121) + 70}%`; // Left range: 70-120
                            } else if (additionalClass.includes('blue')) {
                                coinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                coinImg.style.left =
                                    `${Math.floor(Math.random() * 115) + 361}%`; // Left range: 361-475
                            }
                        } else if (movinCoinprofile.classList.contains('movinCoinprofile4') ||
                            movinCoinprofile.classList.contains('movinCoinprofile5') ||
                            movinCoinprofile.classList.contains('movinCoinprofile6')) {
                            if (additionalClass.includes('yellow')) {
                                coinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                coinImg.style.left =
                                    `${-Math.floor(Math.random() * 137) - 308}%`; // Left range: -308% to -444%
                            } else if (additionalClass.includes('blue')) {
                                coinImg.style.top = `${Math.floor(Math.random() * 19) + 166}%`;
                                coinImg.style.left =
                                    `${-Math.floor(Math.random() * 119) - 20}%`; // Left range: -20% to -138%
                            }
                        }

                        // Call the function again for the next profile after 500ms
                        setTimeout(() => createMovingCoin(i + 1), 900);
                    }, 1000);

                } else {
                    // Skip to the next profile after 500ms
                    setTimeout(() => createMovingCoin(i + 1), 500);
                }
            }

            setInterval(() => createMovingCoin(), 3500);
        });

        document.addEventListener('DOMContentLoaded', function() {
            function getRandomElement(arr) {
                const randomIndex = Math.floor(Math.random() * arr.length);
                return arr[randomIndex];
            }

            function getRandomNumber(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            function createMovingCoinProfile7() {
                if (!allowCoinCreation) return;
                const movinCoinprofile7 = document.querySelector('.movinCoinprofile7');

                if (movinCoinprofile7) {
                    const coinImg = document.createElement('img');
                    coinImg.src = getRandomElement([
                        '{{ asset('/assets/images/frontend/images/yellow10.png') }}',
                        '{{ asset('/assets/images/frontend/images/green50.png') }}',
                        '{{ asset('/assets/images/frontend/images/blue100.png') }}',
                        '{{ asset('/assets/images/frontend/images/orange500.png') }}',
                        '{{ asset('/assets/images/frontend/images/black1k.png') }}',
                        '{{ asset('/assets/images/frontend/images/purple5k.png') }}'
                    ]);

                    coinImg.classList.add('moving-coin-bottom');

                    // Determine the class to add based on the profile index
                    const additionalClass = getRandomElement(['moving-coin7yellow',
                        'moving-coin7blue'
                    ]);
                    coinImg.classList.add(additionalClass);

                    // Append the coin image to the profile div
                    movinCoinprofile7.appendChild(coinImg);

                    setTimeout(() => {
                        if (additionalClass.includes('yellow')) {
                            coinImg.style.top =
                                `${-Math.floor(Math.random() * 76) - 150}%`; // Top range: -150% to -225%
                            coinImg.style.right =
                                `${Math.floor(Math.random() * 21) + 60}%`; // Right range: 60% to 80%
                        } else if (additionalClass.includes('blue')) {
                            coinImg.style.top =
                                `${-Math.floor(Math.random() * 76) - 150}%`; // Top range: -150% to -225%
                            coinImg.style.right =
                                `${Math.floor(Math.random() * 22) + 10}%`; // Right range: 10% to 31%
                        }
                    }, 1000);
                } else {
                    console.log('No movinCoinprofile7 found.');
                }

                // Schedule the next coin creation with a random interval between 100 and 500 ms
                const nextInterval = getRandomNumber(100, 500);
                setTimeout(createMovingCoinProfile7, nextInterval);
            }

            // Initial call to start the cycle
            createMovingCoinProfile7();
        });

        function placeBet(face, amount) {
            // Prepare data for AJAX request
            let data = {
                user_id: userData.id,
                log_id: gameLog.id,
                bet_amount: amount,
                bet_on: face
            };
            if (amount !== 0) {
                // Send AJAX request
                $.ajax({
                    url: "{{ route('dragon.tiger.place.bet') }}",
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

        function updateWallet(userId) {
            let data = {
                'user_id': userId,
                'log_id': gameLog.id,
                'result': finalResult
            };
            $.ajax({
                url: "{{ route('dragon.tiger.wallet.update') }}",
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

        function checkAmount(face, amt) {
            // Calculate the new total amount after placing the bet
            let potentialTotalAmount = totalBetOnDragon + totalBetOnTiger + chosenAmount + totalBetOnTie;

            // Check if the user has sufficient balance
            if (potentialTotalAmount > userData.wallet.balance) {
                alert('Insufficient balance to place bet.');
                return;
            }

            // Update bet amounts and place the bet

            if (face === 'dragon') {
                totalBetOnDragon += chosenAmount;
                placeBet(face, totalBetOnDragon);
            } else if (face === 'tiger') {
                totalBetOnTiger += chosenAmount;
                placeBet(face, totalBetOnTiger);
            } else if (face === 'tie') {
                totalBetOnTie += chosenAmount;
                placeBet(face, totalBetOnTie);
            }
            // Update the total amount and bet count
            totalAmount = totalBetOnDragon + totalBetOnTiger + totalBetOnTie;
            betCount += 1;

            // Update the user's wallet balance in the UI
            let userBalanceElement = document.getElementById('user-wallet-balance');
            let userBalance = parseInt(userBalanceElement.textContent) - chosenAmount;
            userBalanceElement.textContent = userBalance;
        }
    </script>

</body>

</html>
