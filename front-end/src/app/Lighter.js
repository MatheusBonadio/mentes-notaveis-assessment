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
     * @param {string} uuid_burner - The UUID of the burner.
     */
    createLighterBurner(uuid_burner) {
        let lighterDiv = document.createElement('div');
        lighterDiv.id = `lighter_${this._id}`;
        lighterDiv.classList.add('lighterBtn');
        lighterDiv.setAttribute('style', `background-color: ${this._color}`);

        lighterDiv.setAttribute('onclick', `stove.burnerSwitch(this, "${this._id}", "${uuid_burner}")`);

        var burners = document.querySelectorAll('[onclick^="stove.burnerSwitch"]');

        if (burners.length == 0) {
            document.querySelector('.lighterBox').appendChild(lighterDiv);
        } else {
            burners[burners.length - 1].after(lighterDiv)
        }
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
     * Toggles the state of a burner switch.
     * 
     * @param {HTMLElement} element - The element representing the burner switch.
     * @param {string} uuid_burner - The UUID of the burner.
     */
    burnerSwitch(element, uuid_burner) {
        if (!this._lited) {
            element.classList.add('on');
            document.querySelector(`#burner_${uuid_burner}`).classList.add('on');

            this.litedToggle();
        } else {
            element.classList.remove('on');
            document.querySelector(`#burner_${uuid_burner}`).classList.remove('on');

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