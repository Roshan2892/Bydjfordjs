$(".header_share").jsSocials({
      url: "http://bydjfordjs.in/",
      showLabel: false,
      showCount: false,
      shareIn: "popup",
      shares: [ "twitter", "facebook", "googleplus", "whatsapp"]
});


$(".share").each(function() {
    $(this).jsSocials({
        showLabel: false,
        showCount: false,
        shareIn: "popup",
        shares: [ "twitter", "facebook", "googleplus", "whatsapp" ]
    });
});

