import { Game} from "./modules/game.js";

if (window.location.href.split("/")[4] == '?c=game&a=game') {
    new Game();
}