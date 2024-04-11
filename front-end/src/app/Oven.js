class Oven {

    /**
     * Represents an Oven object.
     * @constructor
     * @param {number} width - The width of the oven.
     * @param {number} height - The height of the oven.
     */
    constructor(width, height) {
        this._id = crypto.randomUUID();
        this._width = width;
        this._height = height;
        this._on = false;
        this._lamp = false;
        this._opened = false;
    }

    /**
     * Toggles the state of the oven.
     */
    onToggle() {
        this._on = !this._on;
    }

    /**
     * Toggles the state of the lamp in the oven.
     */
    lampToggle() {
        this._lamp = !this._lamp;
    }

    /**
     * Toggles the state of the oven door.
     */
    doorToggle() {
        this._opened = !this._opened;
    }

    /* --- */

    /**
     * Creates an oven element and appends it to the ovenBox container.
     */
    createOven() {
        const ovenDiv = document.createElement('div');
        ovenDiv.id = `oven_${this._id}`;
        ovenDiv.className = 'oven';
        ovenDiv.setAttribute('onclick', `stove.doorSwitch("${this._id}")`);

        const ovenBackDiv = document.createElement('div');
        ovenBackDiv.className = 'ovenBack';

        const fireDiv = document.createElement('div');
        fireDiv.className = 'fire';

        const ovenDoorDiv = document.createElement('div');
        ovenDoorDiv.className = 'ovenDoor opened';

        const glassDiv = document.createElement('div');
        glassDiv.className = 'glass';

        const brandDiv = document.createElement('div');
        brandDiv.className = 'brand';

        const ovenWidthDiv = document.createElement('div');
        ovenWidthDiv.className = 'ovenWidth';
        ovenWidthDiv.innerHTML = this._width;

        const ovenHeightDiv = document.createElement('div');
        ovenHeightDiv.className = 'ovenHeight';
        ovenHeightDiv.innerHTML = this._height;

        ovenBackDiv.appendChild(fireDiv);
        ovenDoorDiv.appendChild(glassDiv);
        ovenDoorDiv.appendChild(brandDiv);

        ovenDiv.appendChild(ovenBackDiv);
        ovenDiv.appendChild(ovenDoorDiv);
        ovenDiv.appendChild(ovenWidthDiv);
        ovenDiv.appendChild(ovenHeightDiv);

        document.querySelector('.ovenBox').appendChild(ovenDiv);
    }

    /**
     * Creates a lamp element and appends it to the lampBox container.
     */
    createLamp() {
        const lampDiv = document.createElement('div');
        lampDiv.id = `lamp_${this._id}`;
        lampDiv.className = 'lampBtn';
        lampDiv.setAttribute('onclick', `stove.lampSwitch("${this._id}")`);
        document.querySelector('.lampBox').appendChild(lampDiv);
    }

    /**
     * Toggles the oven door open or closed.
     */
    doorSwitch() {
        if (!this._opened) {
            document.querySelector(`#oven_${this._id} .ovenDoor`).classList.add('on');

            this.doorToggle();
        } else {
            document.querySelector(`#oven_${this._id} .ovenDoor`).classList.remove('on');

            this.doorToggle();
        }
    }


    /**
     * Toggles the lamp switch of the oven.
     */
    lampSwitch() {
        if (!this._lamp) {
            document.querySelector(`#oven_${this._id} .glass`).classList.add('on');
            document.querySelector(`#oven_${this._id} .ovenBack`).classList.add('on');

            this.lampToggle();
        } else {
            document.querySelector(`#oven_${this._id} .glass`).classList.remove('on');
            document.querySelector(`#oven_${this._id} .ovenBack`).classList.remove('on');

            this.lampToggle();
        }
    }
}