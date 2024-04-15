/**
 * Represents a lighter.
 */
class Burner {

    constructor() {
        this._id = crypto.randomUUID();
        this._lited = false;
    }

    /**
     * Toggles the state of the lighter (lit or unlit).
     */
    litedToggle() {
        this._lited = !this._lited;
    }

    /* --- */

    /**
     * Creates a burner element and appends it to the burnerBox container.
     */
    createBurner() {
        let burnerDiv = document.createElement('div');
        burnerDiv.id = `burner_${this._id}`;
        burnerDiv.classList.add('burner')
        document.querySelector('.burnerBox').appendChild(burnerDiv);
    }
}