import {Timer} from "./timer.js";

class Book {
    timer = null;
    book = null;
    active = false;
    backgroundPicture = ["url('../fly/img/book1.png')", "url('../fly/img/book2.png')", "url('../fly/img/book3.png')", "url('../fly/img/book4.png')","url('../fly/img/book5.png')"];
    constructor(interval) {
        this.timer = new Timer(interval);
        this.timer.callback = () => this.hideBook();
        this.createBook();
    }

    createBook() {
        this.book = document.createElement('div');
        this.book.className = 'book';
        this.book.style.backgroundImage = this.backgroundPicture[Math.round(Math.random() * 10) % 5];
        document.body.appendChild(this.book);
        this.changePosition();
        this.hideBook()
    }

    changePosition() {
        this.book.style.left = Math.random() * (window.innerWidth - this.book.offsetWidth) + "px";
        this.book.style.top = 0 + "px";
        this.book.style.transform = 'rotate(' + (Math.random() * 360) + 'deg)';
    }

    doElement() {
        this.showBook();
        this.moveBook();
    }

    moveBook() {
        let start = Date.now();
        let book = this.book;
        let timer = setInterval(function() {
            let timePassed = Date.now() - start;
            book.style.top = timePassed / 20 + 'px';
            if (timePassed > 13000) clearInterval(timer);
        }, 20);

    }

    showBook () {
        this.timer.start();
        this.book.style.display = "block";
        this.active = true;
    }

    hideBook() {
        this.timer.stop();
        this.book.style.display = "none";
        this.active = false;
    }

    getPosition() {
        return this.book.getBoundingClientRect();
    }

    getActive() {
        return this.active;
    }
    setActive() {
        this.active = false;
    }

    setPicture() {
        this.book.style.backgroundImage = "url('../fly/img/stars1.png')";
    }
}

export {Book}
