$('body').addClass('overflow-hidden');

function scrollFunction() {
    $(".list-body").mCustomScrollbar({
        scrollInertia: 50,
        theme: "dark-3"
    });
}
scrollFunction();


document.addEventListener("visibilitychange", function () {
    // console.log(document.visibilityState); // "hidden" or "visible"
    // console.log(document.hidden); // true or false
    const music = document.getElementById("background_Audio");
    if (document.hidden) {
        music.pause();
    } else {
        if (window_blur == 0) {
            bet_array.splice(1, 1);
            music.play();
        } else {
            music.pause();
        }
        // sound.play()
    }
}, false);

/*-------HINAL (START)-------*/
$(document).on('hidden.bs.modal', '#bet-history', function () {
    $(".bet_record_count").remove();
})
/*---------HINAL (END)-------*/

// Bet Tab Change Functionality START
$(".tabs-navs .nav-item").click(function () {
    $(this).parent().parent().find(".nav-item").removeClass('active');
    $(this).addClass('active');
});

$(".auto-btn").click(function () {
    $(this).parent().parent().find("#bet_type").val(1);
});

$(".bet-btn").click(function () {
    $(this).parent().parent().find("#bet_type").val(0);
});

$(".navigation-switcher .slider").click(function () {
    $(this).parent().find(".slider").removeClass('active');
    $(this).addClass('active');

    const type = $(this).text();
    if (type == 'Auto') {
        $(this).parent().parent().parent().find(".second-row").addClass('show');
    } else {
        $(this).parent().parent().parent().find(".second-row").removeClass('show');
    }
});

$(".cash-out-switcher .form-check .form-check-input").change(function () {
    if (this.checked) {
        $(this).parent().parent().parent().find(".cashout-spinner-wrapper input").attr('disabled', false);
        $(this).parent().parent().parent().parent().parent().find(".navigation").addClass('stop-action');
    } else {
        $(this).parent().parent().parent().find(".cashout-spinner-wrapper input").attr('disabled', true);
        $(this).parent().parent().parent().parent().parent().find(".navigation").removeClass('stop-action');
    }
});

$("#remove_extra_section_btn").click(function () {
    $("#extra_bet_section").hide();
    $("#add_extra_bet_section_btn").show();
});

$("#add_extra_bet_section_btn").click(function () {
    $("#extra_bet_section").show();
    $("#add_extra_bet_section_btn").hide();
});
// Bet Tab Change Functionality END

function bet_amount_incremental(element) {
    var bet_amount = parseFloat($(element).parent().parent().find(".input #bet_amount").val());
    bet_amount++;
    if (bet_amount <= max_bet_amount) {
        $(element).parent().parent().find(".input #bet_amount").val(bet_amount);
    }
}

function bet_amount_decremental(element) {
    var bet_amount = parseFloat($(element).parent().parent().find(".input #bet_amount").val());
    bet_amount--;
    if (bet_amount >= min_bet_amount) {
        $(element).parent().parent().find(".input #bet_amount").val(bet_amount);
    }
}

function select_direct_bet_amount(element) {
    var current_bet_amount = parseFloat($(element).parent().parent().find(".input #bet_amount").val());
    var adding_bet_amount = parseFloat($(element).find(".amt").text()).toFixed(2);
    if ($(element).hasClass('same')) {
        var new_bet_amount = parseFloat(parseFloat(current_bet_amount) + parseFloat(adding_bet_amount)).toFixed(2);
        if (new_bet_amount <= max_bet_amount) {
            $(element).parent().parent().find(".input #bet_amount").val(new_bet_amount);
        }
    } else {
        $(element).parent().find('.bet-opt').removeClass('same');
        $(element).addClass('same');
        $(element).parent().parent().find(".input #bet_amount").val(adding_bet_amount);
    }
}

var current_game_count;
var multiplier_limit = 0;
var stop_position = 0;

$('.loading-game').addClass('show');
// gameLoadingTimer();

$(document).ready(function () {
    // function viewTicket(ticketData) {
    //         var ticketData = JSON.parse(ticketData);
    //         // console.log(ticketData)
    //         $('.view-ticket-modal').addClass('show');
    //         $('.view-ticket-modal').css('display', 'block');
    //         $('.modal-body').prepend("<span class='senderName'>"+ticketData[0].name+"</span>")
    //         ticketData.forEach((item) => {
    //             // console.log(item)
    //             if(item.userType == 1 && item.message != null) {
    //                 $(".chatSection").append("<div class='senderMsg admin'>"+item.message+"</div>");
    //             } else {
    //                 if(item.message != null) {
    //                     $(".chatSection").append("<div class='senderMsg user'>"+item.message+"</div>");
    //                 }
    //             }
    //         });
    //     }
    $(window).on('beforeunload', function() {
        bet_array = [];
    //     $.ajax({
    //     url: 'updateBets',
    //     data: {
    //         gameId: window.gameId,
    //     },
    //     type: "get",
    //     dataType: "json",
    // });
        // gameover($("#auto_increment_number").text());
    })
    $.ajax({
        url: '/checkAdsExpiration',
                            type: "POST",
                            data: {
                                _token: hash_id
                            },
                            dataType: "json",
                            success: function (intialData) {
                            }
    });
    let music = document.getElementById("background_Audio");
    music.volume = 0.2;
    if ($("#music").prop("checked") == true) {
        music.loop = true;
        music.load();
    } else {
        music.pause();
    }
    $("#wallet_balance").text(currency_symbol + wallet_balance); // Show Wallet Balance
    // $("#header_wallet_balance").text(currency_symbol + wallet_balance); // Show Header Wallet Balance
});

function info_data(intialData) {
    current_game_data = intialData.currentGame;
    current_game_count = intialData.currentGameBetCount;
    show_bet_count(current_game_count);
    window.allBetData = intialData.currentGameBet;
    window.currentUserId = intialData.currentUserId;
    update_bet_list(intialData.currentGameBet, '#all_bets .mCSB_container', 1);
}

var main_counter = 0;
var extra_counter = 0;
function cash_out_now(element, sectionNo, increment = '') {
    // $.ajax({
    //     url: 'updateCashOutBets',
    //     data: {
    //         gameId: window.gameId,
    //     },
    //     type: "get",
    //     dataType: "json",
    //     success: function (result) {
    //         // console.log(result);
    //         if(result.status == 1) {
    //             $("#mCSB_1_container .list-items").each(() => {
    //                 if(!$(this).hasClass("active")) {
    //                     $.each(result.data, function(index, element) {
    //                     // console.log("Index: " + index + ", Value: " + element);
    //                     if($(this).find(".column1.users").attr("id") == element.userid) {
    //                         $(this).addClass("active");
    //                         $(this).find('.column-3').html('<div class="' + get_multiplier_badge_class(element.cashout_multiplier) + ' custom-badge mx-auto">' + element.cashout_multiplier + 'x</div>');
    //                         $(this).find('.column-4').html((element.cashout_multiplier * element.give_amount).toFixed(2));
    //                     }
    //                   });
    //                 }
    //             });
    //         }
    //     }
    // });
    // console.log(game_id);
    // window.cashOutSectionNo = sectionNo;
    var incrementor = $("#auto_increment_number").text().slice(0, -1);
    let betId;
    let betAmt;
    if(sectionNo == 0) {
        cashOutSound();
        enableDisable('main_bet_section');
        betId = $("#main_bet_id").val();
        if(!window.bettingAmt) {
            betAmt = $("#main_bet_section #bet_amount").val();
        } else {
            betAmt = window.bettingAmt;
        }
        // betAmt = $("#main_bet_section #bet_amount").val();
        let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');
        if(is_main_auto_bet_checked) {
            $("#main_bet_section").find("#bet_button").hide();
            $("#main_bet_section").find("#cancle_button").show();
            $("#main_bet_section").find("#cancle_button #waiting").show();
            $("#main_bet_section").find("#cashout_button").hide();
            $("#main_bet_section .controls").removeClass('bet-border-yellow');
            $("#main_bet_section .controls").addClass('bet-border-red');
        } else {
            var i = 0;
            bet_array.forEach((bet) => {
                if(sectionNo == bet.section_no) {
                    bet_array.splice(i, 1);
                }
                i++;
            });
            $("#main_bet_section").find("#bet_button").show();
            $("#main_bet_section").find("#cancle_button").hide();
            $("#main_bet_section").find("#cancle_button #waiting").hide();
            $("#main_bet_section").find("#cashout_button").hide();
            $("#main_bet_section .controls").removeClass('bet-border-red');
            $("#main_bet_section .controls").removeClass('bet-border-yellow');
        }
        var amt = parseFloat(parseFloat(incrementor) * parseFloat(betAmt)).toFixed(2);
        $("#main_bet_section").find("#cash_out_amount").text('');
        $(".cashout-toaster1 .stop-number").html(incrementor + 'x');
        $(".cashout-toaster1 .out-amount").html(amt + currency_symbol);
        $(".cashout-toaster1").addClass('show');
    } else {
        cashOutSoundOtherSection();
        enableDisable('extra_bet_section');
        betId = $("#extra_bet_id").val();
        betAmt = $("#extra_bet_section #bet_amount").val();
        let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');
        if (is_extra_auto_bet_checked) {
            $("#extra_bet_section").find("#bet_button").hide();
            $("#extra_bet_section").find("#cancle_button").show();
            $("#extra_bet_section").find("#cancle_button #waiting").show();
            $("#extra_bet_section").find("#cashout_button").hide();
            $("#extra_bet_section .controls").removeClass('bet-border-yellow');
            $("#extra_bet_section .controls").addClass('bet-border-red');
        } else {
            var i = 0;
            bet_array.forEach((bet) => {
                if(sectionNo == bet.section_no) {
                    bet_array.splice(i, 1);
                }
                i++;
            });
            $("#extra_bet_section").find("#bet_button").show();
            $("#extra_bet_section").find("#cancle_button").hide();
            $("#extra_bet_section").find("#cancle_button #waiting").hide();
            $("#extra_bet_section").find("#cashout_button").show();
            $("#extra_bet_section").find("#cashout_button").hide();
            $("#extra_bet_section .controls").removeClass('bet-border-red');
            $("#extra_bet_section .controls").removeClass('bet-border-yellow');
        }
        var amt = parseFloat(parseFloat(incrementor) * parseFloat(betAmt)).toFixed(2);
        $("#extra_bet_section").find("#cash_out_amount").text('');
        $(".cashout-toaster2 .stop-number").html(incrementor + 'x');
        $(".cashout-toaster2 .out-amount").html(amt + currency_symbol);
        $(".cashout-toaster2").addClass('show');
        secondToastr();
    }
    $.ajax({
        url: 'cash_out',
        data: {
            game_id: game_id,
            bet_id: betId,
            win_multiplier: incrementor,
            betAmt: betAmt
        },
        type: "get",
        dataType: "json",
        success: function (result) {
            if (result.isSuccess) {
                var userId = $("#username").text();
                // var target = $(".list-items .column-1.users[id="+ userId +"]").parents(".list-items:first");÷ß
                var target = $("#all_bets .mCSB_container").find(".list-items .users[id="+ userId +"]").parents(".list-items:first");
                // console.log(target);
                $(target).addClass("active");
                $(target).find(".column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
                $(target).find(".column-4").html((incrementor * betAmt).toFixed(2) + currency_symbol);
                
                if (result.data.wallet_balance != '' && result.data.wallet_balance != NaN && result.data.wallet_balance != 'NaN') {
                    $("#wallet_balance").text(currency_symbol + result.data.wallet_balance);
                    $("#header_wallet_balance").text(currency_symbol + result.data.wallet_balance); // Show Header Wallet Balance
                } else {
                    $("#wallet_balance").text(currency_symbol + '0.00');
                    $("#header_wallet_balance").text(currency_symbol + '0.00'); // Show Header Wallet Balance
                }
                
                if (sectionNo == 0) {
                    $("#my_bet_list #my_bet_section_0").addClass('active');
                    $("#my_bet_list #my_bet_section_0 .column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
                    $("#my_bet_list #my_bet_section_0 .column-4").html(result.data.cash_out_amount.toFixed(2) + currency_symbol);
                    $("#my_bet_list #my_bet_section_0").removeAttr('id');
                    $("#main_auto_bet").prop('disabled', false);
                    // $("#all_bets #all_bet_section_0").removeAttr('id');
                    let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');
                    if (is_main_auto_bet_checked == false) {
                        // Main Bet Button and text box enable
                        $(".main_bet_amount").prop('disabled', false);
                        $("#main_plus_btn").prop('disabled', false);
                        $("#main_minus_btn").prop('disabled', false);
                        $(".main_amount_btn").prop('disabled', false);
                        $("#main_checkout").prop('disabled', false)
                        if ($("#main_checkout").prop('checked')) {
                            $("#main_incrementor").prop('disabled', false);
                        }
                    }
                    $("#main_auto_bet").prop('disabled', false);
                } else {
                    let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');
                    if (is_extra_auto_bet_checked == false) {
                        // Main Bet Button and text box enable
                        $(".extra_bet_amount").prop('disabled', false);
                        $("#extra_minus_btn").prop('disabled', false);
                        $("#extra_plus_btn").prop('disabled', false);
                        $(".extra_amount_btn").prop('disabled', false);
                        $("#extra_checkout").prop('disabled', false);
                        if ($("#extra_checkout").prop('checked')) {
                            $("#extra_incrementor").prop('disabled', false);
                        }
                    }
                    $("#my_bet_list #my_bet_section_1").removeAttr('id');
                    $("#extra_auto_bet").prop('disabled', false);

                }
            }
        }
    });
}
// function cash_out_now(element, section_no, increment = '') {
//     window.cashOutNow = true;
//     if (section_no == 0) {
//         cashOutSound();
//     } else {
//         cashOutSoundOtherSection();
//     }

//     let incrementor;
//     if (increment != '') {
//         incrementor = increment;
//     } else {
//         incrementor = $("#auto_increment_number").text().slice(0, -1);
//     }

//     if (section_no == 0) {
//         enableDisable('main_bet_section');
//         main_cash_out = 0;
//     } else {
//         enableDisable('extra_bet_section');
//         extra_cash_out = 0;
//     }

// let bet_id;
//     if (section_no == 0) {
//         bet_id = $("#main_bet_id").val();
//         var bet_amount = $("#main_bet_section #bet_amount").val();
//     } else {
//         bet_id = $("#extra_bet_id").val();
//         var bet_amount = $("#extra_bet_section #bet_amount").val();
//     }
//     var i = 0;
//     bet_array.forEach((bet) => {
//         if(section_no == bet.section_no) {
//             bet_array.splice(i, 1);
//         }
//         i++;
//     });
//     // let incrementor = $("#auto_increment_number").text().slice(0,-1);
//     game_id = current_game_data.id

//     if (currency_id == 1) {
//         var amt = parseFloat(parseFloat(incrementor) * parseFloat(bet_amount)).toFixed(2);
//     } else {
     
//         var amt = parseFloat(parseFloat(incrementor) * (parseFloat(bet_amount))).toFixed(2);
//     }
//         $('#all_bets .mCSB_container .bet_id_' + member_id + section_no + '').addClass('active');
//         $('#all_bets .mCSB_container .bet_id_' + member_id + section_no + ' .column-3').html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
//         $('#all_bets .mCSB_container .bet_id_' + member_id + section_no + ' .column-4').html(amt + currency_symbol);    
//     if (section_no == 0) {
//         let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');
//         if (is_main_auto_bet_checked) {
//             $("#main_bet_section").find("#bet_button").hide();
//             $("#main_bet_section").find("#cancle_button").show();
//             $("#main_bet_section").find("#cancle_button #waiting").show();
//             $("#main_bet_section").find("#cashout_button").hide();
//             $("#main_bet_section .controls").removeClass('bet-border-yellow');
//             $("#main_bet_section .controls").addClass('bet-border-red');
//         } else {
//             $("#main_bet_section").find("#bet_button").show();
//             $("#main_bet_section").find("#cancle_button").hide();
//             $("#main_bet_section").find("#cancle_button #waiting").hide();
//             $("#main_bet_section").find("#cashout_button").hide();
//             $("#main_bet_section .controls").removeClass('bet-border-red');
//             $("#main_bet_section .controls").removeClass('bet-border-yellow');
//         }

//         $("#main_bet_section").find("#cash_out_amount").text('');
//         $(".cashout-toaster1 .stop-number").html(incrementor + 'x');
//         $(".cashout-toaster1 .out-amount").html(amt + currency_symbol);
//         $(".cashout-toaster1").addClass('show');
//         // firstToastr();
//     }

//     if (section_no == 1) {
//         let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');
//         if (is_extra_auto_bet_checked) {
//             $("#extra_bet_section").find("#extra_bet_now").hide();
//             // $("#extra_bet_section").find("#extra_cancel_now").show();
//             $("#extra_bet_section").find("#cancle_button #waiting").show();
//             $("#extra_bet_section").find("#extra_cashout_button").hide();
//             $("#extra_bet_section .controls").removeClass('bet-border-yellow');
//             $("#extra_bet_section .controls").addClass('bet-border-red');
//         } else {
//             $("#extra_bet_section").find("#extra_bet_now").show();
//             // $("#extra_bet_section").find("#extra_cancel_now").hide();
//             $("#extra_bet_section").find("#cancle_button #waiting").hide();
//             $("#extra_bet_section").find("#extra_cashout_button").hide();
//             $("#extra_bet_section .controls").removeClass('bet-border-red');
//             $("#extra_bet_section .controls").removeClass('bet-border-yellow');
//         }

//         $("#extra_bet_section").find("#cash_out_amount").text('');
//         $(".cashout-toaster2 .stop-number").html(incrementor + 'x');
//         $(".cashout-toaster2 .out-amount").html(amt + currency_symbol);
//         $(".cashout-toaster2").addClass('show');
//         secondToastr();
//     }

//     // toastr.success('You have cashed out! ' + incrementor + 'x You got ' + amt + currency_symbol);

    // $.ajax({
    //     url: 'cash_out',
    //     data: {
    //         game_id: game_id,
    //         bet_id: bet_id,
    //         win_multiplier: incrementor,
    //     },
    //     type: "get",
    //     dataType: "json",
    //     success: function (result) {
    //         if (result.isSuccess) {
    //             var userId = $("#username").text();
    //             var target = $(".list-items .column-1.users[id="+ userId +"]").parents(".list-items:first");
    //             $(target).addClass("active");
    //             $(target).find(".column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //             $(target).find(".column-4").html(result.data.cash_out_amount + currency_symbol);
                
    //             if (result.data.wallet_balance != '' && result.data.wallet_balance != NaN && result.data.wallet_balance != 'NaN') {
    //                 $("#wallet_balance").text(currency_symbol + result.data.wallet_balance);
    //                 $("#header_wallet_balance").text(currency_symbol + result.data.wallet_balance); // Show Header Wallet Balance
    //             } else {
    //                 $("#wallet_balance").text(currency_symbol + '0.00');
    //                 $("#header_wallet_balance").text(currency_symbol + '0.00'); // Show Header Wallet Balance
    //             }
                
    //             if (section_no == 0) {
    //                 $("#my_bet_list #my_bet_section_0").addClass('active');
    //                 $("#my_bet_list #my_bet_section_0 .column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $("#my_bet_list #my_bet_section_0 .column-4").html(result.data.cash_out_amount + currency_symbol);
    //                 let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');

    //                 $("#my_bet_list #my_bet_section_0").removeAttr('id');

    //                 if (is_main_auto_bet_checked == false) {
    //                     $("#main_bet_section").find("#bet_button").show();
    //                     $("#main_bet_section").find("#cancle_button").hide();
    //                     $("#main_bet_section").find("#cancle_button #waiting").hide();
    //                     $("#main_bet_section").find("#cashout_button").hide();
    //                     $("#main_bet_section .controls").removeClass('bet-border-red');
    //                     $("#main_bet_section .controls").removeClass('bet-border-yellow');
    //                     // Main Bet Button and text box enable
    //                     $(".main_bet_amount").prop('disabled', false);
    //                     $("#main_plus_btn").prop('disabled', false);
    //                     $("#main_minus_btn").prop('disabled', false);
    //                     $(".main_amount_btn").prop('disabled', false);
    //                     $("#main_checkout").prop('disabled', false)
    //                     if ($("#main_checkout").prop('checked')) {
    //                         $("#main_incrementor").prop('disabled', false);
    //                     }
    //                 } else {
    //                     $("#main_bet_section").find("#bet_button").hide();
    //                     $("#main_bet_section").find("#cancle_button").show();
    //                     $("#main_bet_section").find("#cancle_button #waiting").show();
    //                     $("#main_bet_section").find("#cashout_button").hide();
    //                     $("#main_bet_section .controls").removeClass('bet-border-yellow');
    //                     $("#main_bet_section .controls").addClass('bet-border-red');
    //                 }
    //                 $("#main_auto_bet").prop('disabled', false);
    //                 var userId = $("#username").text();
    //                 var target = $("#main_auto_bet #all_bet_section_0").find(".column-1.users[id='" + userId + "']").parents(".list-items:first");
    //                 $("#main_auto_bet #all_bet_section_0").find(".column-1.users[id='" + userId + "']").addClass("active");
    //                 $("#main_auto_bet #all_bet_section_0").find(".column-1.users[id='" + userId + "']")
    //                 $(target).find(".column-1.users").addClass("active");
    //                 $(target).find(".colunn-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $("#all_bets #all_bet_section_0").addClass('active');
    //                 $("#all_bets #all_bet_section_0 .column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $("#all_bets #all_bet_section_0 .column-4").html(result.data.cash_out_amount + currency_symbol);
    //                 $(".list-items.active").find(".column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $(".list-items.active").find(".column-4").html(result.data.cash_out_amount + currency_symbol);
    //                 // let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');

    //                 $("#all_bets #all_bet_section_0").removeAttr('id');

    //                 if (is_main_auto_bet_checked == false) {
    //                     // Main Bet Button and text box enable
    //                     $(".main_bet_amount").prop('disabled', false);
    //                     $("#main_plus_btn").prop('disabled', false);
    //                     $("#main_minus_btn").prop('disabled', false);
    //                     $(".main_amount_btn").prop('disabled', false);
    //                     $("#main_checkout").prop('disabled', false)
    //                     if ($("#main_checkout").prop('checked')) {
    //                         $("#main_incrementor").prop('disabled', false);
    //                     }
    //                 }
    //                 $("#main_auto_bet").prop('disabled', false);
    //             }
                
    //             if (section_no == 1) {
    //                 let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');
    //                 if (is_extra_auto_bet_checked == false) {
    //                     $("#extra_bet_section").find("#bet_button").show();
    //                     $("#extra_bet_section").find("#cancle_button").hide();
    //                     $("#extra_bet_section").find("#cancle_button #waiting").hide();
    //                     $("#extra_bet_section").find("#cashout_button").hide();
    //                     $("#extra_bet_section .controls").removeClass('bet-border-red');
    //                     $("#extra_bet_section .controls").removeClass('bet-border-yellow');
    //                     // Main Bet Button and text box enable
    //                     $(".extra_bet_amount").prop('disabled', false);
    //                     $("#extra_minus_btn").prop('disabled', false);
    //                     $("#extra_plus_btn").prop('disabled', false);
    //                     $(".extra_amount_btn").prop('disabled', false);
    //                     $("#extra_checkout").prop('disabled', false);
    //                     if ($("#extra_checkout").prop('checked')) {
    //                         $("#extra_incrementor").prop('disabled', false);
    //                     }
    //                 } else {
    //                     $("#extra_bet_section").find("#bet_button").hide();
    //                     $("#extra_bet_section").find("#cancle_button").show();
    //                     $("#extra_bet_section").find("#cancle_button #waiting").show();
    //                     $("#extra_bet_section").find("#cashout_button").hide();
    //                     $("#extra_bet_section .controls").removeClass('bet-border-yellow');
    //                     $("#extra_bet_section .controls").addClass('bet-border-red');
    //                 }
                    
    //                 $("#my_bet_list #my_bet_section_1").addClass('active');
    //                 $("#my_bet_list #my_bet_section_1 .column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $("#my_bet_list #my_bet_section_1 .column-4").html(result.data.cash_out_amount + currency_symbol);
    //                 $(".list-items.active").find(".column-3").html('<div class="' + get_multiplier_badge_class(incrementor) + ' custom-badge mx-auto">' + incrementor + 'x</div>');
    //                 $(".list-items.active").find(".column-4").html(result.data.cash_out_amount + currency_symbol);
    //                 // let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');

    //                 $("#my_bet_list #my_bet_section_1").removeAttr('id');
    //                 $("#extra_auto_bet").prop('disabled', false);

    //             }
    //         }
    //     }
    // });
// }

function crash_plane(inc_no) {
    // console.log(inc_no)
    $(".cashout-toaster1").removeClass('show');
    window.planeCrash = inc_no;
    const main_bet_id = $("#main_bet_id").val();
    const extra_bet_id = $("#extra_bet_id").val();
    if(window.cashOutNow == false) {
        if(!$("#main_auto_bet").prop('checked')) {
            var i = 0;
            var currentSectionBets = 0;
            bet_array.forEach((bet) => {
                if(bet.section_no == 0) {
                    if(bet.game_id == current_game_data.id) {
                        bet_array.splice(i, 1);
                    } else {
                        currentSectionBets++;
                    }
                }
               i++;
            });
            if(currentSectionBets == 0) {
                $("#main_bet_section").find("#bet_button").show();
                $("#main_bet_section").find("#cancle_button").hide();
                $("#main_bet_section").find("#cancle_button #waiting").hide();
                $("#main_bet_section").find("#cashout_button").hide();
                $("#main_bet_section .controls").removeClass('bet-border-red');
                $("#main_bet_section .controls").removeClass('bet-border-yellow');
            } else {
                $("#main_bet_section").find("#bet_button").hide();
                $("#main_bet_section").find("#cancle_button").show();
                $("#main_bet_section").find("#cancle_button #waiting").show();
                $("#main_bet_section").find("#cashout_button").hide();
                $("#main_bet_section .controls").addClass('bet-border-red');
            }
        }
        if(!$("#extra_auto_bet").prop('checked')) {
            var i = 0;
            var currentSectionBets = 0;
            bet_array.forEach((bet) => {
                if(bet.section_no == 1) {
                    if(bet.game_id == current_game_data.id) {
                        bet_array.splice(i, 1);
                    } else {
                        currentSectionBets++;
                    }
                }
               i++;
            });
            if(currentSectionBets == 0) {
                $("#extra_bet_section").find("#bet_button").show();
                $("#extra_bet_section").find("#cancle_button").hide();
                $("#extra_bet_section").find("#cancle_button #waiting").hide();
                $("#extra_bet_section").find("#cashout_button").hide();
                $("#extra_bet_section .controls").removeClass('bet-border-red');
                $("#extra_bet_section .controls").removeClass('bet-border-yellow');
            } else {
                $("#extra_bet_section").find("#bet_button").hide();
                $("#extra_bet_section").find("#cancle_button").show();
                $("#extra_bet_section").find("#cancle_button #waiting").show();
                $("#extra_bet_section").find("#cashout_button").hide();
                $("#extra_bet_section .controls").addClass('bet-border-red');
            }
        }
    }
    soundPlay();
    firstToastr();
    window.clearInterval(StopPlaneIntervalID);
    $(".flew_away_section").show();
    $("#auto_increment_number").addClass('text-danger');
    stopPlane();
    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
    $("#running_type").text('rest time');
    update_round_history(inc_no);
    const number_of_bet = $(".round-history-list").find('.custom-badge').length;
    if (number_of_bet > 50) {
        $(".round-history-list").find('.custom-badge:last').remove();
    }

    let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');
    let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');

    

    setTimeout(function () {
        const incrementor = $("#auto_increment_number").text().slice(0, -1);
        if (main_cash_out == 2) {
            $("#main_bet_id").val(main_bet_id);
            const main_inc = main_incrementor;
            if (parseFloat(incrementor) >= parseFloat(main_inc)) {
                cash_out_now('', 0, main_inc);
                console.log(4);
            }
            $("#main_bet_id").val('');
        }

        if (extra_cash_out == 2) {
            $("#extra_bet_id").val(extra_bet_id);
            const extra_inc = extra_incrementor;
            if (parseFloat(incrementor) >= parseFloat(extra_inc) && !window.cashedOut) {
                window.cashedOut = true;
                cash_out_now('', 1, extra_inc);
            }
            $("#extra_bet_id").val('');
        }
        window.cashedOut = true;
        main_cash_out = 0;
        extra_cash_out = 0;
    }, 1000);

    

    // if (bet_array.length == 2) {
        if (bet_array[0] && bet_array[0].is_bet != undefined) {
            if (bet_array[0].section_no == 0) {
                $("#cash_out_amount").val("");
                if (is_main_auto_bet_checked) {
                    $("#main_bet_section").find("#bet_button").hide();
                    $("#main_bet_section").find("#cancle_button").show();
                    $("#main_bet_section").find("#cancle_button #waiting").show();
                    $("#main_bet_section").find("#cashout_button").hide();
                    $("#main_bet_section .controls").removeClass('bet-border-yellow');
                    $("#main_bet_section .controls").addClass('bet-border-red');
                } else {
                    $("#main_bet_section").find("#bet_button").show();
                    $("#main_bet_section").find("#cancle_button").hide();
                    $("#main_bet_section").find("#cancle_button #waiting").hide();
                    $("#main_bet_section").find("#cashout_button").hide();
                    $("#main_bet_section .controls").removeClass('bet-border-red');
                    $("#main_bet_section .controls").removeClass('bet-border-yellow');

                    // Main Bet
                    $(".main_bet_amount").prop('disabled', false);
                    $("#main_plus_btn").prop('disabled', false);
                    $("#main_minus_btn").prop('disabled', false);
                    $(".main_amount_btn").prop('disabled', false);
                    $("#main_checkout").prop('disabled', false);
                    if ($("#main_checkout").prop('checked')) {
                        $("#main_incrementor").prop('disabled', false);
                    }
                }

                $("#main_bet_id").val('');
                // $("#main_bet_section").find("#cash_out_amount").text('');


                $("#main_auto_bet").prop('disabled', false);
            } else if (bet_array[0].section_no == 1) {
                if (is_extra_auto_bet_checked) {
                    $("#extra_bet_section").find("#bet_button").hide();
                    $("#extra_bet_section").find("#cancle_button").show();
                    $("#extra_bet_section").find("#cancle_button #waiting").show();
                    $("#extra_bet_section").find("#cashout_button").hide();
                    $("#extra_bet_section .controls").removeClass('bet-border-yellow');
                    $("#extra_bet_section .controls").addClass('bet-border-red');
                } else {
                    $("#extra_bet_section").find("#bet_button").show();
                    $("#extra_bet_section").find("#cancle_button").hide();
                    $("#extra_bet_section").find("#cancle_button #waiting").hide();
                    $("#extra_bet_section").find("#cashout_button").hide();
                    $("#extra_bet_section .controls").removeClass('bet-border-red');
                    $("#extra_bet_section .controls").removeClass('bet-border-yellow');

                    // Extra Bet
                    $(".extra_bet_amount").prop('disabled', false);
                    $("#extra_minus_btn").prop('disabled', false);
                    $("#extra_plus_btn").prop('disabled', false);
                    $(".extra_amount_btn").prop('disabled', false);
                    $("#extra_checkout").prop('disabled', false);
                    if ($("#extra_checkout").prop('checked')) {
                        $("#extra_incrementor").prop('disabled', false);
                    }
                }

                $("#extra_bet_id").val('');
                $("#extra_bet_section").find("#cash_out_amount").text('');


                $("#extra_auto_bet").prop('disabled', false);
            }
        }
        if (bet_array[1] && bet_array[1].is_bet != undefined) {
            if (bet_array[1].section_no == 0) {
                if (is_main_auto_bet_checked) {
                    $("#main_bet_section").find("#bet_button").hide();
                    $("#main_bet_section").find("#cancle_button").show();
                    $("#main_bet_section").find("#cancle_button #waiting").show();
                    $("#main_bet_section").find("#cashout_button").hide();
                    $("#main_bet_section .controls").removeClass('bet-border-yellow');
                    $("#main_bet_section .controls").addClass('bet-border-red');
                } else {
                    // $("#main_bet_section").find("#bet_button").show();
                    // $("#main_bet_section").find("#cancle_button").hide();
                    // $("#main_bet_section").find("#cancle_button #waiting").hide();
                    // $("#main_bet_section").find("#cashout_button").hide();
                    // $("#main_bet_section .controls").removeClass('bet-border-red');
                    // $("#main_bet_section .controls").removeClass('bet-border-yellow');

                    // // Main Bet
                    // $(".main_bet_amount").prop('disabled', false);
                    // $("#main_plus_btn").prop('disabled', false);
                    // $("#main_minus_btn").prop('disabled', false);
                    // $(".main_amount_btn").prop('disabled', false);
                    // $("#main_checkout").prop('disabled', false);
                    // if ($("#main_checkout").prop('checked')) {
                    //     $("#main_incrementor").prop('disabled', false);
                    // }
                }

                $("#main_bet_id").val('');
                $("#main_bet_section").find("#cash_out_amount").text('');


                $("#main_auto_bet").prop('disabled', false);
            } else if (bet_array[1].section_no == 1) {
                if (is_extra_auto_bet_checked) {
                    $("#extra_bet_section").find("#bet_button").hide();
                    $("#extra_bet_section").find("#cancle_button").show();
                    $("#extra_bet_section").find("#cancle_button #waiting").show();
                    $("#extra_bet_section").find("#cashout_button").hide();
                    $("#extra_bet_section .controls").removeClass('bet-border-yellow');
                    $("#extra_bet_section .controls").addClass('bet-border-red');
                } else {
                    // $("#extra_bet_section").find("#bet_button").show();
                    // $("#extra_bet_section").find("#cancle_button").hide();
                    // $("#extra_bet_section").find("#cancle_button #waiting").hide();
                    // $("#extra_bet_section").find("#cashout_button").hide();
                    // $("#extra_bet_section .controls").removeClass('bet-border-red');
                    // $("#extra_bet_section .controls").removeClass('bet-border-yellow');

                    // // Extra Bet
                    // $(".extra_bet_amount").prop('disabled', false);
                    // $("#extra_minus_btn").prop('disabled', false);
                    // $("#extra_plus_btn").prop('disabled', false);
                    // $(".extra_amount_btn").prop('disabled', false);
                    // $("#extra_checkout").prop('disabled', false);
                    // if ($("#extra_checkout").prop('checked')) {
                    //     $("#extra_incrementor").prop('disabled', false);
                    // }
                }

                $("#extra_bet_id").val('');
                $("#extra_bet_section").find("#cash_out_amount").text('');


                $("#extra_auto_bet").prop('disabled', false);
            }
        }
    // }
    // console.log(bet_array);
}
// function getAllBetData() {
//     $.ajax({
//         url: '/game/currentlybetnew',
//                             type: "POST",
//                             data: {
//                                 _token: hash_id
//                             },
//                             dataType: "json",
//                             success: function (intialData) {
//                                 // info_data(intialData);
//                                 window.allBetData = intialData.currentGameBet;
//                             }
//     });
// }

function new_game_generated() {
    window.planeCrash = false;
    window.main_counter = false;
    window.extra_counter = false;
    window.cashOutNow = false;
    $(".list-items").removeClass("active");
    // getAllBetData();
    $("#cash_out_amount").text('');
    is_game_generated = 1;
    $('#my_bet_list .mCSB_container .list-items').removeAttr('id');
    $(".game-centeral-loading").show();

    $("#main_bet_section").find("#cancle_button #waiting").hide();
    $("#extra_bet_section").find("#cancle_button #waiting").hide();

    if (bet_array.length == 1) {
        if (bet_array[0].section_no == 0) {
            enableDisable('main_bet_section');
        }
        if (bet_array[0].section_no == 1) {
            enableDisable('extra_bet_section');
        }
    }
    if (bet_array.length == 2) {
        enableDisable('main_bet_section');
        enableDisable('extra_bet_section');
    }

    $(".load-txt").hide();
    $('body').removeClass('overflow-hidden');
    document.getElementById('auto_increment_number').innerText = '1.00x';
    // $('.loading-game').addClass('show');
    //khushbu
    $('.loading-game').addClass('show');
    // setTimeout(hide_loading_game(), 10000);
    $(".flew_away_section").hide();
    $("#auto_increment_number").removeClass('text-danger');
    $("#all_bets .mCSB_container").html('');
    $("#running_type").text('bet time');
    $("#auto_increment_number_div").hide();
    //khushbu
    current_game_count = 0;

    let is_main_auto_bet_checked = $("#main_auto_bet").prop('checked');
    if (is_main_auto_bet_checked) {
        if (bet_array.length != 2 && (bet_array.length == 0 || (bet_array.length == 1 && bet_array[0].section_no != 0))) {
            var bet_type = $("#main_bet_now").parent().parent().parent().find(".navigation #bet_type").val(); // 0 - Normal, 1 - Auto
            let bet_amount = $("#main_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val();

            if (bet_amount < min_bet_amount || bet_amount == '' || bet_amount == NaN) {
                bet_amount = parseFloat(min_bet_amount).toFixed(2);
            } else if (bet_amount > max_bet_amount) {
                bet_amount = parseFloat(max_bet_amount).toFixed(2);
            } else {
                bet_amount = parseFloat(bet_amount).toFixed(2);
            }

            $("#main_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val(bet_amount);

            if (bet_amount >= min_bet_amount && bet_amount <= max_bet_amount) {
                bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: 0 });
            }
        }

    }

    let is_extra_auto_bet_checked = $("#extra_auto_bet").prop('checked');
    if (is_extra_auto_bet_checked) {
        if (bet_array.length != 2 && (bet_array.length == 0 || (bet_array.length == 1 && bet_array[0].section_no != 1))) {
            var bet_type = $("#extra_bet_now").parent().parent().parent().find(".navigation #bet_type").val(); // 0 - Normal, 1 - Auto
            let bet_amount = $("#extra_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val();

            if (bet_amount < min_bet_amount || bet_amount == '' || bet_amount == NaN) {
                bet_amount = parseFloat(min_bet_amount).toFixed(2);
            } else if (bet_amount > max_bet_amount) {
                bet_amount = parseFloat(max_bet_amount).toFixed(2);
            } else {
                bet_amount = parseFloat(bet_amount).toFixed(2);
            }

            $("#extra_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val(bet_amount);

            if (bet_amount >= min_bet_amount && bet_amount <= max_bet_amount) {
                bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: 1 });
            }
        }

    }

}

function lets_fly_one() {
    is_game_generated = 0;
    $(".stage-board").addClass('blink_section');
    $(".bet-controls").addClass('blink_section');
}

function lets_fly() {
    $(".stage-board").removeClass('blink_section');
    $(".bet-controls").removeClass('blink_section');
    stage_time_out = 0;
    if (bet_array.length == 1 && bet_array[0] && bet_array[0].section_no == 0) {
        enableDisable('main_bet_section');
        $("#main_bet_section").find("#bet_button").hide();
        $("#main_bet_section").find("#cancle_button").hide();
        $("#main_bet_section").find("#cancle_button #waiting").hide();
        $("#main_bet_section").find("#cashout_button").show();
        $("#main_bet_section .controls").removeClass('bet-border-red');
        $("#main_bet_section .controls").addClass('bet-border-yellow');
        $("#main_auto_bet").prop('disabled', true);
        $("#main_checkout").prop('disabled', true);
        $("#main_incrementor").prop('disabled', true);
    }

    if (bet_array.length == 1 && bet_array[0] && bet_array[0].section_no == 1) {
        enableDisable('extra_bet_section');
        $("#extra_bet_section").find("#bet_button").hide();
        $("#extra_bet_section").find("#cancle_button").hide();
        $("#extra_bet_section").find("#cancle_button #waiting").hide();
        $("#extra_bet_section").find("#cashout_button").show();
        $("#extra_bet_section .controls").removeClass('bet-border-red');
        $("#extra_bet_section .controls").addClass('bet-border-yellow');
        $("#extra_auto_bet").prop('disabled', true);
        $("#extra_checkout").prop('disabled', true);
        $("#extra_incrementor").prop('disabled', true);
    }

    if (bet_array.length == 2) {

        if (bet_array[0] && bet_array[0].section_no == 0) {
            enableDisable('main_bet_section');
            $("#main_bet_section").find("#bet_button").hide();
            $("#main_bet_section").find("#cancle_button").hide();
            $("#main_bet_section").find("#cancle_button #waiting").hide();
            $("#main_bet_section").find("#cashout_button").show();
            $("#main_bet_section .controls").removeClass('bet-border-red');
            $("#main_bet_section .controls").addClass('bet-border-yellow');
            $("#main_auto_bet").prop('disabled', true);
            $("#main_checkout").prop('disabled', true);
            $("#main_incrementor").prop('disabled', true);
        }

        if (bet_array[0] && bet_array[0].section_no == 1) {
            enableDisable('extra_bet_section');
            $("#extra_bet_section").find("#bet_button").hide();
            $("#extra_bet_section").find("#cancle_button").hide();
            $("#extra_bet_section").find("#cancle_button #waiting").hide();
            $("#extra_bet_section").find("#cashout_button").show();
            $("#extra_bet_section .controls").removeClass('bet-border-red');
            $("#extra_bet_section .controls").addClass('bet-border-yellow');
            $("#extra_auto_bet").prop('disabled', true);
            $("#extra_checkout").prop('disabled', true);
            $("#extra_incrementor").prop('disabled', true);
        }

        if (bet_array[1] && bet_array[1].section_no == 0) {
            enableDisable('main_bet_section');
            $("#main_bet_section").find("#bet_button").hide();
            $("#main_bet_section").find("#cancle_button").hide();
            $("#main_bet_section").find("#cancle_button #waiting").hide();
            $("#main_bet_section").find("#cashout_button").show();
            $("#main_bet_section .controls").removeClass('bet-border-red');
            $("#main_bet_section .controls").addClass('bet-border-yellow');
            $("#main_auto_bet").prop('disabled', true);
            $("#main_checkout").prop('disabled', true);
            $("#main_incrementor").prop('disabled', true);
        }

        if (bet_array[1] && bet_array[1].section_no == 1) {
            enableDisable('extra_bet_section');
            $("#extra_bet_section").find("#bet_button").hide();
            $("#extra_bet_section").find("#cancle_button").hide();
            $("#extra_bet_section").find("#cancle_button #waiting").hide();
            $("#extra_bet_section").find("#cashout_button").show();
            $("#extra_bet_section .controls").removeClass('bet-border-red');
            $("#extra_bet_section .controls").addClass('bet-border-yellow');
            $("#extra_auto_bet").prop('disabled', true);
            $("#extra_checkout").prop('disabled', true);
            $("#extra_incrementor").prop('disabled', true);
        }
    }

    $(".load-txt").hide();
    $('body').removeClass('overflow-hidden');
    $('.loading-game').removeClass('show');
    $("#auto_increment_number_div").show();
    setVariable(1);
    flyPlaneSound();
}
function incrementor(inc_no) {
    $('.loading-game').removeClass('show');
    $("#auto_increment_number_div").show();
    $("#running_type").text('cash out time');
    // console.log(inc_no);
    // $("#auto_increment_number").val(inc_no + '' + 'x');
    document.getElementById('auto_increment_number').innerText = inc_no + '' + 'x';
    var userId = $("#username").text();
    if (window.allBetData) {
            for (var i = 0; i < window.allBetData.length; i++) {
                var target = $("#" + window.allBetData[i].userid).parents(".list-items:first");
                var changeContentValue = i + 1;
                var userId = $("#username").text();
                var cashOut = '-';
                var multiplication = '-';
                if(!$(target).hasClass("active") && parseFloat(window.allBetData[i].cashout_multiplier > 0 && window.allBetData[i].cashout_multiplier) <= inc_no) {
                    if (parseFloat(window.allBetData[i].cashout_multiplier) <= 2) {
                        var badgeColor = 'bg3';
                    } else if (parseFloat(window.allBetData[i].cashout_multiplier) < 10) {
                        var badgeColor = 'bg1';
                    } else {
                        var badgeColor = 'bg2';
                    }
                    // if(window.allBetData[i].cashOutAmount == undefined) {
                    //     console.log(window.allBetData[i]);
                    // }
                        cashOut = (window.allBetData[i].cashout_multiplier * window.allBetData[i].amount).toFixed(2) + currency_symbol;
                        multiplication = '<div class="' + badgeColor + ' custom-badge mx-auto">' + window.allBetData[i].cashout_multiplier + 'x</div>';
                    $(target).find(".column-3").html(multiplication);
                    $(target).find(".column-4").text(cashOut);
                    $(target).addClass("active");
                }
            }
        }
    if (bet_array.length > 0) {
        let main_isChecked = $('#main_checkout').prop('checked');
        let extra_isChecked = $("#extra_checkout").prop('checked');
        let incrementor;
        for (let i = 0; i < bet_array.length; i++) {
            if (bet_array[i].section_no == 0) {
                if (bet_array[i].is_bet == 1) {
                    if (main_isChecked == true) {
                        incrementor = $('#main_incrementor').val();
                        main_incrementor = incrementor;
                        if (parseFloat(inc_no) >= parseFloat(incrementor)) {
                            if (!window.main_counter) {
                                cash_out_now('', 0, incrementor);
                                window.main_counter = true;
                                main_cash_out = 1;
                            }
                        } else {
                            main_cash_out = 2;
                        }
                    }
                }
            } else if (bet_array[i].section_no == 1) {
                if (bet_array[i].is_bet == 1) {
                    if (extra_isChecked == true) {
                        incrementor = $('#extra_incrementor').val();
                        extra_incrementor = incrementor;
                        if (parseFloat(inc_no) >= parseFloat(incrementor)) {
                            if (!window.extra_counter) {
                                cash_out_now('', 1, incrementor);
                                console.log(4);
                                window.extra_counter = true;
                                extra_counter = 1;
                            }
                        } else {
                            extra_cash_out = 2;
                        }
                    }
                }
            }
        }

    }
    if (bet_array.length > 0) {
        cash_out_multiplier(inc_no);
    }
    setTimeout(() => {
    firstToastr();
    }, 5000);
}

function cash_out_bet(cashOutData) {
    $('#all_bets .mCSB_container .' + cashOutData.hash_id + '').addClass('active');
    $('#all_bets .mCSB_container .' + cashOutData.hash_id + ' .column-3').html('<div class="' + get_multiplier_badge_class(cashOutData.incrementor) + ' custom-badge mx-auto">' + cashOutData.incrementor + 'x</div>');
    if (currency_id == 1) {
        var amt = cashOutData.inr_amount;
    } else {
        var amt = cashOutData.dollar_amount;
    }
    $('#all_bets .mCSB_container .' + cashOutData.hash_id + ' .column-4').html(amt + currency_symbol);
}

function update_bet_list(bets, target, appendType) {
    //khushbu
    if (appendType == 1) {
        $("#all_bets .mCSB_container").html('');
    }
    if (appendType == 2) {
        $('#prev_bets .mCSB_container').html('');
    }
    if (appendType == 1) {
     var html = '';
     var currentUserRow = '';
     for (let key in bets) {
  if (bets.hasOwnProperty(key)) {
      var cashOut = '-';
            var multiplication = '-';
            if (parseFloat(bets[key].cashout_multiplier) <= 2) {
                var badgeColor = 'bg3';
            } else if (parseFloat(bets[key].cashout_multiplier) < 10) {
                var badgeColor = 'bg1';
            } else {
                var badgeColor = 'bg2';
            }
            var isActive = "";
            if(bet_array.length == 0 && window.planeCrash != false) {
                if (parseFloat(bets[key].cashout_multiplier) > 0 && window.planeCrash > bets[key].cashout_multiplier) {
                    var cashOut = Math.round(bets[key].cashout_multiplier*bets[key].amount) + currency_symbol;
                    var multiplication = '<div class="' + badgeColor + ' custom-badge mx-auto">' + bets[key].cashout_multiplier + 'x</div>';
                    isActive = "active";
                } else {
                    var cashOut = '-';
                    var multiplication = '-';
                }
            }
            let sectionNo;
            if(bets[key].section_no) {
                sectionNo = bets[key].section_no;
            }
            if(window.currentUserId && bets[key].userid == window.currentUserId) {
                currentUserRow += '<div class="list-items ' + sectionNo + ' ' + ' ' + isActive + ' ' + '" section="'+ sectionNo +'">' +
                '<div class="column-1 users" id='+ bets[key].userid +'> <img src="' + bets[key].image + '" class="avatar me-1"> ' + bets[key].userid + ' </div>' +
                '<div class="column-2"> <button class="btn btn-transparent previous-history d-flex align-items-center mx-auto"> ' + bets[key].amount + currency_symbol + ' </button> </div>' +
                '<div class="column-3"> ' + multiplication + ' </div>' +
                '<div class="column-4"> ' + cashOut + ' </div>' +
                '</div>';
            } else {
                html += '<div class="list-items ' + sectionNo + ' ' + ' ' + isActive + ' ' + '" section="'+ sectionNo +'">' +
                '<div class="column-1 users" id='+ bets[key].userid +'> <img src="' + bets[key].image + '" class="avatar me-1"> ' + bets[key].userid + ' </div>' +
                '<div class="column-2"> <button class="btn btn-transparent previous-history d-flex align-items-center mx-auto"> ' + bets[key].amount + currency_symbol + ' </button> </div>' +
                '<div class="column-3"> ' + multiplication + ' </div>' +
                '<div class="column-4"> ' + cashOut + ' </div>' +
                '</div>';
            }
            
  }
}
        
        if(currentUserRow != "") {
            html = currentUserRow + html;
        }
        $(target).html(html);
    }
}

function update_my_new_bet(bet_amount, section_no, target) {
    var html = '';
    html += '<div class="list-items" id="my_bet_section_' + section_no + '">' +
        '<div class="column-1 users fw-normal"> ' + get_current_hour_minute() + ' </div>' +
        '<div class="column-2"> <button class="btn btn-transparent previous-history d-flex align-items-center mx-auto fw-normal">' + parseFloat(bet_amount).toFixed(2) + '' + currency_symbol + '</button> </div>' +
        '<div class="column-3"> - </div>' +
        '<div class="column-4 fw-normal"> - </div>' +
        '</div>';
    $(target).prepend(html);
    // $(target).html(html);  
}

function get_multiplier_badge_class(multiplier) {
    if (parseFloat(multiplier) <= 2) {
        return 'bg3';
    } else if (parseFloat(multiplier) < 10) {
        return 'bg1';
    } else {
        return 'bg2';
    }
}

function previous_hand(val) {
    if (val == 1) {
        $("#current_hand_btn").addClass('hide');
        $("#previous_hand_btn").removeClass('hide');
        $("#all_bets").addClass('hide');
        $("#prev_bets").removeClass('hide');
        $("#prev_win_multi").removeClass('hide');
        //khushbu
        prevoius_game_bets(current_game_data.id);
    } else {
        $("#current_hand_btn").removeClass('hide');
        $("#previous_hand_btn").addClass('hide');
        $("#all_bets").removeClass('hide');
        $("#prev_bets").addClass('hide');
        $("#prev_win_multi").addClass('hide');
        //khushbu
        
        show_bet_count($('#all_bets .mCSB_container .list-items').length);
    }
};

function prevoius_game_bets(game_id) {
    $.ajax({
        url: 'previous_game_bet_list',
        data: {
            game_id: game_id,
        },
        type: "POST",
        dataType: "json",
        success: function (result) {
            if (result.isSuccess && Object.keys(result.data).length > 0) {
                var betList = result.data.bet_list;
                var betCount = result.data.bet_counts;
                var winMulti = result.data.win_multi;
                update_bet_list(betList, '#prev_bets .mCSB_container', 2);
                //khushbu
                show_bet_count(betCount);
                $("#prev_win_multi").addClass(get_multiplier_badge_class(winMulti)).text(parseFloat(winMulti).toFixed(2) + 'x');
            } else {
                $("#prev_win_multi").addClass('bg1');
            }
        }
    });
}

function cash_out_multiplier(inc_no) {
    if (bet_array.length == 1 && bet_array[0].section_no == 0) {
        $("#main_bet_section").find("#cash_out_amount").text(parseFloat(bet_array[0].bet_amount * inc_no).toFixed(2) + '' + currency_symbol);
    }
    if (bet_array.length == 1 && bet_array[0].section_no == 1) {
        $("#extra_bet_section").find("#cash_out_amount").text(parseFloat(bet_array[0].bet_amount * inc_no).toFixed(2) + '' + currency_symbol);
    }

    if (bet_array.length == 2) {
        $.map(bet_array, function (item, index) {
            if (item.section_no == 0) {
                $("#main_bet_section").find("#cash_out_amount").text(parseFloat(item.bet_amount * inc_no).toFixed(2) + '' + currency_symbol);
            }
            if (item.section_no == 1) {
                $("#extra_bet_section").find("#cash_out_amount").text(parseFloat(item.bet_amount * inc_no).toFixed(2) + '' + currency_symbol);
            }
        });
    }
}

function show_bet_count(count) {
    $("#total_bets").text(count);
}

function bet_now(element, section_no) {
    if (stage_time_out == 1) {
        if (section_no == 0) {
            enableDisable('main_bet_section');
        } else {
            enableDisable('extra_bet_section');
        }
        $(".error-toaster2").addClass('show');
        errorToastrStageTimeOut();
    } else {
        var bet_type = $(element).parent().parent().parent().find(".navigation #bet_type").val(); // 0 - Normal, 1 - Auto
        // var bet_amount = parseFloat($(element).parent().parent().find(".bet-block .spinner #bet_amount").val());
        let bet_amount = $(element).parent().parent().find(".bet-block .spinner #bet_amount").val();

        if (section_no == 0) {
            $("#main_bet_section .controls").addClass('bet-border-red');
        } else if (section_no == 1) {
            $("#extra_bet_section .controls").addClass('bet-border-red');
        }

        if (bet_amount < min_bet_amount || bet_amount == '' || bet_amount == NaN) {
            bet_amount = parseFloat(min_bet_amount).toFixed(2);
        } else if (bet_amount > max_bet_amount) {
            bet_amount = parseFloat(max_bet_amount).toFixed(2);
        } else {
            bet_amount = parseFloat(bet_amount).toFixed(2);
        }

        $(element).parent().parent().find(".bet-block .spinner #bet_amount").val(bet_amount);

        if (bet_amount >= min_bet_amount && bet_amount <= max_bet_amount) {
            $(element).parent().parent().find("#bet_button").hide();
            $(element).parent().parent().find("#cancle_button").show();
            $(element).parent().parent().find("#cancle_button #waiting").show();

            if (is_game_generated == 1) {
                setTimeout(() => {
                    $(element).parent().parent().find("#cancle_button #waiting").hide();
                }, 1000);
            }
            bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
        }
    }
}

function cancle_now(element, section_no) {
    if (stage_time_out == 1) {
        $(".error-toaster2").addClass('show');
        errorToastrStageTimeOut();
    } else {
        if (section_no == 0) {
            $('#main_auto_bet').prop('checked', false);
            $("#main_bet_section .controls").removeClass('bet-border-red');
        } else if (section_no == 1) {
            $('#extra_auto_bet').prop('checked', false);
            $("#extra_bet_section .controls").removeClass('bet-border-red');
        }

        if (bet_array.length == 1) {
            bet_array = [];
        } 
        if (bet_array.length == 2 && section_no == 0) {
            if (bet_array[0].section_no == 0) {
                bet_array.splice(0, 1); // Remove Perticular Bet
            } 
            
            if (bet_array[0].section_no == 1) {
                bet_array.splice(1, 1); // Remove Perticular Bet
            }
        }

        // delete bet_array[section_no];
        $(element).parent().parent().find("#bet_button").show();
        $(element).parent().parent().find("#cancle_button").hide();
        $(element).parent().parent().find("#cancle_button #waiting").hide();
    }
}

function place_bet_now() {
    // for(let i=0;i < bet_array.length; i++) {
    //     bet_array[i].game_id = current_game_data.id;
    // }
    $.ajax({
        url: '/game/add_bet',
        data: {
            _token: hash_id,
            all_bets: bet_array
        },
        type: "POST",
        dataType: "json",
        success: function (result) {
            if (result.isSuccess) {

                if (result.data.wallet_balance != '' && result.data.wallet_balance != NaN && result.data.wallet_balance != 'NaN') {
                    $("#wallet_balance").text(currency_symbol + result.data.wallet_balance);
                    $("#header_wallet_balance").text(currency_symbol + result.data.wallet_balance); // Show Header Wallet Balance
                } else {
                    $("#wallet_balance").text(currency_symbol + '0.00');
                    $("#header_wallet_balance").text(currency_symbol + '0.00'); // Show Header Wallet Balance
                }

                if (bet_array.length == 1) {
                    update_my_new_bet(bet_array[0].bet_amount, bet_array[0].section_no, '#my_bet_list .mCSB_container');
                } else if (bet_array.length == 2) {
                    if (bet_array[0] != undefined) {
                        update_my_new_bet(bet_array[0].bet_amount, bet_array[0].section_no, '#my_bet_list .mCSB_container');
                    }
                    if (bet_array[1] != undefined) {
                        update_my_new_bet(bet_array[1].bet_amount, bet_array[1].section_no, '#my_bet_list .mCSB_container');
                    }
                }

                if (bet_array.length == 1 && bet_array[0].section_no == 0) {
                    bet_array[0].is_bet = 1;
                    enableDisable('main_bet_section');
                    $("#main_bet_id").val(result.data.return_bets[0].bet_id);
                    bet_array[0].betId = result.data.return_bets[0].bet_id;
                }

                if (bet_array.length == 1 && bet_array[0].section_no == 1) {
                    bet_array[0].is_bet = 1;
                    enableDisable('extra_bet_section');
                    $("#extra_bet_id").val(result.data.return_bets[0].bet_id);
                    bet_array[0].betId = result.data.return_bets[0].bet_id;
                }

                if (bet_array.length == 2) {

                    if (bet_array[0].section_no == 0) {
                        $("#main_bet_id").val(result.data.return_bets[0].bet_id);
                        // $("#extra_bet_id").val(result.data.return_bets[1].bet_id);
                        bet_array[0].is_bet = 1;
                        bet_array[0].betId = result.data.return_bets[0].bet_id;
                    }

                    if (bet_array[0].section_no == 1) {
                        // $("#main_bet_id").val(result.data.return_bets[1].bet_id);
                        $("#extra_bet_id").val(result.data.return_bets[0].bet_id);
                        bet_array[0].is_bet = 1;
                        bet_array[0].betId = result.data.return_bets[0].bet_id;
                    }
                    if (bet_array[1].section_no == 0) {
                        $("#main_bet_id").val(result.data.return_bets[0].bet_id);
                        // $("#extra_bet_id").val(result.data.return_bets[1].bet_id);
                        bet_array[1].is_bet = 1;
                        bet_array[1].betId = result.data.return_bets[1].bet_id;
                    }

                    if (bet_array[1].section_no == 1) {
                        // $("#main_bet_id").val(result.data.return_bets[1].bet_id);
                        $("#extra_bet_id").val(result.data.return_bets[0].bet_id);
                        bet_array[1].is_bet = 1;
                        bet_array[1].betId = result.data.return_bets[1].bet_id;
                    }
                }
            } else {
                $(".error-toaster1 .msg").html(result.message);
                $(".error-toaster1").addClass('show');
                errorToastr();

                $("#main_bet_section").find("#bet_button").show();
                $("#main_bet_section").find("#cancle_button").hide();
                $("#main_bet_section").find("#cancle_button #waiting").hide();
                $("#main_bet_section").find("#cashout_button").hide();
                $("#main_bet_section .controls").removeClass('bet-border-red');
                $("#main_bet_section .controls").removeClass('bet-border-yellow');
                $("#main_bet_section .controls .navigation").removeClass('stop-action');

                $("#extra_bet_section").find("#bet_button").show();
                $("#extra_bet_section").find("#cancle_button").hide();
                $("#extra_bet_section").find("#cancle_button #waiting").hide();
                $("#extra_bet_section").find("#cashout_button").hide();
                $("#extra_bet_section .controls").removeClass('bet-border-red');
                $("#extra_bet_section .controls").removeClass('bet-border-yellow');
                $("#extra_bet_section .controls .navigation").removeClass('stop-action');

                // Main Bet
                $(".main_bet_amount").prop('disabled', false);
                $("#main_plus_btn").prop('disabled', false);
                $("#main_minus_btn").prop('disabled', false);
                $(".main_amount_btn").prop('disabled', false);
                $("#main_checkout").prop('disabled', false)
                if ($("#main_checkout").prop('checked')) {
                    $("#main_incrementor").prop('disabled', false);
                }
                $('#main_auto_bet').prop('checked', false);

                // Extra Bet
                $(".extra_bet_amount").prop('disabled', false);
                $("#extra_minus_btn").prop('disabled', false);
                $("#extra_plus_btn").prop('disabled', false);
                $(".extra_amount_btn").prop('disabled', false);
                $("#extra_checkout").prop('disabled', false);
                if ($("#extra_checkout").prop('checked')) {
                    $("#extra_incrementor").prop('disabled', false);
                }
                $('#extra_auto_bet').prop('checked', false);

                bet_array = [];
            }
        }

    });
}

function firstToastr() {
    let first_no = 1;
    var success_toast1 = setInterval(function () {
        if (first_no < 3) {
            first_no++;
        } else {
            $(".cashout-toaster1").removeClass('show');
            clearInterval(success_toast1);
        }
    }, 5000); // for every 5 second
}

function secondToastr() {
    let second_no = 1;
    var success_toast2 = setInterval(function () {
        if (second_no < 3) {
            second_no++;
        } else {
            $(".cashout-toaster2").removeClass('show');
            clearInterval(success_toast2);
        }
    }, 1000); // for every second
}

function errorToastr() {
    let error_no = 1;
    var error_toast1 = setInterval(function () {
        if (error_no < 3) {
            error_no++;
        } else {
            $(".error-toaster1").removeClass('show');
            clearInterval(error_toast1);
        }
    }, 1000); // for every second
}

function errorToastrStageTimeOut() {
    let stage_error_no = 1;
    var error_toast_stage_time_out = setInterval(function () {
        if (stage_error_no < 3) {
            stage_error_no++;
        } else {
            $(".error-toaster2").removeClass('show');
            clearInterval(error_toast_stage_time_out);
        }
    }, 1000); // for every second
}

function get_current_hour_minute() {
    var date = new Date;
    var hour = date.getHours();
    var minutes = date.getMinutes();

    if (hour.toString().length > 1) {
        var retHour = hour;
    } else {
        var retHour = '0' + hour;
    }

    if (minutes.toString().length > 1) {
        var retMinute = minutes;
    } else {
        var retMinute = '0' + minutes;
    }

    return retHour + ':' + retMinute;
}

function update_round_history(inc_no) {
    var html = '<div class="' + get_multiplier_badge_class(inc_no) + ' custom-badge">' + parseFloat(inc_no).toFixed(2) + 'x</div>'
    $(".payouts-wrapper .payouts-block").prepend(html);
    $(".button-block .history-dropdown .round-history-list").prepend(html);
}

/*-------HINAL (START)-------*/

function loadData() {
    const numItems = $('.bet_record_count').length;
    $.ajax({
        url: '/member_bet',
        type: 'post',
        data: {
            'offset': numItems,
        },
        success: function (result) {
            const length = result.data.length;
            if (length > 0) {
                for (let i = 0; i < length; i++) {
                    if (parseFloat(result.data[i].multiplication) > 0) {
                        var multiplier = `<div class="${get_multiplier_badge_class(result.data[i].multiplication)} custom-badge mx-auto"> ${result.data[i].multiplication}x </div>`;
                    } else {
                        var multiplier = `-`;
                    }
                    $("#member_bet .mCSB_container").append(`
                        <div class="list-items bet_record_count ${result.data[i].cash_out_amount > 0 ? 'active' : ''}">
                            <div class="column-1 users fw-normal">
                                ${result.data[i].date}
                            </div>
                            <div class="column-2">
                                <button class="btn btn-transparent previous-history d-flex align-items-center mx-auto fw-normal">
                                    ${result.data[i].bet_amount + currency_symbol}
                                </button>
                            </div>
                            <div class="column-3">
                                ${multiplier}
                            </div>
                            <div class="column-4 fw-normal">
                                ${result.data[i].cash_out_amount > 0 ? result.data[i].cash_out_amount + currency_symbol : '-'} 
                            </div>
                        </div>
                    `);
                }
            }
            if (length < 10) {
                $("#load_btn").hide();
            } else {
                $("#load_btn").show();
            }
        }
    })
}

$("#main_auto_bet").on('change', function () {
    let isChecked = $(this).prop('checked');
    let section_no = 0;
    const isCheckedCashout = $("#main_checkout").prop('checked');

    if (isChecked) {
        $("#main_bet_section").find("#bet_button").hide();
        $("#main_bet_section").find("#cancle_button").show();
        $("#main_bet_section").find("#cancle_button #waiting").show();
        if (is_game_generated == 1) {
            setTimeout(() => {
                $("#main_bet_section").find("#cancle_button #waiting").hide();
            }, 500);
        }
        $("#main_bet_section").find("#cashout_button").hide();
        $("#main_bet_section .controls").addClass('bet-border-red');
        $("#main_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', true)
        $("#main_bet_section").find('.controls .navigation').addClass('stop-action')
        var bet_type = $("#main_bet_now").parent().parent().parent().find(".navigation #bet_type").val(); // 0 - Normal, 1 - Auto
        let bet_amount = $("#main_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val();

        if (bet_amount < min_bet_amount || bet_amount == '' || bet_amount == NaN) {
            bet_amount = parseFloat(min_bet_amount).toFixed(2);
        } else if (bet_amount > max_bet_amount) {
            bet_amount = parseFloat(max_bet_amount).toFixed(2);
        } else {
            bet_amount = parseFloat(bet_amount).toFixed(2);
        }

        $("#main_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val(bet_amount);

        if (bet_amount >= min_bet_amount && bet_amount <= max_bet_amount) {
            if (bet_array.length == 1) {
                if (bet_array[0].section_no != section_no) {
                    bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
                }
            } else if (bet_array.length == 2) {
                if (bet_array[0].section_no != section_no && bet_array[1].section_no != section_no) {
                    bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
                }
            } else {
                bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
            }
        }

        $(".main_bet_amount").prop('disabled', true);
        $("#main_plus_btn").prop('disabled', true);
        $("#main_minus_btn").prop('disabled', true);
        $(".main_amount_btn").prop('disabled', true);
        $("#main_checkout").prop('disabled', true);
        if ($("#main_checkout").prop('checked')) {
            $("#main_incrementor").prop('disabled', true);
        }

    } else {
        if (isCheckedCashout == false) {
            $("#main_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', false)
            $("#main_bet_section").find('.controls .navigation').removeClass('stop-action')
        } else {
            $("#main_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', true)
            $("#main_bet_section").find('.controls .navigation').addClass('stop-action')
        }
        // if(bet_array.length == 1) {
        //     bet_array.splice(0, 1); // Remove Perticular Bet
        // } else if (bet_array.length == 2 && section_no == 0) {
        //     bet_array.splice(0, 1); // Remove Perticular Bet
        // } else if (bet_array.length == 2 && section_no == 1) {
        //     bet_array.splice(1, 1); // Remove Perticular Bet
        // }

        if (bet_array.length == 1) {
            bet_array.splice(0, 1); // Remove Perticular Bet
        } else if (bet_array.length == 2 && section_no == 0) {
            if (bet_array[0].section_no == 0) {
                bet_array.splice(0, 1); // Remove Perticular Bet
            } else {
                bet_array.splice(1, 1); // Remove Perticular Bet
            }
            
        } else if (bet_array.length == 2 && section_no == 1) {
            if (bet_array[0].section_no == 1) {
                bet_array.splice(0, 1); // Remove Perticular Bet
            } else {
                bet_array.splice(1, 1); // Remove Perticular Bet
            }
        }

        $("#main_bet_section").find("#bet_button").show();
        $("#main_bet_section").find("#cancle_button").hide();
        $("#main_bet_section").find("#cancle_button #waiting").hide();
        $("#main_bet_section").find("#cashout_button").hide();
        $("#main_bet_section .controls").removeClass('bet-border-red');

        $(".main_bet_amount").prop('disabled', false);
        $("#main_plus_btn").prop('disabled', false);
        $("#main_minus_btn").prop('disabled', false);
        $(".main_amount_btn").prop('disabled', false);
        $("#main_checkout").prop('disabled', false)
        if ($("#main_checkout").prop('checked')) {
            $("#main_incrementor").prop('disabled', false);
        }
    }

});

$("#extra_auto_bet").on('change', function () {
    let isChecked = $(this).prop('checked');
    let section_no = 1;
    const isCheckedCashout = $('#extra_checkout').prop('checked');

    if (isChecked) {
        $("#extra_bet_section").find("#bet_button").hide();
        $("#extra_bet_section").find("#cancle_button").show();
        $("#extra_bet_section").find("#cancle_button #waiting").show();
        if (is_game_generated == 1) {
            setTimeout(() => {
                $("#extra_bet_section").find("#cancle_button #waiting").hide();
            }, 500);
        }
        $("#extra_bet_section").find("#cashout_button").hide();
        $("#extra_bet_section .controls").addClass('bet-border-red');
        $("#extra_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', true)
        $("#extra_bet_section").find('.controls .navigation').addClass('stop-action')
        var bet_type = $("#extra_bet_now").parent().parent().parent().find(".navigation #bet_type").val(); // 0 - Normal, 1 - Auto
        let bet_amount = $("#extra_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val();

        if (bet_amount < min_bet_amount || bet_amount == '' || bet_amount == NaN) {
            bet_amount = parseFloat(min_bet_amount).toFixed(2);
        } else if (bet_amount > max_bet_amount) {
            bet_amount = parseFloat(max_bet_amount).toFixed(2);
        } else {
            bet_amount = parseFloat(bet_amount).toFixed(2);
        }

        $("#extra_bet_now").parent().parent().find(".bet-block .spinner #bet_amount").val(bet_amount);

        if (bet_amount >= min_bet_amount && bet_amount <= max_bet_amount) {

            if (bet_array.length == 1) {
                if (bet_array[0].section_no != section_no) {
                    bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
                }
            } else if (bet_array.length == 2) {
                if (bet_array[0].section_no != section_no && bet_array[1].section_no != section_no) {
                    bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
                }
            } else {
                bet_array.push({ bet_type: bet_type, bet_amount: bet_amount, section_no: section_no });
            }
        }
        $(".extra_bet_amount").prop('disabled', true);
        $("#extra_minus_btn").prop('disabled', true);
        $("#extra_plus_btn").prop('disabled', true);
        $(".extra_amount_btn").prop('disabled', true);
        $("#extra_checkout").prop('disabled', true);
        if ($("#extra_checkout").prop('checked')) {
            $("#extra_incrementor").prop('disabled', true);
        }


    } else {
        if (isCheckedCashout == false) {
            $("#extra_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', false)
            $("#extra_bet_section").find('.controls .navigation').removeClass('stop-action')
        } else {
            $("#extra_bet_section").parent().parent().find('.cashout-spinner-wrapper input').prop('disabled', true)
            $("#extra_bet_section").find('.controls .navigation').addClass('stop-action')
        }

        if (bet_array.length == 1) {
            bet_array.splice(0, 1); // Remove Perticular Bet
        } else if (bet_array.length == 2 && section_no == 0) {
            if (bet_array[0].section_no == 0) {
                bet_array.splice(0, 1); // Remove Perticular Bet
            } else {
                bet_array.splice(1, 1); // Remove Perticular Bet
            }
            
        } else if (bet_array.length == 2 && section_no == 1) {
            if (bet_array[0].section_no == 1) {
                bet_array.splice(0, 1); // Remove Perticular Bet
            } else {
                bet_array.splice(1, 1); // Remove Perticular Bet
            }
        }

        $("#extra_bet_section").find("#bet_button").show();
        $("#extra_bet_section").find("#cancle_button").hide();
        $("#extra_bet_section").find("#cancle_button #waiting").hide();
        $("#extra_bet_section").find("#cashout_button").hide();
        $("#extra_bet_section .controls").removeClass('bet-border-red');

        $(".extra_bet_amount").prop('disabled', false);
        $("#extra_minus_btn").prop('disabled', false);
        $("#extra_plus_btn").prop('disabled', false);
        $(".extra_amount_btn").prop('disabled', false);
        $("#extra_checkout").prop('disabled', false);
        if ($("#extra_checkout").prop('checked')) {
            $("#extra_incrementor").prop('disabled', false);
        }

    }

});


/*-----------------HINAL-----------------*/
function soundPlay() {
    let sound = document.getElementById("sound_Audio");
    if (document.hidden) {
        sound.pause();
    } else {
        if ($("#sound").prop("checked") == true) {
            if (window_blur == 0) {
                sound.play();
            } else {
                sound.pause();
            }

        } else {
            sound.pause();
        }
    }
}

function flyPlaneSound() {
    let sound = document.getElementById("fly_plane_audio");
    if (document.hidden) {
        sound.pause();
    } else {
        if ($("#sound").prop("checked") == true) {
            if (window_blur == 0) {
                sound.play();
            } else {
                sound.pause();
            }
        } else {
            sound.pause();
        }
    }
}

function cashOutSound() {
    let sound = document.getElementById("cash_out_audio");
    if (document.hidden) {
        sound.pause();
    } else {
        if ($("#sound").prop("checked") == true) {
            if (window_blur == 0) {
                sound.play();
            } else {
                sound.pause();
            }
        } else {
            sound.pause();
        }
    }
}

function cashOutSoundOtherSection() {
    let sound = document.getElementById("cash_out_audio_2");
    if (document.hidden) {
        sound.pause();
    } else {
        if ($("#sound").prop("checked") == true) {
            if (window_blur == 0) {
                sound.play();
            } else {
                sound.pause();
            }
        } else {
            sound.pause();
        }
    }
}

function backgroundSound() {
    let music = document.getElementById("background_Audio");
    if ($("#music").prop("checked") == true) {
        music.volume = 0.5;
        music.autoplay = true;
        music.loop = true;
        music.load();
    } else {
        music.pause();
    }
}

backgroundSound();
$("#music").on('change', function () {
    backgroundSound();
})

$(".main_bet_btn").on('click', function () {
    if (stage_time_out != 1) {
        let id = $(this).attr('id');
        if (id == 'main_bet_now') {
            $(".main_bet_amount").prop('disabled', true);
            $("#main_plus_btn").prop('disabled', true);
            $("#main_minus_btn").prop('disabled', true);
            $(".main_amount_btn").prop('disabled', true);
            $("#main_checkout").prop('disabled', true);
            $("#main_incrementor").prop('disabled', true);

        } else if (id == 'main_cancel_now') {
            $(".main_bet_amount").prop('disabled', false);
            $("#main_plus_btn").prop('disabled', false);
            $("#main_minus_btn").prop('disabled', false);
            $(".main_amount_btn").prop('disabled', false);
            $("#main_checkout").prop('disabled', false)
            if ($("#main_checkout").prop('checked')) {
                $("#main_incrementor").prop('disabled', false);
            }

        }

        if (id == 'extra_bet_now') {
            $(".extra_bet_amount").prop('disabled', true);
            $("#extra_minus_btn").prop('disabled', true);
            $("#extra_plus_btn").prop('disabled', true);
            $(".extra_amount_btn").prop('disabled', true);
            $("#extra_checkout").prop('disabled', true);
            $("#extra_incrementor").prop('disabled', true);
        } else if (id == 'extra_cancel_now') {
            $(".extra_bet_amount").prop('disabled', false);
            $("#extra_minus_btn").prop('disabled', false);
            $("#extra_plus_btn").prop('disabled', false);
            $(".extra_amount_btn").prop('disabled', false);
            $("#extra_checkout").prop('disabled', false);
            if ($("#extra_checkout").prop('checked')) {
                $("#extra_incrementor").prop('disabled', false);
            }

        }
    }
});

function check_login_status() {
    $.ajax({
        url: 'is_login',
        type: "POST",
        dataType: "json",
        success: function (result) {
            if (result.isSuccess == false) {
                window.location.href = 'login';
            }
        }
    });
}

function gameLoadingTimer() {
    let timer_no = 1;
    var game_loading_timer = setInterval(function () {
        if (timer_no <= 5) {
            if (timer_no == 1) {
                $('.loading-game').addClass('show');
            }
            timer_no++;
        } else {
            $(".loading-game").removeClass('show');
            clearInterval(game_loading_timer);
        }
    }, 1000); // for every second
}

let focus_timer = 0;
let focus_interval;
let visibility_timer = 0;
let visibility_interval;

$(window).focus(function () {
    // console.log('focused');
    // console.log(focus_timer);
    if (focus_timer > 10) {
        // location.reload();
    } else {
        focus_timer = 0;
        clearInterval(focus_interval);
    }
});

let window_blur = 0;
$(window).blur(function () {
    // console.log('blur');
    const music = document.getElementById("background_Audio");
    window_blur = 1;
    music.pause();
    focus_interval = setInterval(function () {
        focus_timer = parseInt(focus_timer + 1);
    }, 1000);
});


$(window).focus(function () {
    // console.log('blur');
    window_blur = 0;
    const music = document.getElementById("background_Audio");
    music.play();

});
document.addEventListener('visibilitychange', function (event) {
    if (document.hidden) {
        // console.log('not visible');
        visibility_interval = setInterval(function () {
            visibility_timer = parseInt(visibility_timer + 1);
        }, 1000);
    } else {
        // console.log(visibility_timer);
        // console.log('is visible');
        if (visibility_timer > 10) {
            // location.reload();
        } else {
            visibility_timer = 0;
            clearInterval(visibility_interval);
        }
    }
});

function enableDisable(section) {
    $(`#${section}`).find('.controls').addClass('dullEffect');
    setTimeout(function () {
        $(`#${section}`).find('.controls').removeClass('dullEffect');
    }, 200);
}

//khushbu for validate auto cash textbox
function main_incrementor_change(new_value) {
    if (new_value < 1.01) {
        $("#main_incrementor").val("1.01");
    } else {
        $("#main_incrementor").val(parseFloat(new_value).toFixed(2));
    }
}
function extra_incrementor_change(new_value) {
    if (new_value < 1.01) {
        $("#extra_incrementor").val("1.01");
    } else {
        $("#extra_incrementor").val(parseFloat(new_value).toFixed(2));
    }
}
function hide_loading_game() {
    $('.loading-game').removeClass('show');
}
// function getGameStatus() {
//     var status = 0;
//     $.ajax({
//         url: 'getGameStatus',
//         type: "get",
//         dataType: "json",
//         success: function(response) {
//             console.log(response['gameStatus'][0].value);
//             status = response;
//         }
//     })
//     return status;
// }
// khushbu for when come from minimize refresh page
$(window).bind("pageshow", function (event) {
    if (event.originalEvent.persisted) {
        $(".load-txt").show();
    }
});

$(".fill-line").bind('oanimationend animationend webkitAnimationEnd', function () {
    // console.log('-----anime---end-----');
    $(".game-centeral-loading").hide();
    $('bottom-left-plane').show();
});

$(".fill-line").bind('oanimationstart animationstart webkitAnimationStart', function () {
    // console.log('-----anime---start-----');
    $(".game-centeral-loading").show();
});

/*-------HINAL (START)-------*/

// $(document).click(function () {
//     if ($(".button-block").hasClass('show')) {
//         $(".button-block").removeClass('show');
//     }
// });

$(".history-top").click(function (e) {
    e.stopPropagation(); // This is the preferred method.
    return false;        // This should not be used unless you dodo not want
});

/*-------HINAL (END)-------*/