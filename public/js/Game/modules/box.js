class Box {
    box = document.getElementById('box');
    actualLeft = 0;

    constructor() {
        this.box.style.left = this.actualLeft + "px";
    }

    setPositionRight() {
        if (this.actualLeft + 20 <= window.outerWidth) {
            this.actualLeft += 20;
            this.box.style.left = this.actualLeft + "px";
        }
    }
    setPositionLeft() {
        if (this.actualLeft - 20 >= -20) {
            this.actualLeft -= 20;
            this.box.style.left = this.actualLeft + "px";
        }
    }

    getPosition() {
        return this.box.getBoundingClientRect();
    }
}

export {Box}