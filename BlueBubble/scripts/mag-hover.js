$(function() {
// OPACITY OF BUTTON SET TO 0%
$(".roll").css("opacity","0");
 
// ON MOUSE OVER
$(".roll").hover(function () {
 
// SET OPACITY TO 70%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 50%
$(this).stop().animate({
opacity: 0
}, "slow");
});

// FUNCTION FOR 3 COLUMN FULL
$(".roll-3full").css("opacity","0");
 
// ON MOUSE OVER
$(".roll-3full").hover(function () {
 
// SET OPACITY TO 70%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 50%
$(this).stop().animate({
opacity: 0
}, "slow");
});

// FUNCTION FOR 3 COLUMN SIDEBAR
$(".roll-3col").css("opacity","0");
 
// ON MOUSE OVER
$(".roll-3col").hover(function () {
 
// SET OPACITY TO 70%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 50%
$(this).stop().animate({
opacity: 0
}, "slow");
});

// FUNCTION FOR 4 COLUMN SIDEBAR
$(".roll-4col").css("opacity","0");
 
// ON MOUSE OVER
$(".roll-4col").hover(function () {
 
// SET OPACITY TO 60%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 60%
$(this).stop().animate({
opacity: 0
}, "slow");
});

// FUNCTION FOR 5 COLUMN SIDEBAR
$(".roll-5col").css("opacity","0");
 
// ON MOUSE OVER
$(".roll-5col").hover(function () {
 
// SET OPACITY TO 60%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 60%
$(this).stop().animate({
opacity: 0
}, "slow");
});

// FUNCTION FOR MULTIVIEW PORTFOLIO
$(".roll-multi").css("opacity","0");
 
// ON MOUSE OVER
$(".roll-multi").hover(function () {
 
// SET OPACITY TO 60%
$(this).stop().animate({
opacity: .6
}, "slow");
},
 
// ON MOUSE OUT
function () {
 
// SET OPACITY BACK TO 60%
$(this).stop().animate({
opacity: 0
}, "slow");
});


});
