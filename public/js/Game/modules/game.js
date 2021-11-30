import {Timer} from "./timer.js";
import {Book} from "./book.js";
import { Box} from "./box.js";

class Game {
    totalBooks = 20;
    actualBooks;
    caughtBooks;
    books = [];
    box = new Box();
    gameSeconds;
    timer;
    game;
    numberOfGames = 0;

    constructor() {
        this.inicialization();
        document.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById("start").onclick = () => this.start();
            for (let i = 0; i < this.totalBooks; i++) {
                this.books[i] = new Book(13000);
            }
        });
        document.addEventListener('keydown',(evt) => this.control(this.box,this.books,evt));
    }

    inicialization() {
        this.actualBooks = 0;
        this.caughtBooks = 0;
        this.gameSeconds = this.totalBooks + 13;
        this.timer = new Timer();
        this.game = true;
        this.timer.callback = () => this.gameTick();
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
                books[i].hideBook();
                this.bookCatch();
            }
        }
    }

    controlBook(book, box) {
        let boxX = box.getPosition().x;
        let boxY = box.getPosition().y;
        let x = book.getPosition().x;
        let y = book.getPosition().y;
        if (boxX <= x && boxX + 150 >= x && boxY - 50 <= y && boxY + 50 >= y && book.getActive()) {
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
            this.stop();
        }
        document.getElementById("timer").innerText = this.gameSeconds.toString();
    }

    stop() {
        this.timer.stop();
        this.game = true;
        this.numberOfGames++;
    }

    redrawScore() {
        document.getElementById("score").innerText = this.caughtBooks.toString() + '/' + this.totalBooks.toString();
    }

    start() {
        if (this.game) {
            if (this.numberOfGames != 0 ) {
                this.inicialization();
            }
            this.redrawScore();
            this.timer.start();
            this.game = false;
        }
    }
}
export {Game};