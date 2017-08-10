;(function () {
    console.log('Start');

    // Today date --------------------------------------------------------------------
    var todayDate = new Date();
    todayDate = todayDate.getDate() + '.'
        + (parseInt(todayDate.getMonth())+1) + '.'
        + todayDate.getFullYear();
    document.getElementById("today-date").innerHTML = todayDate;



    // Set time ----------------------------------------------------------------------
    var hourText = document.getElementById('hour-text');
    var hourUp = document.getElementById('hour-up');
    hourUp.onclick = function () {
        var h = Number(hourText.innerHTML) + 1;
        if (h <= 24) hourText.innerHTML = h;
    }
    var hourDown = document.getElementById('hour-down');
    hourDown.onclick = function () {
        var h = Number(hourText.innerHTML) - 1;
        if (h >= 0) hourText.innerHTML = h;
    }

    var step = 5;
    var minuteText = document.getElementById('minute-text');
    var minuteUp = document.getElementById('minute-up');
    minuteUp.onclick = function () {
        var m = Number(minuteText.innerHTML) + step;
        if (m < 60) {
            minuteText.innerHTML = m
        }
        else {
            var h = Number(hourText.innerHTML) + 1;
            if (h <=24) hourText.innerHTML = h;
            minuteText.innerHTML = 0;
        }

    }
    var minuteDown = document.getElementById('minute-down');
    minuteDown.onclick = function () {
        var m = Number(minuteText.innerHTML) - step;
        if (m > 0){
            minuteText.innerHTML = m;
        }
        else{
            var h = Number(hourText.innerHTML) - 1;
            if (h >= 0) hourText.innerHTML = h;
            if (h != -1 ) minuteText.innerHTML = 55;
        }
    }
    var secondText = document.getElementById('second-text');



    // Start timer ------------------------------------------------------------------
    var startTimer = document.getElementById('start-clock');
    var myVar;
    var countDownDate;
    function myTimer() {
        var h = Number(hourText.innerHTML),
            m = Number(minuteText.innerHTML),
            s = Number(secondText.innerHTML);


        var now = new Date().getTime();
        var distance = countDownDate - now;

        hourText.innerHTML = h;
        minuteText.innerHTML = m;
        secondText.innerHTML = s;
        console.log(countDownDate + '>> ' + h + ':' + m + ':' + s);
    }
    startTimer.onclick = function () {
        countDownDate = new Date().getTime() + ;
        if (startTimer.innerHTML == 'Start') {
            myVar = setInterval(myTimer, 1000);
            startTimer.innerHTML = 'Stop';
        }
        else
        {
            clearInterval(myVar);
            startTimer.innerHTML = 'Start';
        }
    }



})()
