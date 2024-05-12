
function gameover(lastint) {
    $.ajax({
        url: '/game/game_over',
        type: "POST",
        data: {
            _token: hash_id,
            "last_time": lastint,
            'gameType': 0
        },
        dataType: "text",
        success: function (result) {
            // updateGameStatus(0);
            $("#wallet_balance").text(currency_symbol + result);
            $("#header_wallet_balance").text(currency_symbol + result); // Show Header Wallet Balance
            // for(let i=0;i < bet_array.length; i++){
            //     if(bet_array[i] && bet_array[i].is_bet){
            //         bet_array.splice(i, 1);
            //     }
            // }
            // bet_array = [];
        }
    });
}

function currentid() {
    $.ajax({
        url: '/game/currentid',
        type: "post",
        data: {
            _token: hash_id
        },
        dataType: "json",
        success: function (result) {
        }
    });
}
function getGameStatus() {
    $.ajax({
        url: 'getGameStatus',
        type: "get",
        dataType: "json",
        success: function(response) {
            
        }
        });
}
function updateGameStatus(data) {
    $.ajax({
        url: 'updateGameStatus',
        type: "POST",
        data: {
            _token: hash_id,
            status: data,
            updatedAt: new Date()
        },
        dataType: "json",
        success: function(response) {
        }
    });
}
function getCurrNewBets() {
    $.ajax({
                                url: '/game/currentlybetnew',
                                type: "POST",
                                data: {
                                    _token: hash_id
                                },
                                dataType: "json",
                                success: function (intialData) {
                                    window.allBetData = intialData.currentGameBet;
                                    info_data(intialData);
                                }
                            });
}
function generateNewGame() {
    
    var incNo = 1.0;
    setTimeout(() => {
        $("#auto_increment_number_div").hide();
        $('.loading-game').addClass('show');
        $.ajax({
                                url: '/game/my_bets_history',
                                type: "POST",
                                data: {
                                    _token: hash_id
                                },
                                dataType: "json",
                                success: function (data) {
                                    $("#my_bet_list").append();
                                    for (let $i = 0; $i < data.length; $i++) {
                                        let date = new Date(data[$i].created_at);
                                        $("#my_bet_list").append(`
                                    <div class="list-items">
                                    <div class="column-1 users fw-normal">
                                        `+date.getHours()+`:`+date.getMinutes()+`
                                    </div>
                                    <div class="column-2">
                                        <button
                                            class="btn btn-transparent previous-history d-flex align-items-center mx-auto fw-normal">
                                            `+data[$i].amount+`₹
                                        </button>
                                    </div>
                                    <div class="column-3">

                                        <div class="bg3 custom-badge mx-auto">
                                            `+data[$i].cashout_multiplier+`x</div>
                                    </div>
                                    <div class="column-4 fw-normal">
                                        `+Math.round(data[$i].cashout_multiplier*data[$i].amount)+`₹
                                    </div>
                                </div>
                                `);
                                    }
                                }
                            });
        setTimeout(() => {
            getCurrNewBets();
            $.ajax({
                url: '/game/new_game_generated',
                type: "POST",
                data: {
                    _token: hash_id,
                    gameType: 0
                },
                dataType: "json",
                success: function(result) {
                    window.gameId = result.id;
                    if (bet_array.length > 0) {
                        for(let i=0;i < bet_array.length; i++) {
                            bet_array[i].game_id = result.id;
                        }
                        place_bet_now();
                    }
                    info_data(result['currentBetResponse']);
                    current_game_data = result;
                    hide_loading_game();
                    new_game_generated();
                    lets_fly_one();
                     lets_fly();
                     let currentbet = 0;
                     $.ajax({
                            url: '/game/increamentor',
                            type: "POST",
                            data: {
                                _token: hash_id
                            },
                            dataType: "json",
                            success: function (data) {
                                currentbet = data.result;
                                window.currentbet = currentbet;
                                if(window.currentlyBet) {
                                    currentbet = window.currentlyBet;
                                }
                                // getCurrNewBets();
                                var incSpeed = data.incSpeed;
                                incSpeed = incSpeed * 100;
                                var increamtsappgame = setInterval(() => {
                                    if(incNo >= currentbet) {
                                    let res = parseFloat(incNo).toFixed(2);
                                    let result = res;
                                    crash_plane(result);
                                    incrementor(res);
                                    gameover(result);
                                    clearInterval(increamtsappgame);
                                    generateNewGame();
                                } else {
                                    incNo = parseFloat(incNo) + 0.01;
                                    incrementor(parseFloat(incNo).toFixed(2));
                                }
                                }, incSpeed);
                            }
                        });
                }
            });
        }, 5000);
    }, 1500);
}
function check_game_running(event) {
    
}

$(document).ready(function () {
    check_game_running("check");
//     gamegenerate();
});