import {Timer} from "./timer.js";
import {Book} from "./book.js";
import { Box} from "./box.js";

class Game {
    totalBooks = 20;
    actualBooks = 0;
    caughtBooks = 0;
    books = [];
    box = new Box();
    gameSeconds = this.totalBooks + 13;
    timer = new Timer();

    constructor() {
        this.timer.callback = () => this.gameTick();
        document.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById("start").onclick = () => this.start();
            for (let i = 0; i < this.totalBooks; i++) {
                this.books[i] = new Book(13000);
            }
        });
        document.addEventListener('keydown',(evt) => this.control(this.box,this.books,evt));
    }

    control(box, books, evt) {
        if (evt.key == 'ArrowRight') {
            box.setPositionRight();
        } else if (evt.key == 'ArrowLeft') {
            box.setPositionLeft();
        } else if (evt.key == 'Shift') {
            this.controlCatch(box, books);
        }
    }

    controlCatch(box, books) {
        for (let i = 0; i < books.length; i++) {
            if (this.controlBook(books[i],box)) {
                books[i].setPicture();
                this.bookCatch();
            }
        }
    }

    controlBook(book, box) {
        let boxX = box.getPosition().x;
        let boxY = box.getPosition().y;
        let x = book.getPosition().x;
        let y = book.getPosition().y;
        if (boxX <= x && boxX + 100 >= x && boxY - 30 <= y && boxY + 30 >= y && book.getActive()) {
            book.setActive();
            return true;
        } else {
            return false;
        }
    }

    bookCatch() {
        this.caughtBooks++;
        this.redrawScore();
    }

    gameTick() {
        if (this.gameSeconds > 0) {
            this.gameSeconds--;
            if (this.actualBooks < this.totalBooks) {
                this.books[this.actualBooks].doElement();
                this.actualBooks++;
            }
            this.redrawScore();
        } else {
            this.timer.stop();
        }
        document.getElementById("timer").innerText = this.gameSeconds.toString();
    }

    redrawScore() {
        document.getElementById("score").innerText = this.caughtBooks.toString() + '/' + this.totalBooks.toString();
    }

    start() {
        this.redrawScore();
        this.timer.start();
    }
}
export {Game};