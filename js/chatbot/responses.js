function getBotResponse(input) {

    //rock paper scissors

    if (input == "hello") {

        return "I'm here to assist you with any questions or problems you may have. What can I help you with today? 🤗";

    } else if (input == "paper") {

        return "scissors";

    } else if (input == "scissors") {

        return "rock";

    }



    // Simple responses

    if (input == "Deposit Related Query?" || input == "Deposit related" || input == "Deposit" || input == "deposit" || input == "deposit related query" ||  input == "deposit related" ) {

        return "a) Deposit request placed but deposit not reflected in wallet.<br> b) Variation in Deposited Amount & Playing Wallet Amount.";

    } 

    else if (input == "Withdrawal Related Query?" || input == "Withdrawal related" || input == "Withdrawal" || input == "withdrawal" || input == "withdrawal related query" ||  input == "withdrawal related") {

        return "1) Withdrawal Request Placed But Withdrawal Not Received in Bank Account.<br> 2)Variation in withdrawal amount request amount & credited amount into bank account.";

    } 

    else if (input == "Application Related Query?" || input == "Application related" || input == "Application" || input == "application" || input == "application related query" ||  input == "application related") {

        return "i) Please Rate Us If You Loved The Experience of Playing with us.<br> ii) Suggestions Are also Welcome.";

    } 

    else if (input == "Deposit Request Placed But Deposit Not Reflected in Playing Wallet" || input == "a" || input == "b") {

        return "We are extremely sorry for the inconvenience caused. A ticket has been created to solve this issue. We request you to kindly wait for 24hrs. Our team is working hard to serve you.";

    } 

    else if (input == "variation in deposited amount & playing wallet amount" || input == "b" || input == "b") {

        return "We are extremely sorry for the inconvenience caused. A ticket has been created to solve this issue. We request you to kindly wait for 24hrs. Our team is working hard to serve you.";

    } 

    else if (input == "withdrawal request placed but withdrawal not received in bank account" || input == "1" || input == "2") {

        return "We are extremely sorry for the inconvenience caused. A ticket has been created to solve this issue. We request you to kindly wait for 24hrs. Our team is working hard to serve you.";

    } 

    else if (input == "variation in withdrawal amount request amount & credited amount into bank account" || input == "1" || input == "2") {

        return "We are extremely sorry for the inconvenience caused. A ticket has been created to solve this issue. We request you to kindly wait for 24hrs. Our team is working hard to serve you.";

    } 

    else if (input == "Please Rate Us If You Loved The Experience of Playing with us" || input == "i" || input == "2") {

        return "Thanks For Your Rating";

    } 

    else if (input == "Suggestions Are also Welcome." || input == "ii" || input == "ii") {

        return "Thanks For Your Suggestoin. We will sure think about this";

    } 

    else if (input !== "") {

        return "Thanks For Your Feedback !  🤗";

        // return "I'm here to assist you with any questions or problems you may have. What can I help you with today? 🤗";

    } 

    else {

        return "Try asking something else!";

    }

}