/**
 * Represents a lighter.
 */
class Lighter {

    /**
     * Creates a new instance of the Lighter class.
     * @param {string} color - The color of the lighter.
     */
    constructor(color) {
        this._id = crypto.randomUUID();
        this._color = color;
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
     * Creates a lighter burner element and appends it to the DOM.
     */
    createLighterBurner() {
        let lighterDiv = document.createElement('div');
        lighterDiv.id = `lighter_${this._id}`;
        lighterDiv.classList.add('lighterBtn');
        lighterDiv.setAttribute('style', `background-color: ${this._color}`);

        lighterDiv.setAttribute('onclick', `stove.burnerSwitch(this, "${this._id}")`);

        document.querySelector('.lighterBox').appendChild(lighterDiv);
    }


    /**
     * Creates a lighter for the oven.
     * 
     * @param {string} uuid_oven - The UUID of the oven.
     */
    createLighterOven(uuid_oven) {
        let lighterDiv = document.createElement('div');
        lighterDiv.id = `lighter_${this._id}`
        lighterDiv.classList.add('lighterBtn', 'ovenLighter');
        lighterDiv.setAttribute('style', `background-color: ${this._color}`);

        lighterDiv.setAttribute('onclick', `stove.ovenSwitch(this, "${this._id}", "${uuid_oven}")`);

        document.querySelector('.lighterBox').appendChild(lighterDiv);
    }

    /**
     * Toggles the state of a burner element.
     * @param {HTMLElement} element - The burner element to toggle.
     * @param {int} index - The index of the burner element.
     */
    burnerSwitch(element, index) {
        if (!this._lited) {
            element.classList.add('on');
            document.querySelector(`#burner_${index}`).classList.add('on');

            this.litedToggle();
        } else {
            element.classList.remove('on');
            document.querySelector(`#burner_${index}`).classList.remove('on');

            this.litedToggle();
        }
    }

    /**
     * Toggles the state of an oven element.
     * @param {HTMLElement} element - The oven element to toggle.
     * @param {string} uuid_oven - The unique identifier for the oven.
     */
    ovenSwitch(element, uuid_oven) {
        if (!this._lited) {
            element.classList.add('on');
            document.querySelector(`#oven_${uuid_oven}`).classList.add('on');

            this.litedToggle();
        } else {
            element.classList.remove('on');
            document.querySelector(`#oven_${uuid_oven}`).classList.remove('on');

            this.litedToggle();
        }
    }

}