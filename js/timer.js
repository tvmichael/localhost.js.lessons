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

    var step = 1;
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
        var mometTime = new Date(),
            s = Number(secondText.innerHTML),
            m = Number(minuteText.innerHTML),
            h = Number(hourText.innerHTML);

        if (s > 0) {
            s = s - 1;
        }
        else{
            if (m > 0){
                m = m - 1;
                s = 59;
            }
            else {
                if (h > 0){
                    h = h - 1;
                    s = 59;
                    m = 59;
                }
                else {
                    console.log('END!')
                    clearInterval(myVar);
                }

            }

        }
        secondText.innerHTML = s;
        minuteText.innerHTML = m;
        hourText.innerHTML = h;
        //mometTime = parseInt(mometTime.getTime()/1000);
        //console.log('mt=' + mometTime + '  cd=' + countDownDate + ' -- ' + Number(countDownDate - mometTime));
    }
    startTimer.onclick = function () {
        var hx = Number(hourText.innerHTML) * 3600 +
                 Number(minuteText.innerHTML) * 60 +
                 Number(secondText.innerHTML);
        countDownDate = new Date();
        countDownDate = parseInt(countDownDate.getTime()/1000) + hx;
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
