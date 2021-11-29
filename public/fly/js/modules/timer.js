class Timer {

    interval;
    timerId = null;
    _callback = null;



    constructor(interval = 1000) {
        this.interval = interval;
    }

    start() {
        //this.stop();
        this.timerId = window.setInterval(this._callback, this.interval);
    }

    stop() {
        if (this.timerId != null) {
            window.clearInterval(this.timerId);
        }
        this.timerId = null;
    }

    set callback(callback) {
        this._callback =  callback;
    }
}

export {Timer};